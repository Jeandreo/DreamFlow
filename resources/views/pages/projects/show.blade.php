@extends('layouts.app')
@section('title-page', $contents->name ?? 'Projetos')
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

<div class="modal fade" tabindex="-1" id="modal_task">
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
	$(document).on('change', '.task-name, .task-phrase, .task-description', function(){

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
			}
		});


	})


	


	// SHOW TASK
	$(document).on('click', '.show-task', function(){

		// GET DATA
        var taskId = $(this).data('task');

		// EXIBE TASK
		showTask(taskId);

	});
</script>
@endsection