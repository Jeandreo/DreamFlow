@foreach ($contents as $content)
<div class="card mb-6">
	<div class="card-body p-5">
		<!-- BEGIN:HEADER -->
		<div class="p-0 d-flex align-items-center justify-content-between fw-bold mb-2">
			<div class="d-flex align-items-center ps-3 pe-5">
				<h2 class="text-gray-700 fs-6 text-uppercase">{{ $content->name }}</h2>
			</div>
			<div class="d-flex align-items-center">
				<div class="w-125px text-center text-gray-700 fs-7 text-uppercase">
					Designado
				</div>
				<div class="d-flex align-items-center justify-content-center cursor-pointer w-150px text-gray-700 fs-7 text-uppercase">
					Status
				</div>
				<div class="d-flex align-items-center justify-content-center cursor-pointer w-200px text-gray-700 fs-7 text-uppercase">
					Data
				</div>
				<div>
					<i class="fa-solid fa-arrows-to-dot text-hover-primary cursor-pointer py-2 px-3 mx-3 fs-7 text-gray-700"></i>
				</div>
			</div>
		</div>
		<!-- END:HEADER -->
		<div class="min-h-200px draggable-zone load-tasks-project" data-project="{{ $content->id }}" id="project-tasks-{{ $content->id }}">
			{{-- LOAD TASKS HERE --}}
			{{-- LOAD TASKS HERE --}}
			{{-- LOAD TASKS HERE --}}
		</div>
		<form action="#" method="POST" class="send-tasks">
			@csrf
			<input type="hidden" name="project_id" value="{{$content->id}}">
			<input type="text" name="name" class="form-control form-control-solid w-100 rounded mt-5" placeholder="Inserir nova tarefa">
		</form>
	</div>
</div>
@endforeach