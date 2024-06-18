<?php

namespace Database\Factories;

use App\Models\FinancialCategory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FinancialTransactions>
 */
class FinancialTransactionsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        // OPTIONAL PAYMENT
        $datePayment = fake()->optional()->dateTimeBetween('-1 year', 'now');

        // EXAMPLES
        $transactions = [ 'Compra de ração e areia', 'Conta de luz', 'Conta de água', 'Compra do mês', 'Compra semanal de carne', 'Curso de financias', 'Uber', 'Mensalidade da academia', 'Assinatura de TV a cabo', 'Aluguel', 'Compra de roupas', 'Serviço de streaming', 'Manutenção do carro', 'Compra de material escolar', 'Jantar em restaurante', 'Ingressos para o cinema', 'Consulta médica', 'Farmácia', 'Reparos domésticos', 'Assinatura de revista', 'Plano de saúde', 'Passagem de ônibus', 'Passagem de avião', 'Hospedagem em hotel', 'Seguro do carro', 'Seguro residencial', 'Conserto do computador', 'Compra de eletrônicos', 'Compra de móveis', 'Compra de eletrodomésticos', 'Serviço de jardinagem', 'Serviço de limpeza', 'Assinatura de jornal', 'Curso online', 'Doação para caridade', 'Presentes de aniversário', 'Presentes de Natal', 'Compra de brinquedos', 'Mensalidade escolar', 'Taxa de condomínio', 'Conta de gás', 'Taxa de internet', 'Serviço de telefone', 'Compra de material de escritório', 'Compra de livros', 'Compra de revistas', 'Manutenção de bicicleta', 'Pagamento de multa', 'Estacionamento', 'Pedágio', 'Refeição rápida', 'Ingressos para show', 'Taxa de inscrição em evento', 'Compra de utensílios de cozinha', 'Manutenção da casa', 'Pagamento de empréstimo', 'Compra de plantas', 'Compra de ferramentas', 'Serviço de cabeleireiro', 'Serviço de manicure', 'Mensalidade de clube', 'Curso de idiomas', 'Aula de música', 'Aula de dança', 'Inscrição em academia', 'Compra de bijuterias', 'Compra de joias', 'Compra de cosméticos', 'Compra de perfumes', 'Compra de alimentos orgânicos', 'Feira livre', 'Compra de bebidas', 'Compra de vinhos', 'Assinatura de clube de vinhos', 'Compra de equipamentos esportivos', 'Inscrição em maratona', 'Compra de ingressos para teatro', 'Pagamento de impostos', 'Taxa de serviços públicos', 'Manutenção de piscina', 'Compra de peças para carro', 'Taxa de estacionamento', 'Compra de bicicletas', 'Inscrição em concurso', 'Compra de ingressos para museu', 'Assinatura de serviços online', 'Compra de hardware', 'Compra de software', 'Compra de jogos', 'Inscrição em workshop', 'Inscrição em seminário', 'Compra de material artístico', 'Compra de acessórios para celular', 'Compra de acessórios para computador', 'Serviço de mudança', 'Compra de instrumentos musicais' ];

        // WALLET OR CREDIT CARD
        $wallet = fake()->numberBetween(1, 4);
        $credit = null;

        // RAND BETWEEN
        if(rand(0, 1)){
            $wallet = null;
            $credit = 1;
        }

        // GET CATEGORIES
        $categoriesExpense = FinancialCategory::where('status', 1)->where('type', 'expense')->get()->pluck('id');
        $categoriesRevenue = FinancialCategory::where('status', 1)->where('type', 'revenue')->get()->pluck('id');

        // RAND RENEVUE OR EXPENSE
        if(rand(0, 1)){
            $category = $categoriesExpense->random();
            $signal = '-';
        } else {
            $category = $categoriesRevenue->random();
            $signal = null;
        }
        
        return [
            'paid' => rand(0, 1),
            'wallet_id' => $wallet,
            'credit_card_id' => $credit,
            'category_id' => $category,
            'name' => $transactions[array_rand($transactions)],
            'hitching' => fake()->boolean,
            'recurrent' => fake()->boolean,
            'value' => $signal . fake()->randomFloat(2, 10, 1000),
            'value_paid' => fake()->randomFloat(2, 0, 1000),
            'date_purchase' => fake()->dateTimeBetween(Carbon::now()->startOfYear(), Carbon::now()->endOfYear())->format('Y-m-d'),
            'date_payment' => $datePayment ? $datePayment->format('Y-m-d') : null,
            'fees' => fake()->randomFloat(2, 0, 100),
            'description' => fake()->sentence,
            'created_by' => 1,
            'updated_by' => fake()->optional()->numberBetween(1, 10),
        ];
    
    }
}
