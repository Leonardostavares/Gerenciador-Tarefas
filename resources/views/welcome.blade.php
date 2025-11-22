<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home - {{ config('app.name', 'Sistema CRUD') }}</title>

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
                        laravel: '#F9322C', 
                        laravelDark: '#D61F19',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 dark:bg-[#0a0a0a] text-[#1b1b18] flex flex-col min-h-screen font-sans antialiased">

    <nav class="w-full max-w-7xl mx-auto px-6 lg:px-8 py-6 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-laravel rounded-lg flex items-center justify-center text-white font-bold text-lg">
                S
            </div>
            <span class="text-xl font-bold text-gray-800 dark:text-white tracking-tight">Sistema<span class="text-laravel">CRUD</span></span>
        </div>

        @if (Route::has('login'))
            <div class="flex items-center gap-4">
                @auth
                    {{-- USUÁRIO LOGADO: Botão principal aponta para o Dashboard/Tasks (estilo chamativo) --}}
                    <a href="{{ url('/tasks') }}" class="group relative px-6 py-2.5 rounded-full bg-laravel text-white text-sm font-semibold shadow-lg hover:shadow-red-500/40 hover:bg-laravelDark transition-all duration-300 ease-in-out transform hover:-translate-y-0.5 hover:scale-105">
                        <span class="relative z-10">Acessar Sistema</span>
                    </a>
                @else
                    {{-- BOTÃO DE LOGIN (Estilo Clean) --}}
                    <a href="{{ route('login') }}" class="px-5 py-2.5 text-sm font-semibold text-gray-600 dark:text-gray-300 hover:text-laravel dark:hover:text-white transition duration-300">
                        Entrar
                    </a>

                    @if (Route::has('register'))
                        {{-- BOTÃO DE CADASTRO (Estilo Chamativo) --}}
                        <a href="{{ route('register') }}" class="group relative px-6 py-2.5 rounded-full bg-laravel text-white text-sm font-semibold shadow-lg hover:shadow-red-500/40 hover:bg-laravelDark transition-all duration-300 ease-in-out transform hover:-translate-y-0.5 hover:scale-105">
                            <span class="relative z-10">Criar Conta Grátis</span>
                        </a>
                    @endif
                @endauth
            </div>
        @endif
    </nav>

    <div class="flex-grow flex items-center justify-center p-6">
        <main class="flex max-w-5xl w-full flex-col-reverse lg:flex-row bg-white dark:bg-[#161615] shadow-2xl rounded-2xl overflow-hidden border border-gray-100 dark:border-[#3E3E3A]">
            
            <div class="flex-1 p-8 lg:p-16 flex flex-col justify-center">
                
                <div class="mb-8">
                    <span class="inline-block py-1 px-3 rounded-full bg-red-100 dark:bg-red-900/30 text-laravel text-xs font-bold tracking-wide uppercase mb-4">
                        Versão 1.0
                    </span>
                    <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-4 leading-tight">
                        Gerencie suas tarefas com <span class="text-transparent bg-clip-text bg-gradient-to-r from-laravel to-orange-500">Agilidade</span>.
                    </h1>
                    <p class="text-lg text-gray-500 dark:text-gray-400 leading-relaxed">
                        Um sistema robusto feito em Laravel para simplificar o controle de informações, usuários e registros do seu dia a dia.
                    </p>
                </div>

                <div class="space-y-4">
                    <div class="flex items-center gap-4 p-4 rounded-xl bg-gray-50 dark:bg-[#1f1f1e] border border-gray-100 dark:border-[#3E3E3A] hover:border-laravel/30 transition duration-300">
                        <div class="w-10 h-10 rounded-full bg-laravel/10 flex items-center justify-center text-laravel">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800 dark:text-white text-sm">Gestão Completa</h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400">CRUD completo com validações.</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 p-4 rounded-xl bg-gray-50 dark:bg-[#1f1f1e] border border-gray-100 dark:border-[#3E3E3A] hover:border-laravel/30 transition duration-300">
                        <div class="w-10 h-10 rounded-full bg-blue-500/10 flex items-center justify-center text-blue-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800 dark:text-white text-sm">Segurança Total</h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Autenticação e proteção CSRF nativas.</p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="relative w-full lg:w-[45%] bg-gradient-to-br from-[#1f1f1e] to-black flex items-center justify-center p-10 overflow-hidden">
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-laravel opacity-20 blur-[80px] rounded-full"></div>
                
                <div class="absolute inset-0 bg-[url('https://laravel.com/assets/img/welcome/background.svg')] opacity-10 mix-blend-overlay"></div>

                <div class="relative z-10 flex flex-col items-center text-center group">
                    <div class="w-24 h-24 rounded-2xl bg-gradient-to-br from-laravel to-red-700 shadow-2xl shadow-red-900/50 flex items-center justify-center transform group-hover:scale-110 transition duration-500">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path>
                        </svg>
                    </div>
                    <h2 class="mt-6 text-2xl font-bold text-white tracking-wide">MySQL Database</h2>
                    <p class="text-gray-400 text-sm mt-2">Conectado e pronto para uso</p>
                </div>
            </div>

        </main>
    </div>

    <footer class="py-6 text-center text-xs text-gray-400 dark:text-gray-600">
        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }}) &copy; {{ date('Y') }}
    </footer>

</body>
</html>