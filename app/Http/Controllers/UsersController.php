<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class UsersController extends Controller
{
    public function index()
    {
        $users = DB::select('SELECT * FROM users');
        return view('users.index', compact('users'));
    }

    public function create() {
        return view('users.create');
    }

    public function store (Request $request) {    
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|',
        ]);

        DB::insert('INSERT INTO users (name, email, password, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())', [
            $validated['name'],
            $validated['email'],
            bcrypt($validated['password']),
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario criado com sucesso!');
    }
}