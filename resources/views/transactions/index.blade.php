@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-teal-700">HiroiEstate Transactions</h1>
            <p class="text-sm text-gray-500 mb-5">List of all property transactions</p>
            <a href="{{ route('transactions.create') }}"
                class="text-blue-600 hover:underline font-semibold">
                + New Transaction
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-4 text-green-700 bg-green-100 p-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if($transactions->isEmpty())
        <div class="text-gray-600 text-center py-6">
            No transactions found.
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($transactions as $tx)
                <div class="bg-white shadow-lg rounded-lg p-5 border border-gray-100 hover:shadow-xl transition">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">
                        {{ $tx->propertyType->name }}
                    </h2>
                    <p class="text-sm text-gray-500 mb-1">Handled by <strong>{{ $tx->agent->name }}</strong></p>

                    <div class="text-sm mt-3 space-y-1">
                        <p><strong>Customer:</strong> {{ $tx->customer_name }}</p>
                        <p><strong>Email:</strong> {{ $tx->customer_email }}</p>
                        <p>
                            <strong>Status:</strong>
                            <span class="px-2 py-1 rounded text-white text-xs
                                @if($tx->status == 'completed') bg-green-600
                                @elseif($tx->status == 'cancelled') bg-red-600
                                @else bg-yellow-500
                                @endif">
                                {{ ucfirst($tx->status) }}
                            </span>
                        </p>
                        <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($tx->date)->format('d F Y') }}</p>
                        @if($tx->notes)
                            <p class="italic text-gray-600 mt-1">“{{ $tx->notes }}”</p>
                        @endif
                    </div>

                    <div class="mt-4 flex justify-between text-sm">
                        <a href="{{ route('transactions.edit', $tx->id) }}"
                           class="text-blue-600 hover:underline font-semibold">✏️ Edit</a>
                        <form action="{{ route('transactions.destroy', $tx->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                        </form>

                    </div>
                </div>
            @endforeach
        </div>
		<div class="flex gap-3 pt-10">
			<form action="{{ route('transactions.export.excel') }}" method="GET" class="mb-6">
				<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
					<div>
						<label for="from_excel" class="block font-semibold text-sm">From Date</label>
						<input type="date" name="from" id="from_excel" required class="w-full border px-3 py-2 rounded mt-1">
					</div>
					<div>
						<label for="to_excel" class="block font-semibold text-sm">To Date</label>
						<input type="date" name="to" id="to_excel" required class="w-full border px-3 py-2 rounded mt-1">
					</div>
					</div>
					<div class="mt-4 text-right">
						<button type="submit"
							class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded shadow">
							📥 Export to Excel
						</button>
					</div>
			</form>
			<form action="{{ route('transactions.export.pdf') }}" method="GET">
				<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
					<div>
						<label for="from_pdf" class="block font-semibold text-sm">From Date</label>
						<input type="date" name="from" id="from_pdf" required class="w-full border px-3 py-2 rounded mt-1">
					</div>
					<div>
						<label for="to_pdf" class="block font-semibold text-sm">To Date</label>
						<input type="date" name="to" id="to_pdf" required class="w-full border px-3 py-2 rounded mt-1">
					</div>
				</div>
				<div class="mt-4 text-right">
					<button type="submit"
						class="bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded shadow">
						📄 Export to PDF
					</button>
				</div>
			</form>
        </div>
    @endif
</div>
@endsection
