<?php

namespace App\Http\Controllers;

use App\Models\ContactField;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ContactFieldController extends Controller
{
    public function index()
    {
        $fields = ContactField::orderBy('order')->get();
        return view('admin.contact_fields.index', compact('fields'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required|string|max:255',
            'type' => 'required|in:text,email,tel,number,date,select,textarea',
            'category' => 'required|in:inclinic_visit,online_consultation,whatsapp,all',
            'order' => 'nullable|integer|unique:contact_fields,order'
        ]);

        $name = Str::slug($request->label, '_');
        
        ContactField::create([
            'label' => $request->label,
            'name' => $name,
            'type' => $request->type,
            'category' => $request->category,
            'options' => $request->options,
            'is_required' => $request->has('is_required'),
            'order' => $request->order ?: (ContactField::max('order') + 1),
            'placeholder' => $request->placeholder
        ]);

        return redirect()->back()->with('success', 'Field added successfully.');
    }

    public function update(Request $request, ContactField $contactField)
    {
        $request->validate([
            'label' => 'required|string|max:255',
            'type' => 'required|in:text,email,tel,number,date,select,textarea',
            'category' => 'required|in:inclinic_visit,online_consultation,whatsapp,all',
            'order' => 'required|integer|unique:contact_fields,order,' . $contactField->id
        ]);

        $contactField->update([
            'label' => $request->label,
            'type' => $request->type,
            'category' => $request->category,
            'options' => $request->options,
            'is_required' => $request->has('is_required'),
            'order' => $request->order,
            'placeholder' => $request->placeholder
        ]);

        return redirect()->back()->with('success', 'Field updated successfully.');
    }

    public function destroy(ContactField $contactField)
    {
        $contactField->delete();
        return redirect()->back()->with('success', 'Field deleted successfully.');
    }
}
