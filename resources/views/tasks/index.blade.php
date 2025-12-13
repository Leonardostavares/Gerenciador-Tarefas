@extends('layout')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-11"> 
        
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <div class="card shadow-sm border-0">
            
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h4 class="mb-0 text-secondary">
                    <i class="bi bi-list-check text-dark me-2"></i> Minhas Tarefas
                </h4>
                <a href="{{ route('tasks.create') }}" class="btn btn-danger btn-sm rounded-pill px-3">
                    <i class="bi bi-plus-lg"></i> Nova 
                </a>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped mb-0 align-middle"> 
                        <thead class="table-light">
                            <tr>
                                <th scope="col" class="ps-4" style="width: 25%;">Tarefa</th>
                                <th scope="col" style="width: 15%;">Categoria</th>
                                <th scope="col">Status</th>
                                <th scope="col">Data Limite</th>
                                <th scope="col">Finalizada em</th>
                                <th scope="col" class="text-end pe-4">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tasks as $task)
                                <tr>
                                    <td class="ps-4">
                                        <div class="fw-bold text-dark">{{ $task->title }}</div>
                                        @if($task->description)
                                            <small class="text-muted d-block text-truncate" style="max-width: 200px;">
                                                {{ $task->description }}
                                            </small>
                                        @endif
                                    </td>
                                    
                                    <td>
                                        <span class="badge bg-light text-secondary border border-secondary border-opacity-50">
                                            {{ $task->category_name ?? 'Sem Categoria' }}
                                        </span>
                                    </td>
                                    
                                    <td>
                                        @php
                                            // CORREÇÃO AQUI: Mudando para text-white para garantir o contraste.
                                            $badgeClass = match($task->status) {
                                                'completed' => 'bg-success text-white',    // Fundo Verde + Texto BRANCO
                                                'in_progress' => 'bg-primary',
                                                'pending' => 'bg-danger',
                                                default => 'bg-secondary'
                                            };
                                            
                                            $statusText = match($task->status) {
                                                'completed' => 'Concluída',
                                                'in_progress' => 'Em Progresso',
                                                'pending' => 'Pendente',
                                                default => ucfirst($task->status)
                                            };
                                        @endphp
                                        <span class="badge rounded-pill {{ $badgeClass }}">
                                            {{ $statusText }}
                                        </span>
                                    </td>
                                    
                                    <td>
                                        @php
                                            $isLate = $task->status !== 'completed' && $task->limit_date && strtotime($task->limit_date) < time();
                                        @endphp
                                        
                                        <span class="{{ $isLate ? 'text-danger fw-bold' : 'text-muted' }}">
                                            <i class="bi bi-calendar-event me-1"></i>
                                            {{ $task->limit_date ? date('d/m/Y', strtotime($task->limit_date)) : 'Sem data' }}
                                        </span>
                                    </td>

                                    <td>
                                        @if($task->finished_at)
                                            <span class="text-success fw-bold small">
                                                <i class="bi bi-check-circle-fill me-1"></i>
                                                {{ date('d/m/Y H:i', strtotime($task->finished_at)) }}
                                            </span>
                                        @else
                                            <span class="text-muted small">
                                                <i class="bi bi-clock me-1"></i> Não Finalizada
                                            </span>
                                        @endif
                                    </td>

                                    <td class="text-end pe-4">
                                        <div class="btn-group">
                                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-outline-secondary" title="Editar">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="bi bi-clipboard-x display-4 d-block mb-3 text-secondary opacity-50"></i>
                                        <p class="h5">Nenhuma tarefa encontrada.</p>
                                        <a href="{{ route('tasks.create') }}" class="text-decoration-none">
                                            Clique aqui para criar sua primeira tarefa
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white text-muted text-end">
                <small>Total: {{ count($tasks) }} tarefas</small>
            </div>

        </div>
    </div>
</div>

@endsection