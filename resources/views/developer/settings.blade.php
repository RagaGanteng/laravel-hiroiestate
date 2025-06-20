@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-6 bg-white p-6 rounded shadow">
  <h1 class="text-2xl font-bold mb-4">Developer Settings</h1>

  @if(session('success'))
    <div class="p-4 mb-4 text-green-700 bg-green-100 rounded">{{ session('success') }}</div>
  @endif

  <div class="space-y-4">
    <div class="border p-4 rounded bg-gray-50">
      <h2 class="text-lg font-semibold mb-2">🔁 Reset Database</h2>
      <form action="{{ route('developer.reset') }}" method="POST" onsubmit="return confirm('Reset semua data dummy?')">
        @csrf
        <button class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
          Jalankan Reset
        </button>
      </form>
    </div>

    <div class="border p-4 rounded bg-gray-50">
      <h2 class="text-lg font-semibold mb-2">🛠 Info Sistem</h2>
      <ul class="text-sm text-gray-700">
        <li><strong>PHP:</strong> {{ phpversion() }}</li>
        <li><strong>Laravel:</strong> {{ Illuminate\Foundation\Application::VERSION }}</li>
        <li><strong>Base Path:</strong> {{ base_path() }}</li>
        <li><strong>Environment:</strong> {{ app()->environment() }}</li>
      </ul>
    </div>
  </div>
</div>
@endsection
