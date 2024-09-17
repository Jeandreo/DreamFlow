<?php

namespace App\Http\Controllers;

use App\Models\FinancialCategory;
use App\Models\FinancialCreditCard;
use App\Models\FinancialTransactions;
use App\Models\FinancialWallet;
use Illuminate\Http\Request;

class TransactionsApiController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTransactions(Request $request)
    {
        
        // Passar o modelo e o request para o construtor do controller
        $financialTransactionsController = new FinancialTransactionsController($request, new FinancialTransactions);

        // Inicia a consulta com junções e seleções
        $query = $financialTransactionsController->transactions($request);
        
        // Transações
        $transactions = $query->get()->toArray();

        // Obtém as transações recorrente
        $recurrents = $financialTransactionsController->recurringTransactions($request, $transactions);

        // Mescla as duas coleções
        $transactions = collect($transactions)->merge($recurrents);

        // Obtém Faturas
        $data = $financialTransactionsController->fatureTransactions($transactions); 

        // Remove as transações de cartão
        $data = array_filter($data->toArray(), function($transaction) {
            return !($transaction->credit_card_id && $transaction->fature == 0);
        });

        // Organiza a coleção
        $collection = collect($data);

        // Mapeia as colunas
        $collection = collect($data)->map(function ($item) {
            // Define as propriedades padrão para ícone e cor
            $color = '#0076f5';
            $icon = 'fa-solid fa-receipt';
            $category = 'Fatura';
            
            // Se não for fatura, usa os ícones e cores personalizados do pai ou dele mesmo.
            if (!isset($item->fature) || $item->fature == 0) {
                $color = $item->has_father ? $item->father_color : $item->category_color;
                $icon = $item->has_father ? $item->father_icon : $item->category_icon;
                $category = $item->category;
            }
        
            // Adiciona os valores personalizados ao item
            return (object) array_merge((array) $item, [
                'color' => $color,
                'icon' => $icon,
                'category' => $category,
            ]);
        });

        // Agrupamento dos resultados esperados e lançados
        $expected = [
            'total' => $collection->sum('value'),
            'revenue' => $collection->where('value', '>', 0)->sum('value'),
            'expense' => $collection->where('value', '<', 0)->sum('value'),
        ];

        $current = [
            'total' => $collection->where('paid', true)->sum('value'),
            'revenue' => $collection->where('paid', true)->where('value', '>', 0)->sum('value'),
            'expense' => $collection->where('paid', true)->where('value', '<', 0)->sum('value'),
        ];
        
        // COUNT TOTAL RECORDS
        $totalRecords = count($transactions);

        // Retorna para API
        return response()->json([
            'transactions' => $transactions,
            'transactionsFilter' => $collection,
            'expected' => $expected,
            'current' => $current,
            'totalRecords' => $totalRecords,
        ]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function categories()
    {
        // Cartegorias
        $categories = FinancialCategory::where('status', 1)->get();

        // Retorna para API
        return response()->json($categories);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getWalletsCredits()
    {
        // Obtém cartões de crédito
        $wallets = FinancialWallet::where('status', 1)->get()->map(function($wallet) {
            $wallet->type = 'wallet';
            return $wallet;
        });

        $credits = FinancialCreditCard::where('status', 1)->get()->map(function($credit) {
            $credit->type = 'credit';
            return $credit;
        });
        
        // Combina os dados em um único array
        $combined = $wallets->merge($credits);

        // Retorna para API
        return response()->json($combined);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // GET ALL DATA
        $content = FinancialTransactions::find($id);
        $wallets = FinancialWallet::where('status', 1)->get();
        $credits = FinancialCreditCard::where('status', 1)->get();
        $categories = FinancialCategory::where('status', 1)->whereNotNull('father_id')->get();

        // VERIFY IF EXISTS
        if(!$content) return response()->json(['Transaction Not Found'], 404);

        // GENERATES DISPLAY WITH DATA
        return response()->json([
            'transaction' => $content,
            'wallets'     => $wallets,
            'credits'     => $credits,
            'categories'  => $categories,
        ]);
    }

}
