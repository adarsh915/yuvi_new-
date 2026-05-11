<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('order')->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:services,slug',
            'category_tag' => 'required|string|max:255',
            'short_description' => 'required|string',
            'hero_lead' => 'required|string',
            'listing_image' => 'required|image|max:2048',
            'hero_image' => 'required|image|max:2048',
            'approach_text' => 'required|string',
            'safety_text' => 'required|string',
        ]);

        $data = $request->all();
    $slugBase = Str::slug($request->input('slug', $request->title));
    $data['slug'] = $this->generateUniqueSlug($slugBase);
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('listing_image')) {
            $data['listing_image'] = $request->file('listing_image')->store('services', 'public');
        }
        if ($request->hasFile('hero_image')) {
            $data['hero_image'] = $request->file('hero_image')->store('services', 'public');
        }

        // Handle dynamic array inputs
        $data['hero_pills'] = $request->input('hero_pills') ?: [];
        $data['protocol_json'] = $request->input('protocol') ?: [];
        $data['expect_json'] = $request->input('expectations') ?: [];

        Service::create($data);

        return redirect()->route('admin.services')->with('success', 'Service created successfully.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:services,slug,' . $service->id,
            'category_tag' => 'required|string|max:255',
            'short_description' => 'required|string',
            'hero_lead' => 'required|string',
            'approach_text' => 'required|string',
            'safety_text' => 'required|string',
        ]);

        $data = $request->all();
    $slugBase = Str::slug($request->input('slug', $request->title));
    $data['slug'] = $this->generateUniqueSlug($slugBase, $service->id);
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('listing_image')) {
            $data['listing_image'] = $request->file('listing_image')->store('services', 'public');
        }
        if ($request->hasFile('hero_image')) {
            $data['hero_image'] = $request->file('hero_image')->store('services', 'public');
        }

        $data['hero_pills'] = $request->input('hero_pills') ?: [];
        $data['protocol_json'] = $request->input('protocol') ?: [];
        $data['expect_json'] = $request->input('expectations') ?: [];

        $service->update($data);

        return redirect()->route('admin.services')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services')->with('success', 'Service deleted successfully.');
    }

    private function generateUniqueSlug(string $slug, ?int $ignoreId = null): string
    {
        $baseSlug = $slug !== '' ? $slug : 'service';
        $candidate = $baseSlug;
        $counter = 1;

        while (Service::where('slug', $candidate)
            ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
            ->exists()) {
            $candidate = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $candidate;
    }
}
