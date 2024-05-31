<?php

namespace App\Http\Controllers;

use App\Models\Tache;
use Illuminate\Http\Request;

class TacheController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');
        $sortBy = $request->query('sortBy');
        $search = $request->query('search');
        $query = Tache::query();
        // Filter by status if provided
        if ($status) {
            $query->where('status', $status);
        }
        // Sort by due_date or titre
        if ($sortBy) {
            if ($sortBy === 'date_échéance') {
                $query->orderBy('date_échéance', 'asc'); // Sort by due_date in ascending order
            } elseif ($sortBy === 'titre') {
                $query->orderBy('titre', 'asc'); // Sort by titre in ascending order
            }
        }

        // Search by titre or description
        if ($search) {
            $query->where('titre', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
        }

        $tasks = $query->paginate(10);

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'titre' => 'required',
            'description' => 'required',
            'date_échéance' => 'required|date',
            'status' => 'required|in:en cours,terminée',
        ]);

        Tache::create($request->all());

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function edit($id)
    {
        $task = Tache::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, $id)
    {
        // Validation
        $request->validate([
            'titre' => 'required',
            'description' => 'required',
            'date_échéance' => 'required|date',
            'status' => 'required|in:en cours,terminée',
        ]);

        $task = Tache::findOrFail($id);
        $task->update($request->all());

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy($id)
    {
        $task = Tache::findOrFail($id);
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}