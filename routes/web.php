<?php

use App\Http\Controllers\ChatGPTController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectStatusController;
use App\Http\Controllers\ProjectTaskController;
use App\Http\Controllers\UserController;
use App\Models\ProjectTask;
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
            Route::get('/visualizando/{id?}', [ProjectController::class, 'show'])->name('show');
            Route::get('/desabilitar/{id}', [ProjectController::class, 'destroy'])->name('destroy');
            Route::get('/editar/{id}', [ProjectController::class, 'edit'])->name('edit');
            Route::put('/editar/{id}', [ProjectController::class, 'update'])->name('update');
        });

        // TASKS
        Route::prefix('tarefas')->group(function () {
            Route::name('tasks.')->group(function () {
                Route::post('/', [ProjectTaskController::class, 'index'])->name('index');
                Route::post('/adicionar', [ProjectTaskController::class, 'store'])->name('store');
                Route::get('/visualizando/{id}', [ProjectTaskController::class, 'show'])->name('show');
                Route::get('/desabilitar/{id}', [ProjectTaskController::class, 'destroy'])->name('destroy');
                Route::get('/editar/{id}', [ProjectTaskController::class, 'edit'])->name('edit');
                Route::put('/editar/{id}', [ProjectTaskController::class, 'update'])->name('update');
                Route::put('/editar-ajax/{id}', [ProjectTaskController::class, 'updateAjax'])->name('update.ajax');
                Route::get('/ajax/{id}', [ProjectTaskController::class, 'ajax'])->name('ajax');
                Route::post('/check', [ProjectTaskController::class, 'check'])->name('check');
                Route::put('/prioridade', [ProjectTaskController::class, 'priority'])->name('priority');
                Route::put('/designado', [ProjectTaskController::class, 'designated'])->name('designated');
                Route::put('/status', [ProjectTaskController::class, 'status'])->name('status');
                Route::put('/data', [ProjectTaskController::class, 'date'])->name('date');
                Route::put('/ordem', [ProjectTaskController::class, 'order'])->name('order');
            });
        });

        // STATUS
        Route::prefix('status')->group(function () {
            Route::name('statuses.')->group(function () {
                Route::get('/', [ProjectStatusController::class, 'index'])->name('index');
                Route::get('/adicionar', [ProjectStatusController::class, 'create'])->name('create');
                Route::post('/adicionar', [ProjectStatusController::class, 'store'])->name('store');
                Route::get('/visualizando/{id}', [ProjectStatusController::class, 'show'])->name('show');
                Route::get('/desabilitar/{id}', [ProjectStatusController::class, 'destroy'])->name('destroy');
                Route::get('/editar/{id}', [ProjectStatusController::class, 'edit'])->name('edit');
                Route::put('/editar/{id}', [ProjectStatusController::class, 'update'])->name('update');
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

    // CHAT-GPT
    // // Route::prefix('chat-gpt')->group(function () {
    // //     Route::name('users.')->group(function () {
    // //         Route::get('/', [ChatGPTController::class, 'index'])->name('index');
    // //     });
    // // });

});

require __DIR__.'/auth.php';
