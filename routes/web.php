<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// AUTH
Route::middleware(['auth'])->group(function () {

    // DASHBOARD
    Route::get('/', [ProjectController::class, 'index'])->name('index');

    // PROFILE USER
    Route::prefix('projetos')->group(function () {

        //PROJECTS
        Route::name('projects.')->group(function () {
            Route::get('/', [ProjectController::class, 'index'])->name('index');
            Route::get('/adicionar', [ProjectController::class, 'create'])->name('create');
            Route::post('/adicionar', [ProjectController::class, 'store'])->name('store');
            Route::get('/visualizando/{id}', [ProjectController::class, 'show'])->name('show');
            Route::get('/desabilitar/{id}', [ProjectController::class, 'destroy'])->name('destroy');
            Route::get('/editar/{id}', [ProjectController::class, 'edit'])->name('edit');
            Route::put('/editar/{id}', [ProjectController::class, 'update'])->name('update');
        });

        // TASKS
        Route::prefix('tarefas')->group(function () {
            Route::name('tasks.')->group(function () {
                Route::get('/', [TaskController::class, 'index'])->name('index');
                Route::post('/adicionar', [TaskController::class, 'store'])->name('store');
                Route::get('/visualizando/{id}', [TaskController::class, 'show'])->name('show');
                Route::get('/desabilitar/{id}', [TaskController::class, 'destroy'])->name('destroy');
                Route::get('/editar/{id}', [TaskController::class, 'edit'])->name('edit');
                Route::put('/editar/{id}', [TaskController::class, 'update'])->name('update');
            });
        });

        // STATUS
        Route::prefix('status')->group(function () {
            Route::name('status.')->group(function () {
                Route::get('/', [StatusController::class, 'index'])->name('index');
                Route::get('/adicionar', [StatusController::class, 'create'])->name('create');
                Route::post('/adicionar', [StatusController::class, 'store'])->name('store');
                Route::get('/visualizando/{id}', [StatusController::class, 'show'])->name('show');
                Route::get('/desabilitar/{id}', [StatusController::class, 'destroy'])->name('destroy');
                Route::get('/editar/{id}', [StatusController::class, 'edit'])->name('edit');
                Route::put('/editar/{id}', [StatusController::class, 'update'])->name('update');
            });
        });

    });

    // ADMIN
    Route::prefix('administracao')->group(function () {

        // USUARIOS
        Route::prefix('usuarios')->group(function () {
            Route::name('users.')->group(function () {
                Route::get('/', [UserController::class, 'index'])->name('index');
                Route::get('/adicionar', [UserController::class, 'create'])->name('create');
                Route::post('/adicionar', [UserController::class, 'store'])->name('store');
                Route::get('/visualizando/{id}', [UserController::class, 'show'])->name('show');
                Route::get('/desabilitar/{id}', [UserController::class, 'destroy'])->name('destroy');
                Route::get('/editar/{id}', [UserController::class, 'edit'])->name('edit');
                Route::put('/editar/{id}', [UserController::class, 'update'])->name('update');
            });
        });

    });

    // PROFILE USER
    Route::prefix('meu-perfil')->group(function () {
        Route::name('profile.')->group(function () {
            Route::get('/', [ProfileController::class, 'index'])->name('index');
            Route::get('/adicionar', [ProfileController::class, 'create'])->name('create');
            Route::post('/adicionar', [ProfileController::class, 'store'])->name('store');
            Route::get('/visualizando/{id}', [ProfileController::class, 'show'])->name('show');
            Route::get('/desabilitar/{id}', [ProfileController::class, 'destroy'])->name('destroy');
            Route::get('/editar/{id}', [ProfileController::class, 'edit'])->name('edit');
            Route::put('/editar/{id}', [ProfileController::class, 'update'])->name('update');
        });
    });

});

require __DIR__.'/auth.php';
