<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ProjectStatus;
use App\Models\User;
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
            'name' => 'Administração',
            'email' => 'atendimento@dreamake.com.br',
            'role_id' => 1,
            'password' => Hash::make('Inc@ns4v3l_2024'),
            'created_by' => 0,
        ]);

        ProjectCategory::create([
            'name' => 'Tráfego Pago',
            'created_by' => 1,
        ]);

        ProjectCategory::create([
            'name' => 'Marketing Digital',
            'created_by' => 1,
        ]);

        ProjectCategory::create([
            'name' => 'Social Media',
            'created_by' => 1,
        ]);

        ProjectCategory::create([
            'name' => 'Web Design',
            'created_by' => 1,
        ]);

        ProjectCategory::create([
            'name' => 'Design',
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

        // // Project::create([
        // //     'name' => 'Campanha de E-mail Marketing',
        // //     'url' => 'campanha-de-email-marketing',
        // //     'color' => '#1ABC9C',
        // //     'description' => 'Uma série de e-mails estratégicos para promover produtos, engajar clientes e aumentar as vendas.',
        // //     'start_date' => now(),
        // //     'category_id' => 3,
        // //     'manager_id' => 1,
        // //     'created_by' => 1,
        // // ]);
        
        // // Project::create([
        // //     'name' => 'Otimização de SEO',
        // //     'url' => 'otimizacao-de-seo',
        // //     'color' => '#9B59B6',
        // //     'description' => 'Um projeto focado em melhorar a classificação nos mecanismos de busca, aumentando o tráfego orgânico para o site.',
        // //     'start_date' => now(),
        // //     'category_id' => 4,
        // //     'manager_id' => 1,
        // //     'created_by' => 1,
        // // ]);

        // // Project::create([
        // //     'name' => 'Marketing de Conteúdo',
        // //     'url' => 'marketing-de-conteudo',
        // //     'color' => '#3498DB',
        // //     'description' => 'Estratégia para criar e distribuir conteúdo relevante para atrair e engajar o público-alvo.',
        // //     'start_date' => now(),
        // //     'category_id' => 5,
        // //     'manager_id' => 1,
        // //     'created_by' => 1,
        // // ]);
        
        // // Project::create([
        // //     'name' => 'Publicidade Online',
        // //     'url' => 'publicidade-online',
        // //     'color' => '#E67E22',
        // //     'description' => 'Uma campanha paga direcionada para alcançar o público-alvo em sites, redes sociais e mecanismos de busca.',
        // //     'start_date' => now(),
        // //     'category_id' => 2,
        // //     'manager_id' => 1,
        // //     'created_by' => 1,
        // // ]);

        // // Project::create([
        // //     'name' => 'Marketing de Influenciadores',
        // //     'url' => 'marketing-de-influenciadores',
        // //     'color' => '#27AE60',
        // //     'description' => 'Colaboração com influenciadores digitais para promover produtos ou serviços para suas audiências.',
        // //     'start_date' => now(),
        // //     'category_id' => 3,
        // //     'manager_id' => 1,
        // //     'created_by' => 1,
        // // ]);

        ProjectStatus::create([
            'name' => 'A Fazer',
            'color' => '#E67E22',
            'project_id' => 1,
            'order' => 1,
            'created_by' => 1,
        ]);

        ProjectStatus::create([
            'name' => 'Em andamento',
            'color' => '#FFA500',
            'project_id' => 1,
            'order' => 1,
            'created_by' => 1,
        ]);

        ProjectStatus::create([
            'name' => 'Concluído',
            'color' => '#00FF00',
            'project_id' => 1,
            'order' => 1,
            'created_by' => 1,
        ]);

        ProjectStatus::create([
            'name' => 'A Fazer',
            'color' => '#E67E22',
            'project_id' => 2,
            'order' => 1,
            'created_by' => 1,
        ]);

        ProjectStatus::create([
            'name' => 'Em andamento',
            'color' => '#FFA500',
            'project_id' => 2,
            'order' => 1,
            'created_by' => 1,
        ]);

        ProjectStatus::create([
            'name' => 'Concluído',
            'color' => '#00FF00',
            'project_id' => 2,
            'order' => 1,
            'created_by' => 1,
        ]);

        ProjectStatus::create([
            'name' => 'A Fazer',
            'color' => '#E67E22',
            'project_id' => 3,
            'order' => 1,
            'created_by' => 1,
        ]);

        ProjectStatus::create([
            'name' => 'Em andamento',
            'color' => '#FFA500',
            'project_id' => 3,
            'order' => 1,
            'created_by' => 1,
        ]);

        ProjectStatus::create([
            'name' => 'Concluído',
            'color' => '#00FF00',
            'project_id' => 3,
            'order' => 1,
            'created_by' => 1,
        ]);

        ProjectStatus::create([
            'name' => 'A Fazer',
            'color' => '#E67E22',
            'project_id' => 4,
            'order' => 1,
            'created_by' => 1,
        ]);

        ProjectStatus::create([
            'name' => 'Em andamento',
            'color' => '#FFA500',
            'project_id' => 4,
            'order' => 1,
            'created_by' => 1,
        ]);

        ProjectStatus::create([
            'name' => 'Concluído',
            'color' => '#00FF00',
            'project_id' => 4,
            'order' => 1,
            'created_by' => 1,
        ]);

        ProjectStatus::create([
            'name' => 'A Fazer',
            'color' => '#E67E22',
            'project_id' => 5,
            'order' => 1,
            'created_by' => 1,
        ]);

        ProjectStatus::create([
            'name' => 'Em andamento',
            'color' => '#FFA500',
            'project_id' => 5,
            'order' => 1,
            'created_by' => 1,
        ]);

        ProjectStatus::create([
            'name' => 'Concluído',
            'color' => '#00FF00',
            'project_id' => 5,
            'order' => 1,
            'created_by' => 1,
        ]);

        \App\Models\User::factory(10)->create();
    }
}
