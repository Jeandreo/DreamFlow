<?php

use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CatalogItemController;
use App\Http\Controllers\ChallengeController;
use App\Http\Controllers\ChatGPTController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FinancialCategoryController;
use App\Http\Controllers\FinancialController;
use App\Http\Controllers\FinancialCreditCardController;
use App\Http\Controllers\FinancialInstitutionController;
use App\Http\Controllers\FinancialTransactionsController;
use App\Http\Controllers\FinancialWalletController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectCategoryController;
use App\Http\Controllers\ProjectCommentController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectStatusController;
use App\Http\Controllers\ProjectTaskController;
use App\Http\Controllers\UserController;
use App\Models\ChallengeMonthly;
use App\Models\FinancialCreditCard;
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

    // FINANCIAL
    Route::prefix('financeiro')->group(function () {

        // DASHBOARD
        Route::name('financial.')->group(function () {
            Route::get('/', [FinancialController::class, 'index'])->name('index');
        });

        // CATEGORIES
        Route::prefix('categorias')->group(function () {
            Route::name('financial.categories.')->group(function () {
                Route::get('/', [FinancialCategoryController::class, 'index'])->name('index');
                Route::get('/adicionar', [FinancialCategoryController::class, 'create'])->name('create');
                Route::post('/adicionar', [FinancialCategoryController::class, 'store'])->name('store');
                Route::get('/desabilitar/{id}', [FinancialCategoryController::class, 'destroy'])->name('destroy');
                Route::get('/editar/{id}', [FinancialCategoryController::class, 'edit'])->name('edit');
                Route::put('/editar/{id}', [FinancialCategoryController::class, 'update'])->name('update');
            });
        });

        // TRANSACTIONS
        Route::prefix('transacoes')->group(function () {
            Route::name('financial.transactions.')->group(function () {
                Route::get('/', [FinancialTransactionsController::class, 'index'])->name('index');
                Route::post('/adicionar', [FinancialTransactionsController::class, 'store'])->name('store');
                Route::get('/editar/{id}', [FinancialTransactionsController::class, 'edit'])->name('edit');
                Route::put('/editar/{id}', [FinancialTransactionsController::class, 'update'])->name('update');
                Route::get('/processar', [FinancialTransactionsController::class, 'processing'])->name('processing');
                Route::post('/concluida', [FinancialTransactionsController::class, 'checked'])->name('checked');
                Route::put('/remove', [FinancialTransactionsController::class, 'destroy'])->name('destroy');
            });
        });

        // TRANSACTIONS
        Route::prefix('instituicoes')->group(function () {
            Route::name('financial.institutions.')->group(function () {
                Route::get('/', [FinancialInstitutionController::class, 'index'])->name('index');
                Route::get('/adicionar', [FinancialInstitutionController::class, 'create'])->name('create');
                Route::post('/adicionar', [FinancialInstitutionController::class, 'store'])->name('store');
                Route::get('/desabilitar/{id}', [FinancialCategoryController::class, 'destroy'])->name('destroy');
                Route::get('/editar/{id}', [FinancialInstitutionController::class, 'edit'])->name('edit');
                Route::put('/editar/{id}', [FinancialInstitutionController::class, 'update'])->name('update');
            });
        });

        // TRANSACTIONS
        Route::prefix('carteiras')->group(function () {
            Route::name('financial.wallets.')->group(function () {
                Route::get('/', [FinancialWalletController::class, 'index'])->name('index');
                Route::get('/adicionar', [FinancialWalletController::class, 'create'])->name('create');
                Route::post('/adicionar', [FinancialWalletController::class, 'store'])->name('store');
                Route::get('/visualizando/{id?}', [FinancialWalletController::class, 'show'])->name('show');
                Route::get('/desabilitar/{id}', [FinancialWalletController::class, 'destroy'])->name('destroy');
                Route::get('/editar/{id}', [FinancialWalletController::class, 'edit'])->name('edit');
                Route::put('/editar/{id}', [FinancialWalletController::class, 'update'])->name('update');
            });
        });

        // TRANSACTIONS
        Route::prefix('cartoes-de-credito')->group(function () {
            Route::name('financial.credit.cards.')->group(function () {
                Route::get('/', [FinancialCreditCardController::class, 'index'])->name('index');
                Route::get('/adicionar', [FinancialCreditCardController::class, 'create'])->name('create');
                Route::post('/adicionar', [FinancialCreditCardController::class, 'store'])->name('store');
                Route::get('/visualizando/{id?}', [FinancialCreditCardController::class, 'show'])->name('show');
                Route::get('/desabilitar/{id}', [FinancialCreditCardController::class, 'destroy'])->name('destroy');
                Route::get('/editar/{id}', [FinancialCreditCardController::class, 'edit'])->name('edit');
                Route::put('/editar/{id}', [FinancialCreditCardController::class, 'update'])->name('update');
                Route::post('/transactions', [FinancialCreditCardController::class, 'transactions'])->name('transactions');
            });
        });

    });

    // PROFILE USER
    Route::prefix('catalogo')->group(function () {

        // PROJECTS
        Route::name('catalogs.')->group(function () {
            Route::get('/', [CatalogController::class, 'index'])->name('index');
            Route::get('/adicionar', [CatalogController::class, 'create'])->name('create');
            Route::post('/adicionar', [CatalogController::class, 'store'])->name('store');
            Route::get('/visualizando/{id?}', [CatalogController::class, 'show'])->name('show');
            Route::get('/desabilitar/{id}', [CatalogController::class, 'destroy'])->name('destroy');
            Route::get('/editar/{id}', [CatalogController::class, 'edit'])->name('edit');
            Route::put('/editar/{id}', [CatalogController::class, 'update'])->name('update');
        });

    });
    
    // PROFILE USER
    Route::prefix('catalogo-itens')->group(function () {

        // PROJECTS
        Route::name('catalogs.items.')->group(function () {
            Route::get('/', [CatalogItemController::class, 'index'])->name('index');
            Route::get('/adicionar/{id}', [CatalogItemController::class, 'create'])->name('create');
            Route::post('/adicionar/{id}', [CatalogItemController::class, 'store'])->name('store');
            Route::get('/visualizando/{id?}', [CatalogItemController::class, 'show'])->name('show');
            Route::get('/desabilitar/{id}', [CatalogItemController::class, 'destroy'])->name('destroy');
            Route::get('/editar/{id}', [CatalogItemController::class, 'edit'])->name('edit');
            Route::put('/editar/{id}', [CatalogItemController::class, 'update'])->name('update');
        });

    });

    // PROFILE USER
    Route::prefix('projetos')->group(function () {

        // PROJECTS
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
                Route::post('/visualizando-lista', [ProjectTaskController::class, 'showOne'])->name('show.one');
                Route::post('/desabilitar', [ProjectTaskController::class, 'destroy'])->name('destroy');
                Route::get('/desabilitar/{id?}', [ProjectTaskController::class, 'destroy'])->name('destroy');
                Route::post('/exibir-subtarefas', [ProjectTaskController::class, 'showSubtasks'])->name('show.subtasks');
                Route::post('/stand-by', [ProjectTaskController::class, 'standBy'])->name('stand.by');
                Route::get('/stand-by/{id}', [ProjectTaskController::class, 'standBy'])->name('stand.by.active');
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
                Route::post('/prazo', [ProjectTaskController::class, 'time'])->name('time');
                Route::get('/outras/{type?}', [ProjectTaskController::class, 'others'])->name('others');
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

        // CATEGORIES
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

        // CHALLENGES
        Route::prefix('desafios')->group(function () {
            Route::name('challenges.')->group(function () {
                Route::get('/', [ChallengeController::class, 'index'])->name('index');
                Route::get('/adicionar', [ChallengeController::class, 'create'])->name('create');
                Route::post('/adicionar', [ChallengeController::class, 'store'])->name('store');
                Route::get('/desabilitar/{id}', [ChallengeController::class, 'destroy'])->name('destroy');
                Route::get('/editar/{id}', [ChallengeController::class, 'edit'])->name('edit');
                Route::put('/editar/{id}', [ChallengeController::class, 'update'])->name('update');
                Route::post('/marcar', [ChallengeController::class, 'check'])->name('check');
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
