@extends('layouts.app')
@section('title-page', $contents->name ?? 'Projetos')
@section('custom-head')
<script src="{{ asset('assets/plugins/custom/draggable/draggable.bundle.js') }}"></script>
@endsection
@section('content')
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_task">
    PREVIEW TAREFA
</button>
<div class="app-main flex-column flex-row-fluid " id="kt_app_main" style="background: url('{{ asset('assets/media/images/bg_colors.jpg') }}');">
	<div class="d-flex flex-column flex-column-fluid">                             
		<div id="kt_app_content" class="app-content  flex-column-fluid py-6" >
			<div id="kt_app_content_container" class="app-container  container-fluid ">
				<div class="row">
					<div class="col-12" id="load-projects">
						{{-- LOAD PROJECTS HERE --}}
						{{-- LOAD PROJECTS HERE --}}
						{{-- LOAD PROJECTS HERE --}}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" tabindex="-1" id="modal_task">
    <div class="modal-dialog modal-dialog-centered rounded">
        <div class="modal-content rounded">
            <div class="modal-body p-0">
                <div class="row m-0">
					<div class="col-4 bg-dark h-600px rounded-start p-0">
						<div class="h-75px p-3 d-flex align-items-center justify-content-center" style="border-bottom: solid 1px rgba(0, 0, 0, 0.3)">
							<h2 class="text-white fw-bold text-uppercase m-0">Detalhes da missão</h2>
						</div>
						<div class="px-8">
							<span class="badge badge-primary mb-4 mt-7">A fazer</span>
							<h2 class="text-white fs-2x my-4">Desenvolvimento de campanha publicitária</h2>
							<p class="text-white">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
							<div class="h-125px"></div>
							<h3 class="text-white">Detalhes</h3>
							<div class="row pb-3 mb-2" style="border-bottom: solid 1px rgba(0, 0, 0, 0.2)">
								<div class="col-4">
									<p class="text-white fw-bolder m-0">Autor</p>
								</div>
								<div class="col-8">
									<p class="text-white text-end m-0">Jeandreo F. Furquim</p>
								</div>
							</div>
							<div class="row pb-3 mb-2" style="border-bottom: solid 1px rgba(0, 0, 0, 0.2)">
								<div class="col-4">
									<p class="text-white fw-bolder m-0">Projeto</p>
								</div>
								<div class="col-8">
									<p class="text-white text-end m-0">Jeandreo F. Furquim</p>
								</div>
							</div>
							<div class="row pb-3 mb-2">
								<div class="col-4">
									<p class="text-white fw-bolder m-0">Criado as</p>
								</div>
								<div class="col-8">
									<p class="text-white text-end m-0">Jeandreo F. Furquim</p>
								</div>
							</div>
						</div>
					</div>
					<div class="col-8 h-600px rounded-end">
						<div class="h-75px p-3 d-flex align-items-center justify-content-center" style="border-bottom: solid 1px rgba(0, 0, 0, 0.05);">
							<p class="text-gray-600 text-uppercase m-0"><i>“Não é sobre ideias. É sobre fazer as ideias acontecerem.” – Scott Belsky</i></p>
						</div>
						<div class="h-350px">
							<div class="h-100 bg-light rounded mt-2" id="results-comments">
								{{-- COMMENTS HERE --}}
								{{-- COMMENTS HERE --}}
								{{-- COMMENTS HERE --}}
							</div>
						</div>
						<div class="h-100px">
							<div class="pt-5" data-bs-theme="light">
								<textarea name="kt_docs_ckeditor_classic" id="kt_docs_ckeditor_classic">
								</textarea>
							</div>
						</div>
					</div>
				</div>
            </div>
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
		var subtask = $(this).closest('.task-left-side').find('.task-name');
		console.log(subtask);

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
			var taskDiv = $(this).closest('.draggable');

			// ADD ANIMATION AND REMOVE TASK
			taskDiv.addClass('slide-up');
			setTimeout(function() {
				taskDiv.remove();
			}, 500);

		} else {
			subtask.toggleClass('text-decoration-line-through ');
		}

		// PLAY SOUND
		audio.play();

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
	$(document).on('focus', '.task-name', function(){
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
	$(document).on('change', '.task-name, .task-phrase', function(){

		// GET DATA
		var input = $(this).attr('name'); 
		var value = $(this).val();
		var taskId = $(this).data('task');

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

		// AJAX
		$.ajax({
			type:'PUT',
			url: "{{ route('tasks.date') }}",
			data: {_token: @json(csrf_token()), task_id: taskId, date: date},
		});

	});

</script>
@endsection