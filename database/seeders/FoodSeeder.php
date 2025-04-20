<?php

namespace Database\Seeders;

use App\Models\Food;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $foods = [
            'Peito de Frango desfiado' => [
                'type' => 'peso',
                'quantity' => 50,
                'calories' => 83
            ],
            'Doce De Leite Mu Mu' => [
                'type' => 'peso',
                'quantity' => 20,
                'calories' => 70
            ],
            'Arroz' => [
                'type' => 'peso',
                'quantity' => 100,
                'calories' => 130
            ],
            'Banana prata' => [
                'type' => 'unidade',
                'quantity' => 1,
                'calories' => 89
            ],
            'Whey Protein' => [
                'type' => 'unidade',
                'quantity' => 1,
                'calories' => 120
            ],
            'Pão integral' => [
                'type' => 'unidade',
                'quantity' => 2,
                'calories' => 140
            ],
            'Torrada' => [
                'type' => 'unidade',
                'quantity' => 1,
                'calories' => 35
            ],
            'Peito de Frango' => [
                'type' => 'peso',
                'quantity' => 100,
                'calories' => 165
            ],
            'Iogurte Desnatado' => [
                'type' => 'unidade',
                'quantity' => 1,
                'calories' => 60
            ],
            'Helmans Light' => [
                'type' => 'peso',
                'quantity' => 24,
                'calories' => 90
            ],
            'Maçã' => [
                'type' => 'unidade',
                'quantity' => 1,
                'calories' => 52
            ],
            'Salada' => [
                'type' => 'peso',
                'quantity' => 50,
                'calories' => 15
            ],
            'Aveia em flocos' => [
                'type' => 'peso',
                'quantity' => 50,
                'calories' => 190
            ],
            'Tomate' => [
                'type' => 'peso',
                'quantity' => 100,
                'calories' => 18
            ],
            'Bombom Ouro Branco' => [
                'type' => 'peso',
                'quantity' => 20,
                'calories' => 110
            ],
            'Queijo Light Tirolez' => [
                'type' => 'unidade',
                'quantity' => 1,
                'calories' => 35
            ],
            'Feijão preto' => [
                'type' => 'peso',
                'quantity' => 100,
                'calories' => 130
            ],
            'Presunto Frimesa' => [
                'type' => 'unidade',
                'quantity' => 1,
                'calories' => 19
            ],
            'Iogurte Morango Zero' => [
                'type' => 'unidade',
                'quantity' => 1,
                'calories' => 50
            ],
            'Purê de Batata' => [
                'type' => 'peso',
                'quantity' => 100,
                'calories' => 85
            ],
            'Iogurte natural' => [
                'type' => 'peso',
                'quantity' => 100,
                'calories' => 60
            ],
            'Mussarela' => [
                'type' => 'unidade',
                'quantity' => 1,
                'calories' => 50
            ],
            'Manga palmer' => [
                'type' => 'unidade',
                'quantity' => 1,
                'calories' => 110
            ],
            'Banana caturra' => [
                'type' => 'unidade',
                'quantity' => 1,
                'calories' => 89
            ],
            
            // Nona linha
            'Gelatina' => [
                'type' => 'peso',
                'quantity' => 100,
                'calories' => 10
            ],
            'Clube Social Integral' => [
                'type' => 'unidade',
                'quantity' => 1,
                'calories' => 70
            ],
            'Salada de Frutas' => [
                'type' => 'peso',
                'quantity' => 150,
                'calories' => 100
            ],
            'Macarrão integral' => [
                'type' => 'peso',
                'quantity' => 100,
                'calories' => 160
            ],
            'Leite Condensado' => [
                'type' => 'peso',
                'quantity' => 20,
                'calories' => 65
            ],
            'Carne moída' => [
                'type' => 'peso',
                'quantity' => 100,
                'calories' => 200
            ],
            'Kiwi' => [
                'type' => 'unidade',
                'quantity' => 1,
                'calories' => 40
            ],
            'Paçoquita Rolha' => [
                'type' => 'unidade',
                'quantity' => 1,
                'calories' => 80
            ],
            
            // 13ª linha
            'Molho de tomate' => [
                'type' => 'volume',
                'quantity' => 120,
                'calories' => 50
            ],
            'Omelete' => [
                'type' => 'unidade',
                'quantity' => 1,
                'calories' => 240
            ],
            
            // 14ª linha
            'Bife Patinho' => [
                'type' => 'peso',
                'quantity' => 100,
                'calories' => 200
            ],
            'Whey Protein Chocolate' => [
                'type' => 'unidade',
                'quantity' => 1,
                'calories' => 120
            ],
            'Requeijão' => [
                'type' => 'peso',
                'quantity' => 30,
                'calories' => 60
            ]
        ];

        foreach ($foods as $foodName => $info) {
            Food::create([
                'name' => $foodName,
                'type' => $info['type'],
                'quantity' => $info['quantity'],
                'calories' => $info['calories'],
                'created_by' => 1,
            ]);
        }
    }
}
