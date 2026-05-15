<?php

namespace App\Http\Controllers;

use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class ServiceCategoryController extends Controller
{
    public function index()
    {
        $categories = ServiceCategory::withCount('services')->orderBy('order')->get();
        return view('admin.service_categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'order' => 'nullable|integer|min:0',
        ]);

        $order = $request->order ?? (ServiceCategory::max('order') + 1);

        // Shift if this order is already taken
        if (ServiceCategory::where('order', $order)->exists()) {
            ServiceCategory::where('order', '>=', $order)->increment('order');
        }

        ServiceCategory::create([
            'name' => $request->name,
            'order' => $order,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->back()->with('success', 'Category created successfully.');
    }

    public function update(Request $request, ServiceCategory $serviceCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'order' => 'required|integer|min:0',
        ]);

        $newOrder = (int)$request->order;

        if ($newOrder !== $serviceCategory->order) {
            if (ServiceCategory::where('order', $newOrder)->where('id', '!=', $serviceCategory->id)->exists()) {
                ServiceCategory::where('order', '>=', $newOrder)->where('id', '!=', $serviceCategory->id)->increment('order');
            }
        }

        $serviceCategory->update([
            'name' => $request->name,
            'order' => $newOrder,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->back()->with('success', 'Category updated successfully.');
    }

    public function destroy(ServiceCategory $serviceCategory)
    {
        $serviceCategory->delete();
        return redirect()->back()->with('success', 'Category deleted successfully.');
    }
}
