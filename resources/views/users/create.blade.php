@extends('layout')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4 mt-4">
    <h1>Criar Nova Conta</h1>
</div>

<div class="card shadow-sm mx-auto" style="max-width: 500px;">
    <div class="card-body">
        
        <form method="POST" action="{{ route('users.store') }}">
            
            {{-- 1. TOKEN CSRF: Essencial para segurança no Laravel --}}
            @csrf 

            {{-- Campo Nome (Obrigatório) --}}
            <div class="mb-3">
                <label for="name" class="form-label">Nome <span class="text-danger">*</span></label>
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

            {{-- CAMPO CPF (Obrigatório) --}}
            <div class="mb-3">
                <label for="cpf" class="form-label">CPF <span class="text-danger">*</span></label>
                <input 
                    type="text" 
                    class="form-control @error('cpf') is-invalid @enderror" 
                    id="cpf" 
                    name="cpf" 
                    value="{{ old('cpf') }}"
                    placeholder="Ex: 123.456.789-00"
                    required
                >
                @error('cpf')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Campo Email (Obrigatório) --}}
            <div class="mb-3">
                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
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

            {{-- Campo Senha (Obrigatório) --}}
            <div class="mb-3">
                <label for="password" class="form-label">Senha <span class="text-danger">*</span></label>
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
            
            {{-- CAMPO CONFIRMAÇÃO DE SENHA (Obrigatório) --}}
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmar Senha <span class="text-danger">*</span></label>
                <input 
                    type="password" 
                    class="form-control" 
                    id="password_confirmation" 
                    name="password_confirmation" 
                    required
                >
            </div>

            ---
            
            {{-- CAMPO ENDEREÇO (OPCIONAL) --}}
            <div class="mb-3">
                <label for="address" class="form-label">Endereço (Opcional)</label>
                <input 
                    type="text" 
                    class="form-control @error('address') is-invalid @enderror" 
                    id="address" 
                    name="address" 
                    value="{{ old('address') }}"
                    {{-- O atributo 'required' está removido --}}
                >
                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- CAMPO TELEFONE (OBRIGATÓRIO) --}}
            <div class="mb-3">
                <label for="phone" class="form-label">Telefone <span class="text-danger">*</span></label>
                <input 
                    type="text" 
                    class="form-control @error('phone') is-invalid @enderror" 
                    id="phone" 
                    name="phone" 
                    value="{{ old('phone') }}"
                    placeholder="Ex: (11) 91234-5678"
                    required
                >
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            ---

            {{-- Botões de Ação --}}
            <button type="submit" class="btn btn-success me-2">
                <i class="fas fa-user-plus"></i> Registrar
            </button>
            
            <a href="{{ route('login') }}" class="btn btn-secondary">
                Já tenho conta (Ir para Login)
            </a>
        </form>

    </div>
</div>

@endsection