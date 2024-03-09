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
					<div class="col-12" id="load-tasks">
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
				//appendTo: selector,
				appendTo: "body",
				constrainDimensions: true
			}
		});
	}

	function loadProjects(){
		// AJAX
		$.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			type: 'GET',
			url: "{{ route('tasks.index') }}",
			success: function(data){
				// INSERE PROJETOS
				$('#load-tasks').html(data);

				// BUSCA AS TAREFAS DOS PROJETOS
				$('.load-tasks-project').each(function(){
					loadTasks($(this).data('project'));
					draggable();
				});

			}
		});
	}

	loadProjects();

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
		var name = $(this).find('[name="name"]').val();
		var project = $(this).find('[name="project_id"]').val();

		// AJAX
        $.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: 'POST',
            url: "{{ route('tasks.store') }}",
			data: {project_id: project, name: name},
            success: function(data){
				loadTasks(project)
            }
        });

	});

</script>
@endsection