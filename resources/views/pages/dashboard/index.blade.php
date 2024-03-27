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
                        Bom diiiiaa Jeandreo! {{ randomEmoji() }}
                    </h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-6 my-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-white fs-5 opacity-75">
                            “Se você realmente quer algo, não espere. Ensine a si mesmo a ser impaciente.” – Gurbaksh Chahal
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
									@if ($monthChallenge)
									Desafio do mês: <span class="text-info">{{ $monthChallenge->name }}</span>
									@else
									Desafio do mês: <span class="text-danger">Nenhum desafio cadastrado</span>! 😤
									@endif
                                    <i class="fa-solid fa-circle-exclamation text-gray-300 fs-5" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" title="Precisa ser algo que te estremessa de medo!!! 😱<br><li>Correr todo dia 1h</li><li>Ler 20 páginas por dia</li><li>Assistir um episódio em inglês por dia</li>"></i>
                                </h2>
                                <div class="d-flex justify-content-center">
                                    <div class="d-flex hover-scroll-x pt-2 pb-3 pb-md-0">
                                        @for ($i = $previousMonth->daysInMonth - 0; $i <= $previousMonth->daysInMonth; $i++)
                                        <div class="h-35px w-35px min-h-35px min-w-35px rounded-circle d-flex align-items-center justify-content-center mx-1 bg-light fw-bold text-gray-700 opacity-50 mt-2">
                                            {{ str_pad($i, 2, '0', STR_PAD_LEFT) }}
                                        </div>
                                        @endfor
                                        @for ($day = 1; $day <= $actualMonth->daysInMonth; $day++)
                                            @if (checkDayMonth(date('Y-m-' . $day), 'mensal'))
                                            <div class="d-block @if(checkDayMonth(date('Y-m-' . $day), 'mensal')->completed == true) bg-success @else bg-danger @endif rounded py-2 px-2 mx-1 @if($monthChallenge) check-day @endif" data-day="{{ $day }}" data-type="mensal" @if($monthChallenge) data-challenge="{{ $monthChallenge->id }}" @endif>
                                                <div class="h-25px w-25px min-h-25px min-w-25px rounded-circle d-flex align-items-center justify-content-center fw-bold bg-white text-primary">
                                                    {{ str_pad($day, 2, '0', STR_PAD_LEFT) }}
                                                </div>
                                                <p class="fs-9 fw-bold text-center text-white mb-0 text-center mt-1 text-uppercase">
													{{ $daysOfWeek[date('D', strtotime(date('Y-m-' . $day)))] }}
                                                </p>
                                            </div>
                                            @elseif (date('Y-m-d', strtotime(date('Y-m-' . $day))) <= date('Y-m-d'))
                                            <div class="d-block bg-primary rounded py-2 px-2 mx-1 @if($monthChallenge) check-day @endif" data-day="{{ $day }}" data-type="mensal" @if($monthChallenge) data-challenge="{{ $monthChallenge->id }}" @endif>
                                                <div class="h-25px w-25px min-h-25px min-w-25px rounded-circle d-flex align-items-center justify-content-center fw-bold bg-white text-primary">
                                                    {{ str_pad($day, 2, '0', STR_PAD_LEFT) }}
                                                </div>
                                                <p class="fs-9 fw-bold text-center text-white mb-0 text-center mt-1 text-uppercase">
													{{ $daysOfWeek[date('D', strtotime(date('Y-m-' . $day)))] }}
                                                </p>
                                            </div>
                                            @elseif (date('Y-m-d', strtotime(date('Y-m-' . $day))) > date('Y-m-d'))
                                            <div class="d-block bg-light rounded py-2 px-2 mx-1">
                                                <div class="h-25px w-25px min-h-25px min-w-25px rounded-circle d-flex align-items-center justify-content-center fw-bold bg-white text-primary">
                                                    {{ str_pad($day, 2, '0', STR_PAD_LEFT) }}
                                                </div>
                                                <p class="fs-9 fw-bold text-center text-gray-700 mb-0 text-center mt-1 text-uppercase">
													{{ $daysOfWeek[date('D', strtotime(date('Y-m-' . $day)))] }}
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
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card mb-4">
                                            <div class="card-header border-0 py-5 d-block">
                                                <h3 class="mb-0 text-center">
                                                    <span class="card-label fs-4 text-uppercase fw-bold text-gray-700 m-0">
														@if($weekChallenge)
														{{ $weekChallenge->name }}
														@else
														Sem <span class="text-danger">nada</span> para essa semana? 😑😡
														@endif
													</span>
                                                </h3>
                                                <p class="text-muted fw-semibold fs-7 text-center">
                                                    Não tenha medo de desistir do bom para perseguir o ótimo.
                                                </p>
                                            </div>
                                            <div class="card-body pt-0 px-2">
                                                <div class="d-flex justify-content-center hover-scroll-x pb-3 pb-md-0">
													@if ($weekChallenge)
													<div class="d-flex">
														@for ($currentDay = strtotime($weekChallenge->custom_start); $currentDay <= strtotime($weekChallenge->custom_end); $currentDay = strtotime('+1 day', $currentDay))
															<div class="d-block @if(checkDayMonth(date('Y-m-' . date('d', $currentDay)), 'semanal') && checkDayMonth(date('Y-m-' . date('d', $currentDay)), 'semanal')->completed == true) bg-success @elseif(checkDayMonth(date('Y-m-' . date('d', $currentDay)), 'semanal') && checkDayMonth(date('Y-m-' . date('d', $currentDay)), 'semanal')->completed == false) bg-danger @else bg-primary @endif rounded py-2 px-2 mx-1 @if($weekChallenge) check-day @endif" data-day="{{ date('d', $currentDay) }}" data-type="semanal" data-challenge="{{ $weekChallenge->id }}">
																<div class="h-25px w-25px min-h-25px min-w-25px rounded-circle d-flex align-items-center justify-content-center fw-bold bg-white text-primary">
																	{{ str_pad(date('d', $currentDay), 2, '0', STR_PAD_LEFT) }}
																</div>
																<p class="fs-9 fw-bold text-center text-white mb-0 text-center mt-1 text-uppercase">
																	{{ $daysOfWeek[date('D', $currentDay)] }}
																</p>
															</div>
														@endfor
													</div>
													@else
														<div class="h-125px bg-light rounded w-100 mx-10 d-flex align-items-center justify-content-center">
															<div class="text-center">
																<p class="fw-bold text-gray-700 fs-4 mb-0">SEM DESAFIOS ESSA SEMANA 😔</p>
																<p class="text-gray-600 fs-6">Que pena, parece que você não planejou nenhum desafio para si.</p>
															</div>
														</div>
													@endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <textarea class="form-control form-control-solid" name="notes" rows="3" placeholder="Anotações aqui...">{{ Auth::user()->notes }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 d-grid align-items-stretch">
                                <div class="card mb-4">
                                    <div class="card-header border-0 py-5">
                                        <h3 class="card-title align-items-start flex-column">
                                            <span class="card-label fs-4 text-uppercase fw-bold text-gray-700 m-0">Quais são as próximas conquistas?</span>
                                        </h3>
                                        <div class="card-toolbar">
                                            <span class="text-muted fw-semibold fs-7">O maior risco é não correr risco algum.</span>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        @if ($challenges->count())
                                            @foreach ($challenges as $challenge)
                                                <div class="bg-light rounded mb-3 p-3">
                                                    <div class="row">
                                                        <div class="col-12 col-md-6 d-flex align-items-center">
                                                            <p class="m-0 fs-5 fw-bold text-gray-700">{{ $challenge->name }}</p>
                                                        </div>
                                                        <div class="col-12 col-md-5 d-flex align-items-center">
                                                            <div class="d-flex hover-scroll-x">
                                                                @foreach ($challenge->subtasks as $key => $mission)
                                                                <div class="min-h-20px min-w-20px rounded-circle centered @if($mission->checked) bg-success text-white @elseif(!$mission->checked && $mission->date && strtotime($mission->date) < time()) bg-danger text-white @else bg-white text-primary @endif me-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" title="{{ $mission->name }} @if($mission->date) {{ '<br><b>' . date('d/m/Y', strtotime($mission->date)) . '</b>' }} @endif">
                                                                    <span class="fw-bold">{{ $key + 1 }}</span>
                                                                </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-1 d-flex align-items-center">
                                                            @if ($challenge->date)
                                                                <span class="badge badge-light-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" title="<span class='text-primary fw-bold'>DEADLINE</span><br><b>{{ date('d/m/Y', strtotime($challenge->date)) }}</b>">
                                                                    {{ ceil((strtotime($challenge->date) - time()) / (60 * 60 * 24)) }}
                                                                </span>
                                                            @else
                                                                <span class="badge badge-light">
                                                                    -
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center h-100">
                                            <div class="text-center">
                                                <p class="fw-bold text-gray-700 fs-3 mb-1">EIIIIITAAA VOCÊ ESTA SEM DESAFIOS 😱</p>
                                                <p class="text-gray-600 fs-5">Para você ter um desafio, você precisa ter uma tarefa com subtarefas.</p>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-2 d-none d-md-block">
                                <div class="card" style="background: url('{{ asset('assets/media/images/lion.avif') }}');background-size: cover;height: 96%; background-position: center;">
                                    <div class="card-body">
                                        
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
                                @include('pages.tasks._tasks')
                              </div>
                              <!-- BEGIN: SEND TASKS -->
                                @if (projects()->where('reminder', true)->first())
                                <form action="#" method="POST" class="send-tasks">
                                    @csrf
                                    <input type="hidden" name="project_id" value="{{ projects()->where('reminder', true)->first()->id }}">
                                    <input type="text" name="name" class="form-control form-control-solid w-100 rounded mt-5" placeholder="Inserir nova tarefa">
                                </form>
                                @endif
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
	var projectId = {{ $contents->id ?? 0 }};

	function callFunctions(){
		generateFlatpickr();
		KTMenu.createInstances();
	}

	// DRAGGABLE
	function draggable(){
		var containers = document.querySelectorAll(".draggable-zone");
		if (containers.length === 0) return false;
		var swappable = new Sortable.default(containers, {
			draggable: ".draggable",
			handle: ".draggable .draggable-handle",
			mirror: {
				constrainDimensions: true,
			},
		});

		// ON STOP DRAG
		swappable.on('drag:stopped', function(event) {

			// GET DIV OF ELEMENT
			var movedDiv = event.originalSource;

			// GET ID OF TASK
			var taskId = $(movedDiv).data('task');

			// GET PROJECT
			var draggableDropped = $(movedDiv).closest('.draggable-zone');
			
			// TYPE DRAGGABLE
			var draggableType = draggableDropped.data('type');

			// GET PROJECT
			var projectId = draggableDropped.data('project');

			// START
			var tasksOrderIds = [];

			// GET IDS OF TASKS ONLY DRAGGABLE-ZONE
			draggableDropped.find('.task-list').each(function() {
				// OBTEM ITEM
				var item = $(this).data('task');
				tasksOrderIds.push(item);
			});

			// HIDE NO TASKS IN ZONE DROPPED
			draggableDropped.find('.no-tasks').fadeOut();

			// AJAX
			$.ajax({
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				type:'PUT',
				url: "{{ route('tasks.order') }}",
				data: {
					_token: @json(csrf_token()), 
					project_id: projectId, 
					task_id: taskId, 
					tasksOrderIds: tasksOrderIds
				},
				success: function(response){
					
					// CHANGE COLOR PROJECT ON TASK
					$(movedDiv).find('.color-task').css('background', response['color']);

					// GET ZONE INITIAL
					var startZone = $('#project-tasks-' + response['startProject']);
					
					// COUNT TASKS IN ZONE
					var tasksCount = startZone.find('.task-list').length;

					// IF NO TASKS IN ZONE
					if (tasksCount == 0) startZone.find('.no-tasks').fadeIn();

				}
			});

		});

	}
	
	// FUNCTION LOAD PROJECTS
	function loadProjects(){
		// AJAX
		$.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			type: 'POST',
			url: "{{ route('tasks.index') }}",
			data: {project_id: projectId},
			success: function(data){
				// LOAD PROJECTS
				$('#load-projects').html(data);

				// COUNT PROJECTS
				var projectsCount = $('.load-tasks-project').length;
				var counting = 0;

				// SEARCH TASKS OF PROJECTS
				$('.load-tasks-project').each(function(){

					// INSERT TASKS IN PROJECTS
					loadTasks($(this).data('project'));

					// ADD ONE IN COUNTING
					++counting;

					// IF LAST TASKS
					if(counting == projectsCount){
						setTimeout(() => {
							callFunctions();
							draggable();
						}, 200);
					}

				});

			}
		});
	}

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

	$(document).on('click', '.show-tasks-fileds', function(){
		$('#card-to-fileds').toggle();
	});

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

	

	// CALL FUNCTIONS
	loadProjects();

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

	// UPDATE DESIGNATED TASK
	$(document).on('click', '.task-designated', function(){

		// GET TEXT
		var taskId = $(this).data('task');
		var designated = $(this).data('designated');

		// SAVE FLAG
		var img = $(this).closest('.designated-div').find('.designated');

		// AJAX
		$.ajax({
			type: 'PUT',
			url: "{{ route('tasks.designated') }}",
			data: {_token: @json(csrf_token()), task_id: taskId, designated_id: designated},
			success: function(data){
				img.attr('src', data);
			}
		});

	});

	// UPDATE STATUS
    $(document).on('click', '.tasks-status', function(e){
        
		// GET DATA
        var taskId = $(this).data('task');
        var statusId = $(this).data('status');

		// GET ACTUAL STATUS
		var status = $(this).closest('.actual-status');

		// AJAX
        $.ajax({
            type:'PUT',
            url: "{{ route('tasks.status') }}",
            data: {_token: @json(csrf_token()), task_id: taskId, status_id: statusId},
            success:function(data) {
                // CHANGE TO NEW COLOR AND NAME STATUS
				status.find('.status-name').text(data['name']);
				status.css('background', data['color']);
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


	function loadCheckeds(){

		// AJAX
		$.ajax({
			type:'POST',
			url: "{{ route('tasks.checkeds') }}",
			data: {_token: @json(csrf_token()), project_id: projectId},
			success:function(data) {
				//  REPLACE CONTENT
				$('#load-checkeds').html(data);
			}
		});

	}

	loadCheckeds();

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
    $(document).on('click', '.check-day', function(){

		// GET DAY
        var day = $(this).data('day');
        var challenge = $(this).data('challenge');
        var type = $(this).data('type');
        var btnDay = $(this);

		// AJAX
        $.ajax({
            type:'POST',
            url: "{{ route('challenges.check') }}",
            data: {_token: @json(csrf_token()), day: day, challenge: challenge, type: type},
            success:function(data) {

				// UPDATE COLORS
				if(data[0] == true){
					btnDay.removeClass('bg-primary bg-danger').addClass('bg-success');
				} else {
					btnDay.removeClass('bg-primary bg-success').addClass('bg-danger');
				}

            }
        });

    });

    // MART AS CHALLENGE
    $(document).on('change', '[name="challenge"]', function(){

        // GET DAY
        var taskId = $(this).data('task');
        var checked = $(this).is(':checked');

        // AJAX
        $.ajax({
            type:'POST',
            url: "{{ route('tasks.challenge') }}",
            data: {_token: @json(csrf_token()), task_id: taskId, checked: checked},
            success:function(data) {
                console.log(data);
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