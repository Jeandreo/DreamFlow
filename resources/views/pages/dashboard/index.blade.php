@extends('layouts.app')
@section('title-page', 'Dashboard')
@section('title-toolbar', 'Dashboard')
@section('content')
<div class="row">
    <div class="col-12">
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
                        <span class="rounded-start bg-primary text-white fs-3 w-30px h-35px d-flex align-items-center justify-content-center fw-bolder me-4">
                            1
                        </span>
                        <span class="fw-bold text-gray-700">
                            Lançamento do Core como Saas
                        </span>
                    </div>
                </div>
                <div class="card mb-2">
                    <div class="d-flex align-items-center">
                        <span class="rounded-start bg-primary text-white fs-3 w-30px h-35px d-flex align-items-center justify-content-center fw-bolder me-4">
                            2
                        </span>
                        <span class="fw-bold text-gray-700">
                            Ser um corredor profissional
                        </span>
                    </div>
                </div>
                <div class="card mb-2">
                    <div class="d-flex align-items-center">
                        <span class="rounded-start bg-primary text-white fs-3 w-30px h-35px d-flex align-items-center justify-content-center fw-bolder me-4">
                            3
                        </span>
                        <span class="fw-bold text-gray-700">
                            Se tornar mais elegante
                        </span>
                    </div>
                </div>
                <div class="card mb-2">
                    <div class="d-flex align-items-center">
                        <span class="rounded-start bg-primary text-white fs-3 w-30px h-35px d-flex align-items-center justify-content-center fw-bolder me-4">
                            4
                        </span>
                        <span class="fw-bold text-gray-700">
                            Ter uma Rede Social forte
                        </span>
                    </div>
                </div>
                <div class="card mb-2">
                    <div class="d-flex align-items-center">
                        <span class="rounded-start bg-primary text-white fs-3 w-30px h-35px d-flex align-items-center justify-content-center fw-bolder me-4">
                            5
                        </span>
                        <span class="fw-bold text-gray-700">
                            Viver mais experiências
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-5">
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
                <textarea class="form-control form-control-solid" name="notes" rows="3" placeholder="Anotações aqui...">{{ Auth::user()->notes }}</textarea>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4 d-grid align-items-stretch mb-4">
        <div id="carousel_meals" class="card card-flush carousel carousel-custom slide h-xl-100" data-bs-ride="carousel" data-bs-interval="15000">
            <div class="card-header pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fs-4 text-uppercase fw-bold text-gray-700 m-0">Bora Comer Certinho? 😋</span>
                    <span class="text-muted fw-semibold fs-7">É só seguir o plano e deixar o shape agradecer! 🍽️🔥</span>
                </h3>
                <div class="card-toolbar">
                @if ($diet)
                    <ol class="p-0 m-0 carousel-indicators carousel-indicators-bullet carousel-indicators-active-primary">
                        @foreach ($diet->today()->meals as $key => $meal)
                            <li data-bs-target="#carousel_meals" data-bs-slide-to="{{ $key }}" class="ms-1 @if($key == 0) active @endif"></li>
                        @endforeach
                    </ol>
                @else
                <a href="{{ route('nutrition.index') }}" class="btn btn-sm btn-light">
                    Alimentação
                </a>
                @endif
            </div>
            </div>
            <div class="card-body py-6">
                @if ($diet)
                <div class="carousel-inner h-100">
                    @foreach ($diet->today()->meals as $key => $meal)
                    <div class="carousel-item @if($key == 0) active @endif">
                        <div class="row">
                            @if ($meal->items->count())
                                @foreach ($meal->items as $item)
                                <div class="col-12 mb-2">
                                    <div class="d-flex align-items-center">
                                        <div class="form-check form-check-custom form-check-solid cursor-pointer me-2">
                                            <input class="form-check-input cursor-pointer check-eat" value="{{ $item->id }}" type="checkbox" id="item_{{ $item->id }}"/>
                                        </div>
                                        <label class="text-gray-700 fw-bold mb-0 fs-6 cursor-pointer" for="item_{{ $item->id }}">
                                            {{ Str::limit($item->item()->name, 35) }}
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center h-150px">
                                <div class="text-center">
                                    <p class="fw-bold text-gray-700 fs-4 mb-0 text-uppercase">{{ $meal->name }}</p>
                                    <p class="text-gray-600 fs-6">Monte sua dieta em alimentação.</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="bg-light rounded py-3 px-7 h-150px d-flex justify-content-center align-items-center">
                    <div class="text-center">
                        <p class="fw-bold text-gray-700 fs-6 mb-0 lh-1">DIETA NÃO PROGRAMADA 😔</p>
                        <p class="text-gray-600 fs-6">Como você quer ficar saradão desse jeito?</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
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
            <div id="carousel_list" class="card card-flush carousel carousel-custom carousel-stretch slide h-xl-100" data-bs-ride="carousel" data-bs-interval="5000">
                <div class="card-header pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fs-4 text-uppercase fw-bold text-gray-700 m-0">Minhas listas</span>
                        <span class="text-muted fw-semibold fs-7">O maior risco é não correr risco algum.</span>
                    </h3>
                    <div class="card-toolbar">
                        <ol class="p-0 m-0 carousel-indicators carousel-indicators-bullet carousel-indicators-active-primary">
                            @for ($i = 0; $i < $lists->count(); ++$i)
                                <li data-bs-target="#carousel_list" data-bs-slide-to="{{ $i }}" class="ms-1 @if($i == 0)active @endif"></li>
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
    <div class="col-12 d-grid align-items-stretch">
        <div class="card mb-4">
            <div class="card-body p-2 px-4">
                <div class="row h-100">
                    <div class="col-4 px-1 my-1">
                        <img src="{{ findImage('mural/meia.png', 'beautiful') }}" class="rounded-sm w-100 object-fit-cover show-image cursor-pointer h-300px">
                    </div>
                    <div class="col-4 px-1 my-1">
                        <img src="{{ findImage('mural/porsche.jpg', 'beautiful') }}" class="rounded-sm w-100 object-fit-cover show-image cursor-pointer h-300px">
                    </div>
                    <div class="col-4 px-1 my-1">
                        <img src="{{ findImage('mural/amor_3.jpg', 'beautiful') }}" class="rounded-sm w-100 object-fit-cover show-image cursor-pointer h-300px">
                    </div>
                    <div class="col-4 px-1 my-1">
                        <img src="{{ findImage('mural/fazer.jpg', 'beautiful') }}" class="rounded-sm w-100 object-fit-cover show-image cursor-pointer h-300px">
                    </div>
                    <div class="col-4 px-1 my-1">
                        <img src="{{ findImage('mural/Jeandreo-Forbes.jpg', 'beautiful') }}" class="rounded-sm w-100 object-fit-cover show-image cursor-pointer h-300px">
                    </div>
                    <div class="col-4 px-1 my-1">
                        <img src="{{ findImage('mural/maratona.jpg', 'beautiful') }}" class="rounded-sm w-100 object-fit-cover show-image cursor-pointer h-300px">
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

        // Carrega lista
        loadList();

    });

    // Desmarca ou marca
    $(document).on('change', '.check-eat', function(){

        // Obtém item da dieta
        var itemId = $(this).val();
        var eaten = $(this).is(':checked');

        // AJAX
        $.ajax({
            type:'POST',
            url: "{{ route('foods.eat') }}",
            data: {
                _token: @json(csrf_token()),
                itemId: itemId,
                eaten: eaten,
            },
            success:function(response) {
               
            }
        });

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
