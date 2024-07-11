<?php

namespace App\Http\Controllers;

use App\Models\Financial;
use App\Models\FinancialCategory;
use App\Models\FinancialCreditCard;
use App\Models\FinancialTransactions;
use App\Models\FinancialWallet;
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

}
