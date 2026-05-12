<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'leads_count' => \App\Models\Lead::count(),
            'faqs_count' => \App\Models\Faq::count(),
            'stories_count' => \App\Models\SuccessStory::count(),
            'testimonials_count' => \App\Models\Testimonial::count(),
            'treatment_types_count' => \App\Models\TreatmentType::count(),
            'gallery_count' => \App\Models\Gallery::count(),
            'blogs_count' => \App\Models\Blog::count(),
            'services_count' => \App\Models\Service::count(),
        ];
        $recent_leads = \App\Models\Lead::orderBy('created_at', 'desc')->take(5)->get();
        return view('admin.index', compact('stats', 'recent_leads'));
    }

    public function leads()
    {
        $query = \App\Models\Lead::query();

        if (request()->filled('q')) {
            $search = trim((string) request('q'));
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('subject', 'like', "%{$search}%")
                    ->orWhere('message', 'like', "%{$search}%");
            });
        }

        if (request()->filled('consultation_type')) {
            $query->where('consultation_type', request('consultation_type'));
        }

        if (request()->filled('preferred_location')) {
            $query->where('preferred_location', request('preferred_location'));
        }

        if (request()->filled('subject')) {
            $query->where('subject', request('subject'));
        }

        if (request()->filled('date_from')) {
            $query->whereDate('created_at', '>=', request('date_from'));
        }

        if (request()->filled('date_to')) {
            $query->whereDate('created_at', '<=', request('date_to'));
        }

        $leads = $query->orderBy('created_at', 'desc')->get();
        $locations = \App\Models\Lead::whereNotNull('preferred_location')->where('preferred_location', '!=', '')->distinct()->pluck('preferred_location');
        $subjects = \App\Models\Lead::whereNotNull('subject')->where('subject', '!=', '')->distinct()->pluck('subject');

        return view('admin.leads.index', compact('leads', 'locations', 'subjects'));
    }

    public function exportLeadsCsv(Request $request)
    {
        $query = \App\Models\Lead::query();

        if ($request->filled('q')) {
            $search = trim((string) $request->input('q'));
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('subject', 'like', "%{$search}%")
                    ->orWhere('message', 'like', "%{$search}%");
            });
        }

        if ($request->filled('consultation_type')) {
            $query->where('consultation_type', $request->input('consultation_type'));
        }

        if ($request->filled('preferred_location')) {
            $query->where('preferred_location', $request->input('preferred_location'));
        }

        if ($request->filled('subject')) {
            $query->where('subject', $request->input('subject'));
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->input('date_from'));
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->input('date_to'));
        }

        $leads = $query->orderBy('created_at', 'desc')->get();

        $dynamicKeys = [];
        foreach ($leads as $lead) {
            if (is_array($lead->dynamic_data)) {
                foreach ($lead->dynamic_data as $key => $value) {
                    if (!in_array($key, $dynamicKeys, true)) {
                        $dynamicKeys[] = $key;
                    }
                }
            }
        }

        $headers = array_merge([
            'id',
            'created_at',
            'first_name',
            'last_name',
            'full_name',
            'email',
            'phone',
            'subject',
            'consultation_type',
            'preferred_location',
            'message',
            'status',
        ], $dynamicKeys);

        $filename = 'leads-' . now()->format('Y-m-d-His') . '.csv';

        return response()->streamDownload(function () use ($leads, $headers, $dynamicKeys) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $headers);

            foreach ($leads as $lead) {
                $row = [
                    $lead->id,
                    optional($lead->created_at)->format('Y-m-d H:i:s'),
                    $lead->first_name,
                    $lead->last_name,
                    trim(($lead->first_name ?? '') . ' ' . ($lead->last_name ?? '')),
                    $lead->email,
                    $lead->phone,
                    $lead->subject,
                    $lead->consultation_type,
                    $lead->preferred_location,
                    $lead->message,
                    $lead->status,
                ];

                foreach ($dynamicKeys as $key) {
                    $row[] = is_array($lead->dynamic_data) && array_key_exists($key, $lead->dynamic_data)
                        ? (string) $lead->dynamic_data[$key]
                        : '';
                }

                fputcsv($handle, $row);
            }

            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    public function leadDetails(\App\Models\Lead $lead)
    {
        return view('admin.leads.details', compact('lead'));
    }

    public function destroyLead(\App\Models\Lead $lead)
    {
        $lead->delete();
        return redirect()->route('admin.leads')->with('success', 'Lead deleted successfully.');
    }

    public function faqs()
    {
        $faqs = \App\Models\Faq::orderBy('order')->get();
        return view('admin.faqs.index', compact('faqs'));
    }

    public function stories()
    {
        $stories = \App\Models\SuccessStory::orderBy('order')->get();
        return view('admin.stories.index', compact('stories'));
    }

    public function settings()
    {
        $settings = \App\Models\SiteSetting::all();
        return view('admin.settings.index', compact('settings'));
    }

    public function settingsUpdate(Request $request)
    {
        // Handle text settings
        if ($request->has('settings')) {
            foreach ($request->settings as $key => $value) {
                \App\Models\SiteSetting::where('key', $key)->update(['value' => $value]);
            }
        }

        // Handle file uploads (Logos)
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $key => $file) {
                if ($file->isValid()) {
                    $path = $file->store('settings', 'public');
                    \App\Models\SiteSetting::where('key', $key)->update(['value' => $path]);
                }
            }
        }

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
}
