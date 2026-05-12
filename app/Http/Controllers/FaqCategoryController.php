<?php

namespace App\Http\Controllers;

use App\Models\FaqCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FaqCategoryController extends Controller
{
    public function index()
    {
        $categories = FaqCategory::withCount('faqs')->orderBy('order')->get();
        return view('admin.faq_categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:faq_categories,name',
            'order' => 'nullable|integer',
        ]);

        FaqCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'order' => $request->order ?: (FaqCategory::max('order') + 1),
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->back()->with('success', 'FAQ Category created successfully.');
    }

    public function update(Request $request, FaqCategory $faqCategory)
    {
        $request->validate([
            'name' => 'required|unique:faq_categories,name,' . $faqCategory->id,
            'order' => 'required|integer',
        ]);

        $faqCategory->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'order' => $request->order,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->back()->with('success', 'FAQ Category updated successfully.');
    }

    public function destroy(FaqCategory $faqCategory)
    {
        if ($faqCategory->faqs()->count() > 0) {
            return redirect()->back()->with('error', 'Cannot delete category that has FAQs.');
        }

        $faqCategory->delete();
        return redirect()->back()->with('success', 'FAQ Category deleted successfully.');
    }
}
