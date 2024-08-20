<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\Challenge;
use App\Models\Project;
use App\Models\ProjectTask;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // $tasks = ProjectTask::where('date', '<=', date('Y-m-d'))
        $tasks = ProjectTask::where('date', '<=', date('Y-m-d', strtotime('+1 days')))
                            ->whereNull('task_id')
                            ->where('checked', false)
                            ->where('status', 1)
                            ->where('designated_id', Auth::id())
                            ->get();

        // GET IDS ALREADY
        $already = $tasks->pluck('id')->toArray();

        // SEARCH
        $tasks = ProjectTask::where('status', 1)
                            ->where('date', '<=', date('Y-m-d', strtotime('+1 days')))
                            ->where('checked', false)
                            ->whereNotNull('name')
                            ->where(function($query) use ($already) {
                                $query->whereNull('task_id')
                                    ->orWhere(function($query) use ($already) {
                                        $query->whereNotNull('task_id')
                                            ->whereNotIn('task_id', $already);
                                    });
                            })
                            ->where('designated_id', Auth::id())
                            ->orderBy('date')
                            ->get();

        // CHALLENGES
        $challenges = ProjectTask::where('status', 1)->where('date', '>=', now())->where('checked', false)->where('challenge', true)->where('created_by', Auth::id())->get();

        // GET USERS FOR TASK
        $users = User::where('status', 1)->get();

        // GET CHALLENGE
        $monthChallenge = Challenge::where('type', 'mensal')->where('date', date('m/Y'))->where('status', 1)->where('created_by', Auth::id())->first();

        // GET WEEK CHALLENGE
        $weekChallenge = Challenge::where('type', 'semanal')->where('custom_start', '<=', now())->where('custom_end', '>=', now())->where('status', 1)->where('created_by', Auth::id())->first();

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

        // OBTÉM LISTAS
        $lists = Catalog::where('status', 1)->orderBy('name', 'ASC')->where('created_by', Auth::id())->get();

        // OBTÉM PROJETOS
        $projects = Project::where('status', 1)->get();

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
            'lists' => $lists,
            'projects' => $projects,
        ]);

    }
}
