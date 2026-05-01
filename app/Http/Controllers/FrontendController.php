<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuizQuestion;
use App\Models\QuizSubmission;

class FrontendController extends Controller
{
    public function index()
    {
        $faqs = \App\Models\Faq::where('is_active', true)->orderBy('order')->get();
        $stories = \App\Models\SuccessStory::where('is_active', true)->orderBy('order')->get();
        $settings = \App\Models\SiteSetting::all()->pluck('value', 'key');
        $services = \App\Models\Service::where('is_active', true)->orderBy('order')->get();
        $blogs = \App\Models\Blog::where('is_active', true)->orderBy('created_at', 'desc')->take(3)->get();

        return view('frontend.index', compact('faqs', 'stories', 'settings', 'services', 'blogs'));
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function blog()
    {
        $blogs = \App\Models\Blog::where('is_active', true)->orderBy('created_at', 'desc')->get();
        $categories = \App\Models\Blog::where('is_active', true)
            ->select('category', \DB::raw('count(*) as total'))
            ->groupBy('category')
            ->get();
            
        return view('frontend.blog', compact('blogs', 'categories'));
    }

    public function blogDetails($slug)
    {
        $blog = \App\Models\Blog::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $relatedBlogs = \App\Models\Blog::where('id', '!=', $blog->id)
            ->where('is_active', true)
            ->where('category', $blog->category)
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
        $fields = \App\Models\ContactField::all();
        $rules = [];
        
        foreach ($fields as $field) {
            $fieldRules = $field->is_required ? ['required'] : ['nullable'];
            if ($field->type == 'email') $fieldRules[] = 'email';
            $rules[$field->name] = $fieldRules;
        }

        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        // Prepare lead data
        $firstName = $request->input('first_name', '');
        $lastName = $request->input('last_name', '');
        $email = $request->input('email', '');
        $phone = $request->input('phone', '');
        $subject = $request->input('primary_concern', 'General Inquiry');
        $message = $request->input('message', 'No message provided');

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
            'name' => trim($firstName . ' ' . $lastName),
            'email' => $email,
            'phone' => $phone,
            'subject' => $subject,
            'message' => $message,
            'dynamic_data' => $dynamicData
        ]);

        return response()->json(['success' => true]);
    }

    public function faq()
    {
        $faqs = \App\Models\Faq::where('is_active', true)->orderBy('order')->get();
        return view('frontend.faq', compact('faqs'));
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
            'yes_count' => $yesCount
        ]);

        $resultMsg = '';
        if ($yesCount === 0) {
            $resultMsg = 'Based on your responses, you have no immediate red flags. However, if you are planning to conceive, a routine consultation with Dr. Yuvi is always a great first step.';
        } else if ($yesCount <= 3) {
            $resultMsg = 'You answered "Yes" to ' . $yesCount . ' concern(s). There are some areas worth discussing with a specialist. We recommend booking a consultation to explore your options and get a personalised care plan.';
        } else {
            $resultMsg = 'You answered "Yes" to ' . $yesCount . ' concern(s), indicating moderate to significant fertility-related factors. We strongly recommend a comprehensive clinical evaluation with Dr. Yuvi to identify the best path forward for you.';
        }

        return response()->json([
            'success' => true,
            'message' => $resultMsg,
            'yes_count' => $yesCount
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
}
