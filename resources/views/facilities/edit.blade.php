@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white shadow-md rounded-xl mt-6">
  <h2 class="text-2xl font-bold mb-4 text-center">Edit Facility</h2>

  @if ($errors->any())
  <div class="mb-4 p-4 bg-red-100 text-red-600 rounded">
    <ul class="list-disc pl-5">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <form action="{{ route('facilities.update', $facility->id) }}" method="POST" class="space-y-4">
    @csrf
    @method('PUT')

    <div>
      <label for="name" class="block font-semibold mb-1">Facility Name</label>
      <input type="text" name="name" id="name"
        value="{{ old('name', $facility->name) }}"
        class="w-full border rounded px-3 py-2"
        placeholder="e.g. Kolam Renang, Garasi" required>
    </div>

    <div>
      <label for="description" class="block font-semibold mb-1">Description</label>
      <textarea name="description" id="description" rows="4"
        class="w-full border rounded px-3 py-2"
        placeholder="Short description...">{{ old('description', $facility->description) }}</textarea>
    </div>

    <div class="text-right">
      <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded">Update</button>
    </div>
  </form>
</div>
@endsection
