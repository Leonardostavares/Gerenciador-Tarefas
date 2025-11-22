@extends('layout')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4 mt-4">
    <h1>Lista de Usuários</h1>
    <a href="{{ route('users.create') }}" class="btn btn-success">Novo Usuário</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        
        {{-- Verifica se a coleção de usuários NÃO está vazia --}}
        @unless(empty($users))
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Data de Cadastro</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                {{-- Loop para exibir os usuários --}}
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        {{-- Proteção contra $user->created_at ser nulo --}}
                        @if ($user->created_at)
                            {{ date('d/m/Y', strtotime($user->created_at)) }}
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        <a href="#" class="btn btn-sm btn-primary">Editar</a>
                        <button class="btn btn-sm btn-danger">Excluir</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        @else
            {{-- Mensagem exibida se a coleção estiver vazia --}}
            <div class="alert alert-info text-center mt-3">
                Nenhum usuário encontrado no banco de dados.
            </div>
        @endunless
        
    </div>
</div>

@endsection