@extends('layouts.app')
@section('title-page', 'Dashboard')
@section('title-toolbar', 'Dashboard')
@section('content')
<div class="row pb-12 m-0" style="background: url('{{ asset('assets/media/images/bg_colors.jpg') }}'); background-position: center;">
    <div class="col-12">
        <div class="toolbar py-15" id="kt_toolbar">
            <!--begin::Container-->
            <div id="kt_toolbar_container" class=" container-xxl  d-flex justify-content-center">
                <!--begin::Page title-->
                <div class="page-title">
                    <!--begin::Title-->
                    <h1 class="text-white fw-bold my-1 fs-2 text-center">
                        Bom dia Jeandreo!
                    </h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-6 my-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-white fs-5 opacity-75">
                            O maior risco é não correr risco algum.
                        </li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
            </div>
            <!--end::Container-->
        </div>
    </div>
</div>
<div class="app-main flex-column flex-row-fluid " id="kt_app_main">
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_content" class="app-content  flex-column-fluid py-6" >
            <div id="kt_app_content_container" class="app-container  container-fluid ">
                <div class="row mt-n20">
                    <div class="col-12">
                        <div class="card mb-4 shadow">
                            <div class="card-body pb-5 px-2">
                                <h2 class="fs-4 text-uppercase text-gray-700 text-center mb-5">
                                    Desafio do mês: Ler 20 páginas todo dia
                                    <i class="fa-solid fa-circle-exclamation text-gray-300 fs-5" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" title="Precisa ser algo que te estremessa de medo!!! 😱<br><li>Correr todo dia 1h</li><li>Ler 20 páginas por dia</li><li>Assistir um episódio em inglês por dia</li>"></i>
                                </h2>
                                <div class="d-flex justify-content-center">
                                    <div class="d-flex scroll-y pt-2 pb-3 pb-md-0">
                                        @for ($i = $previousMonth->daysInMonth - 0; $i <= $previousMonth->daysInMonth; $i++)
                                        <div class="h-35px w-35px min-h-35px min-w-35px rounded-circle d-flex align-items-center justify-content-center mx-1 bg-light fw-bold text-gray-700 opacity-50 mt-2">
                                            {{ str_pad($i, 2, '0', STR_PAD_LEFT) }}
                                        </div>
                                        @endfor
                                        @for ($day = 1; $day <= $actualMonth->daysInMonth; $day++)

                                            @if (checkDayMonth(date('Y-m-' . $day)))
                                            <div class="d-block bg-success rounded py-2 px-2 mx-1 check-day" data-day="{{ $day }}">
                                                <div class="h-25px w-25px min-h-25px min-w-25px rounded-circle d-flex align-items-center justify-content-center fw-bold bg-white text-primary">
                                                    {{ str_pad($day, 2, '0', STR_PAD_LEFT) }}
                                                </div>
                                                <p class="fs-9 fw-bold text-center text-white mb-0 text-center mt-1 text-uppercase">
                                                    {{ date('D', strtotime(date('Y-m-' . $day))) }}
                                                </p>
                                            </div>
                                            @elseif (date('Y-m-d', strtotime(date('Y-m-' . $day))) <= date('Y-m-d'))
                                            <div class="d-block bg-primary rounded py-2 px-2 mx-1 check-day" data-day="{{ $day }}">
                                                <div class="h-25px w-25px min-h-25px min-w-25px rounded-circle d-flex align-items-center justify-content-center fw-bold bg-white text-primary">
                                                    {{ str_pad($day, 2, '0', STR_PAD_LEFT) }}
                                                </div>
                                                <p class="fs-9 fw-bold text-center text-white mb-0 text-center mt-1 text-uppercase">
                                                    {{ date('D', strtotime(date('Y-m-' . $day))) }}
                                                </p>
                                            </div>
                                            @elseif (date('Y-m-d', strtotime(date('Y-m-' . $day))) > date('Y-m-d'))
                                            <div class="d-block bg-light rounded py-2 px-2 mx-1">
                                                <div class="h-25px w-25px min-h-25px min-w-25px rounded-circle d-flex align-items-center justify-content-center fw-bold bg-white text-primary">
                                                    {{ str_pad($day, 2, '0', STR_PAD_LEFT) }}
                                                </div>
                                                <p class="fs-9 fw-bold text-center text-gray-700 mb-0 text-center mt-1 text-uppercase">
                                                    {{ date('D', strtotime(date('Y-m-' . $day))) }}
                                                </p>
                                            </div>
                                            @endif

                                        @endfor
                                        <div class="h-35px w-35px min-h-35px min-w-35px rounded-circle d-flex align-items-center justify-content-center mx-1 bg-light mt-1 fw-bold text-gray-700 opacity-50 mt-2">
                                            01
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <div class="card mb-4">
                                    <div class="card-header border-0 py-5">
                                        <h3 class="card-title align-items-start flex-column">
                                            <span class="card-label fs-4 text-uppercase fw-bold text-gray-700 m-0">Semana da Leitura</span>
                                            <span class="text-muted fw-semibold fs-7">Latest trends</span>
                                        </h3>
                                        <div class="card-toolbar">
                                            <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            <i class="ki-duotone ki-category fs-6"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="d-flex justify-content-center scroll-y pb-3 pb-md-0">
                                            <div class="d-flex">
                                                @foreach (range(1, 7) as $dayOfWeek)
                                                @php
                                                $currentDay = \Carbon\Carbon::now()->startOfWeek()->addDays($dayOfWeek - 1);
                                                @endphp
                                                <div class="d-block bg-primary rounded py-2 px-1 mx-1">
                                                    <div class="h-md-35px w-md-35px min-h-md-35px min-w-md-35px h-30px w-30px min-h-30px min-w-30px rounded-circle d-flex align-items-center justify-content-center fw-bold mx-1 bg-hover-success text-hover-white bg-white text-primary">
                                                        {{ str_pad($currentDay->day, 2, '0', STR_PAD_LEFT) }}
                                                    </div>
                                                    <p class="fs-9 fw-bold text-center text-white mb-0 text-center mt-1 text-uppercase">{{ date('D', strtotime($currentDay)) }}</p>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6" style="display: none;">
                                <div class="card mb-4">
                                    <div class="card-header border-0 py-5">
                                        <h3 class="card-title align-items-start flex-column">
                                            <span class="card-label fs-4 text-uppercase fw-bold text-gray-700 m-0">O que vou encarar essa semana?</span>
                                            <span class="text-muted fw-semibold fs-7">Latest trends</span>
                                        </h3>
                                        <div class="card-toolbar">
                                            <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            <i class="ki-duotone ki-category fs-6"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="d-flex justify-content-center">
                                            <div class="d-flex">
                                                @foreach (range(1, 7) as $dayOfWeek)
                                                @php
                                                $currentDay = \Carbon\Carbon::now()->startOfWeek()->addDays($dayOfWeek - 1);
                                                @endphp
                                                <div class="d-block bg-primary rounded py-2 px-1 mx-1">
                                                    <div class="h-md-35px w-md-35px min-h-md-35px min-w-md-35px h-30px w-30px min-h-30px min-w-30px rounded-circle d-flex align-items-center justify-content-center fw-bold mx-1 bg-hover-success text-hover-white bg-white text-primary">
                                                        {{ str_pad($currentDay->day, 2, '0', STR_PAD_LEFT) }}
                                                    </div>
                                                    <p class="fs-9 fw-bold text-center text-white mb-0 text-center mt-1 text-uppercase">{{ date('D', strtotime($currentDay)) }}</p>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-8">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <textarea class="form-control form-control-solid" name="notes" rows="5" placeholder="Anotações aqui...">{{ Auth::user()->notes }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4" style="display: none;">
                        <div class="card">
                            <div class="card-header border-0 py-5">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fs-4 text-uppercase fw-bold text-gray-700 m-0">Como vai esta nosso mês?</span>
                                    <span class="text-muted fw-semibold fs-7">Latest trends</span>
                                </h3>
                                <div class="card-toolbar">
                                    <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="ki-duotone ki-category fs-6"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header border-0 py-5">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fs-4 text-uppercase fw-bold text-gray-700 m-0">Próximas tarefas</span>
                                    <span class="text-muted fw-semibold fs-7">Seja um destruidor de tarefas!</span>
                                </h3>
                                <div class="card-toolbar">
                                    <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="ki-duotone ki-category fs-6"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                              <!-- BEGIN:TASKS -->
                              <div style="min-height: 50px;">
                                @if ($tasks->count())
                                    @foreach ($tasks as $task)
                                    <!-- BEGIN:TASK AND SUBTASK -->
                                    <div class="dmk-div-task">
                                    <div class="d-grid">
                                        <!-- BEGIN:TASK -->
                                        <div class="bg-white rounded p-0 d-flex align-items-center justify-content-between mb-2 shadow-list dmk-tasks h-45px task-list task-on-subtask z-index-1" data-task="{{ $task->id }}">
                                            <div class="d-flex align-items-center justify-content-between w-100 h-100">
                                                <div class="d-flex align-items-center h-100 w-100">
                                                <div style="background: {{ $task->project->color }};" class="rounded-start h-100 d-flex align-items-center color-task task-icons">
                                                        <div class="form-check form-check-custom form-check-solid py-2 px-5">
                                                            <input class="form-check-input w-15px h-15px cursor-pointer check-task task-main" data-task="{{ $task->id }}" type="checkbox" value="1" style="border-radius: 3px" @if($task->checked == true) checked @endif/>
                                                            <i class="fa-solid p-1 fa-list-check fs-5 text-white ms-5 cursor-pointer add-subtasks zoom-hover zoom-hover-03" data-task="{{ $task->id }}" data-project="{{ $task->project->id }}"></i>
                                                            <a href="{{ route('tasks.stand.by', $task->id) }}">
                                                                <i class="fa-solid fa-hourglass-start p-1 fs-5 text-white ms-3 cursor-pointer zoom-hover zoom-hover-03"></i>
                                                            </a>
                                                            <a href="{{ route('tasks.destroy', $task->id) }}" class="tasks-destroy">
                                                                <i class="fa-solid p-1 fa-trash-alt fs-5 text-white ms-3 cursor-pointer zoom-hover zoom-hover-03"></i>
                                                            </a>
                                                        </div>
                                                </div>
                                                <div class="d-flex align-items-center h-100 w-100 div-name-task">
                                                    <label for="rename-task-{{ $task->id }}" class="d-none d-md-flex">
                                                        <i class="fa-solid fa-pen-to-square text-hover-primary cursor-pointer py-2 w-50px text-center fs-5 edit-name-task" data-task="{{ $task->id }}"></i>
                                                    </label>
                                                    <div class="d-block min-w-md-300px w-100 px-3 px-md-0">
                                                        <p class="text-gray-600 text-hover-primary fs-6 lh-1 fw-normal p-0 mb-1 cursor-pointer border-0 w-100 task-name show-task" style="margin-top: 3px;" data-task="{{ $task->id }}">{{ $task->name }}</p>
                                                        <input type="text" class="text-gray-600 fs-6 lh-1 fw-normal p-0 m-0 border-0 w-100 input-name" maxlength="80" value="{{ $task->name }}" name="name" data-task="{{ $task->id }}" id="rename-task-{{ $task->id }}" style="display: none; margin-bottom: 1px !important;">
                                                        <div class="input-phrase" @if($task->phrase == '') style="display: none;" @endif>
                                                            <input type="text" class="text-gray-500 fs-6 lh-1 fw-normal p-0 m-0 border-0 w-100 fs-7 d-flex task-phrase z-index-9 h-15px mt-n1" maxlength="255" name="phrase" value="{{ $task->phrase }}" @if($task->phrase == '') style="border-bottom: dashed 1px #bbbdcb63 !important;" @endif data-task="{{ $task->id }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                                @if ($task->comments->count())
                                                <span>
                                                <i class="fa-regular fa-comments text-gray-300 p-2 ms-5"></i>
                                                </span>
                                                @endif
                                                <span class="task-priority d-none d-md-flex" data-task="{{ $task->id }}">
                                                <i class="fa-solid fa-font-awesome p-2 
                                                @if ($task->priority == 0)
                                                text-gray-300
                                                @elseif($task->priority == 1)
                                                text-warning
                                                @elseif($task->priority == 2)
                                                text-info
                                                @elseif($task->priority == 3)
                                                text-danger
                                                @endif
                                                cursor-pointer me-5"></i>
                                                </span>
                                            </div>
                                            <div class="d-flex align-items-center h-100 d-none d-md-flex">
                                               
                                                <input type="text" class="form-control border-0 form-control-sm flatpickr w-auto text-center w-200px task-date task-date-{{ $task->id }} 
                                                
                                                @if(date('Y-m-d', strtotime($task->date)) == date('Y-m-d'))
                                                text-primary
                                                @elseif(strtotime($task->date) < time())
                                                text-danger
                                                @elseif(\Carbon\Carbon::parse($task->date)->diffInDays() <= 2)
                                                text-info
                                                @else
                                                text-gray-700
                                                @endif" data-task="{{ $task->id }}" placeholder="Prazo da tarefa" value="@if($task->date) {{ date('Y-m-d H:i:s', strtotime($task->date)) }} @endif"/>
                                                <!-- SEPARATOR -->
                                                <div class="separator-vertical h-100"></div>
                                                <!-- SEPARATOR -->
                                                <div>
                                                <i class="fa-solid fa-chevron-down text-hover-primary py-2 px-3 mx-3 fs-6 draggable-handle"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END:TASK -->
                                    </div>
                                    <!-- BEGIN:SUB-TASK -->
                                    @foreach ($task->subtasks as $subtask)
                                        <div class="mb-2 ms-12">
                                            <div class="bg-white rounded p-0 d-flex align-items-center justify-content-between mb-2 shadow-list dmk-tasks h-35px task-list task-on-subtask z-index-1" data-task="{{ $subtask->id }}">
                                            <div class="d-flex align-items-center justify-content-between w-100 h-100">
                                                <div class="d-flex align-items-center h-100 w-100 task-left-side">
                                                    <div style="background: {{ $subtask->project->color }}" class="rounded-start h-100 w-40px d-flex align-items-center justify-content-center color-task">
                                                        <div class="form-check form-check-custom form-check-solid">
                                                            <input class="form-check-input w-15px h-15px cursor-pointer check-task" data-task="{{ $subtask->id }}" type="checkbox" value="1" style="border-radius: 3px" @if($subtask->checked == true) checked @endif/>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center h-100 w-100 div-name-task">
                                                    <label for="rename-subtask-{{ $subtask->id }}">
                                                        <i class="fa-solid @if($subtask->name != '')fa-pen-to-square @else fa-eye @endif text-hover-primary cursor-pointer py-2 w-50px text-center fs-5 edit-name-task" data-task="{{ $subtask->task_id }}"></i>
                                                    </label>
                                                    <div class="d-block min-w-300px w-100">
                                                            <p class="text-gray-600 text-hover-primary fs-6 lh-1 fw-normal p-0 mb-0 cursor-pointer border-0 w-100 task-name show-task" data-task="{{ $subtask->id }}" style="margin-top: 1px;  @if($subtask->name == '') display: none; @endif">{{ $subtask->name }}</p>
                                                            <input type="text" id="rename-subtask-{{ $subtask->id }}" class="text-gray-600 fs-6 lh-1 fw-normal p-0 m-0 border-0 w-100 input-name placeholder-02 @if($subtask->checked == true) text-decoration-line-through @endif" value="{{ $subtask->name }}" name="name" placeholder="Subtarefa" data-task="{{ $subtask->id }}" @if($subtask->name != '') style="display: none;" @endif>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if ($subtask->comments->count())
                                                <span>
                                                    <i class="fa-regular fa-comments text-gray-300 p-2 ms-5"></i>
                                                </span>
                                                @endif
                                                <span class="task-priority" data-task="{{ $subtask->id }}">
                                                <i class="fa-solid fa-font-awesome p-2 
                                                    @if ($subtask->priority == 0)
                                                    text-gray-300
                                                    @elseif($subtask->priority == 1)
                                                    text-warning
                                                    @elseif($subtask->priority == 2)
                                                    text-info
                                                    @elseif($subtask->priority == 3)
                                                    text-danger
                                                    @endif
                                                    cursor-pointer me-5"></i>
                                                </span>
                                            </div>
                                            <div class="d-flex align-items-center h-100">
                                                <div class="d-flex p-0 align-items-center justify-content-center cursor-pointer h-100 w-150px rounded-0 actual-status" style="background: {{ $subtask->statusInfo->color }}">
                                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-start">
                                                        <p class="text-white fw-bold m-0 status-name">{{ $subtask->statusInfo->name }}</p>
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-250px py-4" data-kt-menu="true" style="">
                                                            @foreach ($subtask->project->statuses as $status)
                                                            <div class="menu-item px-3 mb-2">
                                                                <span data-task="{{ $subtask->id }}" data-status="{{ $status->id }}" class="menu-link px-3 d-block text-center tasks-status" style="background: {{ $status->color }}; color: white">
                                                                <span class="">{{ $status->name }}</span>
                                                                </span>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control border-0 form-control-sm flatpickr w-auto text-center w-200px task-date" data-task="{{ $subtask->id }}" placeholder="Prazo da tarefa" value="@if($subtask->date) {{ date('Y-m-d H:i:s', strtotime($subtask->date)) }} @endif"/>
                                            </div>
                                                <!-- SEPARATOR -->
                                                <div class="separator-vertical h-100"></div>
                                                <!-- SEPARATOR -->
                                                <div>
                                                <i class="fa-solid fa-bars-staggered text-gray-300 py-2 px-3 mx-3 fs-6"></i>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    </div>
                                    <!-- END:SUB-TASK -->
                                    <!-- END:TASK AND SUBTASK -->
                                    @endforeach
                                @endif
                                <div class="no-tasks" @if ($tasks->count()) style="display: none;" @endif>
                                    <div class="rounded bg-light d-flex align-items-center justify-content-center h-50px">
                                    <div class="text-center">
                                        <p class="m-0 text-gray-600 fw-bold text-uppercase">Sem tarefas ainda nesse projeto</p>
                                    </div>
                                    </div>
                                </div>
                              </div>
                              <!-- BEGIN: SEND TASKS -->
                              <form action="#" method="POST" class="send-tasks">
                                 @csrf
                                 <input type="text" name="name" class="form-control form-control-solid w-100 rounded mt-5" placeholder="Inserir nova tarefa">
                              </form>
                              <!-- END: SEND TASKS -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" data-bs-focus="false" id="modal_task">
        <div class="modal-dialog modal-dialog-centered rounded">
            <div class="modal-content rounded bg-transparent" id="load-task">
                {{-- LOAP TASK HERE --}}
                {{-- LOAP TASK HERE --}}
                {{-- LOAP TASK HERE --}}
            </div>
        </div>
    </div>

