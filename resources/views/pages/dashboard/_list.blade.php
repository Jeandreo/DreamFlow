@if ($tasks->count())
    @foreach ($tasks as $task)
        @include('pages.tasks._tasks')
    @endforeach
@endif
<div class="no-tasks" @if ($tasks->count() != 0) style="display: none;" @endif>
    <div class="rounded bg-light d-flex align-items-center justify-content-center h-50px">
        <div class="text-center">
            <p class="m-0 text-gray-600 fw-bold text-uppercase">Sem tarefas ainda em lembretes</p>
        </div>
    </div>
</div>