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
            'blogs_count' => \App\Models\Blog::count(),
            'services_count' => \App\Models\Service::count(),
        ];
        return view('admin.index', compact('stats'));
    }

    public function leads()
    {
        $leads = \App\Models\Lead::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.leads.index', compact('leads'));
    }

    public function leadDetails(\App\Models\Lead $lead)
    {
        return view('admin.leads.details', compact('lead'));
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
