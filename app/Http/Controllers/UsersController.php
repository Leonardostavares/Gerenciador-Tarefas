<?php

namespace App\Http\Controllers;

use App\Mail\ResetPassword;
use App\Mail\ResetSenhaLink;
use App\Mail\WelcomeEmail;
use App\Service\DataCleaner;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function index()
    {
        try {
            $users = DB::select('SELECT id, name, email, cpf, created_at, updated_at FROM users');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao buscar usuários: ' . $e->getMessage());
        }
        return view('users.index', compact('users'));
    }

    public function create() {
        return view('users.create');
    }

    public function store (Request $request, DataCleaner $dataCleaner) {    
        
        $cpfCleaned = $dataCleaner->clearString($request->input('cpf'));
        $phoneCleaned = $dataCleaner->clearString($request->input('phone'));

        $request->merge(['cpf' => $cpfCleaned, 'phone' => $phoneCleaned]);


        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|',
            'cpf' => 'required|string|size:11|unique:users',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        DB::insert('INSERT INTO users (name, email, cpf,password, address, phone, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())', [
            $validated['name'],
            $validated['email'],
            $validated['cpf'],  
            bcrypt($validated['password']),
            $validated['address'],
            $validated['phone'],
        ]);

        Mail::to($validated['email'])->queue(new WelcomeEmail($validated));
        
        return redirect()->route('login')->with('success', 'Usuario criado com sucesso!');
    }
    public function edit($id) {
        $userArray = DB::select('SELECT * FROM users WHERE id = ?', [$id]);

        if (empty($userArray)) {
            return redirect()->route('users.index')->with('error', 'Usuário não encontrado.');
        }
        $user = $userArray[0];
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id){
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


    public function editarSenha($id) {
        $user = Auth::user();
        return view('users.alterarSenha', compact('user'));
    }

    public function alterarSenha(Request $request, $id){
        $validated = $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        DB::update('UPDATE users SET password = ?, updated_at = NOW() WHERE id = ?', [
            bcrypt($validated['password']),
            $id,
        ]);

        Auth::logout();

        return redirect()->route('login')->with('success', 'Senha alterada com sucesso. Por favor, faça login novamente.');
    }

    public function profileShow() {
        $user = Auth::user();
        return view('users.profile', compact('user'));
    }

}