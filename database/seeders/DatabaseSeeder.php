<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Catalog;
use App\Models\CatalogItem;
use App\Models\Challenge;
use App\Models\DayOfWeek;
use App\Models\Diet;
use App\Models\Dish;
use App\Models\Financial;
use App\Models\FinancialCategory;
use App\Models\FinancialCreditCard;
use App\Models\FinancialInstitution;
use App\Models\FinancialTransactions;
use App\Models\FinancialWallet;
use App\Models\Food;
use App\Models\Meal;
use App\Models\MealItem;
use App\Models\MealTime;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ProjectStatus;
use App\Models\ProjectTask;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::create([
            'name' => 'Jeandreo Furquim',
            'email' => 'jeandreofur@gmail.com',
            'role_id' => 1,
            'password' => Hash::make('Inc@ns4v3l_2025'),
            'sidebar' => false,
            'created_by' => 0,
        ]);

        User::create([
            'name' => 'Eduarda Cruz',
            'email' => 'eduarda@dreamake.com.br',
            'role_id' => 2,
            'password' => Hash::make('atingir_metas'),
            'created_by' => 0,
        ]);

        ProjectCategory::create([
            'name' => 'Vendas',
            'type' => 1,
            'created_by' => 1,
        ]);

        ProjectCategory::create([
            'name' => 'Tráfego Pago',
            'type' => 1,
            'created_by' => 1,
        ]);

        ProjectCategory::create([
            'name' => 'Marketing Digital',
            'type' => 1,
            'created_by' => 1,
        ]);

        ProjectCategory::create([
            'name' => 'Social Media',
            'type' => 1,
            'created_by' => 1,
        ]);

        ProjectCategory::create([
            'name' => 'Web Design',
            'type' => 1,
            'created_by' => 1,
        ]);

        ProjectCategory::create([
            'name' => 'Design',
            'type' => 1,
            'created_by' => 1,
        ]);

        ProjectCategory::create([
            'name' => 'Financias',
            'type' => 1,
            'created_by' => 1,
        ]);

        Project::create([
            'name' => 'Lembretes',
            'reminder' => true,
            'type' => 2,
            'url' => 'lembrete',
            'color' => '#5632a8',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
            'start_date' => now(),
            'category_id' => 1,
            'manager_id' => 1,
            'created_by' => 1,
        ]);

        Project::create([
            'name' => 'Academia',
            'type' => 2,
            'url' => 'academia',
            'color' => '#5632a8',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
            'start_date' => now(),
            'category_id' => 1,
            'manager_id' => 1,
            'created_by' => 1,
        ]);

        Project::create([
            'name' => 'Campanha de Marketing Digital',
            'url' => 'campanha-de-marketing-digital',
            'color' => '#5632a8',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
            'start_date' => now(),
            'category_id' => 1,
            'manager_id' => 1,
            'created_by' => 1,
        ]);

        Project::create([
            'name' => 'Campanha de Mídias Sociais',
            'url' => 'campanha-de-midias-sociais',
            'color' => '#FF5733',
            'description' => 'Uma campanha estratégica para aumentar o engajamento e alcance nas principais plataformas de mídias sociais.',
            'start_date' => now(),
            'category_id' => 2,
            'manager_id' => 1,
            'created_by' => 1,
        ]);

        Project::create([
            'name' => 'Campanha de E-mail Marketing',
            'url' => 'campanha-de-email-marketing',
            'color' => '#1ABC9C',
            'description' => 'Uma série de e-mails estratégicos para promover produtos, engajar clientes e aumentar as vendas.',
            'start_date' => now(),
            'category_id' => 3,
            'manager_id' => 1,
            'created_by' => 1,
        ]);

        Project::create([
            'name' => 'Otimização de SEO',
            'url' => 'otimizacao-de-seo',
            'color' => '#9B59B6',
            'description' => 'Um projeto focado em melhorar a classificação nos mecanismos de busca, aumentando o tráfego orgânico para o site.',
            'start_date' => now(),
            'category_id' => 4,
            'manager_id' => 1,
            'created_by' => 1,
        ]);

        Project::create([
            'name' => 'Marketing de Conteúdo',
            'url' => 'marketing-de-conteudo',
            'color' => '#3498DB',
            'description' => 'Estratégia para criar e distribuir conteúdo relevante para atrair e engajar o público-alvo.',
            'start_date' => now(),
            'category_id' => 5,
            'manager_id' => 1,
            'created_by' => 1,
        ]);

        Project::create([
            'name' => 'Publicidade Online',
            'url' => 'publicidade-online',
            'color' => '#009ef7',
            'description' => 'Uma campanha paga direcionada para alcançar o público-alvo em sites, redes sociais e mecanismos de busca.',
            'start_date' => now(),
            'category_id' => 2,
            'manager_id' => 1,
            'created_by' => 1,
        ]);

        Project::create([
            'name' => 'Marketing de Influenciadores',
            'url' => 'marketing-de-influenciadores',
            'color' => '#27AE60',
            'description' => 'Colaboração com influenciadores digitais para promover produtos ou serviços para suas audiências.',
            'start_date' => now(),
            'category_id' => 3,
            'manager_id' => 1,
            'created_by' => 1,
        ]);

        ProjectStatus::create([
            'name' => 'A Fazer',
            'color' => '#009ef7',
            'project_id' => 1,
            'order' => 1,
            'created_by' => 1,
        ]);

        ProjectStatus::create([
            'name' => 'Em andamento',
            'color' => '#79bc17',
            'project_id' => 1,
            'order' => 1,
            'created_by' => 1,
        ]);

        ProjectStatus::create([
            'name' => 'Concluído',
            'color' => '#282c43',
            'project_id' => 1,
            'order' => 1,
            'created_by' => 1,
        ]);

        ProjectStatus::create([
            'name' => 'A Fazer',
            'color' => '#009ef7',
            'project_id' => 2,
            'order' => 1,
            'created_by' => 1,
        ]);

        ProjectStatus::create([
            'name' => 'Em andamento',
            'color' => '#79bc17',
            'project_id' => 2,
            'order' => 1,
            'created_by' => 1,
        ]);

        ProjectStatus::create([
            'name' => 'Concluído',
            'color' => '#282c43',
            'project_id' => 2,
            'order' => 1,
            'created_by' => 1,
        ]);

        ProjectStatus::create([
            'name' => 'A Fazer',
            'color' => '#009ef7',
            'project_id' => 3,
            'order' => 1,
            'created_by' => 1,
        ]);

        ProjectStatus::create([
            'name' => 'Em andamento',
            'color' => '#79bc17',
            'project_id' => 3,
            'order' => 1,
            'created_by' => 1,
        ]);

        ProjectStatus::create([
            'name' => 'Concluído',
            'color' => '#282c43',
            'project_id' => 3,
            'order' => 1,
            'created_by' => 1,
        ]);

        ProjectStatus::create([
            'name' => 'A Fazer',
            'color' => '#009ef7',
            'project_id' => 4,
            'order' => 1,
            'created_by' => 1,
        ]);

        ProjectStatus::create([
            'name' => 'Em andamento',
            'color' => '#79bc17',
            'project_id' => 4,
            'order' => 1,
            'created_by' => 1,
        ]);

        ProjectStatus::create([
            'name' => 'Concluído',
            'color' => '#282c43',
            'project_id' => 4,
            'order' => 1,
            'created_by' => 1,
        ]);

        ProjectStatus::create([
            'name' => 'A Fazer',
            'color' => '#009ef7',
            'project_id' => 5,
            'order' => 1,
            'created_by' => 1,
        ]);

        ProjectStatus::create([
            'name' => 'Em andamento',
            'color' => '#79bc17',
            'project_id' => 5,
            'order' => 1,
            'created_by' => 1,
        ]);

        ProjectStatus::create([
            'name' => 'Concluído',
            'color' => '#282c43',
            'project_id' => 5,
            'order' => 1,
            'created_by' => 1,
        ]);

        ProjectTask::create([
            'project_id' => 1,
            'status_id' => 1,
            'designated_id' => rand(1, 5),
            'checked' => rand(0, 1),
            'priority' => rand(0, 3),
            'date' => now(),
            'name' => 'Reunião com cliente para entender o projeto',
            'phrase' => 'Levar 5 ideias para facilitar a comunicação',
            'created_by' => rand(1, 5),
        ]);

        ProjectTask::create([
            'project_id' => 1,
            'status_id' => rand(1, 3),
            'designated_id' => rand(1, 5),
            'checked' => rand(0, 1),
            'priority' => rand(0, 3),
            'date' => now(),
            'name' => 'Desenvolvimento de protótipo inicial',
            'phrase' => 'Garantir que os principais recursos estejam funcionando corretamente',
            'created_by' => rand(1, 5),
        ]);

        ProjectTask::create([
            'project_id' => 1,
            'status_id' => rand(1, 3),
            'designated_id' => rand(1, 5),
            'checked' => rand(0, 1),
            'priority' => rand(0, 3),
            'date' => now(),
            'name' => 'Testes de Usabilidade',
            'created_by' => rand(1, 5),
        ]);

        ProjectTask::create([
            'project_id' => 1,
            'status_id' => rand(1, 3),
            'designated_id' => rand(1, 5),
            'checked' => rand(0, 1),
            'priority' => rand(0, 3),
            'date' => now(),
            'name' => 'Implementação de novos recursos',
            'phrase' => 'Adicionar funcionalidades solicitadas pelo cliente',
            'created_by' => rand(1, 5),
        ]);

        ProjectTask::create([
            'project_id' => 1,
            'status_id' => rand(1, 3),
            'designated_id' => rand(1, 5),
            'checked' => rand(0, 1),
            'priority' => rand(0, 3),
            'date' => now(),
            'name' => 'Revisão de código',
            'phrase' => 'Verificar e corrigir erros no código-fonte',
            'created_by' => rand(1, 5),
        ]);

        ProjectTask::create([
            'project_id' => 1,
            'status_id' => rand(1, 3),
            'designated_id' => rand(1, 5),
            'checked' => rand(0, 1),
            'priority' => rand(0, 3),
            'date' => now(),
            'name' => 'Preparação para entrega do projeto',
            'phrase' => 'Garantir que todos os requisitos estejam atendidos antes da entrega ao cliente',
            'created_by' => rand(1, 5),
        ]);

        ProjectTask::create([
            'project_id' => 2,
            'status_id' => rand(1, 3),
            'designated_id' => rand(1, 5),
            'checked' => rand(0, 1),
            'priority' => rand(0, 3),
            'date' => now(),
            'name' => 'Implementação de funcionalidade de chat em tempo real',
            'created_by' => rand(1, 5),
        ]);

        ProjectTask::create([
            'project_id' => 2,
            'status_id' => rand(1, 3),
            'designated_id' => rand(1, 5),
            'checked' => rand(0, 1),
            'priority' => rand(0, 3),
            'date' => now(),
            'name' => 'Otimização de desempenho da aplicação',
            'created_by' => rand(1, 5),
        ]);

        ProjectTask::create([
            'project_id' => 2,
            'status_id' => rand(1, 3),
            'designated_id' => rand(1, 5),
            'checked' => rand(0, 1),
            'priority' => rand(0, 3),
            'date' => now(),
            'name' => 'Implementação de sistema de notificações por e-mail',
            'phrase' => 'Desenvolver um sistema de notificações por e-mail para alertar os usuários sobre eventos importantes',
            'created_by' => rand(1, 5),
        ]);

        ProjectTask::create([
            'project_id' => 2,
            'status_id' => rand(1, 3),
            'designated_id' => rand(1, 5),
            'checked' => rand(0, 1),
            'priority' => rand(0, 3),
            'date' => now(),
            'name' => 'Refatoração do código-fonte',
            'phrase' => 'Reestruturar o código para torná-lo mais legível e sustentável a longo prazo',
            'created_by' => rand(1, 5),
        ]);

        ProjectTask::create([
            'project_id' => 6,
            'status_id' => rand(1, 3),
            'designated_id' => rand(1, 5),
            'checked' => rand(0, 1),
            'priority' => rand(0, 3),
            'date' => now(),
            'name' => 'Testes de segurança da aplicação',
            'phrase' => 'Realizar testes de segurança para identificar e corrigir possíveis vulnerabilidades',
            'created_by' => rand(1, 5),
        ]);

        ProjectTask::create([
            'project_id' => 2,
            'status_id' => rand(1, 3),
            'designated_id' => rand(1, 5),
            'checked' => rand(0, 1),
            'priority' => rand(0, 3),
            'date' => now(),
            'name' => 'Desenvolvimento de interface de administração',
            'phrase' => 'Criar uma interface de administração para gerenciar conteúdos e usuários do sistema',
            'created_by' => rand(1, 5),
        ]);

        ProjectTask::create([
            'project_id' => 3,
            'status_id' => rand(1, 3),
            'designated_id' => rand(1, 5),
            'checked' => rand(0, 1),
            'priority' => rand(0, 3),
            'date' => now(),
            'name' => 'Integração com API de terceiros',
            'phrase' => 'Integrar com API de terceiros para adicionar novos recursos ao sistema',
            'created_by' => rand(1, 5),
        ]);

        ProjectTask::create([
            'project_id' => 3,
            'status_id' => rand(1, 3),
            'designated_id' => rand(1, 5),
            'checked' => rand(0, 1),
            'priority' => rand(0, 3),
            'date' => now(),
            'name' => 'Melhoria na documentação do código',
            'phrase' => 'Atualizar e aprimorar a documentação do código para facilitar a manutenção futura',
            'created_by' => rand(1, 5),
        ]);

        ProjectTask::create([
            'project_id' => 3,
            'status_id' => rand(1, 3),
            'designated_id' => rand(1, 5),
            'checked' => rand(0, 1),
            'priority' => rand(0, 3),
            'date' => now(),
            'name' => 'Implementação de sistema de cache',
            'phrase' => 'Adicionar um sistema de cache para melhorar o desempenho e a escalabilidade da aplicação',
            'created_by' => rand(1, 5),
        ]);

        ProjectTask::create([
            'project_id' => 2,
            'status_id' => rand(1, 3),
            'designated_id' => rand(1, 5),
            'checked' => rand(0, 1),
            'priority' => rand(0, 3),
            'date' => now(),
            'name' => 'Configuração de servidor de produção',
            'phrase' => 'Configurar o servidor de produção para garantir alta disponibilidade e segurança',
            'created_by' => rand(1, 5),
        ]);




        ProjectTask::create([
            'project_id' => 4,
            'status_id' => rand(1, 3),
            'designated_id' => rand(1, 5),
            'checked' => rand(0, 1),
            'priority' => rand(0, 3),
            'date' => now(),
            'name' => 'Desenvolvimento de campanha publicitária',
            'phrase' => 'Criar estratégias de marketing para promover o produto/serviço',
            'created_by' => rand(1, 5),
        ]);

        ProjectTask::create([
            'project_id' => 4,
            'status_id' => rand(1, 3),
            'designated_id' => rand(1, 5),
            'checked' => rand(0, 1),
            'priority' => rand(0, 3),
            'date' => now(),
            'name' => 'Análise de mercado e concorrência',
            'phrase' => 'Realizar estudo de mercado para identificar oportunidades e ameaças',
            'created_by' => rand(1, 5),
        ]);

        ProjectTask::create([
            'project_id' => 4,
            'status_id' => rand(1, 3),
            'designated_id' => rand(1, 5),
            'checked' => rand(0, 1),
            'priority' => rand(0, 3),
            'date' => now(),
            'name' => 'Desenvolvimento de materiais de vendas',
            'phrase' => 'Elaborar apresentações, folhetos e outras ferramentas de vendas',
            'created_by' => rand(1, 5),
        ]);

        ProjectTask::create([
            'project_id' => 6,
            'status_id' => rand(1, 3),
            'designated_id' => rand(1, 5),
            'checked' => rand(0, 1),
            'priority' => rand(0, 3),
            'date' => now(),
            'name' => 'Treinamento da equipe de vendas',
            'phrase' => 'Realizar treinamentos para melhorar habilidades de vendas e conhecimento do produto',
            'created_by' => rand(1, 5),
        ]);

        ProjectTask::create([
            'project_id' => 5,
            'status_id' => rand(1, 3),
            'designated_id' => rand(1, 5),
            'checked' => rand(0, 1),
            'priority' => rand(0, 3),
            'date' => now(),
            'name' => 'Gestão de redes sociais',
            'phrase' => 'Gerenciar perfis em redes sociais para aumentar a visibilidade da marca',
            'created_by' => rand(1, 5),
        ]);

        ProjectTask::create([
            'project_id' => 5,
            'status_id' => rand(1, 3),
            'designated_id' => rand(1, 5),
            'checked' => rand(0, 1),
            'priority' => rand(0, 3),
            'date' => now(),
            'name' => 'Desenvolvimento de parcerias estratégicas',
            'phrase' => 'Identificar e estabelecer parcerias com outras empresas para aumentar as vendas',
            'created_by' => rand(1, 5),
        ]);

        ProjectTask::create([
            'project_id' => 5,
            'status_id' => rand(1, 3),
            'designated_id' => rand(1, 5),
            'checked' => rand(0, 1),
            'priority' => rand(0, 3),
            'date' => now(),
            'name' => 'Otimização de funil de vendas',
            'phrase' => 'Analisar e otimizar o funil de vendas para aumentar a conversão de leads em clientes',
            'created_by' => rand(1, 5),
        ]);

        ProjectTask::create([
            'project_id' => 6,
            'status_id' => rand(1, 3),
            'designated_id' => rand(1, 5),
            'checked' => rand(0, 1),
            'priority' => rand(0, 3),
            'date' => now(),
            'name' => 'Participação em eventos do setor',
            'phrase' => 'Representar a empresa em eventos do setor para criar networking e gerar leads',
            'created_by' => rand(1, 5),
        ]);

        ProjectTask::create([
            'project_id' => 2,
            'status_id' => rand(1, 3),
            'designated_id' => rand(1, 5),
            'checked' => rand(0, 1),
            'priority' => rand(0, 3),
            'date' => now(),
            'name' => 'Análise de métricas de marketing',
            'phrase' => 'Analisar métricas de marketing para avaliar o desempenho das campanhas',
            'created_by' => rand(1, 5),
        ]);

        ProjectTask::create([
            'project_id' => 2,
            'status_id' => rand(1, 3),
            'designated_id' => rand(1, 5),
            'checked' => rand(0, 1),
            'priority' => rand(0, 3),
            'date' => now(),
            'name' => 'Desenvolvimento de estratégia de pricing',
            'phrase' => 'Desenvolver uma estratégia de precificação competitiva para maximizar lucros',
            'created_by' => rand(1, 5),
        ]);

        Challenge::create([
            'name' => 'Frutifera',
            'type' => 'mensal',
            'url' => 'frutifera',
            'date' => '03/2024',
            'created_by' => 1,
        ]);

        Catalog::create([
            'name' => 'Receitas de Academia',
            'url' => 'receitas-de-academia',
            'color' => '#b7f246',
            'icon' => 'fa-solid fa-carrot',
            'description' => 1,
            'created_by' => 1,
        ]);

        Catalog::create([
            'name' => 'Vídeos Motivacionais',
            'url' => 'videos-motivacionais',
            'color' => '#fff700',
            'icon' => 'fa-solid fa-hand-fist',
            'description' => 1,
            'created_by' => 1,
        ]);

        CatalogItem::create([
            'catalog_id' => 1,
            'name' => 'Massa',
            'url' => 'Massa' . rand(0,9999),
            'link_video' => 'Massa',
            'link_blog' => 'Massa',
            'content' => 'Massa',
            'created_by' => 1,
        ]);

        CatalogItem::create([
            'catalog_id' => 1,
            'name' => 'Massa',
            'url' => 'Massa' . rand(0,9999),
            'link_video' => 'Massa',
            'link_blog' => 'Massa',
            'content' => 'Massa',
            'created_by' => 1,
        ]);

        CatalogItem::create([
            'catalog_id' => 1,
            'name' => 'Massa',
            'url' => 'Massa' . rand(0,9999),
            'link_video' => 'Massa',
            'link_blog' => 'Massa',
            'content' => 'Massa',
            'created_by' => 1,
        ]);

        CatalogItem::create([
            'catalog_id' => 1,
            'name' => 'Massa',
            'url' => 'Massa' . rand(0,9999),
            'link_video' => 'Massa',
            'link_blog' => 'Massa',
            'content' => 'Massa',
            'created_by' => 1,
        ]);

        CatalogItem::create([
            'catalog_id' => 1,
            'name' => 'Massa',
            'url' => 'Massa' . rand(0,9999),
            'link_video' => 'Massa',
            'link_blog' => 'Massa',
            'content' => 'Massa',
            'created_by' => 1,
        ]);

        CatalogItem::create([
            'catalog_id' => 1,
            'name' => 'Massa',
            'url' => 'Massa' . rand(0,9999),
            'link_video' => 'Massa',
            'link_blog' => 'Massa',
            'content' => 'Massa',
            'created_by' => 1,
        ]);

        CatalogItem::create([
            'catalog_id' => 1,
            'name' => 'Massa',
            'url' => 'Massa' . rand(0,9999),
            'link_video' => 'Massa',
            'link_blog' => 'Massa',
            'content' => 'Massa',
            'created_by' => 1,
        ]);

        CatalogItem::create([
            'catalog_id' => 1,
            'name' => 'Massa',
            'url' => 'Massa' . rand(0,9999),
            'link_video' => 'Massa',
            'link_blog' => 'Massa',
            'content' => 'Massa',
            'created_by' => 1,
        ]);

        FinancialInstitution::create([
            'name' => 'NuBank',
            'created_by' => 1,
        ]);

        FinancialInstitution::create([
            'name' => 'Itaú',
            'created_by' => 1,
        ]);

        FinancialInstitution::create([
            'name' => 'Mercado Pago',
            'created_by' => 1,
        ]);

        FinancialInstitution::create([
            'name' => 'C6 Bank',
            'created_by' => 1,
        ]);

        FinancialInstitution::create([
            'name' => 'PagSeguro',
            'created_by' => 1,
        ]);

        FinancialInstitution::create([
            'name' => 'Banco do Brasil',
            'created_by' => 1,
        ]);

        FinancialInstitution::create([
            'name' => 'Bradesco',
            'created_by' => 1,
        ]);

        FinancialInstitution::create([
            'name' => 'Santander',
            'created_by' => 1,
        ]);

        FinancialInstitution::create([
            'name' => 'Caixa Econômica Federal',
            'created_by' => 1,
        ]);

        FinancialInstitution::create([
            'name' => 'Banco Inter',
            'created_by' => 1,
        ]);

        FinancialInstitution::create([
            'name' => 'BTG Pactual',
            'created_by' => 1,
        ]);

        FinancialInstitution::create([
            'name' => 'XP Investimentos',
            'created_by' => 1,
        ]);

        FinancialInstitution::create([
            'name' => 'Banco Neon',
            'created_by' => 1,
        ]);

        FinancialInstitution::create([
            'name' => 'Banco Original',
            'created_by' => 1,
        ]);

        FinancialInstitution::create([
            'name' => 'Banrisul',
            'created_by' => 1,
        ]);

        FinancialInstitution::create([
            'name' => 'Sicredi',
            'created_by' => 1,
        ]);

        FinancialInstitution::create([
            'name' => 'PicPay',
            'created_by' => 1,
        ]);

        FinancialInstitution::create([
            'name' => 'Ame Digital',
            'created_by' => 1,
        ]);

        FinancialInstitution::create([
            'name' => 'Banco Pan',
            'created_by' => 1,
        ]);

        FinancialInstitution::create([
            'name' => 'BMG',
            'created_by' => 1,
        ]);

        FinancialWallet::create([
            'name' => 'NuBank',
            'url' => 'nubank',
            'color' => '#9d00e6',
            'institution_id' => 1,
            'description' => 'Conta para movimentações gerais',
            'created_by' => 1,
        ]);

        FinancialWallet::create([
            'name' => 'Mercado Pago',
            'url' => 'mercado-pago',
            'color' => '#00b4f0',
            'institution_id' => 3,
            'description' => 'Conta salário Eduarda',
            'created_by' => 1,
        ]);

        FinancialWallet::create([
            'name' => 'Itaú',
            'url' => 'itau',
            'color' => '#0f0f0f',
            'institution_id' => 2,
            'description' => 'Conta Salário Jeandreo',
            'created_by' => 1,
        ]);

        FinancialWallet::create([
            'name' => 'Nubank (Caixinha)',
            'url' => 'nubank-caixinha',
            'color' => '#6603c9',
            'institution_id' => 1,
            'description' => 'Conta para aportes',
            'created_by' => 1,
        ]);

        FinancialCategory::create([
            'name' => 'Despesas de Casa',
            'type' => 'expense',
            'color' => '#911901',
            'icon' => 'fa-solid fa-sack-dollar',
            'created_by' => 1,
        ]);

        FinancialCategory::create([
            'name' => 'Aluguel',
            'type' => 'expense',
            'father_id' => 1,
            'color' => '#6b6b6b',
            'icon' => 'fa-solid fa-home',
            'created_by' => 1,
        ]);

        FinancialCategory::create([
            'name' => 'Entreterimento',
            'type' => 'expense',
            'father_id' => 1,
            'color' => '#cf2200',
            'created_by' => 1,
        ]);

        FinancialCategory::create([
            'name' => 'Transporte',
            'type' => 'expense',
            'color' => '#007bff',
            'icon' => 'fa-solid fa-car',
            'created_by' => 1,
        ]);

        FinancialCategory::create([
            'name' => 'Combustível',
            'type' => 'expense',
            'father_id' => 4,
            'color' => '#ffc107',
            'created_by' => 1,
        ]);

        FinancialCategory::create([
            'name' => 'Manutenção do Carro',
            'type' => 'expense',
            'father_id' => 4,
            'color' => '#28a745',
            'created_by' => 1,
        ]);

        FinancialCategory::create([
            'name' => 'Alimentação',
            'type' => 'expense',
            'color' => '#28a745',
            'icon' => 'fa-solid fa-utensils',
            'created_by' => 1,
        ]);

        FinancialCategory::create([
            'name' => 'Supermercado',
            'type' => 'expense',
            'father_id' => 7,
            'color' => '#6610f2',
            'created_by' => 1,
        ]);

        FinancialCategory::create([
            'name' => 'Lanche',
            'type' => 'expense',
            'father_id' => 7,
            'color' => '#6610f2',
            'created_by' => 1,
        ]);

        FinancialCategory::create([
            'name' => 'Viagem',
            'type' => 'expense',
            'color' => '#6610f2',
            'icon' => 'fa-solid fa-plane',
            'created_by' => 1,
        ]);

        FinancialCategory::create([
            'name' => 'Hospedagem',
            'type' => 'expense',
            'father_id' => 10,
            'color' => '#17a2b8',
            'created_by' => 1,
        ]);

        FinancialCategory::create([
            'name' => 'Passagens',
            'type' => 'expense',
            'father_id' => 10,
            'color' => '#ffc107',
            'created_by' => 1,
        ]);


        FinancialCategory::create([
            'name' => 'Salário',
            'type' => 'revenue',
            'color' => '#a4d100',
            'icon' => 'fa-solid fa-sack-dollar',
            'created_by' => 1,
        ]);

        FinancialCategory::create([
            'name' => 'Investimentos',
            'type' => 'revenue',
            'color' => '#3a9d9a',
            'icon' => 'fa-solid fa-chart-line',
            'created_by' => 1,
        ]);


        FinancialCreditCard::create([
            'name' => 'C&A',
            'limit' => 750.00,
            'wallet_id' => 1,
            'last_numbers' => '0531',
            'closing_day' => 5,
            'due_day' => 15,
            'description' => 'Cartão para emergencias',
            'created_by' => 1,
        ]);


        FinancialCreditCard::create([
            'name' => 'SENFF',
            'limit' => 750.00,
            'wallet_id' => 1,
            'last_numbers' => '0531',
            'closing_day' => 5,
            'due_day' => 10,
            'description' => 'Cartão para emergencias',
            'created_by' => 1,
        ]);

        /* FinancialTransactions::create([
            'wallet_id' => 1,
            'category_id' => 3,
            'name' => 'Netflix',
            'hitching' => 1,
            'value' => 10,
            'date_purchase' => now(),
            'date_payment' => now(),
            'created_by' => 1,
        ]);

        FinancialTransactions::create([
            'wallet_id' => 1,
            'category_id' => 3,
            'name' => 'Google',
            'hitching' => 2,
            'value' => 10,
            'date_purchase' => now(),
            'date_payment' => now(),
            'created_by' => 1,
        ]);

        FinancialTransactions::create([
            'credit_card_id' => 1,
            'category_id' => 8,
            'name' => 'Tênis para corrida',
            'value' => 10,
            'date_purchase' => now(),
            'date_payment' => Carbon::now()->addMonth()->startOfMonth()->addDays(14),
            'created_by' => 1,
        ]);

        FinancialTransactions::create([
            'credit_card_id' => 2,
            'category_id' => 8,
            'name' => 'Uber',
            'value' => 10,
            'date_purchase' => now(),
            'date_payment' => Carbon::now()->addMonth()->startOfMonth()->addDays(9),
            'created_by' => 1,
        ]);

        FinancialTransactions::create([
            'credit_card_id' => 1,
            'category_id' => 8,
            'name' => 'Comida',
            'value' => 10,
            'date_purchase' => now(),
            'date_payment' => Carbon::now()->addMonth()->startOfMonth()->addDays(14),
            'created_by' => 1,
        ]);

        FinancialTransactions::create([
            'wallet_id' => 1,
            'category_id' => 3,
            'name' => 'TaekWondo',
            'value' => 2,
            'date_purchase' => now(),
            'date_payment' => now(),
            'created_by' => 1,
        ]); */

       // Cria alimentos
        //    $foods = Food::factory()->count(20)->create();


       /* /
       // Cria pratos com alimentos
       $dishes = Dish::factory()->count(10)->create()->each(function ($dish) use ($foods) {
           $dish->foods()->attach(
               $foods->random(3)->pluck('id')->toArray()
           );
       });

       // Cria dietas
       $diets = Diet::factory()->count(1)->create();

       // Dias da semana e refeições padrão
       $days = ['Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado', 'Domingo'];
       $mealNames = ['Café da Manhã', 'Lanche da Manhã', 'Almoço', 'Lanche da Tarde', 'Jantar'];

       foreach ($diets as $diet) {
           foreach ($days as $day) {
               $dayOfWeek = DayOfWeek::create([
                   'name'     => $day,
                   'diet_id'  => $diet->id,
               ]);

               foreach ($mealNames as $mealName) {
                   MealTime::create([
                       'name'            => $mealName,
                       'day_of_week_id'  => $dayOfWeek->id,
                   ]);
               }
           }
       }

       // Associa alimentos/pratos às refeições
       foreach ($diets as $diet) {
           foreach ($diet->days as $day) {
               foreach ($day->meals as $mealTime) {
                   // Define entre 2 e 4 itens para essa refeição
                   $itemCount = rand(1, 2);

                   for ($i = 0; $i < $itemCount; $i++) {
                       $isFood = rand(0, 1);

                       if ($isFood) {
                           $food = $foods->random();
                           MealItem::create([
                               'meal_time_id' => $mealTime->id,
                               'food_id'      => $food->id,
                               'dish_id'      => null,
                               'quantity'     => rand(1, 3),
                           ]);
                       } else {
                           $dish = $dishes->random();
                           MealItem::create([
                               'meal_time_id' => $mealTime->id,
                               'food_id'      => null,
                               'dish_id'      => $dish->id,
                               'quantity'     => rand(1, 2),
                           ]);
                       }
                   }
               }
           }
       } */

       // Usuários de exemplo
       User::factory(10)->create();
    }
}
