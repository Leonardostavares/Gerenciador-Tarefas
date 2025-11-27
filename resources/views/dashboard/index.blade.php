@extends('layout')

@section('content')

    <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
        <h1>Painel Principal</h1>
    </div>

    <div>
        <h2>Olá, {{ $user->name }}!</h2>
        <p>Você está logado(a) e acessando uma área protegida.</p>
        
        <hr>

        {{-- NOVA SEÇÃO: Botões de Ação --}}
        <div class="mb-4">
            <h3>Ações do Sistema</h3>
            <p>Gerenciamento de tarefas do dia a dia </p>
        </div>

        <hr>

        <h3>Detalhes da Conta</h3>
        <ul>
            <li><strong>ID:</strong> {{ $user->id }}</li>
            <li><strong>Nome de Usuário:</strong> {{ $user->name }}</li>
            <li><strong>E-mail:</strong> {{ $user->email }}</li>
            <li><strong>CPF:</strong> {{ $user->cpf }}</li>
            <li><strong>Membro Desde:</strong> {{ $user->created_at->format('d/m/Y \à\s H:i:s') }}</li>
        </ul>

        {{-- Botões de Edição --}}
        <div class="mt-4">
            <h4>Configurações da Conta</h4>
            <div class="d-flex gap-3 mt-3">
                
                {{-- ⭐ MODIFICAÇÃO CHAVE: Usando <a> para gerar o link de edição --}}
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">
                    <i class="bi bi-envelope-fill me-2"></i>
                    Atualizar informações
                </a>
                
                <button type="button" class="btn btn-outline-danger">
                    <i class="bi bi-lock-fill me-2"></i>
                    Alterar Senha
                </button>
            </div>
        </div>
        
    </div>

@endsection