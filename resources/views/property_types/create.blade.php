@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white shadow-md rounded-xl mt-6">
  <h2 class="text-2xl font-bold mb-4 text-center">Add New Property Type</h2>

  <form action="{{ route('property-types.store') }}" method="POST" class="space-y-4">
    @csrf

    <div>
      <label for="name" class="block font-semibold mb-1">Name</label>
      <input type="text" name="name" id="name" class="w-full border rounded px-3 py-2" placeholder="e.g. Rumah, Apartemen" required>
    </div>

    <div>
      <label for="description" class="block font-semibold mb-1">Description</label>
      <textarea name="description" id="description" rows="4" class="w-full border rounded px-3 py-2" placeholder="Short description about this property type"></textarea>
    </div>

    <div>
      <label class="block font-semibold mb-1">Is Residential?</label>
      <select name="is_residential" class="w-full border rounded px-3 py-2">
        <option value="1">Yes</option>
        <option value="0">No</option>
      </select>
    </div>

    <div>
      <label for="average_size" class="block font-semibold mb-1">Average Size (m²)</label>
      <input type="number" name="average_size" id="average_size" class="w-full border rounded px-3 py-2" placeholder="e.g. 120">
    </div>

    <div class="text-right">
      <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">Save</button>
    </div>
  </form>
</div>
@endsection
