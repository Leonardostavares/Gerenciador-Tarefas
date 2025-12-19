<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    {{-- 1. ADICIONADO: Meta Tag para o Reverb identificar o usuário --}}
    <meta name="user-id" content="{{ auth()->id() }}">

    <title>{{ config('app.name', 'Sistema CRUD') }}</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    {{-- 2. ADICIONADO: Carregamento do Vite (Echo/Reverb) --}}
    @vite(['resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        .navbar {
            background-color: #ffffff !important;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .navbar-brand {
            font-weight: 700;
            color: #111827 !important;
            letter-spacing: -0.5px;
        }
        
        .nav-link {
            color: #4b5563 !important;
            font-weight: 500;
            transition: color 0.2s;
        }
        
        .nav-link:hover,
        .nav-link.active {
            color: #dc3545 !important;
        }
        
        .main-content {
            flex: 1;
        }
        
        .footer {
            background-color: #fff;
            border-top: 1px solid #e5e7eb;
            padding: 25px 0;
            color: #6b7280;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

    <header>
        <nav class="navbar navbar-expand-lg shadow-sm">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/') }}">
                    <i class="bi bi-database-fill text-danger"></i> Sistema CRUD
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('tasks.index') }}">
                                    <i class="bi bi-list-check me-1"></i> Minhas Tarefas
                                </a>
                            </li>
                        @endauth
                    </ul>

                    <ul class="navbar-nav ms-auto">
                        @guest

                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown">
                                    <div class="bg-light rounded-circle d-flex justify-content-center align-items-center border" style="width: 32px; height: 32px;">
                                        <i class="bi bi-person-fill text-secondary"></i>
                                    </div>
                                    <span>{{ Auth::user()->name }}</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('users.profile') }}">
                                            <i class="bi bi-person-badge me-2"></i> Meu Perfil
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('dashboard') }}">
                                            <i class="bi bi-person-gear me-2"></i> Graficos
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="bi bi-box-arrow-right me-2"></i> Sair
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="container mt-5 mb-5 main-content">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    {{-- 3. ADICIONADO: @stack para permitir que a blade de dashboard injete os scripts do gráfico aqui --}}
    @stack('scripts')
</body>
</html>