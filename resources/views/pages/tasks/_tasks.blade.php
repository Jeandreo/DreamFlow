<!-- BEGIN:TASK AND SUBTASK -->
<div class="draggable dmk-div-task" data-task="{{ $task->id }}">
	<div class="d-grid">
		<!-- BEGIN:TASK -->
		@include('pages.tasks._task')
		<!-- END:TASK -->
	</div>
	<!-- BEGIN:SUB-TASK -->
	<div class="subtasks-zone subtasks-zone-{{ $task->id }}" style="display: none;">
		@foreach ($task->subtasks as $subtask)
		@include('pages.tasks._subtask')
		@endforeach
	</div>
</div> 
<!-- END:TASK AND SUBTASK -->