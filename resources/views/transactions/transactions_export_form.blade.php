@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-6 bg-white shadow rounded">
    <h2 class="text-2xl font-bold mb-4">Export Transaction Report</h2>

    <form action="{{ route('transactions.export.excel') }}" method="GET" class="mb-4 flex gap-4">
        <div class="flex-1">
            <label>From</label>
            <input type="date" name="from" required class="w-full border p-2 rounded">
        </div>
        <div class="flex-1">
            <label>To</label>
            <input type="date" name="to" required class="w-full border p-2 rounded">
        </div>
        <div class="flex items-end">
            <button class="bg-green-600 text-white px-4 py-2 rounded">Export Excel</button>
        </div>
    </form>

    <form action="{{ route('transactions.export.pdf') }}" method="GET" class="flex gap-4">
        <div class="flex-1">
            <label>From</label>
            <input type="date" name="from" required class="w-full border p-2 rounded">
        </div>
        <div class="flex-1">
            <label>To</label>
            <input type="date" name="to" required class="w-full border p-2 rounded">
        </div>
        <div class="flex items-end">
            <button class="bg-red-600 text-white px-4 py-2 rounded">Export PDF</button>
        </div>
    </form>
</div>
@endsection
