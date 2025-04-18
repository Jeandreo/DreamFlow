@extends('layouts.app')

@section('title-page', 'Gerenciar Dieta')

@section('title-toolbar', 'Gerenciar Dieta')

@section('content')
<div class="row">
	<div class="col">
		@foreach ([
			'Segunda',
			'Terça',
			'Quarta',
			'Quinta',
			'Sexta',
			'Sábado',
			'Domingo',
		] as $day)
			<div class="card mb-8">
				<div class="card-header d-flex align-items-center justify-content-center py-0 min-h-50px" style="background: linear-gradient(180deg, #85c515, #48a833)">
					<span class="title-header fs-1 text-white text-uppercase fw-bold">
						{{ $day }}
					</span>
				</div>
				<div class="card-body p-0">
					<div class="row m-0">
						@foreach ([
							'Café da Manhã',
							'Lanche da Manhã',
							'Almoço',
							'Lanche da Tarde',
							'Jantar',
						] as $lunch)
						<div class="col p-0 @if (!$loop->last) border-end @endif">
							<p class="mb-0 text-center fs-6 text-gray-700 fw-bolder text-uppercase h-40px bg-light d-flex align-items-center justify-content-center border-bottom">
								{{ $lunch }}
							</p>
							<div class="p-4">
								@foreach ([
									'Peito de Frango' => '85kcal',
									'2 Ovos' => '85kcal',
									'200ml de Iogurte' => '85kcal',
									'Paçoca' => '85kcal',
								] as $food => $kcal)
								<div class="d-flex justify-content-between">
									<span class="text-gray-700 fw-bold">
										{{ $food }}
									</span>
									<span class="text-gray-600">
										{{ $kcal }}
									</span>
								</div>
								@if (!$loop->last)
									<div class="separator separator-dashed my-2"></div>
								@endif
								@endforeach
								<select class="form-select form-select-food border-0 p-0 fs-7 mt-4 select-ajax" data-placeholder="Adicionar">
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
</script>
@endsection