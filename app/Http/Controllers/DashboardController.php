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

        // CHALLENGES
        $challenges = ProjectTask::where('status', 1)->where('date', '>=', now())->where('checked', false)->where('challenge', true)->get();

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

        // OBTÉM LISTAS
        $lists = Catalog::where('status', 1)->orderBy('name', 'ASC')->get();

        // OBTÉM PROJETOS
        $projects = Project::where('status', 1)->get();

        // RETURN VIEW WITH DATA
        return view('pages.dashboard.index')->with([
            'actualMonth' => $actualMonth,
            'previousMonth' => $previousMonth,
            'challenges' => $challenges,
            'daysOfWeek' => $daysOfWeek,
            'monthChallenge' => $monthChallenge,
            'weekChallenge' => $weekChallenge,
            'lists' => $lists,
            'projects' => $projects,
            'pageClean' => true,
        ]);

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list($range = 'today')
    {

        // GET MAIN TASKS
        $tasks = ProjectTask::whereNull('task_id')
        ->where('checked', false)
        ->where('status', 1)
        ->where('designated_id', Auth::id());

        // FILTER DATES
        if ($range == 'today') {
            $tasks->whereDate('date', date('Y-m-d'));
        } else {
            $tasks->where('date', '<=', date('Y-m-d', strtotime('+3 days')));
        }

        // Executa a consulta para obter as tarefas principais
        $tasks = $tasks->get();

        // GET IDS ALREADY
        $already = $tasks->pluck('id')->toArray();

        // GET SUBTASKS EXCEPT MAINS
        $subtasksAndTasks = ProjectTask::where('status', 1)
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
            ->orderBy('date');

        // FILTER DATES
        if ($range == 'today') {
            $subtasksAndTasks->whereDate('date', date('Y-m-d'));
        } else {
            $subtasksAndTasks->where('date', '<=', date('Y-m-d', strtotime('+2 days')));
        }

        // Encerra a consulta para obter as subtarefas
        $tasks = $subtasksAndTasks->get();


        // OBTÉM PROJETOS
        $projects = Project::where('status', 1)->get();

        // GET USERS FOR TASK
        $users = User::where('status', 1)->get();

        // RETURN VIEW WITH DATA
        return view('pages.dashboard._list')->with([
            'tasks' => $tasks,
            'projects' => $projects,
            'users' => $users,
        ]);

    }
}
