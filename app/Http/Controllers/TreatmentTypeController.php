<?php

namespace App\Http\Controllers;

use App\Models\TreatmentType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TreatmentTypeController extends Controller
{
    public function index()
    {
        $treatmentTypes = TreatmentType::orderBy('order')->get();
        return view('admin.treatment-types.index', compact('treatmentTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:treatment_types',
            'description' => 'nullable|string',
        ]);

        TreatmentType::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'order' => $request->order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->back()->with('success', 'Treatment type added successfully.');
    }

    public function update(Request $request, TreatmentType $treatmentType)
    {
        $request->validate([
            'name' => 'required|string|unique:treatment_types,name,' . $treatmentType->id,
            'description' => 'nullable|string',
        ]);

        $treatmentType->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'order' => $request->order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->back()->with('success', 'Treatment type updated successfully.');
    }

    public function destroy(TreatmentType $treatmentType)
    {
        $treatmentType->delete();
        return redirect()->back()->with('success', 'Treatment type deleted successfully.');
    }
}
