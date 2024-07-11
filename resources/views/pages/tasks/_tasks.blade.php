<!-- BEGIN:TASK AND SUBTASK -->
<div class="draggable dmk-div-task" data-task="{{ $task->id }}">
	<div class="d-grid">
		<!-- BEGIN:TASK -->
		@include('pages.tasks._task')
		<!-- END:TASK -->
	</div>
	<!-- BEGIN:SUB-TASK -->
	<div class="subtasks-zone subtasks-zone-{{ $task->id }}" @if($task->open_subtasks == false) style="display: none;" @endif id="subtasks-zone-{{ $task->id }}">
		@foreach ($task->subtasks()->where('status', 1)->orderBy('order', 'ASC')->orderBy('date', 'ASC')->get() as $subtask)
		@include('pages.tasks._subtask')
		@endforeach
	</div>
</div> 
<!-- END:TASK AND SUBTASK -->