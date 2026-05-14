<?php

namespace App\Http\Controllers;

use App\Models\MediaPodcast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaPodcastController extends Controller
{
    public function index()
    {
        $podcasts = MediaPodcast::orderBy('order')->latest('id')->get();
        return view('admin.media.podcasts', compact('podcasts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'episode_no' => 'nullable|string',
            'duration' => 'nullable|string',
            'image' => 'nullable|image|max:5120',
            'spotify_link' => 'nullable|url',
            'apple_link' => 'nullable|url',
            'order' => 'nullable|integer|min:0',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('media/podcasts', 'public');
        }

        if (!isset($validated['order'])) {
            $validated['order'] = (MediaPodcast::max('order') ?? 0) + 1;
        }

        MediaPodcast::create($validated);

        return redirect()->back()->with('success', 'Podcast episode added successfully.');
    }

    public function update(Request $request, MediaPodcast $podcast)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'episode_no' => 'nullable|string',
            'duration' => 'nullable|string',
            'image' => 'nullable|image|max:5120',
            'spotify_link' => 'nullable|url',
            'apple_link' => 'nullable|url',
            'order' => 'required|integer|min:0',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            if ($podcast->image) {
                Storage::disk('public')->delete($podcast->image);
            }
            $validated['image'] = $request->file('image')->store('media/podcasts', 'public');
        }

        $podcast->update($validated);

        return redirect()->back()->with('success', 'Podcast episode updated successfully.');
    }

    public function destroy(MediaPodcast $podcast)
    {
        if ($podcast->image) {
            Storage::disk('public')->delete($podcast->image);
        }
        $podcast->delete();
        return redirect()->back()->with('success', 'Podcast episode deleted successfully.');
    }
}
