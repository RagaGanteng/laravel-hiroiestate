@extends('layouts.app')

@section('content')
<div class="p-6">
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">User Management</h2>
    <div class="mb-4 flex justify-end gap-2">
        <a href="{{ route('users.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">+ Add New</a>
        <a href="{{ route('users.export.excel') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
            Export Excel
        </a>
        <a href="{{ route('users.export.pdf') }}" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
            Export PDF
        </a>
    </div>

  </div>

  <table class="w-full bg-white shadow-md rounded-xl overflow-hidden">
    <thead class="bg-gray-100 text-left">
      <tr>
        <th class="p-3">#</th>
        <th class="p-3">Name</th>
        <th class="p-3">Email</th>
        <th class="p-3">Role</th>
        <th class="p-3">Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($users as $user)
      <tr class="border-t">
        <td class="p-3">{{ $loop->iteration }}</td>
        <td class="p-3">{{ $user->name }}</td>
        <td class="p-3">{{ $user->email }}</td>
        <td class="p-3 capitalize">{{ $user->role }}</td>
        <td class="p-3 space-x-2">
          <a href="{{ route('users.edit', $user->id) }}" class="text-blue-500 hover:underline">Edit</a>
          <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button class="text-red-500 hover:underline" onclick="return confirm('Delete this user?')">Delete</button>
          </form>
        </td>
      </tr>
      @empty
      <tr><td colspan="5" class="p-4 text-center text-gray-500">No users found.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
