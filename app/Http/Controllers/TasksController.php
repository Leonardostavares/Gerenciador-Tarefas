<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    public function index(){
    
    $tasks = DB::select('SELECT id, title, status, limit_date, description FROM tasks WHERE user_id = ?', [Auth::id()]);       
    
    return view('tasks.index', compact('tasks'));    
    }

    public function create() {
        return view('tasks.create');
    }

    public function store(Request $request) {
       $validated = $request->validate([
           'title' => 'required|string|max:255',
           'description' => 'nullable|string',
           'limit_date' => 'nullable|date',
       ]);

       DB::insert('INSERT INTO tasks (title, description, limit_date, user_id, created_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW())', [
           $validated['title'],
           $validated['description'] ?? null,
           $validated['limit_date'] ?? null,
           Auth::id(),
       ]);
       
       return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }
}
