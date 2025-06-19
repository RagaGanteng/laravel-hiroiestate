@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white shadow-md rounded-xl mt-6">
  <h2 class="text-2xl font-bold mb-4 text-center">Edit Agent</h2>

  @if ($errors->any())
  <div class="mb-4 p-4 bg-red-100 text-red-600 rounded">
    <ul class="list-disc pl-5">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <form action="{{ route('agents.update', $agent->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div>
      <label for="name" class="block font-semibold mb-1">Full Name</label>
      <input type="text" name="name" id="name"
        value="{{ old('name', $agent->name) }}"
        class="w-full border rounded px-3 py-2" required>
    </div>

    <div>
      <label for="email" class="block font-semibold mb-1">Email</label>
      <input type="email" name="email" id="email"
        value="{{ old('email', $agent->email) }}"
        class="w-full border rounded px-3 py-2" required>
    </div>

    <div>
      <label for="phone" class="block font-semibold mb-1">Phone Number</label>
      <input type="text" name="phone" id="phone"
        value="{{ old('phone', $agent->phone) }}"
        class="w-full border rounded px-3 py-2" required>
    </div>

    <div>
    	<label for="photo" class="block font-semibold mb-1">Choose Photo</label>
		<input type="file" name="photo" id="photo"
			class="w-full border rounded px-3 py-2 file:bg-gray-100 file:border-none file:rounded file:px-4">
  	</div>

    <div>
      <label for="bio" class="block font-semibold mb-1">Bio</label>
      <textarea name="bio" id="bio" rows="4"
        class="w-full border rounded px-3 py-2"
        placeholder="Short biography...">{{ old('bio', $agent->bio) }}</textarea>
    </div>

    <div class="text-right">
      <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded">
        Update Agent
      </button>
    </div>
  </form>
</div>
@endsection
