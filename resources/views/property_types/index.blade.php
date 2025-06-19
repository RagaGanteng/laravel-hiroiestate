@extends('layouts.app')

@section('content')
<div class="p-6">
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Property Types</h2>
    <a href="{{ route('property-types.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">+ Add New</a>
  </div>

  <div>
    <table class="w-full bg-white shadow-md rounded-xl overflow-hidden">
      <thead class="bg-gray-100 text-left">
        <tr>
          <th class="p-3">#</th>
          <th class="p-3">Name</th>
          <th class="p-3">Description</th>
          <th class="p-3">Residential?</th>
          <th class="p-3">Avg. Size (m²)</th>
          <th class="p-3">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($propertyTypes as $type)
        <tr class="border-t hover:bg-gray-50">
          <td class="p-3">{{ $loop->iteration }}</td>
          <td class="p-3 font-semibold">{{ $type->name }}</td>
          <td class="p-3 text-sm text-gray-600">{{ $type->description }}</td>
          <td class="p-3">{{ $type->is_residential ? 'Yes' : 'No' }}</td>
          <td class="p-3">{{ $type->average_size ?? '-' }}</td>
          <td class="p-3 space-x-2">
            <a href="{{ route('property-types.edit', $type->id) }}" class="text-blue-500 hover:underline">Edit</a>
            <form action="{{ route('property-types.destroy', $type->id) }}" method="POST" class="inline">
              @csrf @method('DELETE')
              <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Delete this property type?')">Delete</button>
            </form>
          </td>
        </tr>
        @empty
        <tr><td colspan="6" class="p-4 text-center text-gray-500">No property types available.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
