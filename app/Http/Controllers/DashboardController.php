<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
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

        // GET TASKS
        $tasks = ProjectTask::where('date', '<=', date('Y-m-d', strtotime('+1 days')))
                            ->whereNull('task_id')
                            ->where('checked', false)
                            ->where('status', 1)
                            ->orderBy('date')
                            ->get();

        // ALREADY
        $already = $tasks->pluck('id')->toArray();
        $subtasks = ProjectTask::where('date', '<=', date('Y-m-d', strtotime('+1 days')))
                            ->whereNotNull('task_id')
                            ->where('checked', false)
                            ->whereNotIn('task_id', $already)
                            ->where('status', 1)
                            ->orderBy('date')
                            ->get();

        // MERGE
        $tasks = $tasks->merge($subtasks);

        // CHALLENGES
        $challenges = ProjectTask::where('date', '>=', now())->where('checked', false)->where('challenge', true)->get();

        // GET USERS FOR TASK
        $users = User::where('status', 1)->get();

        // GET CHALLENGE
        $monthChallenge = Challenge::where('type', 'mensal')->where('date', date('m/Y'))->where('status', 1)->first();

        // GET WEEK CHALLENGE
        $weekChallenge = Challenge::where('type', 'semanal')->where('custom_start', '<=', now())->where('custom_end', '>=', now())->where('status', 1)->first();

        // FORMAT DAYS
        $daysOfWeek = [
            'Sun' => 'Dom',
            'Mon' => 'Seg',
            'Tue' => 'Ter',
            'Wed' => 'Qua',
            'Thu' => 'Qui',
            'Fri' => 'Sex',
            'Sat' => 'Sáb',
        ];

        // RETURN VIEW WITH DATA
        return view('pages.dashboard.index')->with([
            'actualMonth' => $actualMonth,
            'previousMonth' => $previousMonth,
            'tasks' => $tasks,
            'users' => $users,
            'challenges' => $challenges,
            'daysOfWeek' => $daysOfWeek,
            'monthChallenge' => $monthChallenge,
            'weekChallenge' => $weekChallenge,
        ]);

    }
}
