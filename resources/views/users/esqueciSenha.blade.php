@extends('layout')

@section('title', 'Esqueci a Senha')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Recuperação de Senha</h2>
                </div>

                <div class="card-body">
                    <p class="text-center">
                        Insira seu endereço de e-mail abaixo. Enviaremos um link para redefinir sua senha.
                    </p>

                    <!-- Formulário com @csrf -->
                    <form method="POST" action="{{ route('password.enviarLink') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Endereço de E-mail</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3 d-grid">
                            <!-- Corrigido o fechamento do botão -->
                            <button type="submit" class="btn btn-primary">
                                Enviar Link de Redefinição
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
