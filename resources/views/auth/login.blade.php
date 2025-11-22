@extends('layout')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-5">
        
        <h2 class="text-center mb-4">Acesso ao Sistema</h2>
        
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white text-center">
                Por favor, faça login
            </div>
            <div class="card-body">
                
                {{-- O action foi corrigido para 'login.store' --}}
                <form method="POST" action="{{ route('login.store') }}">
                    @csrf 

                    {{-- Campo Email --}}
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input 
                            type="email" 
                            class="form-control @error('email') is-invalid @enderror" 
                            id="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            required 
                            autofocus
                        >
                        {{-- Exibe mensagens de erro de validação para o campo 'email' --}}
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Campo Senha --}}
                    <div class="mb-3">
                        <label for="password" class="form-label">Senha</label>
                        <input 
                            type="password" 
                            class="form-control @error('password') is-invalid @enderror" 
                            id="password" 
                            name="password" 
                            required
                        >
                        {{-- Exibe mensagens de erro de validação para o campo 'password' --}}
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Botão de Submissão --}}
                    <button type="submit" class="btn btn-primary w-100 mt-2">
                        <i class="fas fa-sign-in-alt"></i> Entrar
                    </button>
                    
                    {{-- Opcional: Link para Esqueci a Senha --}}
                    <div class="text-center mt-3">
                        <a href="#" class="text-muted">Esqueceu sua senha?</a>
                    </div>
                </form>

            </div>
        </div>
        
        {{-- 🟢 BOTÃO/LINK DE CADASTRO ADICIONADO AQUI --}}
        <div class="text-center mt-4">
            <p class="text-muted mb-2">Novo no sistema?</p>
            <a href="{{ route('users.create') }}" class="btn btn-success w-100">
                <i class="fas fa-user-plus"></i> Criar Nova Conta
            </a>
        </div>
        
    </div>
</div>

@endsection