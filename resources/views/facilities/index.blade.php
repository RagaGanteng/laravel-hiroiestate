@extends('layouts.app')

@section('content')
<div class="p-6">
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Facility</h2>
    <a href="{{ route('facilities.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">+ Add New</a>
  </div>

  <table class="w-full bg-white shadow-md rounded-xl overflow-hidden">
    <thead class="bg-gray-100 text-left">
      <tr>
        <th class="p-3">#</th>
        <th class="p-3">Name</th>
        <th class="p-3">Description</th>
        <th class="p-3">Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($facilities as $facility)
      <tr class="border-t">
        <td class="p-3">{{ $loop->iteration }}</td>
        <td class="p-3">{{ $facility->name }}</td>
        <td class="p-3 text-sm text-gray-600">{{ $facility->description }}</td>
        <td class="p-3 space-x-2">
          <a href="{{ route('facilities.edit', $facility->id) }}" class="text-blue-500">Edit</a>
          <form action="{{ route('facilities.destroy', $facility->id) }}" method="POST" class="inline">
            @csrf @method('DELETE')
            <button class="text-red-500" onclick="return confirm('Delete?')">Delete</button>
          </form>
        </td>
      </tr>
      @empty
      <tr><td colspan="5" class="p-4 text-center text-gray-500">No data.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
