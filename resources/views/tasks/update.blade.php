@extends('layout') {{-- 👆 Seu layout principal --}}

@section('title', 'Editar Tarefa')

@section('content')
<div class="container mt-5">
    
    <h2>✏️ Editar Tarefa: {{ $task->title }}</h2>

    {{-- A action do formulário aponta para a rota tasks.update --}}
    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        
        @csrf 
        @method('PUT') {{-- ESSENCIAL: Simula o método HTTP PUT para o Controller --}}

        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
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
            <input type="date" class="form-control @error('limit_date') is-invalid @enderror" id="limit_date" name="limit_date" value="{{ old('limit_date', $task->limit_date ? \Carbon\Carbon::parse($task->limit_date)->format('Y-m-d') : '') }}">
            @error('limit_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
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