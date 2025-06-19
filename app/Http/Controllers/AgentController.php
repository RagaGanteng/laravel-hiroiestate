<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function index()
    {
        $agents = Agent::latest()->paginate(10);
        return view('agents.index', compact('agents'));
    }

    public function create()
    {
        return view('agents.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:agents,email,' . ($agent->id ?? 'NULL'),
            'phone' => 'required|string|max:20',
            'photo' => 'nullable|file|image|mimes:jpg,jpeg,png|max:2048',
            'bio' => 'nullable|string',
        ]);


        $data = $request->all();

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('agents', 'public');
            $data['photo'] = 'storage/' . $photoPath;
        }


        Agent::create($data);

        return redirect()->route('agents.index')->with('success', 'Agent created!');
    }


    public function edit(Agent $agent)
    {
        return view('agents.edit', compact('agent'));
    }

    public function update(Request $request, Agent $agent)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:agents,email,' . ($agent->id ?? 'NULL'),
            'phone' => 'required|string|max:20',
            'photo' => 'nullable|file|image|mimes:jpg,jpeg,png|max:2048',
            'bio' => 'nullable|string',
        ]);


        $data = $request->all();

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('agents', 'public');
            $data['photo'] = 'storage/' . $photoPath;
        }


        $agent->update($data);

        return redirect()->route('agents.index')->with('success', 'Agent updated!');
    }


    public function destroy(Agent $agent)
    {
        $agent->delete();
        return redirect()->route('agents.index')->with('success', 'Agent deleted!');
    }
}

