<?php

namespace App\Http\Controllers;

use App\Models\FinancialCategory;
use App\Models\FinancialCreditCard;
use App\Models\FinancialTransactions;
use App\Models\FinancialWallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TransactionsApiController extends Controller
{

    // Configura api
    protected $apiTransaction;
    protected $repository;

    // Contruct
    public function __construct(Request $request, FinancialTransactions $content)
    {
        // Passar o modelo e o request para o construtor do controller
        $this->apiTransaction = new FinancialTransactionsController($request, new FinancialTransactions);
        $this->repository = $content;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function balance()
    {
        // Inicia a consulta com junções e seleções
        $balance = $this->apiTransaction->balance();

        // Retorna para API
        return response()->json($balance);
    }

    /**
     * Marca uma transação como paga ou não paga.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function paid($id)
    {
        // Inicia a consulta com junções e seleções
        $transaction = $this->repository->find($id);

        // Verifica se a transação foi encontrada
        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transação não encontrada.',
            ], 404);
        }

        // Alterna o estado de 'paid'
        $transaction->paid = !$transaction->paid;
        $transaction->save();

        // Retorna para API com o estado atual e sucesso
        return response()->json([
            'success' => true,
            'paid' => $transaction->paid,
            'message' => 'Transação atualizada com sucesso.'
        ]);
    }

    /**
     * Marca uma transação como paga ou não paga.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function transaction($id)
    {
        // Inicia a consulta com junções e seleções
        $transaction = $this->repository->with('category')->find($id);

        // Verifica se a transação foi encontrada
        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transação não encontrada.',
            ], 404);
        }

        // Consulta
        $category = $transaction->category;
        if ($category->father) {
            $category->color = $category->father->color;
            $category->icon = $category->father->icon;
        }

        // Obtém os dados do pagamento
        if($transaction->wallet_id){
            $paymentMethod = $transaction->wallet;
            $type = 'wallet';
        } else {
            $paymentMethod = $transaction->credit;
            $type = 'credit';
        }

        // Obtém pagamentos
        $transaction->payment = [
            'id' => $paymentMethod->id,
            'name' => $paymentMethod->name,
            'url' => url("storage/instituicoes/$paymentMethod->institution_id/logo-150px.jpg"),
            'type' => $type,
        ];

        // Retorna para API com o estado atual e sucesso
        return response()->json([
            'success' => true,
            'transaction' => $transaction,
            'message' => 'Transação encontrada com sucesso.'
        ]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function transactions(Request $request)
    {
        // Extrai dados
        $data = $request->all();

        // Formata
        if (!isset($data['date_begin'])) {
            $data['date_begin'] = date('Y-m-01');
        }

        if (!isset($data['date_end'])) {
            $data['date_end'] = date('Y-m-t');
        }

        // Conecta API
        $apiTransaction = $this->apiTransaction;

        // Inicia a consulta com junções e seleções
        $query = $apiTransaction->transactions($data);

        // Transações
        $transactions = $query->get()->toArray();

        // Obtém as transações recorrente
        $recurrents = $apiTransaction->recurringTransactions($data, $transactions);

        // Mescla as duas coleções
        $transactions = collect($transactions)->merge($recurrents);

        // Obtém Faturas
        $fatures = $apiTransaction->fatureTransactions($data);

        // Remove as transações de cartão
        $fatures = array_filter($fatures->toArray(), function ($transaction) {
            return !($transaction->credit_card_id && $transaction->fature == 0);
        });

        // Mescla as duas coleções
        $transactions = collect($transactions)->merge($fatures);

        // Mapeia as colunas
        $collection = collect($transactions)->map(function ($item) {
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

        // Formata
        $transactionsFilter = array_values($collection->toArray());

        // Retorna para API
        return response()->json([
            'transactions' => $transactionsFilter,
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
    public function categories($type = null)
    {

        // Categories
        $categories = [];

        // Obtém as categorias ativas
        $categoriesFathers = FinancialCategory::where('status', 1)->whereNull('father_id');

        // Filtra de acordo com o tipo
        if($type){
            $categoriesFathers = $categoriesFathers->where('type', $type);
        }

        // Consulta
        $categoriesFathers = $categoriesFathers->get();

        foreach ($categoriesFathers as $father) {
            $categories[] = $father;
            foreach ($father->childrens as $child) {
                $child->color = $father->color;
                $categories[] = $child;
            }
        }

        // Retorna para API
        return response()->json($categories);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function newTransaction(Request $request)
    {
        // Conecta API
        $apiTransaction = $this->apiTransaction;

        // Inicia a consulta com junções e seleções
        $apiTransaction->store($request);

        // Retorna para API
        return response()->json('Transação adicionada com sucesso.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function walletsCredits()
    {
        // Obtém cartões de crédito
        $wallets = FinancialWallet::where('status', 1)->get()->map(function ($wallet) {
            $wallet->type = 'wallet';
            $wallet->total = $wallet->total();
            $wallet->url = url("storage/instituicoes/$wallet->institution_id/logo-150px.jpg");
            return $wallet;
        });

        $credits = FinancialCreditCard::where('status', 1)->get()->map(function ($credit) {
            $credit->type = 'credit';
            $credit->total = $credit->total();
            $credit->url = url("storage/instituicoes/$credit->institution_id/logo-150px.jpg");
            return $credit;
        });

        // Combina os dados em um único array usando concat
        $combined = $wallets->concat($credits);

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
        if (!$content) return response()->json(['Transaction Not Found'], 404);

        // GENERATES DISPLAY WITH DATA
        return response()->json([
            'transaction' => $content,
            'wallets'     => $wallets,
            'credits'     => $credits,
            'categories'  => $categories,
        ]);
    }
}
