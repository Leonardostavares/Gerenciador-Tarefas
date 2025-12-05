@extends('layout') 

@section('content')
    <div class="container">
        <h2 class="text-center">Redefinir Senha</h2>
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('password.atualizarSenha') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}"> 
            
            <div class="form-group">
                <label for="email">Email</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    class="form-control" 
                    value="{{ $email ?? old('email') }}" 
                    required
                    readonly
                >
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