<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\ResetPasswordEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PasswordController extends Controller
{
    public function esqueciSenha() {
        return view('users.esqueciSenha');
    }

    public function enviarLink(Request $request) {
        
        $request->validate([
            'email' => 'required|email',
        
        ]);
        
        $user = DB::select ('SELECT * FROM users WHERE email = ?', [$request->email]);
        
        if (!$user) {
            return back()->withErrors(['email' => 'Email não encontrado.']);
        }

        $token = Str::random(60);

        if (DB::table('password_reset_tokens')->where('email', $request->email)->exists()) {
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();
        }
        
        DB::insert('INSERT INTO password_reset_tokens (email, token, created_at) VALUES (?, ?, ?)', [
            $request->email,
            $token,
            now()
        ]);

        $link = url('/users/redefinirSenha/' . $token);

        Mail::to($request->email)->queue(new ResetPasswordEmail($link));

        return redirect()->route('login')->with('status', 'Link de redefinição de senha enviado para o seu email.');
    }

    public function exibirFormulario($token) {
        $reset = DB::select ('SELECT * FROM password_reset_tokens WHERE token = ?', [$token]);
        if (empty($reset)) {
            return redirect('/esqueci-senha')->withErrors(['token' => 'Token inválido ou expirado.']);
        }
        return view('users.resetSenha', ['token' => $token]);

    }

    public function atualizarSenha(Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        $reset = DB::select ('SELECT * FROM password_reset_tokens WHERE token = ? AND email = ?', [$request->token, $request->email]);
        if (empty($reset)) {
            return back()->withErrors(['token' => 'Token inválido ou expirado.']);
        }
        DB::update('UPDATE users SET password = ? WHERE email = ?', [
            bcrypt($request->password),
            $request->email
        ]);
        DB::delete('DELETE FROM password_reset_tokens WHERE email = ?', [$request->email]);

        return redirect('/login')->with('status', 'Senha atualizada com sucesso.');
    }
}
