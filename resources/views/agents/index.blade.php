@extends('layouts.app')

@section('content')
<div class="p-6">
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Agent Directory</h2>
    @auth
      @if(in_array(Auth::user()->role, ['admin', 'agent', 'developer']))
          <a href="{{ route('agents.create') }}" class="btn btn-primary">+ Add New</a>
      @endif
    @endauth
  </div>

  @if(session('success'))
    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
      {{ session('success') }}
    </div>
  @endif

  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 pt-9">
    @forelse ($agents as $agent)
    <div class=" bg-white shadow-md rounded-xl overflow-hidden">
      @if($agent->photo)
        <img src="{{ asset($agent->photo) }}" alt="Agent Photo" class="h-80 w-full object-cover">
      @else
        <div class="h-48 bg-gray-200 flex items-center justify-center text-gray-500 italic">No Photo</div>
      @endif

      <div class="p-4">
        <h3 class="text-lg font-semibold">{{ $agent->name }}</h3>
        <p class="text-sm text-gray-600">{{ $agent->email }}</p>
        <p class="text-sm text-gray-600">{{ $agent->phone }}</p>
        <p class="text-sm text-gray-500 mt-2 line-clamp-3">{{ $agent->bio }}</p>

        <div class="flex justify-between items-center mt-4">
          @auth
            @if(Auth::user()->role !== 'user')
                <a href="{{ route('agents.edit', $agent->id) }}"
                  class="text-sm text-blue-600 hover:underline">Edit</a>

                <form action="{{ route('agents.destroy', $agent->id) }}" method="POST" onsubmit="return confirm('Delete this agent?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-sm text-red-600 hover:underline">Delete</button>
                </form>
            @endif
          @endauth
        </div>
      </div>
    </div>
    @empty
      <p class="text-gray-500 col-span-full text-center">No agents found.</p>
    @endforelse
  </div>

  <div class="mt-6">
    {{ $agents->links() }}
  </div>
</div>
@endsection
