@extends('layouts.app')

@section('title-page', 'Alimentos')

@section('title-toolbar', 'Alimentos')

@section('content')
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<table class="table table-striped table-row-bordered gy-1 gs-7 border rounded align-middle dmk-datatables">
						<thead>
							<tr class="fw-bold fs-6 text-gray-800 px-7">
								<th>Nome</th>
								<th>Quantidade</th>
								<th>Proteínas (g)</th>
								{{-- <th>Carboidratos (g)</th>
								<th>Gorduras (g)</th> --}}
								<th>Calorias</th>
								<th class="text-center">Status</th>
								<th class="text-center" width="165px">
									<span>Ações</span>
								</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($contents as $content)
								<tr>
									<td>
										<a href="{{ route('foods.edit', $content->id) }}" class="text-center text-gray-700 text-hover-primary fw-bold">
											{{ $content->name }}
										</a>
									</td>
									<td>
										{{ $content->quantity }}{{ $content->type == 'unidade' ? ' unidade' : 'g' }}
									</td>
									<td>{{ $content->proteins }}</td>
									{{-- <td>{{ $content->carbohydrates }}</td>
									<td>{{ $content->fats }}</td> --}}
									<td>{{ $content->calories }}<span class="fs-8 text-gray-500">/kcal</span></td>
									<td class="text-center">
										@if($content->status == 1) 
										<span class="badge badge-light-success">
											Ativo
										</span>
										@else
										<span class="badge badge-light-danger">
											Inativo
										</span>
										@endif
									</td>
									<td class="text-center">
										<a href="{{ route('foods.edit', $content->id) }}" class="btn btn-sm btn-light btn-active-light-success btn-icon">
											<i class="fa-solid fa-pen-to-square "></i>
										</a>
										<a href="{{ route('foods.destroy', $content->id) }}" class="btn btn-sm btn-light btn-active-light-danger btn-icon">
											<i class="fa-solid fa-trash-can"></i>
										</a>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<div class="d-flex justify-content-between mt-6">
				<a href="{{ route('nutrition.index') }}" class="btn btn-sm fw-bold btn-secondary">Voltar</a>
				<a href="{{ route('foods.create') }}" class="btn btn-sm fw-bold btn-primary btn-active-danger">Adicionar Alimento</a>
			</div>
		</div>
	</div>
@endsection