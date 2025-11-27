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
            'cpf' => 'required|string|size:11|unique:users',
        ]);

        DB::insert('INSERT INTO users (name, email, cpf,password, created_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW())', [
            $validated['name'],
            $validated['email'],
            $validated['cpf'],  
            bcrypt($validated['password']),
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario criado com sucesso!');
    }
    public function edit($id) {
        $userArray = DB::select('SELECT * FROM users WHERE id = ?', [$id]);

        if (empty($userArray)) {
            return redirect()->route('users.index')->with('error', 'Usuário não encontrado.');
        }
        $user = $userArray[0];
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'cpf' => 'required|string|size:11|unique:users,cpf,'.$id,
        ]);
        DB::update('UPDATE users SET name = ?, email = ?, cpf = ?, updated_at = NOW() WHERE id = ?', [
            $validated['name'],
            $validated['email'],
            $validated['cpf'],
            $id,
        ]);
        return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso.');
    }
}