@endsection

@section('custom-footer')
<script>
	
	// PROJECT ID
	var projectId = 0;

	// FUNCTION LOAD TASKS
	function loadTasks(id){

		// AJAX
        $.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: 'GET',
            url: "{{ route('tasks.ajax', '') }}/" + id,
            success: function(data){
				$('#project-tasks-' + id).html(data);
				callFunctions();
            }
        });

	}

	// SEND NEW TASK
	$(document).on('submit', '.send-tasks', function(e){

		// STOP EVENT
		e.preventDefault();

		// GET TITLE OF TASK
		var inputName = $(this).find('[name="name"]');
		var project = $(this).find('[name="project_id"]').val();

		// AJAX
        $.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: 'POST',
            url: "{{ route('tasks.store') }}",
			data: {project_id: project, name: inputName.val()},
            success: function(data){
				loadTasks(project);
				inputName.val('');
            }
        });

	});

	// LOAD SOUND
	var audio = new Audio('{{ asset("assets/media/sounds/task-checked.mp3") }}');

	// SAVE STATUS CHECKED
	$(document).on('click', '.check-task', function(){

		// GET TASK
		var taskId = $(this).data('task');
		var isMain = $(this).hasClass('task-main');
		var subtask = $(this).closest('.task-left-side').find('.input-name');
		var checked = $(this).is(':checked');

		// AJAX
        $.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: 'POST',
            url: "{{ route('tasks.check') }}",
			data: {task_id: taskId},
        });

		// IF TASK MAIN
		if(isMain){
			// SELECT DIV OF TASK
			var taskDiv = $(this).closest('.dmk-div-task');

			// ADD ANIMATION AND REMOVE TASK
			taskDiv.addClass('slide-up');
			setTimeout(function() {
				taskDiv.remove();
			}, 500);

		} else {
			subtask.toggleClass('text-decoration-line-through ');
		}

		// IF CHECKED
		if(checked){
			// PLAY SOUND
			audio.play();
		}

	});


	// SAVE STATUS CHECKED
	$(document).on('click', '.edit-name-task', function(){

		var div = $(this).closest('.div-name-task');

		$(this).toggleClass('fa-pen-to-square fa-eye');

		div.find('.task-name').toggle();
		div.find('.input-name').toggle();

	});

	// SAVE STATUS CHECKED
	$(document).on('click', '.add-subtasks', function(){

		// GET TASK
		var taskId = $(this).data('task');
		var projectId = $(this).data('project');

		// DIV
		var divSubtasks = $(this).closest('.draggable');

		// AJAX
		$.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			type: 'POST',
			url: "{{ route('tasks.subtask') }}",
			data: {task_id: taskId, project_id: projectId},
			success: function(data){
				divSubtasks.append(data);
			}
		});

	});

	// SHOW INPUT PHRASE
	$(document).on('focus', '.input-name', function(){
		$(this).next('.input-phrase').fadeIn();
	});

	// HIDE INPUT PHRASE
	$(document).on('blur', '.input-phrase input', function(){

		var text = $(this).val().trim();
		if(text == ''){
			$(this).closest('.input-phrase').fadeOut().css('border-bottom', 'dashed 1px #bbbdcb63 !important');
		} else {
			$(this).css('border-bottom', '');
		};
	});

	// UPDATE TITLE AND PHRASE
	$(document).on('change', '.input-name, .task-phrase, .task-description', function(){

		// GET DATA
		var input = $(this).attr('name'); 
		var value = $(this).val();
		var taskId = $(this).data('task');
		
		// IF RENAME TASK
		if(input == 'name'){
			$(this).closest('.div-name-task').find('.task-name').text(value);
		}

		// AJAX
		$.ajax({
			type: 'PUT',
			url: "{!! route('tasks.update.ajax', '') !!}/" + taskId,
			data: {_token: @json(csrf_token()), input: input, value: value},
		});

	});

	// UPDATE TITLE AND PHRASE
	$(document).on('click', '.task-priority', function(){

		// GET TEXT
		var taskId = $(this).data('task');

		// SAVE FLAG
		var flagHtml = $(this).find('i');

		// AJAX
		$.ajax({
			type: 'PUT',
            url: "{{ route('tasks.priority') }}",
			data: {_token: @json(csrf_token()), task_id: taskId},
			success: function(data){

				// ALTERA PRIORIDADE
				if (data == 1){
					flagHtml.removeClass('text-gray-300').addClass('text-warning');
				} else if (data == 2){
					flagHtml.removeClass('text-warning ').addClass('text-info');
				} else if (data == 3){
					flagHtml.removeClass('text-info').addClass('text-danger');
				} else {
					flagHtml.removeClass('text-danger').addClass('text-gray-300');
				}

			}
		});

	});

	// UPDATE DATE
	$(document).on('change', '.task-date', function(){
    
		// GET NEW DATE
		var date = $(this).val();
		var taskId = $(this).data('task');

		// GET ACTUAL DATE
        var currentDate = new Date();
		
        // FORMAT DATE
        var taskDate = new Date(date);

		// Obtenha as datas sem as horas, minutos e segundos
		var taskDateWithoutTime = new Date(taskDate.getFullYear(), taskDate.getMonth(), taskDate.getDate());
		var currentDateWithoutTime = new Date(currentDate.getFullYear(), currentDate.getMonth(), currentDate.getDate());

		// GET DIFERENCE
		var difference = Math.floor((taskDateWithoutTime - currentDateWithoutTime) / (1000 * 60 * 60 * 24));

		// REMOVE PREVIOUS CLASS
		$('.task-date-' + taskId).removeClass('text-danger text-primary text-info text-gray-700');

        // VERIIFY DIFERENCE
        if (difference < 0) {
            $('.task-date-' + taskId).addClass('text-danger');
        } else if (difference == 0) {
            $('.task-date-' + taskId).addClass('text-primary');
        } else if (difference <= 2) {
            $('.task-date-' + taskId).addClass('text-info');
        } else {
            $('.task-date-' + taskId).addClass('text-gray-700');
        }

		// AJAX
		$.ajax({
			type:'PUT',
			url: "{{ route('tasks.date') }}",
			data: {_token: @json(csrf_token()), task_id: taskId, date: date},
		});

	});

	function showTask(id){

		// AJAX
        $.ajax({
            type:'POST',
            url: "{{ route('tasks.show') }}",
            data: {_token: @json(csrf_token()), task_id: id},
            success:function(data) {

                console.log('chegou');

				//  REPLACE CONTENT
				$('#load-task').html(data);

                // CHANGE TO NEW COLOR AND NAME STATUS
				$('#modal_task').modal('show');

				// LOAD COMMENTS
				loadComments(id);

				// LOAD EDITOR
				loadEditorText();

            }
        });

	}

	function loadComments(id){

		// AJAX
		$.ajax({
			type:'POST',
			url: "{{ route('comments.show') }}",
			data: {_token: @json(csrf_token()), task_id: id},
			success:function(data) {
				//  REPLACE CONTENT
				$('#results-comments').html(data);
			}
		});

	}

	// SHOW TASK
	$(document).on('submit', '#send-comment', function(e){

		// PARA EVENTO
		e.preventDefault();

		// GET DATA
		var taskId = $(this).data('task');
		var text = $(this).find('[name="text"]').val();

		// AJAX
		$.ajax({
			type:'POST',
			url: "{{ route('comments.store') }}",
			data: {_token: @json(csrf_token()), task_id: taskId, text: text},
			success:function(data) {
				loadComments(taskId);
				textarea.setData('');
				$('#results-comments').scrollTop(0);
			}
		});

	});

	// SHOW TASK
	$(document).on('click', '.destroy-comment', function(e){

		// PARA EVENTO
		e.preventDefault();

		// GET DATA
		var url = $(this).attr('href');
		var taskId = $(this).data('task');

		// AJAX
		$.ajax({
			type:'PUT',
			url: url,
			data: {_token: @json(csrf_token())},
			success:function(data) {
				loadComments(taskId);
			}
		});

	});

	// SHOW TASK
	$(document).on('click', '.show-task', function(){

		// GET DATA
        var taskId = $(this).data('task');

		// EXIBE TASK
		showTask(taskId);

	});

    // SHOW TASK
    $(document).on('click', '.show-task', function(){

        // GET DATA
        var taskId = $(this).data('task');

        // EXIBE TASK
        showTask(taskId);

    });
    
    // SHOW TASK
    $(document).on('click', '.check-day', function(){

        // GET DAY
        var day = $(this).data('day');
        $(this).toggleClass('bg-success bg-primary');

        // AJAX
		$.ajax({
			type:'POST',
			url: "{{ route('comments.store') }}",
			data: {_token: @json(csrf_token()), task_id: taskId, text: text},
			success:function(data) {
				loadComments(taskId);
				textarea.setData('');
				$('#results-comments').scrollTop(0);
			}
		});

    });
    
    // CONFIG NOTES
    var typingTimer;
    var doneTypingInterval = 300;

    // CHANGE NOTES FOR USER
    $(document).on('input', '[name="notes"]', function(){
        clearTimeout(typingTimer);
        typingTimer = setTimeout(function() {

            // GET NOTE
            var notes = $('[name="notes"]').val();

            // AJAX
            $.ajax({
                type:'PUT',
                url: "{{ route('users.notes') }}",
                data: {_token: @json(csrf_token()), notes: notes},
                success:function(data) {
                    console.log(data);
                }
            });

        }, doneTypingInterval);
    });


</script>
@endsection