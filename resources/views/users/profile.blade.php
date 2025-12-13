@extends('layout') 
{{-- Garanta que 'layouts.app' é o nome do seu layout principal --}}

@section('title', 'Meu Perfil')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-9 col-md-10">
            <div class="card shadow-sm border-0">
                
                <div class="card-header bg-white border-bottom p-4">
                    <h3 class="mb-0 text-dark-emphasis d-flex align-items-center">
                        <i class="bi bi-person-circle me-3 text-danger"></i> 
                        Detalhes do Perfil do Usuário
                    </h3>
                </div>
                
                <div class="card-body p-4 p-md-5">
                    
                    <p class="text-muted mb-4 border-bottom pb-3">
                        Visualize suas informações pessoais e de contato cadastradas no sistema.
                    </p>

                    <div class="row g-3">
                        
                        <div class="col-12 border-bottom pb-3 mb-3">
                            <label class="form-label text-secondary fw-bold">Nome Completo</label>
                            <p class="lead mb-0 text-dark">{{ $user->name }}</p>
                        </div>

                        <div class="col-md-6 border-bottom pb-3 mb-3">
                            <label class="form-label text-secondary fw-bold">E-mail</label>
                            <p class="lead mb-0">{{ $user->email }}</p>
                        </div>
                        
                        <div class="col-md-6 border-bottom pb-3 mb-3">
                            <label class="form-label text-secondary fw-bold">Telefone</label>
                            <p class="lead mb-0">{{ $user->phone ?? 'Não cadastrado' }}</p>
                        </div>
                        
                        <div class="col-md-6 border-bottom pb-3 mb-3">
                            <label class="form-label text-secondary fw-bold">CPF</label>
                            <p class="lead mb-0 text-danger">
                                @if($user->cpf)
                                    {{ substr($user->cpf, 0, 3) }}.***.***-** <span class="badge bg-warning text-dark ms-2">Sensível</span>
                                @else
                                    <span class="text-muted">Não cadastrado</span>
                                @endif
                            </p>
                        </div>
                        
                        <div class="col-12">
                            <label class="form-label text-secondary fw-bold">Endereço Completo</label>
                            
                            @if($user->address)
                                <p class="lead mb-0 text-dark">
                                    {{-- Exibe o endereço completo da única coluna --}}
                                    {{ $user->address }}
                                </p>
                            @else
                                <p class="lead mb-0 text-muted">Endereço não cadastrado.</p>
                            @endif
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection