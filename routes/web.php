    <?php
    use App\Http\Controllers\PasswordController;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\Auth\LoginController;
    use App\Http\Controllers\UsersController;
    use App\Http\Controllers\DashboardController;

    Route::get('/', function () {
        return view('welcome');
    });


    // Rotas disponiveis apenas para quem NÃO está logado
    Route::middleware('guest')->group(function () {
        
        Route::get('/login', [LoginController::class, 'create'])->name('login');
        
        Route::get('/users/create', [UsersController::class, 'create'])->name('users.create');
        
        Route::post('/users/store', [UsersController::class, 'store'])->name('users.store');
        
        Route::post('/login', [LoginController::class, 'store'])->name('login.store');

        Route::get('/users/esqueciSenha', [PasswordController::class, 'esqueciSenha'])->name('users.esqueciSenha');

        Route::post('/users/esqueciSenha', [PasswordController::class, 'enviarLink'])->name('password.enviarLink');
        
        Route::get('/users/redefinirSenha/{token}', [PasswordController::class, 'exibirFormulario'])->name('password.exibirFormulario');
        
        Route::post('/users/redefinirSenha', [PasswordController::class, 'atualizarSenha'])->name('password.atualizarSenha');

    });

    // Rotas disponiveis apenas para quem ESTÁ logado
    Route::middleware('auth')->group(function () {
        Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

        Route::get('tasks', [App\Http\Controllers\TasksController::class, 'index'])->name('tasks.index');

        Route::get('tasks/create', [App\Http\Controllers\TasksController::class, 'create'])->name('tasks.create');

        Route::post('tasks', [App\Http\Controllers\TasksController::class, 'store'])->name('tasks.store');

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('tasks/{id}/edit', [App\Http\Controllers\TasksController::class, 'edit'])->name('tasks.edit');
        
        Route::put('tasks/{id}/update', [App\Http\Controllers\TasksController::class, 'update'])->name('tasks.update');

        Route::get('/users/{id}/edit', [UsersController::class, 'edit'])->name('users.edit');

        Route::put('/users/{id}/update', [UsersController::class, 'update'])->name('users.update');

        Route::patch('/users/alterarSenha/{id}', [UsersController::class, 'alterarSenha'])->name('users.alterarSenha');

        Route::get('/users/{id}/editarSenha', [UsersController::class, 'editarSenha'])->name('users.editarSenha');

    });