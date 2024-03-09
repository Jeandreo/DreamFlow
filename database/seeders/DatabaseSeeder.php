<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
            'role' => 1,
            'password' => Hash::make('Inc@ns4v3l_2024'),
            'created_by' => 0,
        ]);

        \App\Models\User::factory(10)->create();
    }
}
