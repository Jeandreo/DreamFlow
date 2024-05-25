<?php

namespace App\Http\Controllers;

use App\Models\Financial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        // Atualizando o array de séries para incluir as tarefas concluídas
        $series = [
            [
                'name' => 'Entrada',
                'data' => array_values([800.00,850.50,900.75,950.20,1000.00,1100.45,1200.90,1300.35,1500.00,1750.80,1900.25,2000.00]),
            ],
            [
                'name' => 'Saída',
                'data' => array_values([810.25,860.40,920.55,980.75,1050.10,1150.65,1250.30,1350.90,1600.45,1800.85,1950.70,1999.99]),
            ],
        ];

        return view('pages.financial.index')->with([
            'series' => $series,
            'monthNames' => array_values($monthNames),
        ]);

    }
}
