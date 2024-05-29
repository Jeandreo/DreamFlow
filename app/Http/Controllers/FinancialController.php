<?php

namespace App\Http\Controllers;

use App\Models\Financial;
use App\Models\FinancialTransactions;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinancialController extends Controller
{
    protected $request;
    private $repository;
    
    public function __construct(Request $request, Financial $content)
    {
        
        $this->request = $request;
        $this->repository = $content;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mapeamento de números de mês para meses em português
        $monthNames = [
            1 => 'Janeiro',
            2 => 'Fevereiro',
            3 => 'Março',
            4 => 'Abril',
            5 => 'Maio',
            6 => 'Junho',
            7 => 'Julho',
            8 => 'Agosto',
            9 => 'Setembro',
            10 => 'Outubro',
            11 => 'Novembro',
            12 => 'Dezembro',
        ];

        // Inicializando os arrays de entrada e saída
        $entradas = array_fill(1, 12, 0);
        $saidas = array_fill(1, 12, 0);
        $aporte = array_fill(1, 12, 0);

        // Consultar o banco de dados para obter os totais mensais de entradas e saídas
        $transactions = FinancialTransactions::select(
            DB::raw('MONTH(date_venciment) as month'),
            DB::raw('SUM(value) as total')
        )
        ->whereYear('date_venciment', date('Y')) // Filtra o ano atual, pode ser modificado conforme necessário
        ->groupBy('month')
        ->get();

        foreach ($transactions as $transaction) {
            if ($transaction->total > 0) {
                $entradas[$transaction->month] += $transaction->total;
                $aporte[$transaction->month] += rand(20, 300);
            } elseif ($transaction->total < 0) {
                $saidas[$transaction->month] += abs($transaction->total);
            }
            $aporte[$transaction->month] += rand(20, 300);
        }

        // Organizando os dados para a variável $series
        $series = [
            [
                'name' => 'Entrada',
                'data' => array_values($entradas),
            ],
            [
                'name' => 'Saída',
                'data' => array_values($saidas),
            ],
            [
                'name' => 'Aporte',
                'data' => array_values($aporte),
            ],
        ];

        $currentMonth = Carbon::now()->format('Y-m');

        // Filtrar transações pelo mês atual e calcular as somas das entradas e saídas
        $entriesSum = FinancialTransactions::where('value', '>=', 0)
            ->where('date_venciment', 'like', $currentMonth . '%')
            ->sum('value');
    
        $exitsSum = FinancialTransactions::where('value', '<', 0)
            ->where('date_venciment', 'like', $currentMonth . '%')
            ->sum('value');
    
        // Calcula a diferença
        $difference = $entriesSum + $exitsSum;
    
        // Retorna os resultados em um array
        $values = [
            'revenues' => $entriesSum,
            'expenses' => $exitsSum,
            'difference' => $difference,
        ];

        return view('pages.financial.index')->with([
            'values' => $values,
            'series' => $series,
            'monthNames' => array_values($monthNames),
        ]);

    }

}
