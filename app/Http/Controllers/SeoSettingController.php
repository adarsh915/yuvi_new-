<?php

namespace App\Http\Controllers;

use App\Models\SeoSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SeoSettingController extends Controller
{
    public function index()
    {
        // Define core pages if they don't exist
        $corePages = [
            'home' => 'Home Page',
            'about' => 'About Us',
            'blog' => 'Blog List',
            'services' => 'Services List',
            'faq' => 'FAQ Page',
            'contact' => 'Contact Us',
            'gallery' => 'Gallery Page',
            'quiz' => 'Quiz Page',
            'success_stories' => 'Success Stories',
            'team' => 'Team Page',
            'media' => 'Media Page',
        ];

        foreach ($corePages as $identifier => $name) {
            SeoSetting::firstOrCreate(['page_identifier' => $identifier]);
        }

        $seoSettings = SeoSetting::all();
        $pageNames = $corePages;

        return view('admin.seo.index', compact('seoSettings', 'pageNames'));
    }

    public function update(Request $request, SeoSetting $seoSetting)
    {
        $request->validate([
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
        ]);

        $data = $request->only(['meta_title', 'meta_description', 'meta_keywords']);

        $seoSetting->update($data);

        return redirect()->back()->with('success', 'SEO settings updated successfully for ' . ucfirst($seoSetting->page_identifier));
    }
}
