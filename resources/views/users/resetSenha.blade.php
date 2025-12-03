@extends('layout')  <!-- Extende o layout principal -->

@section('content')  <!-- Define o conteúdo principal da página -->
    <div class="container">
        <h2 class="text-center">Redefinir Senha</h2>
        
        <!-- Mensagens de erro -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Mensagem de sucesso -->
        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <!-- Formulário de redefinir senha -->
        <form action="{{ route('password.atualizarSenha') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">  <!-- Passando o token recebido pelo link -->
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>
            
            <div class="form-group">
                <label for="password">Nova Senha</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirmar Nova Senha</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Redefinir Senha</button>
        </form>
    </div>
@endsection
