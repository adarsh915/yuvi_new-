<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with('category')->orderBy('order')->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        $categories = ServiceCategory::where('is_active', true)->orderBy('order')->get();
        return view('admin.services.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'service_category_id' => 'required|exists:service_categories,id',
            'category_tag' => 'required|string|max:255',
            'hero_lead' => 'required|string',
            'listing_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'hero_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'approach_text' => 'required|string',
            'safety_text' => 'required|string',
            'order' => 'nullable|integer|unique:services,order',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:255',
            'stat1_num' => 'nullable|string|max:255',
            'stat1_label' => 'nullable|string|max:255',
            'stat2_num' => 'nullable|string|max:255',
            'stat2_label' => 'nullable|string|max:255',
            'stat3_num' => 'nullable|string|max:255',
            'stat3_label' => 'nullable|string|max:255',
        ], [
            'title.required' => 'Service title is required.',
            'service_category_id.required' => 'Please select a clinical category.',
            'category_tag.required' => 'Category badge text is required for the service card.',
            'hero_lead.required' => 'Hero lead text is required for the service banner.',
            'listing_image.required' => 'A listing thumbnail image is required.',
            'listing_image.max' => 'Listing image must not exceed 5MB.',
            'hero_image.required' => 'A hero banner image is required.',
            'hero_image.max' => 'Hero image must not exceed 5MB.',
            'approach_text.required' => 'The approach section content cannot be empty.',
            'safety_text.required' => 'The safety & ethics section content cannot be empty.',
            'order.unique' => 'This display order number is already taken.',
        ]);

        $data = $request->all();
        $slugBase = Str::slug($request->input('slug', $request->title));
        $data['slug'] = $this->generateUniqueSlug($slugBase);
        $data['is_active'] = $request->has('is_active');
        $data['order'] = $request->input('order') ?: (Service::max('order') + 1);

        if ($request->hasFile('listing_image')) {
            $data['listing_image'] = $request->file('listing_image')->store('services', 'public');
        }
        if ($request->hasFile('hero_image')) {
            $data['hero_image'] = $request->file('hero_image')->store('services', 'public');
        }

        // Handle short_description (hidden from form, but required in DB)
        $data['short_description'] = $request->input('short_description', $request->hero_lead);

        // Handle dynamic array inputs
        $data['hero_pills'] = $request->input('hero_pills') ?: [];
        $data['protocol_json'] = $request->input('protocol') ?: [];
        $data['expect_json'] = $request->input('expectations') ?: [];

        Service::create($data);

        return redirect()->route('admin.services')->with('success', 'Service created successfully.');
    }

    public function edit(Service $service)
    {
        $categories = ServiceCategory::where('is_active', true)->orderBy('order')->get();
        return view('admin.services.edit', compact('service', 'categories'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'service_category_id' => 'required|exists:service_categories,id',
            'category_tag' => 'required|string|max:255',
            'hero_lead' => 'required|string',
            'approach_text' => 'required|string',
            'safety_text' => 'required|string',
            'listing_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'order' => 'nullable|integer|unique:services,order,' . $service->id,
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:255',
            'stat1_num' => 'nullable|string|max:255',
            'stat1_label' => 'nullable|string|max:255',
            'stat2_num' => 'nullable|string|max:255',
            'stat2_label' => 'nullable|string|max:255',
            'stat3_num' => 'nullable|string|max:255',
            'stat3_label' => 'nullable|string|max:255',
        ], [
            'title.required' => 'Service title is required.',
            'service_category_id.required' => 'Please select a clinical category.',
            'category_tag.required' => 'Category badge text is required.',
            'hero_lead.required' => 'Hero lead text is required.',
            'approach_text.required' => 'The approach section content cannot be empty.',
            'safety_text.required' => 'The safety & ethics section content cannot be empty.',
            'listing_image.max' => 'Listing image must not exceed 5MB.',
            'hero_image.max' => 'Hero image must not exceed 5MB.',
            'order.unique' => 'This display order number is already taken.',
        ]);

        $data = $request->except(['listing_image', 'hero_image', 'slug']);
        
        // Handle Slug
        $slugBase = Str::slug($request->input('slug', $request->title));
        $data['slug'] = $this->generateUniqueSlug($slugBase, $service->id);
        
        // Handle Booleans
        $data['is_active'] = $request->has('is_active');

        // Handle Images
        if ($request->hasFile('listing_image')) {
            $data['listing_image'] = $request->file('listing_image')->store('services', 'public');
        }
        if ($request->hasFile('hero_image')) {
            $data['hero_image'] = $request->file('hero_image')->store('services', 'public');
        }

        $data['short_description'] = $request->input('short_description', $request->hero_lead);

        // Handle Arrays
        $data['hero_pills'] = $request->input('hero_pills') ?: [];
        $data['protocol_json'] = $request->input('protocol') ?: [];
        $data['expect_json'] = $request->input('expectations') ?: [];

        // Handle Order
        $data['order'] = $request->filled('order') ? $request->input('order') : $service->order;

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
