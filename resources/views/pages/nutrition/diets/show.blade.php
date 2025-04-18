@extends('layouts.app')

@section('title-page', 'Gerenciar Dieta')

@section('title-toolbar', 'Gerenciar Dieta')

@section('content')
<div class="row">
	<div class="col">
		@foreach ($diet->meals->groupBy('day_of_week')->toArray() as $meal)
			<div class="card mb-8">
				<div class="card-header d-flex align-items-center justify-content-center py-0 min-h-50px" style="background: linear-gradient(180deg, #85c515, #48a833)">
					<span class="title-header fs-1 text-white text-uppercase fw-bold">
						{{ $meal[0]['day_of_week'] }}
					</span>
				</div>
				<div class="card-body p-0">
					<div class="row m-0">
						@foreach ($meal as $lunch)
							<div class="col p-0 @if (!$loop->last) border-end @endif">
								<p class="mb-0 text-center fs-6 text-gray-700 fw-bolder text-uppercase h-40px bg-light d-flex align-items-center justify-content-center border-bottom">
									{{ $lunch['name'] }}
								</p>
								{{ dd($meal->items) }}
								<div class="p-4">
									@foreach ($groupedItems[$day][$lunch] ?? [] as $item)
										<div class="d-flex justify-content-between">
											<span class="text-gray-700 fw-bold">
												{{ Str::limit($item->food?->name ?? $item->dish?->name, 23) }}
											</span>
											<span class="text-gray-600">
												{{ floor($item->food?->calories ?? $item->dish?->getTotalCaloriesAttribute()) }}
											</span>
										</div>
											<div class="separator separator-dashed my-3"></div>
									@endforeach
									<select class="form-select form-select-food border-0 p-0 fs-7 select-ajax add-food" data-diet="{{ $diet->id }}" data-day="{{ $day }}" data-lunch="{{ $lunch }}" data-placeholder="Adicionar">
										<option></option>
									</select>
								</div>
							</div>
						@endforeach
					</div>
				</div>
				<div class="card-footer d-flex flex-wrap gap-3 py-4 justify-content-center">
					<div class="d-flex justify-content-between align-items-center bg-light-primary rounded px-5 py-2">
						<i class="fa-solid fa-egg text-primary fs-4 me-2"></i>
						<div class="text-primary">
							<span>Proteínas</span>
							<span class="fw-bolder">42g</span>
						</div>
					</div>
					<div class="d-flex justify-content-between align-items-center bg-light-warning rounded px-5 py-2">
						<i class="fa-solid fa-bread-slice text-warning fs-4 me-2"></i>
						<div class="text-warning">
							<span>Carboidratos</span>
							<span class="fw-bolder">42g</span>
						</div>
					</div>
					<div class="d-flex justify-content-between align-items-center bg-light-danger rounded px-5 py-2">
						<i class="fa-solid fa-drumstick-bite text-danger fs-4 me-2"></i>
						<div class="text-danger">
							<span>Gorduras</span>
							<span class="fw-bolder">42g</span>
						</div>
					</div>
					<div class="d-flex justify-content-between align-items-center bg-light-success rounded px-5 py-2">
						<i class="fa-solid fa-leaf text-success fs-4 me-2"></i>
						<div class="text-success">
							<span>Fibras</span>
							<span class="fw-bolder">12g</span>
						</div>
					</div>
					<div class="d-flex justify-content-between align-items-center bg-light-info rounded px-5 py-2">
						<i class="fa-solid fa-utensils text-info fs-4 me-2"></i>
						<div class="text-info">
							<span>Sódio</span>
							<span class="fw-bolder">500mg</span>
						</div>
					</div>
					<div class="d-flex justify-content-between align-items-center bg-light-dark rounded px-5 py-2">
						<i class="fa-solid fa-fire text-gray-700 fs-4 me-2"></i>
						<div class="text-gray-700">
							<span>Calorias</span>
							<span class="fw-bolder">200kcal</span>
						</div>
					</div>
				</div>
			</div>
		@endforeach

	</div>
	<div class="col-2">
		@foreach ([
			'Jeandreo' => [
				'Altura' => '173cm',
				'Peso' 	 => '81,5kg',
				'Idade'  => '25 anos',
				'TMB' 	 => '1950/kcal',
			],
			'Eduarda' => [
				'Altura' => '158cm',
				'Peso' 	 => '78kg',
				'Idade'  => '22 anos',
				'TMB' 	 => '1413/kcal',
			]
		] as $person => $keys)
		<div class="card mb-8">
			<div class="card-body">
					<p class="text-center text-uppercase text-gray-700 fw-bolder fw-bolder">
						{{ $person }}
					</p>
					@foreach ($keys as $key => $info)
					<div class="d-flex justify-content-between">
						<span class="text-gray-700 fw-bold">
							{{ $key }}
						</span>
						<span class="text-gray-600">
							{{ $info }}
						</span>
					</div>
					@endforeach
				</div>
			</div>
		@endforeach
	</div>
</div>
	@include('pages.nutrition.diets._resume')
@endsection

@section('custom-footer')
@parent
<script>
	selectOptionsAjax();
	$(document).on('change', '.add-food', function(){

		// Obtém dados
		var foodId 	= $(this).val();
		var dietId 	= $(this).data('diet');
		var day 	= $(this).data('day');
		var lunch 	= $(this).data('lunch');

		console.log(foodId, dietId, day, lunch);

        // AJAX
        $.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: 'POST',
            url: "{{ route('diets.items.store') }}",
            data: {
				food_dish: 	 foodId,	
				diet_id: 	 dietId,	
				day_of_week: day,	
				meal_time: 	 lunch,	
			},
            success: function(data){
                alert('sucesso');
            }
        });


	});
</script>
@endsection