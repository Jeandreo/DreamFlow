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
                        Bom diiiiaa {{ Auth::user()->name }}! {{ randomEmoji() }}
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
                                                            @if (date('Y-m-d', $currentDay) <= date('Y-m-d'))
															<div class="d-block @if(checkDayMonth(date('Y-m-' . date('d', $currentDay)), 'semanal') && checkDayMonth(date('Y-m-' . date('d', $currentDay)), 'semanal')->completed == true) bg-success @elseif(checkDayMonth(date('Y-m-' . date('d', $currentDay)), 'semanal') && checkDayMonth(date('Y-m-' . date('d', $currentDay)), 'semanal')->completed == false) bg-danger @else bg-primary @endif rounded py-2 px-2 mx-1 @if($weekChallenge) check-day @endif" data-day="{{ date('d', $currentDay) }}" data-type="semanal" data-challenge="{{ $weekChallenge->id }}">
																<div class="h-25px w-25px min-h-25px min-w-25px rounded-circle d-flex align-items-center justify-content-center fw-bold bg-white text-primary">
																	{{ str_pad(date('d', $currentDay), 2, '0', STR_PAD_LEFT) }}
																</div>
																<p class="fs-9 fw-bold text-center text-white mb-0 text-center mt-1 text-uppercase">
																	{{ $daysOfWeek[date('D', $currentDay)] }}
																</p>
															</div>
                                                            @else
                                                                <div class="d-block bg-light rounded py-2 px-2 mx-1">
                                                                    <div class="h-25px w-25px min-h-25px min-w-25px rounded-circle d-flex align-items-center justify-content-center fw-bold bg-white text-primary">
                                                                        {{ str_pad(date('d', $currentDay), 2, '0', STR_PAD_LEFT) }}
                                                                    </div>
                                                                    <p class="fs-9 fw-bold text-center text-gray-700 mb-0 text-center mt-1 text-uppercase">
                                                                        {{ $daysOfWeek[date('D', $currentDay)] }}
                                                                    </p>
                                                                </div>
                                                            @endif
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
                    console.log(data);
                }
            });

        }, doneTypingInterval);
    });
</script>
@include('pages.tasks._javascript')
@endsection