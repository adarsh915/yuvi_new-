<?php

namespace App\Http\Controllers;

use App\Models\SuccessStory;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    public function index()
    {
        $stories = SuccessStory::orderBy('order')->get();
        return view('admin.stories.index', compact('stories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'video_url' => 'required',
            'treatment_type' => 'required',
        ]);

        $video_url = $this->convertEmbedUrl($request->video_url);

        SuccessStory::create([
            'title' => $request->title,
            'video_url' => $video_url,
            'treatment_type' => $request->treatment_type,
            'patient_name' => $request->patient_name,
            'order' => $request->order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->back()->with('success', 'Story added successfully.');
    }

    public function update(Request $request, SuccessStory $story)
    {
        $request->validate([
            'title' => 'required',
            'video_url' => 'required',
            'treatment_type' => 'required',
        ]);

        $video_url = $this->convertEmbedUrl($request->video_url);

        $story->update([
            'title' => $request->title,
            'video_url' => $video_url,
            'treatment_type' => $request->treatment_type,
            'patient_name' => $request->patient_name,
            'order' => $request->order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->back()->with('success', 'Story updated successfully.');
    }

    public function destroy(SuccessStory $story)
    {
        $story->delete();
        return redirect()->back()->with('success', 'Story deleted successfully.');
    }

    private function convertEmbedUrl($url)
    {
        // YouTube Shorts
        if (str_contains($url, 'youtube.com/shorts/')) {
            $parts = explode('/shorts/', $url);
            $id = explode('?', $parts[1])[0];
            return "https://www.youtube.com/embed/" . $id . "?autoplay=1&mute=1&loop=1&playlist=" . $id;
        }

        // Standard YouTube
        if (str_contains($url, 'youtube.com/watch?v=')) {
            $parts = explode('v=', $url);
            $id = explode('&', $parts[1])[0];
            return "https://www.youtube.com/embed/" . $id . "?autoplay=1&mute=1&loop=1&playlist=" . $id;
        }

        if (str_contains($url, 'youtu.be/')) {
            $parts = explode('youtu.be/', $url);
            $id = explode('?', $parts[1])[0];
            return "https://www.youtube.com/embed/" . $id . "?autoplay=1&mute=1&loop=1&playlist=" . $id;
        }

        // Instagram
        if (str_contains($url, 'instagram.com/')) {
            if (str_contains($url, '/reel/') || str_contains($url, '/p/')) {
                // Ensure it has /embed at the end or use a clean link
                $url = strtok($url, '?'); // Remove query params
                return rtrim($url, '/') . "/embed";
            }
        }

        return $url;
    }
}
