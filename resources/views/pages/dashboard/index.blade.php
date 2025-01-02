@extends('layouts.app')
@section('title-page', 'Dashboard')
@section('title-toolbar', 'Dashboard')
@section('custom-head')
<script src="{{ asset('assets/plugins/custom/draggable/draggable.bundle.js') }}"></script>
@endsection
@section('content')
<div class="row m-0 background-dashboard" style="background-image: url('{{ asset('assets/media/logos/background-pattern.webp') }}'); background-size: cover;">
    <div style="background: linear-gradient(0deg, #090c11, #18202bf0);">
        <div class="col-12">
            <div class="toolbar py-20 mb-10" id="kt_toolbar">
                <div id="kt_toolbar_container" class=" container-xxl  d-flex justify-content-center">
                    @include('includes.nav-admin', ['title' => "Bom diiiiaa Capitão!", 'phrase' => "“Se você realmente quer algo, não espere. Ensine a si mesmo a ser impaciente.” – Gurbaksh Chahal"])
                </div>
            </div>
        </div>
    </div>
</div>
<div class="app-main flex-column flex-row-fluid " id="kt_app_main">
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_content" class="app-content  flex-column-fluid py-6" >
            <div id="kt_app_content_container" class="app-container  container-fluid ">
                <div class="row mt-n20">
                    {{-- <div class="col-12">
                        <div class="card mb-4">
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
                            <div class="col-12 col-md-3">
                                <div class="row">
                                    <div class="col-12 mb-4">
                                        <div class="d-flex align-items-center justify-content-center rounded p-5" style="background: linear-gradient(3deg, #e54a10, #f6a33d); box-shadow: 0px 0px 30px #ff9200a8;">
                                            <span class="fw-bolder text-white fs-7 text-uppercase text-center">O Ano da Prosperidade!</span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="card mb-2">
                                            <div class="d-flex align-items-center">
                                                <span class="rounded-start bg-primary text-white fs-3 w-30px h-35px d-flex align-items-center justify-content-center fw-bolder me-5">
                                                    1
                                                </span>
                                                <span class="fw-bold text-gray-700">
                                                   Lançamento do Core como Saas
                                                </span>
                                            </div>
                                        </div>
                                        <div class="card mb-2">
                                            <div class="d-flex align-items-center">
                                                <span class="rounded-start bg-primary text-white fs-3 w-30px h-35px d-flex align-items-center justify-content-center fw-bolder me-5">
                                                    1
                                                </span>
                                                <span class="fw-bold text-gray-700">
                                                   Conquistar 86 Kg ou uma barriga tonificada!
                                                </span>
                                            </div>
                                        </div>
                                        <div class="card mb-2">
                                            <div class="d-flex align-items-center">
                                                <span class="rounded-start bg-primary text-white fs-3 w-30px h-35px d-flex align-items-center justify-content-center fw-bolder me-5">
                                                    2
                                                </span>
                                                <span class="fw-bold text-gray-700">
                                                   Ler 12 Livros no Ano!
                                                </span>
                                            </div>
                                        </div>
                                        <div class="card mb-2">
                                            <div class="d-flex align-items-center">
                                                <span class="rounded-start bg-primary text-white fs-3 w-30px h-35px d-flex align-items-center justify-content-center fw-bolder me-5">
                                                    4
                                                </span>
                                                <span class="fw-bold text-gray-700">
                                                   Capacitação para Liderança!
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
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
                                                <div class="bg-light rounded py-3 px-7">
                                                    <div class="text-center">
                                                        <p class="fw-bold text-gray-700 fs-6 mb-0 lh-1">SEM DESAFIOS ESSA SEMANA 😔</p>
                                                        <p class="text-gray-600 fs-6">Que pena, parece que você não planejou nenhum desafio para si.</p>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-4">
                                    <div class="card-body p-2">
                                        <textarea class="form-control form-control-solid" name="notes" rows="2" placeholder="Anotações aqui...">{{ Auth::user()->notes }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-5 d-grid align-items-stretch">
                                <div class="card mb-4">
                                    <div class="card-body p-2 px-4">
                                        <div class="row h-100">
                                            <div class="col-4 px-1 my-1">
                                                <img src="{{ findImage('mural/amor.jpg', 'beautiful') }}" class="rounded-sm w-100 object-fit-cover show-image cursor-pointer" style="height: 107px">
                                            </div>
                                            <div class="col-4 px-1 my-1">
                                                <img src="{{ findImage('mural/porsche.jpg', 'beautiful') }}" class="rounded-sm w-100 object-fit-cover show-image cursor-pointer" style="height: 107px">
                                            </div>
                                            <div class="col-4 px-1 my-1">
                                                <img src="{{ findImage('mural/amor_3.jpg', 'beautiful') }}" class="rounded-sm w-100 object-fit-cover show-image cursor-pointer" style="height: 107px">
                                            </div>
                                            <div class="col-4 px-1 my-1">
                                                <img src="{{ findImage('mural/duda.jpg', 'beautiful') }}" class="rounded-sm w-100 object-fit-cover show-image cursor-pointer" style="height: 107px">
                                            </div>
                                            <div class="col-4 px-1 my-1">
                                                <img src="{{ findImage('mural/Jeandreo-Forbes.jpg', 'beautiful') }}" class="rounded-sm w-100 object-fit-cover show-image cursor-pointer" style="height: 107px">
                                            </div>
                                            <div class="col-4 px-1 my-1">
                                                <img src="{{ findImage('mural/maratona.jpg', 'beautiful') }}" class="rounded-sm w-100 object-fit-cover show-image cursor-pointer" style="height: 107px">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-8 d-grid align-items-stretch">
                            <div class="card mb-4">
                                <div class="card-header border-0 py-5">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fs-4 text-uppercase fw-bold text-gray-700 m-0">Próximas conquistas?</span>
                                        <span class="text-muted fw-semibold fs-7">O maior risco é não correr risco algum.</span>
                                    </h3>
                                </div>
                                <div class="card-body pt-0">
                                    @if ($challenges->count())
                                        @foreach ($challenges as $challenge)
                                            <div class="bg-light rounded mb-3 p-3">
                                                <div class="row">
                                                    <div class="col-12 col-md-3 d-flex align-items-center">
                                                        <p class="m-0 fs-5 fw-bold text-gray-700">{{ $challenge->name }}</p>
                                                    </div>
                                                    <div class="col-12 col-md-8 d-flex align-items-center">
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
                                                                {{ ceil((strtotime($challenge->date) - time()) / (60 * 60 * 24)) }} dias
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
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center h-150px">
                                        <div class="text-center">
                                            <p class="fw-bold text-gray-700 fs-3 mb-1">EIIIIITAAA VOCÊ ESTA SEM DESAFIOS 😱</p>
                                            <p class="text-gray-600 fs-5">Para você ter um desafio, você precisa ter uma tarefa.</p>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 d-grid align-items-stretch">
                            <div class="card mb-4">
                                <div id="kt_carousel_1_carousel" class="card card-flush carousel carousel-custom carousel-stretch slide h-xl-100" data-bs-ride="carousel" data-bs-interval="5000">
                                    <div class="card-header pt-5">
                                        <h3 class="card-title align-items-start flex-column">
                                            <span class="card-label fs-4 text-uppercase fw-bold text-gray-700 m-0">Minhas listas</span>
                                            <span class="text-muted fw-semibold fs-7">O maior risco é não correr risco algum.</span>
                                        </h3>
                                        <div class="card-toolbar">
                                            <ol class="p-0 m-0 carousel-indicators carousel-indicators-bullet carousel-indicators-active-primary">
                                                @for ($i = 0; $i < $lists->count(); ++$i)
                                                    <li data-bs-target="#kt_carousel_1_carousel" data-bs-slide-to="{{ $i }}" class="ms-1 @if($i == 0)active @endif"></li>
                                                @endfor
                                            </ol>
                                        </div>
                                    </div>
                                    <div class="card-body py-6">
                                        <div class="carousel-inner h-100">
                                        @if ($lists->count())
                                            @foreach ($lists as $key => $list)
                                            <div class="carousel-item @if($key == 0)active @endif">
                                                <div class="row h-150px">
                                                    @if ($list->items->count())
                                                        @foreach ($list->items()->get()->take(6) as $item)
                                                        <div class="col-6 mb-2">
                                                            <a href="{{ route('catalogs.items.show', $item->id) }}">
                                                                <div class="d-flex align-items-center">
                                                                    <img src="{{ findImage('catalogos/' .$list->id . '/' . $item->id . '/capa-300px.jpg', 'beautiful') }}" class="object-fit-cover h-40px w-60px rounded-sm me-3" alt="">
                                                                    <div class="d-flex justify-content-start flex-column">
                                                                        <p class="text-gray-800 fw-bold text-hover-primary mb-0 fs-6">
                                                                            {{ Str::limit($item->name, 16) }}
                                                                        </p>
                                                                        <span class="text-gray-500 fw-semibold d-block fs-7">
                                                                            {{ Str::limit($item->catalog->name, 18) }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        @endforeach
                                                    @else
                                                    <div class="bg-light rounded d-flex align-items-center justify-content-center h-150px">
                                                        <div class="text-center">
                                                            <p class="fw-bold text-gray-700 fs-4 mb-0">SEM ITENS NA LISTA 🧐</p>
                                                            <p class="text-gray-600 fs-6">Adicione seus items e gerencie suas ideias aqui.</p>
                                                            <a href="{{ route('catalogs.show', $list->id) }}" class="btn btn-sm btn-primary btn-active-danger text-uppercase fw-bolder">
                                                                Adicionar Itens
                                                            </a>
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            @endforeach
                                        @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center h-150px">
                                            <div class="text-center">
                                                <p class="fw-bold text-gray-700 fs-3 mb-1">SEM LISTAS CADASTRADAS 😱</p>
                                                <p class="text-gray-600 fs-5">Para você ter um desafio, você precisa ter uma tarefa.</p>
                                            </div>
                                        </div>
                                        @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
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
                                        <input class="form-check-input h-20px cursor-pointer" type="checkbox" id="tasks_today"/>
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

        // Verifica se esta checado
        var checked = $(this).is(':checked');

        // Carrega lista
        loadList(checked);

    });

    // Carrega listagem
    function loadList(checked = false){

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
