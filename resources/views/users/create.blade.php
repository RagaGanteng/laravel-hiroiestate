@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white shadow-md rounded-xl mt-6">
  <h2 class="text-2xl font-bold mb-4 text-center">Add New User</h2>

  @if ($errors->any())
  <div class="mb-4 p-4 bg-red-100 text-red-600 rounded">
    <ul class="list-disc pl-5">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <form action="{{ route('users.store') }}" method="POST" class="space-y-4">
    @csrf

    <div>
      <label for="name" class="block font-semibold mb-1">Full Name</label>
      <input type="text" name="name" id="name"
        value="{{ old('name') }}"
        class="w-full border rounded px-3 py-2"
        placeholder="e.g. Raka Aditya" required>
    </div>

    <div>
      <label for="email" class="block font-semibold mb-1">Email</label>
      <input type="email" name="email" id="email"
        value="{{ old('email') }}"
        class="w-full border rounded px-3 py-2"
        placeholder="e.g. user@email.com" required>
    </div>

    <div>
      <label for="role" class="block font-semibold mb-1">Role</label>
      <select name="role" id="role" class="w-full border rounded px-3 py-2" required>
        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
        <option value="agent" {{ old('role') == 'agent' ? 'selected' : '' }}>Agent</option>
        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
        <option value="developer" {{ old('role') == 'developer' ? 'selected' : '' }}>developer</option>
      </select>
    </div>

    <div>
      <label for="password" class="block font-semibold mb-1">Password</label>
      <input type="password" name="password" id="password"
        class="w-full border rounded px-3 py-2"
        placeholder="Min. 6 characters" required>
    </div>

    <div>
      <label for="password_confirmation" class="block font-semibold mb-1">Confirm Password</label>
      <input type="password" name="password_confirmation" id="password_confirmation"
        class="w-full border rounded px-3 py-2"
        placeholder="Confirm password" required>
    </div>

    <div class="text-right">
      <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">Save</button>
    </div>
  </form>
</div>
@endsection
