@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white shadow-md rounded-xl mt-6">
  <h2 class="text-2xl font-bold mb-4 text-center">Add New Agent</h2>

  @if ($errors->any())
  <div class="mb-4 p-4 bg-red-100 text-red-600 rounded">
    <ul class="list-disc pl-5">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <form action="{{ route('agents.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div>
      <label for="name" class="block font-semibold mb-1">Full Name</label>
      <input type="text" name="name" id="name"
        value="{{ old('name') }}"
        class="w-full border rounded px-3 py-2"
        placeholder="e.g. Riko Sugimoto" required>
    </div>

    <div>
      <label for="email" class="block font-semibold mb-1">Email</label>
      <input type="email" name="email" id="email"
        value="{{ old('email') }}"
        class="w-full border rounded px-3 py-2"
        placeholder="e.g. riko@example.com" required>
    </div>

    <div>
      <label for="phone" class="block font-semibold mb-1">Phone Number</label>
      <input type="text" name="phone" id="phone"
        value="{{ old('phone') }}"
        class="w-full border rounded px-3 py-2"
        placeholder="e.g. +62 812-3456-7890" required>
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
        placeholder="Write a short biography...">{{ old('bio') }}</textarea>
    </div>

    <div class="text-right">
      <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">
        Add Agent
      </button>
    </div>
  </form>
</div>
@endsection
