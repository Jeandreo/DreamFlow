<?php

use App\Http\Controllers\ChatGPTController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectCategoryController;
use App\Http\Controllers\ProjectCommentController;
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
    Route::get('/', [DashboardController::class, 'index'])->name('index');

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
            Route::get('/lembrete/{id}', [ProjectController::class, 'reminder'])->name('reminder');
        });

        // TASKS
        Route::prefix('tarefas')->group(function () {
            Route::name('tasks.')->group(function () {
                Route::post('/', [ProjectTaskController::class, 'index'])->name('index');
                Route::post('/adicionar', [ProjectTaskController::class, 'store'])->name('store');
                Route::post('/visualizando', [ProjectTaskController::class, 'show'])->name('show');
                Route::get('/desabilitar/{id}', [ProjectTaskController::class, 'destroy'])->name('destroy');
                Route::get('/stand-by/{id}', [ProjectTaskController::class, 'standBy'])->name('stand.by');
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
                Route::post('/subtarefa', [ProjectTaskController::class, 'subtask'])->name('subtask');
                Route::post('/concluidas', [ProjectTaskController::class, 'checkeds'])->name('checkeds');
                Route::post('/desafio', [ProjectTaskController::class, 'challenge'])->name('challenge');
            });
        });

        // STATUS
        Route::prefix('status')->group(function () {
            Route::name('statuses.')->group(function () {
                Route::get('/', [ProjectStatusController::class, 'index'])->name('index');
                Route::get('/adicionar', [ProjectStatusController::class, 'create'])->name('create');
                Route::post('/adicionar', [ProjectStatusController::class, 'store'])->name('store');
                Route::get('/desabilitar/{id}', [ProjectStatusController::class, 'destroy'])->name('destroy');
                Route::get('/editar/{id}', [ProjectStatusController::class, 'edit'])->name('edit');
                Route::put('/editar/{id}', [ProjectStatusController::class, 'update'])->name('update');
            });
        });

        // STATUS
        Route::prefix('categorias')->group(function () {
            Route::name('categories.')->group(function () {
                Route::get('/', [ProjectCategoryController::class, 'index'])->name('index');
                Route::get('/adicionar', [ProjectCategoryController::class, 'create'])->name('create');
                Route::post('/adicionar', [ProjectCategoryController::class, 'store'])->name('store');
                Route::get('/desabilitar/{id}', [ProjectCategoryController::class, 'destroy'])->name('destroy');
                Route::get('/editar/{id}', [ProjectCategoryController::class, 'edit'])->name('edit');
                Route::put('/editar/{id}', [ProjectCategoryController::class, 'update'])->name('update');
            });
        });

        // COMMENTS
        Route::prefix('comentarios')->group(function () {
            Route::name('comments.')->group(function () {
                Route::post('/adicionar', [ProjectCommentController::class, 'store'])->name('store');
                Route::post('/visualizando', [ProjectCommentController::class, 'show'])->name('show');
                Route::put('/desabilitar/{id}', [ProjectCommentController::class, 'destroy'])->name('destroy');
                Route::put('/editar/{id}', [ProjectCommentController::class, 'update'])->name('update');
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
                Route::put('/barra-lateral', [UserController::class, 'sidebar'])->name('sidebar');
                Route::put('/notas', [UserController::class, 'notes'])->name('notes');
            });
        });

    });
    // PROFILE USER
    Route::prefix('configuracoes')->group(function () {
        Route::name('configs.')->group(function () {
            Route::post('/CKEupload', [ConfigController::class, 'CKEupload']);
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
