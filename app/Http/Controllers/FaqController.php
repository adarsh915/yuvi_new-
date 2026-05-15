<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::with('faqCategory')
            ->orderBy('faq_category_id')
            ->orderBy('order')
            ->get();
        $categories = FaqCategory::where('is_active', true)->orderBy('order')->get();
        return view('admin.faqs.index', compact('faqs', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
            'faq_category_id' => 'nullable|exists:faq_categories,id',
            'order' => 'nullable|integer|min:0',
        ]);

        $order = $request->order ?: (Faq::max('order') + 1);

        // Shift if this order is already taken
        if (Faq::where('order', $order)->exists()) {
            Faq::where('order', '>=', $order)->increment('order');
        }

        Faq::create([
            'question' => $request->question,
            'answer' => $request->answer,
            'faq_category_id' => $request->faq_category_id,
            'order' => $order,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->back()->with('success', 'FAQ added successfully.');
    }

    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
            'faq_category_id' => 'nullable|exists:faq_categories,id',
            'order' => 'required|integer|min:0',
        ]);

        $newOrder = (int)$request->order;

        if ($newOrder !== $faq->order) {
            if (Faq::where('order', $newOrder)->where('id', '!=', $faq->id)->exists()) {
                Faq::where('order', '>=', $newOrder)->where('id', '!=', $faq->id)->increment('order');
            }
        }

        $faq->update([
            'question' => $request->question,
            'answer' => $request->answer,
            'faq_category_id' => $request->faq_category_id,
            'order' => $newOrder,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->back()->with('success', 'FAQ updated successfully.');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->back()->with('success', 'FAQ deleted successfully.');
    }
}
