<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\QuizQuestion;
use App\Models\QuizSubmission;

class FrontendController extends Controller
{
    public function index()
    {
        $faqs = \App\Models\Faq::where('is_active', true)->orderBy('order')->get();
        $stories = \App\Models\SuccessStory::where('is_active', true)->orderBy('order')->take(4)->get();
        $sliders = \App\Models\Slider::where('is_active', true)->orderBy('order')->get();
        $settings = \App\Models\SiteSetting::all()->pluck('value', 'key');
        $services = \App\Models\Service::where('is_active', true)->orderBy('order')->get();
        $blogs = \App\Models\Blog::where('is_active', true)->orderBy('created_at', 'desc')->take(4)->get();

        return view('frontend.index', compact('faqs', 'stories', 'sliders', 'settings', 'services', 'blogs'));
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function blog()
    {
        $blogs = \App\Models\Blog::where('is_active', true)->orderBy('created_at', 'desc')->get();
        $categories = \App\Models\Blog::where('is_active', true)
            ->select('category', DB::raw('count(*) as total'))
            ->groupBy('category')
            ->get();

        return view('frontend.blog', compact('blogs', 'categories'));
    }

    public function blogDetails($slug)
    {
        $blog = \App\Models\Blog::with('category_rel')->where('slug', $slug)->where('is_active', true)->firstOrFail();
        $relatedBlogs = \App\Models\Blog::with('category_rel')->where('id', '!=', $blog->id)
            ->where('is_active', true)
            ->where('category_id', $blog->category_id)
            ->limit(2)
            ->get();
        return view('frontend.blog-details', compact('blog', 'relatedBlogs'));
    }

    public function contact()
    {
        $settings = \App\Models\SiteSetting::all()->pluck('value', 'key');
        $dynamicFields = \App\Models\ContactField::orderBy('order')->get();
        return view('frontend.contact', compact('settings', 'dynamicFields'));
    }

    public function contactSubmit(Request $request)
    {
        $selectedCategory = $request->input('consultation_type');
        $fields = \App\Models\ContactField::where(function ($q) use ($selectedCategory) {
            $q->where('category', 'all');
            if (!empty($selectedCategory)) {
                $q->orWhere('category', $selectedCategory);
            }
        })->get();
        $rules = [];
        // Base field validations
        $rules['first_name'] = ['required', 'string', 'max:255'];
        $rules['last_name'] = ['required', 'string', 'max:255'];
        $rules['email'] = ['required', 'email', 'max:255'];
        $rules['phone'] = ['required', 'regex:/^\d{10}$/'];
        $rules['primary_concern'] = ['required', 'string', 'max:255'];
        $rules['preferred_location'] = ['nullable', 'string', 'max:255'];
        $rules['consultation_type'] = ['required', 'in:inclinic_visit,online_consultation,whatsapp'];
        $rules['message'] = ['required', 'string', 'min:10'];

        foreach ($fields as $field) {
            $fieldRules = $field->is_required ? ['required'] : ['nullable'];
            switch ($field->type) {
                case 'email':
                    $fieldRules[] = 'email';
                    break;
                case 'tel':
                    $fieldRules[] = 'regex:/^\d{10}$/';
                    break;
                case 'number':
                    $fieldRules[] = 'numeric';
                    break;
                case 'date':
                    $fieldRules[] = 'date';
                    break;
                case 'select':
                    // build in: rule from options if available
                    if (!empty($field->options)) {
                        $opts = array_filter(array_map('trim', explode(',', $field->options)));
                        if (!empty($opts)) {
                            $fieldRules[] = 'in:' . implode(',', array_map(function ($o) {
                                return str_replace(',', '', $o);
                            }, $opts));
                        }
                    }
                    break;
                default:
                    $fieldRules[] = 'string';
                    break;
            }

            $rules[$field->name] = $fieldRules;
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Prepare lead data
        $firstName = $request->input('first_name', '');
        $lastName = $request->input('last_name', '');
        $email = $request->input('email', '');
        $phone = $request->input('phone', '');
        $subject = $request->input('primary_concern', 'General Inquiry');
        $message = $request->input('message', 'No message provided');
        $preferredLocation = $request->input('preferred_location', null);
        $consultationType = $request->input('consultation_type', 'inclinic_visit');

        // Capture all dynamic data
        $dynamicData = [];
        foreach ($fields as $field) {
            // Skip fields already mapped to main columns
            if (in_array($field->name, ['first_name', 'last_name', 'email', 'phone', 'message', 'primary_concern'])) {
                continue;
            }
            if ($request->has($field->name)) {
                $dynamicData[$field->label] = $request->input($field->name);
            }
        }

        \App\Models\Lead::create([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'phone' => $phone,
            'subject' => $subject,
            'consultation_type' => $consultationType,
            'preferred_location' => $preferredLocation,
            'message' => $message,
            'dynamic_data' => $dynamicData
        ]);

        return response()->json(['success' => true]);
    }

    public function faq()
    {
        $faqs = \App\Models\Faq::where('is_active', true)->orderBy('order')->get();
        // Since category is nullable, we filter out nulls/empties. We also use values() to reset keys after filtering.
        $categories = $faqs->pluck('category')->filter()->unique()->values();
        return view('frontend.faq', compact('faqs', 'categories'));
    }

    public function gallery()
    {
        return view('frontend.gallery');
    }

    public function privacyPolicy()
    {
        return view('frontend.privacy-policy');
    }

    public function quiz()
    {
        $questions = QuizQuestion::where('is_active', true)->orderBy('order')->get();
        return view('frontend.quiz', compact('questions'));
    }

    public function quizSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'answers' => 'required|array'
        ]);

        // Optionally compute a local yes count for messaging, but do not store or expose it.
        $yesCount = 0;
        foreach ($request->answers as $ans) {
            if ($ans === 'Yes') $yesCount++;
        }

        $submission = QuizSubmission::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'city' => $request->city,
            'answers_json' => $request->answers,
        ]);

        $resultMsg = '';
        if ($yesCount === 0) {
            $resultMsg = 'Based on your responses, you have no immediate red flags. However, if you are planning to conceive, a routine consultation with Dr. Yuvi is always a great first step.';
        } else if ($yesCount <= 3) {
            $resultMsg = 'You answered "Yes" to several concerns. Consider booking a consultation to explore options and get a personalised care plan.';
        } else {
            $resultMsg = 'Your responses indicate multiple concerns; we recommend a comprehensive clinical evaluation with Dr. Yuvi.';
        }

        return response()->json([
            'success' => true,
            'message' => $resultMsg
        ]);
    }

    public function serviceDetail($slug)
    {
        $service = \App\Models\Service::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $allServices = \App\Models\Service::where('id', '!=', $service->id)->where('is_active', true)->limit(4)->get();
        return view('frontend.service-detail', compact('service', 'allServices'));
    }

    public function services()
    {
        $services = \App\Models\Service::where('is_active', true)->orderBy('order')->get();
        return view('frontend.services', compact('services'));
    }

    public function successStories()
    {
        $stories = \App\Models\SuccessStory::where('is_active', true)->orderBy('order')->get();
        return view('frontend.success-stories', compact('stories'));
    }

    public function team()
    {
        return view('frontend.team');
    }

    public function media()
    {
        return view('frontend.media');
    }
}
