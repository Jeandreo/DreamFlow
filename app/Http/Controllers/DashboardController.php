<?php

namespace App\Http\Controllers;

use App\Models\ProjectTask;
use App\Models\User;
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


        // MAKE INSTANCE WITH DATE
        $actualMonth = Carbon::create(date('Y'), date('m'), 1);

        // GET DAYS OF PREVIOUS MONTH
        $previousMonth = $actualMonth->copy()->subMonth();

        // GET TASKS AND CHALLENGES
        $tasks = ProjectTask::where('date', '<=', date('Y-m-d', strtotime('+2 days')))->where('checked', false)->whereNull('task_id')->orderBy('date')->where('status', 1)->get();
        $challenges = ProjectTask::where('date', '>=', now())->where('checked', false)->where('challenge', true)->get();

        // GET USERS FOR TASK
        $users = User::where('status', 1)->get();

        // RETURN VIEW WITH DATA
        return view('pages.dashboard.index')->with([
            'actualMonth' => $actualMonth,
            'previousMonth' => $previousMonth,
            'tasks' => $tasks,
            'users' => $users,
            'challenges' => $challenges,
        ]);

    }
}
