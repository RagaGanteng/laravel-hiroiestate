@extends('layouts.app')

@section('content')
<div class="p-6">
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Property Types</h2>
    @auth
      @if(Auth::user()->role !== 'user')
          <a href="{{ route('property_types.create') }}"
            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
            + Add New
          </a>
      @endif
    @endauth
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
            @auth
              @if(Auth::user()->role !== 'user')
                  <a href="{{ route('property_types.edit', $type->id) }}"
                    class="text-blue-600 hover:underline text-sm">Edit</a>

                  <form action="{{ route('property_types.destroy', $type->id) }}" method="POST" class="inline"
                        onsubmit="return confirm('Delete this type?')">
                      @csrf
                      @method('DELETE')
                      <button class="text-red-600 hover:underline text-sm" type="submit">Delete</button>
                  </form>
              @endif
          @endauth

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
