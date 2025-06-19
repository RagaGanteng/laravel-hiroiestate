@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white shadow-md rounded-xl mt-6">
  <h2 class="text-2xl font-bold mb-4 text-center">Edit User</h2>

  @if ($errors->any())
  <div class="mb-4 p-4 bg-red-100 text-red-600 rounded">
    <ul class="list-disc pl-5">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-4">
    @csrf
    @method('PUT')

    <div>
      <label for="name" class="block font-semibold mb-1">Full Name</label>
      <input type="text" name="name" id="name"
        value="{{ old('name', $user->name) }}"
        class="w-full border rounded px-3 py-2"
        placeholder="e.g. Raka Aditya" required>
    </div>

    <div>
      <label for="email" class="block font-semibold mb-1">Email</label>
      <input type="email" name="email" id="email"
        value="{{ old('email', $user->email) }}"
        class="w-full border rounded px-3 py-2"
        placeholder="e.g. user@email.com" required>
    </div>

    <div>
      <label for="role" class="block font-semibold mb-1">Role</label>
      <select name="role" id="role" class="w-full border rounded px-3 py-2" required>
        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
        <option value="agent" {{ $user->role == 'agent' ? 'selected' : '' }}>Agent</option>
        <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
      </select>
    </div>

    <div class="text-right">
      <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded">Update</button>
    </div>
  </form>
</div>
@endsection
