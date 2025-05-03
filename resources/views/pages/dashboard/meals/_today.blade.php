
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
        <a href="{{ route('nutrition.index') }}" class="btn btn-sm btn-icon btn-light-success btn-active-primary">
            <i class="fa-solid fa-utensils"></i>
        </a>
        @endif
    </div>
    </div>
    <div class="card-body pb-2 pt-1">
        @if ($diet)
        <div class="carousel-inner h-100">
            @foreach ($diet->plannedToday() as $mealData)
                <div class="carousel-item @if($loop->first) active @endif">
                    @if ($mealData['foods']->count())
                        @foreach ($mealData['foods'] as $item)
                            <div class="d-flex justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="form-check form-check-custom form-check-solid cursor-pointer me-2">
                                        <input 
                                            class="form-check-input cursor-pointer check-eat" 
                                            @if(isset($diet->eatToday()[$mealData['meal_id']]) && in_array($item['food']->id, $diet->eatToday()[$mealData['meal_id']])) checked @endif  
                                            value="{{ $item['food']->id }}" 
                                            data-meal="{{ $mealData['meal_id'] }}" 
                                            type="checkbox" 
                                            id="item_{{ $item['food']->id }}"
                                        />
                                    </div>
                                    <label class="d-flex justify-content-between cursor-pointer" for="item_{{ $item['food']->id }}">
                                        <span class="text-gray-700 fw-bold d-flex align-items-center">
                                            {{ Str::limit($item['food']->name, 35) }}
                                            @if (!$item['is_extra'] && $item['quantity'] > 1)
                                                @if ($item['food']->type == 'unidade')
                                                    <span class="fw-normal text-gray-500 fs-7 ms-2">{{ $item['quantity'] }}uni</span>
                                                @else
                                                    <span class="fw-normal text-gray-500 fs-7 ms-2">{{ $item['quantity'] }}g</span>
                                                @endif
                                            @endif
                                        </span>
                                        @if($item['is_extra'])
                                            <span class="badge badge-light-warning ms-2">Extra</span>
                                        @endif
                                    </label>
                                </div>
                                <div>
                                    <span class="text-gray-600">
                                        {{ floor($item['food']->calories) }}/kcal
                                    </span>
                                </div>
                            </div>
                            @if (!$loop->last)
                            <div class="separator separator-dashed my-2"></div>
                            @endif
                        @endforeach
                        <button class="btn btn-sm btn-light w-100 mt-4 meal-extra" data-meal="{{ $mealData['meal_id'] }}" data-bs-toggle="modal" data-bs-target="#modal_add_food">
                            Adicionar alimento fora da dieta
                        </button>
                    @else
                        <div class="bg-light rounded d-flex align-items-center justify-content-center h-175px">
                            <div class="text-center">
                                <p class="fw-bold text-gray-700 fs-4 mb-0 text-uppercase">{{ $mealData['meal_name'] }}</p>
                                <p class="text-gray-600 fs-6">Monte sua dieta em alimentação.</p>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
        
        @else
        <div class="bg-light rounded py-3 px-7 h-225px d-flex justify-content-center align-items-center">
            <div class="text-center">
                <p class="fw-bold text-gray-700 fs-6 mb-0 lh-1">DIETA NÃO PROGRAMADA 😔</p>
                <p class="text-gray-600 fs-6">Como você quer ficar saradão desse jeito?</p>
            </div>
        </div>
        @endif
    </div>
    <div class="card-footer pt-1 pb-2">
        <div class="row">
            <div class="col-6">
                <p class="fw-bold text-gray-700 mb-1">
                    Consumido até agora: <i class="fa-solid fa-circle-info" data-bs-toggle="tooltip" title="Quantia de calorias que você consumiu ao longo do dia."></i><br>
                    <span class="fw-bolder text-success">{{ $diet->caloriesEatenToday() }}<span class="fw-normal text-gray-600 fs-8">/kcal</span></span>
                </p>
            </div>
            <div class="col-3">
                <p class="fw-bold text-gray-700 mb-1">
                    TMB: <i class="fa-solid fa-circle-info" data-bs-toggle="tooltip" title="É a quantidade de calorias que seu corpo gasta em repouso absoluto para manter funções básicas vitais."></i><br>
                    <span class="fw-bolder text-success">{{ Auth::user()->lastBody->bmr ?? '-' }}<span class="fw-normal text-gray-600 fs-8">/kcal</span></span></span>
                </p>
            </div>
            <div class="col-3">
                <p class="fw-bold text-gray-700 mb-1">
                    GED: <i class="fa-solid fa-circle-info" data-bs-toggle="tooltip" title="Gasto Energético Diário: É o total de calorias que seu corpo gasta considerando a taxa base + quantidade gasta por exercícios."></i><br>
                    <span class="fw-bolder text-success">{{ Auth::user()->lastBody->total_calories ?? '-' }}<span class="fw-normal text-gray-600 fs-8">/kcal</span></span>
                </p>
            </div>
        </div>
    </div>
</div>