<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        // MAKE ISNTACE WITH DATE
        $actualMonth = Carbon::create(date('Y'), date('m'), 1);

        // Obtém o número de dias do mês anterior
        $previousMonth = $actualMonth->copy()->subMonth();

        // RETURN VIEW WITH DATA
        return view('pages.dashboard.index')->with([
            'actualMonth' => $actualMonth,
            'previousMonth' => $previousMonth,
        ]);

    }
}
