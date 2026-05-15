<?php

namespace App\Http\Controllers;

use App\Models\MediaEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaEventController extends Controller
{
    public function index()
    {
        $events = MediaEvent::orderBy('order')->latest('id')->get();
        return view('admin.media.events', compact('events'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_text' => 'nullable|string',
            'image' => 'nullable|image|max:5120',
            'link' => 'nullable|url',
            'order' => 'nullable|integer|min:0|unique:media_events,order',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('media/events', 'public');
        }

        if (!isset($validated['order'])) {
            $validated['order'] = (MediaEvent::max('order') ?? 0) + 1;
        }

        MediaEvent::create($validated);

        return redirect()->back()->with('success', 'Media event added successfully.');
    }

    public function update(Request $request, MediaEvent $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_text' => 'nullable|string',
            'image' => 'nullable|image|max:5120',
            'link' => 'nullable|url',
            'order' => 'required|integer|min:0|unique:media_events,order,' . $event->id,
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $validated['image'] = $request->file('image')->store('media/events', 'public');
        }

        $event->update($validated);

        return redirect()->back()->with('success', 'Media event updated successfully.');
    }

    public function destroy(MediaEvent $event)
    {
        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }
        $event->delete();
        return redirect()->back()->with('success', 'Media event deleted successfully.');
    }
}
