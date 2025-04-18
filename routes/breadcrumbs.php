<?php 
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Painél central
Breadcrumbs::for('dashboard.index', function (BreadcrumbTrail $trail) {
    $trail->push('Painél Central', route('dashboard.index'));
});

// Tarefas
Breadcrumbs::for('dashboard.tasks', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard.index');
    $trail->push('Tarefas', route('dashboard.tasks'));
});
// Lista
Breadcrumbs::for('dashboard.list', function (BreadcrumbTrail $trail, $range = null) {
    $trail->push('Lista', route('dashboard.list', $range));
});

////////////// FINANCEIRO //////////////

// Dashboard financeiro
Breadcrumbs::for('financial.index', function (BreadcrumbTrail $trail) {
    $trail->push('Financeiro', route('financial.index'));
});

// Categorias
Breadcrumbs::for('financial.categories.index', function (BreadcrumbTrail $trail) {
    $trail->parent('financial.index');
    $trail->push('Categorias', route('financial.categories.index'));
});
Breadcrumbs::for('financial.categories.create', function (BreadcrumbTrail $trail) {
    $trail->parent('financial.categories.index');
    $trail->push('Adicionar', route('financial.categories.create'));
});
Breadcrumbs::for('financial.categories.edit', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('financial.categories.index');
    $trail->push('Editar Categoria', route('financial.categories.edit', $id));
});

// Transações
Breadcrumbs::for('financial.transactions.index', function (BreadcrumbTrail $trail) {
    $trail->parent('financial.index');
    $trail->push('Transações', route('financial.transactions.index'));
});
Breadcrumbs::for('financial.transactions.edit', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('financial.transactions.index');
    $trail->push('Editar Transação', route('financial.transactions.edit', $id));
});
Breadcrumbs::for('financial.transactions.processing', function (BreadcrumbTrail $trail) {
    $trail->parent('financial.transactions.index');
    $trail->push('Processar', route('financial.transactions.processing'));
});
Breadcrumbs::for('financial.transactions.checked', function (BreadcrumbTrail $trail) {
    $trail->parent('financial.transactions.index');
    $trail->push('Concluídas', route('financial.transactions.checked'));
});

// Instituições
Breadcrumbs::for('financial.institutions.index', function (BreadcrumbTrail $trail) {
    $trail->parent('financial.index');
    $trail->push('Instituições', route('financial.institutions.index'));
});
Breadcrumbs::for('financial.institutions.create', function (BreadcrumbTrail $trail) {
    $trail->parent('financial.institutions.index');
    $trail->push('Adicionar', route('financial.institutions.create'));
});
Breadcrumbs::for('financial.institutions.edit', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('financial.institutions.index');
    $trail->push('Editar Instituição', route('financial.institutions.edit', $id));
});

// Carteiras
Breadcrumbs::for('financial.wallets.index', function (BreadcrumbTrail $trail) {
    $trail->parent('financial.index');
    $trail->push('Carteiras', route('financial.wallets.index'));
});
Breadcrumbs::for('financial.wallets.create', function (BreadcrumbTrail $trail) {
    $trail->parent('financial.wallets.index');
    $trail->push('Adicionar', route('financial.wallets.create'));
});
Breadcrumbs::for('financial.wallets.show', function (BreadcrumbTrail $trail, $id = null) {
    $trail->parent('financial.wallets.index');
    $trail->push('Visualizando', route('financial.wallets.show', $id));
});
Breadcrumbs::for('financial.wallets.edit', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('financial.wallets.index');
    $trail->push('Editar Carteira', route('financial.wallets.edit', $id));
});

// Cartões de Crédito
Breadcrumbs::for('financial.credit.cards.index', function (BreadcrumbTrail $trail) {
    $trail->parent('financial.index');
    $trail->push('Cartões de Crédito', route('financial.credit.cards.index'));
});
Breadcrumbs::for('financial.credit.cards.create', function (BreadcrumbTrail $trail) {
    $trail->parent('financial.credit.cards.index');
    $trail->push('Adicionar', route('financial.credit.cards.create'));
});
Breadcrumbs::for('financial.credit.cards.show', function (BreadcrumbTrail $trail, $id = null) {
    $trail->parent('financial.credit.cards.index');
    $trail->push('Visualizando', route('financial.credit.cards.show', $id));
});
Breadcrumbs::for('financial.credit.cards.edit', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('financial.credit.cards.index');
    $trail->push('Editar Cartão', route('financial.credit.cards.edit', $id));
});
Breadcrumbs::for('financial.credit.cards.transactions', function (BreadcrumbTrail $trail) {
    $trail->parent('financial.credit.cards.index');
    $trail->push('Transações', route('financial.credit.cards.transactions'));
});

// Débitos
Breadcrumbs::for('financial.debits.index', function (BreadcrumbTrail $trail) {
    $trail->parent('financial.index');
    $trail->push('Débitos', route('financial.debits.index'));
});
Breadcrumbs::for('financial.debits.create', function (BreadcrumbTrail $trail) {
    $trail->parent('financial.debits.index');
    $trail->push('Adicionar', route('financial.debits.create'));
});
Breadcrumbs::for('financial.debits.edit', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('financial.debits.index');
    $trail->push('Editar Débito', route('financial.debits.edit', $id));
});

////////////// NUTRIÇÃO //////////////

// Dashboard de Alimentação
Breadcrumbs::for('nutrition.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard.index');
    $trail->push('Nutrição', route('nutrition.index'));
});

