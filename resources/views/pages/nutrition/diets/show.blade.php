@extends('layouts.app')

@section('title-page', 'Gerenciar Dieta')

@section('title-toolbar', 'Gerenciar Dieta')

@section('content')
<div class="row">
	<div class="col-12">
		@foreach ($diet->days as $day)
		<div class="card mb-8 card-day card-day-{{ $day->id }}" data-day="{{ $day->id }}">
			<div class="card-body p-2">
			  <div class="card border border-gray-200">
				<div class="card-header d-flex align-items-center justify-content-center py-0 min-h-50px bg-dark">
				  <span class="title-header fs-1 text-white text-uppercase fw-bold">
					{{ $day->name }}
				  </span>
				</div>
				<div class="card-body p-0">
				  <div class="row m-0 d-flex align-items-stretch"> 
					@foreach ($day->meals as $meal)
					  <div class="col-12 col-xl p-0 d-flex flex-column @if (!$loop->last) border-end @endif">
						<div class="h-40px bg-light d-flex align-items-center justify-content-center border-bottom p-4">
							<p class="mb-0 text-center fs-6 text-gray-700 fw-bolder text-uppercase">
								{{ $meal->name }}
							</p>
						</div>
						<div class="items p-4 d-flex flex-column" style="min-height: 1px; height: 100%;">
							@foreach ($meal->items ?? [] as $item)
									@include('pages.nutrition.diets._template')
							@endforeach
							<div class="flex-grow-1"></div>
							<div class="">
								<div class="d-flex align-items-center justify-content-between mb-4 p-2 px-4 bg-light rounded meal-total">
									<span class="text-gray-700 fs-8 text-uppercase fw-bold">Total</span>
									<span class="text-gray-600 fs-7 fw-semibold">
									<span class="meal-calories">{{ $meal->getTotalNutrient('calories') }}</span>/kcal</span>
								</div>
								<div class="px-4">
									<select class="form-select form-select-food border-0 p-0 fs-7 select-ajax add-food" data-meal="{{ $meal->id }}" data-placeholder="Adicionar">
										<option></option>
									</select>
								</div>
							</div>
						</div>
					  </div>
					@endforeach
				  </div>
				</div>
				@php
				  $nutrients = $day->getTotalNutrients();
				@endphp
				<div class="card-footer d-flex flex-wrap gap-3 py-4 justify-content-center">
				  <div class="d-flex justify-content-between align-items-center bg-light-primary rounded px-5 py-2">
					<i class="fa-solid fa-egg text-primary fs-4 me-2"></i>
					<div class="text-primary">
					  <span>Proteínas</span>
					  <span class="fw-bolder qnt-proteins">{{ $nutrients['proteins'] ?? 0 }}g</span>
					</div>
				  </div>
				  <div class="d-flex justify-content-between align-items-center bg-light-warning rounded px-5 py-2">
					<i class="fa-solid fa-bread-slice text-warning fs-4 me-2"></i>
					<div class="text-warning">
					  <span>Carboidratos</span>
					  <span class="fw-bolder qnt-carbohydrates">{{ $nutrients['carbohydrates'] ?? 0 }}g</span>
					</div>
				  </div>
				  <div class="d-flex justify-content-between align-items-center bg-light-danger rounded px-5 py-2">
					<i class="fa-solid fa-drumstick-bite text-danger fs-4 me-2"></i>
					<div class="text-danger">
					  <span>Gorduras</span>
					  <span class="fw-bolder qnt-fats">{{ $nutrients['fats'] ?? 0 }}g</span>
					</div>
				  </div>
				  <div class="d-flex justify-content-between align-items-center bg-light-success rounded px-5 py-2">
					<i class="fa-solid fa-leaf text-success fs-4 me-2"></i>
					<div class="text-success">
					  <span>Fibras</span>
					  <span class="fw-bolder qnt-fibers">{{ $nutrients['fibers'] ?? 0 }}g</span>
					</div>
				  </div>
				  <div class="d-flex justify-content-between align-items-center bg-light-info rounded px-5 py-2">
					<i class="fa-solid fa-utensils text-info fs-4 me-2"></i>
					<div class="text-info">
					  <span>Sódio</span>
					  <span class="fw-bolder qnt-sodium">{{ $nutrients['sodium'] ?? 0 }}mg</span>
					</div>
				  </div>
				  <div class="d-flex justify-content-between align-items-center bg-light-dark rounded px-5 py-2">
					<i class="fa-solid fa-fire text-gray-700 fs-4 me-2"></i>
					<div class="text-gray-700">
					  <span>Calorias</span>
					  <span class="fw-bolder qnt-calories">{{ $nutrients['calories'] ?? 0 }}kcal</span>
					</div>
				  </div>
				</div>
			  </div>
			</div>
		  </div>
		@endforeach
	</div>
</div>
{{-- @include('pages.nutrition.diets._resume') --}}
@endsection

@section('custom-footer')
@parent
<script>
	selectOptionsAjax();

	/**
	 * Adiciona alimento a dieta
	 */
	$(document).on('change', '.add-food', function() {
		// Obtém dados
		var foodId = $(this).val();
		var mealId = $(this).data('meal');
		var dayId = $(this).closest('.card-day').data('day');

		// Se não houver alimento selecionado, não faz nada
		if (!foodId) return;

		// Seleciona container
		var container = $(this).closest('.items');

		// AJAX
		$.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			type: 'POST',
			url: "{{ route('diets.items.store') }}",
			data: {
				meal_time_id: mealId,    
				food_dish: foodId,    
			},
			success: function(data) {

				// Atualiza as calorias do dia
				container.find('.meal-calories').text(data['meal']);

				// Insere antes do select
				container.find('.flex-grow-1').before(data['html']);

				// Limpa o select usando métodos do Select2
				$(this).val(null).trigger('change');

				// Atualiza total de calorias da refeição
				loadNutrients(dayId);
			}.bind(this)
		});
	});

	/**
	 * Remove alimento da dieta
	 */
	$(document).on('click', '.remove-item', function() {
		// Obtém dados
		var itemId = $(this).data('item');
		var container = $(this).closest('.items');
		
		// Remove o item e o separador seguinte
		var $itemElement = $(this).closest('.d-flex.justify-content-between');
		$itemElement.next('.separator').remove(); // Remove o separador
		$itemElement.remove(); // Remove o item
		
		var dayId = $(this).closest('.card-day').data('day');

		// AJAX
		$.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			type: 'GET',
			url: "{{ route('diets.items.destroy', '') }}/" + itemId,
			success: function(caloriesMeal) {

				// Atualiza as calorias do dia
				container.find('.meal-calories').text(caloriesMeal);
				
				// Atualiza os totais
				loadNutrients(dayId);
				
				// Mensagem de sucesso
				toastr.success('Item removido com sucesso!');

			},
		});
	});


	// Carrega os nutrientes do dia
	function loadNutrients(id){
		// AJAX
		$.ajax({
			type: 'GET',
			url: "{{ route('diets.nutrients', '') }}/" + id,
			success: function(data){

				// Obtém o quadro
				var card = $('.card-day-' + id);

				// Atualiza os valores
				card.find('.qnt-calories').text(data['calories'] + 'kcal');
				card.find('.qnt-sodium').text(data['sodium'] + 'mg');
				card.find('.qnt-proteins').text(data['proteins'] + 'g');
				card.find('.qnt-carbohydrates').text(data['carbohydrates'] + 'g');
				card.find('.qnt-fats').text(data['fats'] + 'g');
				card.find('.qnt-fibers').text(data['fibers'] + 'g');

			}
		});
	}

</script>
@endsection