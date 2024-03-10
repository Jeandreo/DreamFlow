@extends('layouts.app')
@section('title-page', $contents->name)
@section('custom-head')
<script src="{{ asset('assets/plugins/custom/draggable/draggable.bundle.js') }}"></script>
@endsection
@section('content')
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

@endsection
@section('custom-footer')
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script>
	
	// PROJECT ID
	var projectId = {{ $contents->id }};

	// DRAGGABLE
	function draggable(){
		var containers = document.querySelectorAll(".draggable-zone");
		if (containers.length === 0) return false;
		var swappable = new Sortable.default(containers, {
			draggable: ".draggable",
			handle: ".draggable .draggable-handle",
			mirror: {
				appendTo: "body",
				constrainDimensions: true
			}
		});
	}

	// FUNCTION LOAD PROJECTS
	function loadProjects(){
		// AJAX
		$.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			type: 'GET',
			url: "{{ route('tasks.index') }}",
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
							draggable();
							generateFlatpickr();
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

		// AJAX
        $.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: 'POST',
            url: "{{ route('tasks.check') }}",
			data: {task_id: taskId},
        });

		// SELECT DIV OF TASK
		var taskDiv = $(this).closest('.draggable');

		// ADD ANIMATION AND REMOVE TASK
		taskDiv.addClass('slide-up');
		setTimeout(function() {
			taskDiv.remove();
		}, 500);

		// PLAY SOUND
		audio.play();


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

		// OBTEM TEXTO, ID e TIPO
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


</script>
@endsection