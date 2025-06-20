@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white shadow rounded">
    <h2 class="text-2xl font-bold mb-4">Edit Transaction</h2>

    @if ($errors->any())
        <div class="mb-4 bg-red-100 text-red-600 p-3 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="property_type_id" class="block font-semibold">Property Type</label>
            <select name="property_type_id" id="property_type_id" class="w-full mt-1 p-2 border rounded">
                @foreach ($types as $type)
                    <option value="{{ $type->id }}" {{ $transaction->property_type_id == $type->id ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="agent_id" class="block font-semibold">Agent</label>
            <select name="agent_id" id="agent_id" class="w-full mt-1 p-2 border rounded">
                @foreach ($agents as $agent)
                    <option value="{{ $agent->id }}" {{ $transaction->agent_id == $agent->id ? 'selected' : '' }}>
                        {{ $agent->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="customer_name" class="block font-semibold">Customer Name</label>
            <input type="text" name="customer_name" value="{{ $transaction->customer_name }}" class="w-full p-2 border rounded">
        </div>

        <div class="mb-4">
            <label for="customer_email" class="block font-semibold">Customer Email</label>
            <input type="email" name="customer_email" value="{{ $transaction->customer_email }}" class="w-full p-2 border rounded">
        </div>

        @unless(Auth::user()->role === 'user')
            <div class="mb-4">
                <label for="status" class="block font-semibold">Status</label>
                <select name="status" class="w-full p-2 border rounded">
                    <option value="pending" {{ $transaction->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="completed" {{ $transaction->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ $transaction->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
        @endunless


        <div class="mb-4">
            <label for="date" class="block font-semibold">Transaction Date</label>
            <input type="date" name="date" value="{{ $transaction->date }}" class="w-full p-2 border rounded">
        </div>

        <div class="mb-4">
            <label for="notes" class="block font-semibold">Notes</label>
            <textarea name="notes" class="w-full p-2 border rounded" rows="4">{{ $transaction->notes }}</textarea>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Update Transaction
            </button>
        </div>
    </form>
</div>
@endsection
