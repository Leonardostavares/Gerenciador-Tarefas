@extends('layout')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4 mt-4">
    <h1>Criar Nova Conta</h1>
    {{-- REMOVIDO: O link 'Voltar para a Lista' foi removido, pois o usuário não está logado --}}
</div>

<div class="card shadow-sm mx-auto" style="max-width: 500px;">
    <div class="card-body">
        
        <form method="POST" action="{{ route('users.store') }}">
            
            {{-- 1. TOKEN CSRF: Essencial para segurança no Laravel --}}
            @csrf 

            {{-- Campo Nome --}}
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input 
                    type="text" 
                    class="form-control @error('name') is-invalid @enderror" 
                    id="name" 
                    name="name" 
                    value="{{ old('name') }}"
                    required
                >
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

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
                >
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
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
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            {{-- O CAMPO DE CONFIRMAÇÃO DE SENHA FOI REMOVIDO AQUI --}}

            {{-- Botões de Ação --}}
            <button type="submit" class="btn btn-success me-2">
                <i class="fas fa-user-plus"></i> Registrar
            </button>
            
            {{-- MODIFICADO: Redireciona para o login em vez da lista --}}
            <a href="{{ route('login') }}" class="btn btn-secondary">
                Já tenho conta (Ir para Login)
            </a>
        </form>

    </div>
</div>

@endsection