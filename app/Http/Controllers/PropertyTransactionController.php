<?php

namespace App\Http\Controllers;

use App\Models\PropertyTransaction;
use Illuminate\Http\Request;
use App\Models\PropertyType;
use App\Models\Agent;


class PropertyTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = \App\Models\PropertyTransaction::with('propertyType', 'agent')->latest()->get();
        return view('transactions.index', compact('transactions'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = PropertyType::all();
        $agents = Agent::all();
        return view('transactions.create', compact('types', 'agents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'property_type_id' => 'required|exists:property_types,id',
            'agent_id' => 'required|exists:agents,id',
            'customer_name' => 'required|string',
            'customer_email' => 'required|email',
            'status' => 'required|in:pending,completed,cancelled',
            'date' => 'required|date',
            'notes' => 'nullable|string'
        ]);

        PropertyTransaction::create($request->all());

        return redirect()->route('transactions.index')->with('success', 'Transaction created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(PropertyTransaction $propertyTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $transaction = \App\Models\PropertyTransaction::findOrFail($id);
        $types = \App\Models\PropertyType::all();
        $agents = \App\Models\Agent::all();

        return view('transactions.edit', compact('transaction', 'types', 'agents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'property_type_id' => 'required|exists:property_types,id',
            'agent_id' => 'required|exists:agents,id',
            'customer_name' => 'required|string',
            'customer_email' => 'required|email',
            'status' => 'required|in:pending,completed,cancelled',
            'date' => 'required|date',
            'notes' => 'nullable|string'
        ]);

        $transaction = \App\Models\PropertyTransaction::findOrFail($id);
        $transaction->update($request->all());

        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $transaction = PropertyTransaction::findOrFail($id);
        $transaction->delete();

        return redirect()->route('transactions.index')
            ->with('success', 'Transaction deleted successfully!');
    }


}
