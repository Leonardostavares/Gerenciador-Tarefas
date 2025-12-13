<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    public function index(){
    
    $tasks = DB::select('SELECT tasks.id, tasks.title, tasks.status, tasks.limit_date, tasks.description, tasks.finished_at, categories.name as category_name FROM tasks LEFT JOIN categories ON tasks.category_id = categories.id WHERE tasks.user_id = ?', [Auth::id()]);       
    
    return view('tasks.index', compact('tasks'));    
    }

    public function create() {
        $categories = DB::select('SELECT id, name FROM categories');
        return view('tasks.create', compact('categories'));
    }

    public function store(Request $request) {
       $validated = $request->validate([
           'title' => 'required|string|max:255',
           'description' => 'nullable|string',
           'limit_date' => 'nullable|date',
           'category_id' => 'nullable|integer',
       ]);

       DB::insert('INSERT INTO tasks (title, description, limit_date, category_id, user_id, created_at, updated_at) VALUES (?, ?, ?, ?, ?, NOW(), NOW())', [
           $validated['title'],
           $validated['description'] ?? null,
           $validated['limit_date'] ?? null,
           $validated['category_id'] ?? null,
           Auth::id(),
       ]);
       
       return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function edit($id) {
        $categories = DB::select('SELECT id, name FROM categories');
        $taskArray = DB::select('SELECT * FROM tasks WHERE id = ? AND user_id = ?', [$id, Auth::id()]);

        if (empty($taskArray)) {
            return redirect()->route('tasks.index')->with('error', 'Task not found.');
        }
        $task = $taskArray[0];
        return view('tasks.edit', compact('task', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'limit_date' => 'nullable|date',
            'status' => 'required|in:concluída,pendente',
            'category_id' => 'nullable|integer',
        ]);

        DB::update('UPDATE tasks SET title = ?, description = ?, limit_date = ?, status = ?, category_id = ?, updated_at = NOW() WHERE id = ? AND user_id = ?', [
            $validated['title'],
            $validated['description'] ?? null,
            $validated['limit_date'] ?? null,
            $validated['status'],
            $validated['category_id'] ?? null,
            $id,
            Auth::id(),
        ]);
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }
}