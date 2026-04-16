<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = auth()->user()->todos()->latest()->get();
        return view('todos.index', compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('todos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validate the data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // 2. Create the todo linked to the user
        auth()->user()->todos()->create($validated);

        // 3. Redirect back to index
        return redirect()->route('todos.index')->with('success', 'Todo created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $todo = auth()->user()->todos()->findOrFail($id);
        return view('todos.edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $todo = auth()->user()->todos()->findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Manually handle the checkbox
        $validated['is_completed'] = $request->has('is_completed');

        // Update completed_at based on the status change
        if ($validated['is_completed'] && !$todo->is_completed) {
            $validated['completed_at'] = now();
        } elseif (!$validated['is_completed']) {
            $validated['completed_at'] = null;
        }

        $todo->update($validated);

        return redirect()->route('todos.index')->with('success', 'Todo updated!');
    }

    public function toggle(Todo $todo)
    {
        // Ownership check
        $todo = auth()->user()->todos()->findOrFail($todo->id);

        $todo->update([
            'is_completed' => !$todo->is_completed,
            'completed_at' => !$todo->is_completed ? now() : null,
        ]);

        return back()->with('success', 'Status updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $todo = auth()->user()->todos()->findOrFail($id);
        $todo->delete();

        return redirect()->route('todos.index')->with('success', 'Todo deleted!');
    }
}
