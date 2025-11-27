@extends('layout')

@section('title', 'Editar Perfil')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Atualizar Minhas Informações (ID: {{ $user->id }})</h4>
                </div>
                <div class="card-body">
                    
                    {{-- O formulário aponta para a rota 'users.update', passando o ID do usuário --}}
                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        
                        @csrf
                        @method('PUT') {{-- ESSENCIAL: Simula o método HTTP PUT --}}

                        {{-- Campo Nome --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome Completo</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" 
                                   value="{{ old('name', $user->name) }}" 
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Campo E-mail --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" 
                                   value="{{ old('email', $user->email) }}" 
                                   required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Campo CPF --}}
                        <div class="mb-3">
                            <label for="cpf" class="form-label">CPF</label>
                            <input type="text" class="form-control @error('cpf') is-invalid @enderror" 
                                   id="cpf" name="cpf" 
                                   value="{{ old('cpf', $user->cpf) }}" 
                                   maxlength="14"
                                   required>
                            @error('cpf')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="d-flex justify-content-between mt-4">
                            <button type="submit" class="btn btn-success">Salvar Alterações</button>
                            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Voltar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection