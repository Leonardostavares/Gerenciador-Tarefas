@extends('layout')

@section('title', 'Alterar Senha')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow-sm">
                <div class="card-header bg-danger text-white">
                    <h4 class="mb-0">🔒 Alterar Senha de Acesso</h4>
                </div>
                <div class="card-body">

                    {{-- Exibe mensagens de erro geral (ex: Senha Atual Incorreta) --}}
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    
                    {{-- O formulário envia para a rota de update de senha --}}
                    {{-- A rota de update é simples: users/password, usando o método PATCH --}}
                    <form method="POST" action="{{ route('users.alterarSenha', ['id' => $user->id]) }}">
                        
                        @csrf
                        @method('PATCH') {{-- Usa o método PATCH, ideal para alterações parciais --}}
                        <hr>
                        {{-- Campo Nova Senha --}}
                        <div class="mb-3">
                            <label for="password" class="form-label">Nova Senha</label>
                            {{-- O nome do campo é 'password' para que a regra 'confirmed' funcione --}}
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                   id="password" name="password" required minlength="8">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Campo Confirmação da Nova Senha --}}
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmar Nova Senha</label>
                            {{-- O nome do campo DEVE ser 'password_confirmation' para funcionar com a regra 'confirmed' --}}
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                                   id="password_confirmation" name="password_confirmation" required minlength="8">
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="d-flex justify-content-between mt-4">
                            <button type="submit" class="btn btn-danger">Alterar Senha</button>
                            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection