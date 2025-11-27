@extends('layout') 
{{-- 👆 Altere 'layouts.app' se o seu arquivo for diferente, ex: 'layouts.default' --}}

@section('title', 'Editar Tarefa')

@section('content')
<div class="container mt-5">
    
    <h2>✏️ Editar Tarefa: {{ $task->title }}</h2>

    {{-- O formulário de edição DEVE usar o método HTTP PUT ou PATCH --}}
    {{-- A diretiva @method faz o "spoofing" (simulação) do método --}}
    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        
        @csrf {{-- Proteção contra Cross-Site Request Forgery --}}
        @method('PUT') {{-- Simula o método PUT, que é o padrão para updates RESTful --}}

        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            {{-- value="{{ old('title', $task->title) }}" garante que: --}}
            {{-- 1. Se houver erro de validação, o valor antigo (old) é mantido. --}}
            {{-- 2. Caso contrário, o valor atual da task é exibido. --}}
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $task->title) }}" required>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descrição (Opcional)</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $task->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="limit_date" class="form-label">Data Limite (Opcional)</label>
            {{-- Formata a data para o formato de input HTML (YYYY-MM-DD) --}}
            <input type="date" class="form-control @error('limit_date') is-invalid @enderror" id="limit_date" name="limit_date" value="{{ old('limit_date', $task->limit_date ? \Carbon\Carbon::parse($task->limit_date)->format('Y-m-d') : '') }}">
            @error('limit_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">`
            <label for="status" class="form-label">Status</label>
            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                {{-- Cria a variável $currentStatus para simplificar a verificação --}}
                @php $currentStatus = old('status', $task->status); @endphp
                
                <option value="pending" @selected($currentStatus === 'pending')>Pendente</option>
                <option value="in_progress" @selected($currentStatus === 'in_progress')>Em Progresso</option>
                <option value="completed" @selected($currentStatus === 'completed')>Concluída</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection