@extends('layout')

@section('content')

    <div class="container">
        <h1>Cadastrar Nova Tarefa</h1>

        {{-- O bloco de erros gerais pode ser mantido, mas o @error é mais específico --}}
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
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}" required>
                @error('title')
                    <div style="color: red;">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="category_id">Categoria:</label><br>
                <select id="category_id" name="category_id" class="form-control" required>
                    <option value="">Selecione uma Categoria</option>
                    {{-- 🔄 Loop pelas categorias passadas pelo Controller --}}
                    @foreach ($categories as $category)
                        <option 
                            value="{{ $category->id }}"
                            {{-- Mantém a seleção após um erro de validação --}}
                            {{ old('category_id') == $category->id ? 'selected' : '' }}
                        >
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <div style="color: red;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Descrição:</label><br>
                {{-- Adicionei o old() aqui para manter o valor em caso de erro --}}
                <textarea id="description" name="description" class="form-control">{{ old('description') }}</textarea>
                @error('description')
                    <div style="color: red;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="limit_date">Data Limite:</label><br>
                <input type="date" id="limit_date" name="limit_date" class="form-control" value="{{ old('limit_date') }}" required>
                @error('limit_date')
                    <div style="color: red;">{{ $message }}</div>
                @enderror
            </div>

            <br>
            <button type="submit" class="btn-submit">Salvar Tarefa</button>
            <a href="{{ route('tasks.index') }}">Cancelar</a>
        </form>
    </div>

@endsection