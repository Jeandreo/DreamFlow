@extends('layouts.app')
@section('title-page', 'Tarefas')
@section('title-toolbar', 'Tarefas')
@section('custom-head')
<script src="{{ asset('assets/plugins/custom/draggable/draggable.bundle.js') }}"></script>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header border-0 py-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fs-4 text-uppercase fw-bold text-gray-700 m-0">Faça o que for preciso pela missão!</span>
                    <span class="text-muted fw-semibold fs-7">Seja um destruidor de tarefas!</span>
                </h3>
                <div class="card-toolbar">
                    <div class="form-check form-switch form-check-custom form-check-solid">
                        <label class="form-check-label cursor-pointer me-2 fw-bold text-danger text-gray-600 text-uppercase" for="tasks_today">
                            Apenas as dos próximos dias
                        </label>
                        <input class="form-check-input h-20px cursor-pointer" type="checkbox" id="tasks_today" checked/>
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
              <!-- BEGIN:TASKS -->
              <div style="min-height: 50px;">
                <div id="tasks-list">
                    {{-- RESULTS HERE --}}
                    {{-- RESULTS HERE --}}
                    {{-- RESULTS HERE --}}
                </div>
                @if(projects()->exists())
                <form action="#" method="POST" class="send-tasks">
                    @csrf
                    <div class="d-flex h-40px mt-5">
                        <input type="text" name="name" class="form-control form-control-solid w-100 h-100 rounded-start border" placeholder="Inserir nova tarefa" style="border-radius: 10px 0px 0px 10px !important;">
                        <input type="text" class="form-control flatpickr rounded-0 text-center w-200px input bg-gray-300 border-0" placeholder="00/00/0000" name="date" value="{{ date('Y-m-d') }}" required/>
                        <input type="hidden" name="project_id" value="{{ projects()->where('reminder', true)->exists() ? projects()->where('reminder', true)->first()->id : 1 }}">
                        <div class="d-flex p-0 align-items-center justify-content-center cursor-pointer h-100 w-200px rounded-0 background-project" style="background: {{ projects()->where('reminder', true)->first()->color }}">
                            <div class="w-200px h-100 d-flex align-items-center justify-content-center" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-start">
                                <p class="text-white fw-bold m-0 text-center project-name">{{ projects()->where('reminder', true)->first()->name }}</p>
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-250px py-4" data-kt-menu="true" style="">
                                    @foreach ($projects as $project)
                                    <div class="menu-item px-3 mb-2">
                                        <span data-project="{{ $project->id }}" data-color="{{ $project->color }}" class="menu-link px-3 d-block text-center send-tasks-projects" style="background: {{ $project->color }}; color: white">
                                            {{ $project->name }}
                                        </span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="w-50px bg-light"></div>
                        <button type="submit" class="border-0 w-60px bg-primary bg-hover-success rounded-end d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-paper-plane fs-4 text-white"></i>
                        </button>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="modal fade" data-bs-focus="false" id="modal_task">
    <div class="modal-dialog modal-dialog-centered rounded">
        <div class="modal-content rounded bg-transparent" id="load-task">
            {{-- LOAD TASK HERE --}}
            {{-- LOAD TASK HERE --}}
            {{-- LOAD TASK HERE --}}
        </div>
    </div>
</div>
@endsection


@section('custom-footer')
<script>
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
                }
            });

        }, doneTypingInterval);
    });

    // Desmarca ou marca
    $(document).on('change', '#tasks_today', function(){

        // Carrega lista
        loadList();

    });

    // Carrega listagem
    function loadList(){

        // Verifica se esta checado
        var checked = $('#tasks_today').is(':checked');

        // RANGE
        var range = checked ? 'next_days' : 'all';

        // AJAX
        $.ajax({
            type:'GET',
            url: "{{ route('dashboard.list', '') }}/" + range,
            success:function(response) {
                $('#tasks-list').html(response);
                generateFlatpickr();
                KTMenu.createInstances();
                $('body').tooltip({selector: '[data-bs-toggle="tooltip"]',html: true});
            }
        });
    }

    loadList();

</script>
@include('pages.tasks._javascript')
@endsection
