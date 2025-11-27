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

    public function edit($id) {

        $taskArray = DB::select('SELECT * FROM tasks WHERE id = ? AND user_id = ?', [$id, Auth::id()]);

        if (empty($taskArray)) {
            return redirect()->route('tasks.index')->with('error', 'Task not found.');
        }
        $task = $taskArray[0];
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'limit_date' => 'nullable|date',
            'status' => 'required|in:pending,completed,in_progress',
        ]);

        DB::update('UPDATE tasks SET title = ?, description = ?, limit_date = ?, status = ?, updated_at = NOW() WHERE id = ? AND user_id = ?', [
            $validated['title'],
            $validated['description'] ?? null,
            $validated['limit_date'] ?? null,
            $validated['status'],
            $id,
            Auth::id(),
        ]);
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }
}