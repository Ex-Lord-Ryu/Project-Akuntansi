<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index()
    {
        $statuses = Status::all();
        return view('status.index', compact('statuses'));
    }

    public function create()
    {
        return view('status.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_status' => 'required|string',
        ]);

        Status::create($request->all());
        return redirect()->route('status.index')
                         ->with('success', 'Status created successfully.');
    }

    public function show(Status $status)
    {
        return view('status.show', compact('status'));
    }

    public function edit(Status $status)
    {
        return view('status.edit', compact('status'));
    }

    public function update(Request $request, Status $status)
    {
        $request->validate([
            'nama_status' => 'required|string',
        ]);

        $status->update($request->all());
        return redirect()->route('status.index')
                         ->with('success', 'Status updated successfully.');
    }

    public function destroy(Status $status)
    {
        $status->delete();
        return redirect()->route('status.index')
                         ->with('success', 'Status deleted successfully.');
    }
}
