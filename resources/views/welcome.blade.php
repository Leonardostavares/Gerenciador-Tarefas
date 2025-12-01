<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gerenciador de Tarefas - {{ config('app.name', 'Sistema CRUD') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'media', 
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Instrument Sans', 'sans-serif'],
                    },
                    colors: {
                        primary: '#F9322C', 
                        secondary: '#D61F19',
                        cardBg: '#1F1F1E',
                        lightGray: '#F9F9F9',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-lightGray dark:bg-[#0a0a0a] text-[#1b1b18] flex flex-col min-h-screen font-sans antialiased">

    {{-- BARRA DE NAVEGAÇÃO --}}
    <nav class="w-full max-w-7xl mx-auto px-6 lg:px-8 py-6 flex items-center justify-between border-b border-gray-300 dark:border-gray-700">
        <div class="flex items-center gap-2">
            <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center text-white font-bold text-lg">
                <span class="text-xl">T</span>
            </div>
            <span class="text-xl font-bold text-gray-800 dark:text-white tracking-tight">Task<span class="text-primary">Flow</span></span>
        </div>

        @if (Route::has('login'))
            <div class="flex items-center gap-4">
                @auth
                    <a href="{{ url('/tasks') }}" class="px-6 py-3 rounded-full bg-primary text-white text-sm font-semibold shadow-lg hover:shadow-red-500/40 hover:bg-secondary transition-all duration-300 ease-in-out">
                        Acessar Tarefas
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-5 py-2 text-sm font-semibold text-gray-600 dark:text-gray-300 hover:text-primary dark:hover:text-white transition duration-300">
                        Entrar
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-6 py-3 rounded-full bg-primary text-white text-sm font-semibold shadow-lg hover:shadow-red-500/40 hover:bg-secondary transition-all duration-300 ease-in-out">
                            Criar Conta
                        </a>
                    @endif
                @endauth
            </div>
        @endif
    </nav>

    {{-- CONTEÚDO PRINCIPAL --}}
    <div class="flex-grow flex items-center justify-center p-6">
        <main class="flex max-w-7xl w-full flex-col lg:flex-row bg-white dark:bg-[#161615] shadow-xl rounded-2xl overflow-hidden border border-gray-100 dark:border-[#3E3E3A]">

            {{-- SEÇÃO DE BEM-VINDO --}}
            <div class="flex-1 p-8 lg:p-16 flex flex-col justify-center">
                <div class="mb-8">
                    <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-4 leading-tight">
                        Organize suas Tarefas com <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-orange-500">Eficiência</span>.
                    </h1>
                    <p class="text-lg text-gray-500 dark:text-gray-400 leading-relaxed">
                        Um sistema intuitivo e simples para organizar suas tarefas e melhorar sua produtividade no dia a dia.
                    </p>
                </div>

                {{-- BOTÕES DE AÇÃO --}}
                <div class="space-y-6">
                    <a href="{{ route('tasks.create') }}" class="w-full text-center px-6 py-3 rounded-full bg-primary text-white text-lg font-semibold shadow-lg hover:shadow-red-500/40 hover:bg-secondary transition-all duration-300 ease-in-out">
                        Adicionar Nova Tarefa
                    </a>

                    <a href="{{ url('/tasks') }}" class="w-full text-center px-6 py-3 rounded-full border-2 border-primary text-primary text-lg font-semibold shadow-lg hover:shadow-red-500/40 hover:bg-secondary transition-all duration-300 ease-in-out">
                        Ver Minhas Tarefas
                    </a>
                </div>
            </div>

            {{-- IMAGEM VISUAL --}}
            <div class="relative w-full lg:w-[45%] bg-gradient-to-br from-[#1f1f1e] to-black flex items-center justify-center p-10 overflow-hidden">
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-primary opacity-20 blur-[80px] rounded-full"></div>
                <div class="absolute inset-0 bg-[url('https://laravel.com/assets/img/welcome/background.svg')] opacity-10 mix-blend-overlay"></div>
                
                <div class="relative z-10 flex flex-col items-center text-center group">
                    <div class="w-24 h-24 rounded-2xl bg-gradient-to-br from-primary to-red-700 shadow-2xl shadow-red-900/50 flex items-center justify-center transform group-hover:scale-110 transition duration-500">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path>
                        </svg>
                    </div>
                    <h2 class="mt-6 text-2xl font-bold text-white tracking-wide">Banco de Dados Seguro</h2>
                    <p class="text-gray-400 text-sm mt-2">Suas tarefas estão seguras e prontas para serem acessadas de qualquer lugar.</p>
                </div>
            </div>

        </main>
    </div>

</body>
</html>
