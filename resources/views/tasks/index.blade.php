@extends('layout') {{-- Puxa o seu layout principal, nome: 'layout' --}}

@section('content')

<div class="row justify-content-center">
    <div class="col-md-10">
        
        {{-- Mensagens de feedback (Ex: "Task updated successfully.") --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <div class="card shadow-sm border-0">
            
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h4 class="mb-0 text-secondary">
                    <i class="bi bi-list-check text-danger me-2"></i> Minhas Tarefas
                </h4>
                <a href="{{ route('tasks.create') }}" class="btn btn-danger btn-sm rounded-pill px-3">
                    <i class="bi bi-plus-lg"></i> Nova 
                </a>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" class="ps-4" style="width: 40%;">Tarefa</th>
                                <th scope="col">Status</th>
                                <th scope="col">Data Limite</th>
                                <th scope="col" class="text-end pe-4">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tasks as $task)
                                <tr>
                                    <td class="ps-4">
                                        <div class="fw-bold text-dark">{{ $task->title }}</div>
                                        @if($task->description)
                                            <small class="text-muted d-block text-truncate" style="max-width: 300px;">
                                                {{ $task->description }}
                                            </small>
                                        @endif
                                    </td>

                                    <td>
                                        @php
                                            // Lógica para definir a cor do badge
                                            $badgeClass = match($task->status) {
                                                'completed' => 'bg-success',
                                                'in_progress' => 'bg-primary',
                                                'pending' => 'bg-warning text-dark',
                                                default => 'bg-secondary'
                                            };
                                            
                                            // Tradução simples para exibição
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
                                            // Verifica se a data limite passou e a task não está concluída
                                            $isLate = $task->status !== 'completed' && $task->limit_date && strtotime($task->limit_date) < time();
                                        @endphp
                                        
                                        <span class="{{ $isLate ? 'text-danger fw-bold' : 'text-muted' }}">
                                            <i class="bi bi-calendar-event me-1"></i>
                                            {{ $task->limit_date ? date('d/m/Y', strtotime($task->limit_date)) : 'Sem data' }}
                                        </span>
                                    </td>

                                    <td class="text-end pe-4">
                                        <div class="btn-group">
                                            {{-- ⭐ BOTÃO DE EDIÇÃO: Aponta para a rota tasks.edit --}}
                                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-outline-secondary" title="Editar">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5 text-muted">
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