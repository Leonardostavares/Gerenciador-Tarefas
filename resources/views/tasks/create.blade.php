@extends('layout')

@section('content')

    <div class="container">
        <h1>Cadastrar Nova Tarefa</h1>

        @if ($errors->any())
            <div style="color: red; margin-bottom: 15px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>   
            </div>
        @endif

        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="title">Título da Tarefa:</label><br>
                <input type="text" id="title" name="title" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">Descrição:</label><br>
                <textarea id="description" name="description" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label for="limit_date">Data Limite:</label><br>
                <input type="date" id="limit_date" name="limit_date" class="form-control" required>
            </div>

            <br>
            <button type="submit" class="btn-submit">Salvar Tarefa</button>
            <a href="{{ route('tasks.index') }}">Cancelar</a>
        </form>
    </div>

@endsection