// Dietas
Breadcrumbs::for('diets.index', function (BreadcrumbTrail $trail) {
    $trail->parent('nutrition.index');
    $trail->push('Dietas', route('diets.index'));
});

Breadcrumbs::for('diets.create', function (BreadcrumbTrail $trail) {
    $trail->parent('diets.index');
    $trail->push('Adicionar', route('diets.create'));
});

Breadcrumbs::for('diets.show', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('diets.index');
    $trail->push("Gerenciar Dieta", route('diets.show', $id));
});

Breadcrumbs::for('diets.edit', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('diets.index');
    $trail->push("Editar Dieta", route('diets.edit', $id));
});

// Alimentos
Breadcrumbs::for('foods.index', function (BreadcrumbTrail $trail) {
    $trail->parent('nutrition.index');
    $trail->push('Alimentos', route('foods.index'));
});

Breadcrumbs::for('foods.create', function (BreadcrumbTrail $trail) {
    $trail->parent('foods.index');
    $trail->push('Adicionar', route('foods.create'));
});

Breadcrumbs::for('foods.edit', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('foods.index');
    $trail->push("Editar Alimento", route('foods.edit', $id));
});

// Pratos
Breadcrumbs::for('dishes.index', function (BreadcrumbTrail $trail) {
    $trail->parent('nutrition.index');
    $trail->push('Pratos', route('dishes.index'));
});

Breadcrumbs::for('dishes.create', function (BreadcrumbTrail $trail) {
    $trail->parent('dishes.index');
    $trail->push('Adicionar', route('dishes.create'));
});

Breadcrumbs::for('dishes.edit', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('dishes.index');
    $trail->push("Editar Prato", route('dishes.edit', $id));
});

////////////// NUTRIÇÃO //////////////

////////////// Catalogo //////////////

// Catálogo - Página Inicial
Breadcrumbs::for('catalogs.index', function (BreadcrumbTrail $trail) {
    $trail->push('Catálogo', route('catalogs.index'));
});

// Catálogo - Adicionar
Breadcrumbs::for('catalogs.create', function (BreadcrumbTrail $trail) {
    $trail->parent('catalogs.index');
    $trail->push('Adicionar Produto', route('catalogs.create'));
});

// Catálogo - Visualizar
Breadcrumbs::for('catalogs.show', function (BreadcrumbTrail $trail, $id = null) {
    $trail->parent('catalogs.index');
    $trail->push('Visualizando', route('catalogs.show', $id));
});

// Catálogo - Editar
Breadcrumbs::for('catalogs.edit', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('catalogs.index');
    $trail->push('Editar Produto', route('catalogs.edit', $id));
});

////////////// Catalogo //////////////


////////////// Projetos //////////////

// Projetos
Breadcrumbs::for('agenda.index', function (BreadcrumbTrail $trail) {
});

Breadcrumbs::for('projects.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard.index');
    $trail->push('Lista de projetos', route('projects.index'));
});

Breadcrumbs::for('projects.show', function (BreadcrumbTrail $trail) {
    $trail->parent('projects.index');
    $trail->push('Visualizando Projeto', route('projects.show'));
});

Breadcrumbs::for('tasks.others', function (BreadcrumbTrail $trail) {
    $trail->parent('projects.index');
    $trail->push('Ideias e Excluídas', route('projects.index'));
});

// Status > Lista
Breadcrumbs::for('statuses.index', function (BreadcrumbTrail $trail) {
    $trail->parent('projects.index');
    $trail->push('Status', route('statuses.index'));
});

// Status > Adicionar
Breadcrumbs::for('statuses.create', function (BreadcrumbTrail $trail) {
    $trail->parent('statuses.index');
    $trail->push('Adicionar', route('statuses.create'));
});

// Status > Editar
Breadcrumbs::for('statuses.edit', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('statuses.index');
    $trail->push('Editar', route('statuses.edit', $id));
});

// Categorias > Lista
Breadcrumbs::for('categories.index', function (BreadcrumbTrail $trail) {
    $trail->parent('projects.index');
    $trail->push('Categorias', route('categories.index'));
});

// Categorias > Adicionar
Breadcrumbs::for('categories.create', function (BreadcrumbTrail $trail) {
    $trail->parent('categories.index');
    $trail->push('Adicionar', route('categories.create'));
});

// Categorias > Editar
Breadcrumbs::for('categories.edit', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('categories.index');
    $trail->push('Editar', route('categories.edit', $id));
});


////////////// Projetos //////////////

// Desafios > Lista
Breadcrumbs::for('challenges.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard.index');
    $trail->push('Desafios', route('challenges.index'));
});

// Desafios > Adicionar
Breadcrumbs::for('challenges.create', function (BreadcrumbTrail $trail) {
    $trail->parent('challenges.index');
    $trail->push('Adicionar', route('challenges.create'));
});

// Desafios > Editar
Breadcrumbs::for('challenges.edit', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('challenges.index');
    $trail->push('Editar', route('challenges.edit', $id));
});


// Usuários > Lista
Breadcrumbs::for('users.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard.index');
    $trail->push('Usuários', route('users.index'));
});

// Usuários > Adicionar
Breadcrumbs::for('users.create', function (BreadcrumbTrail $trail) {
    $trail->parent('users.index');
    $trail->push('Adicionar', route('users.create'));
});

// Usuários > Editar
Breadcrumbs::for('users.edit', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('users.index');
    $trail->push('Editar', route('users.edit', $id));
});
