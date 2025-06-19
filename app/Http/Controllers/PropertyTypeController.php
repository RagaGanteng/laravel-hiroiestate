<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyType;

class PropertyTypeController extends Controller
{
    public function index()
    {
        $propertyTypes = PropertyType::latest()->paginate(10);
        return view('property_types.index', compact('propertyTypes'));
    }

    public function create()
    {
        return view('property_types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_residential' => 'required|boolean',
            'average_size' => 'nullable|integer|min:0',
        ]);

        PropertyType::create($request->all());

        return redirect()->route('property-types.index')->with('success', 'Property type created!');
    }

    public function edit(PropertyType $propertyType)
    {
        return view('property_types.edit', compact('propertyType'));
    }

    public function update(Request $request, PropertyType $propertyType)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_residential' => 'required|boolean',
            'average_size' => 'nullable|integer|min:0',
        ]);

        $propertyType->update($request->all());

        return redirect()->route('property-types.index')->with('success', 'Property type updated!');
    }

    public function destroy(PropertyType $propertyType)
    {
        $propertyType->delete();
        return redirect()->route('property-types.index')->with('success', 'Deleted!');
    }
}

