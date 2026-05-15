<?php

namespace App\Http\Controllers;

use App\Models\MediaHighlight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaHighlightController extends Controller
{
    public function index()
    {
        $highlights = MediaHighlight::orderBy('order')->latest('id')->get();
        return view('admin.media.highlights', compact('highlights'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:5120',
            'type' => 'required|in:image,video',
            'video_url' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('media/highlights', 'public');
        }

        if (!isset($validated['order'])) {
            $validated['order'] = (MediaHighlight::max('order') ?? 0) + 1;
        }

        MediaHighlight::create($validated);

        return redirect()->back()->with('success', 'Media highlight added successfully.');
    }

    public function update(Request $request, MediaHighlight $highlight)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:5120',
            'type' => 'required|in:image,video',
            'video_url' => 'nullable|string',
            'order' => 'required|integer|min:0|unique:media_highlights,order,' . $highlight->id,
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            if ($highlight->image) {
                Storage::disk('public')->delete($highlight->image);
            }
            $validated['image'] = $request->file('image')->store('media/highlights', 'public');
        }

        $highlight->update($validated);

        return redirect()->back()->with('success', 'Media highlight updated successfully.');
    }

    public function destroy(MediaHighlight $highlight)
    {
        if ($highlight->image) {
            Storage::disk('public')->delete($highlight->image);
        }
        $highlight->delete();
        return redirect()->back()->with('success', 'Media highlight deleted successfully.');
    }
}
