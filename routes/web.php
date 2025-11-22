<?php

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

});

// Rotas disponiveis apenas para quem ESTÁ logado
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

    Route::get('/users', [UsersController::class, 'index'])->name('users.index');

    Route::get('tasks', [App\Http\Controllers\TasksController::class, 'index'])->name('tasks.index');

    Route::get('tasks/create', [App\Http\Controllers\TasksController::class, 'create'])->name('tasks.create');

    Route::post('tasks', [App\Http\Controllers\TasksController::class, 'store'])->name('tasks.store');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});