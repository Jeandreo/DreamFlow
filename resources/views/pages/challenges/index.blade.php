@extends('layouts.app')

@section('title-page', 'Desafios')

@section('title-toolbar', 'Desafios')

@section('content')
	@include('layouts.title')
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<table class="table table-striped table-row-bordered gy-3 gs-7 border rounded align-middle dmk-datatables">
						<thead>
							<tr class="fw-bold fs-6 text-gray-800 px-7">
								<th width="4%" class="pe-0 ps-5">ID</th>
								<th>Nome</th>
								<th>Desempenho</th>
								<th>Tipo</th>
								<th>Mês</th>
								<th class="text-center">Status</th>
								<th class="text-center" width="165px">
									<span>Ações</span>
								</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($contents as $content)
							<tr>
								<td class="pe-0 ps-4">
									<span class="fw-semibold text-gray-700">
										{{  str_pad($content->id , 4 , '0' , STR_PAD_LEFT)}}
									</span>
								</td>
								<td>
									<a href="{{ route('challenges.edit', $content->id) }}" class="text-gray-800 text-hover-primary fs-6 fw-normal">
										{{ $content->name }}
									</a>
								</td>
								<td>
									<div class="d-flex w-225px flex-wrap">
										@foreach ($content->getDays() as $day)
										<div class="rounded-circle min-h-10px min-w-10px h-10px w-10px me-1 mb-1 @if($day['completed'] === 1) bg-success @elseif($day['completed'] === 0) bg-danger @elseif ($day['completed'] === null && now() < $day['date']) bg-gray-300 @else bg-primary @endif" data-bs-toggle="tooltip" title="{{ date('d/m/Y', strtotime($day['date'])) }}"></div>
										@endforeach
									</div>
								</td>
								<td>
									<span class="text-gray-700">
										@if ($content->type == 'mensal')
											<span class="badge badge-light-primary">Mensal</span>
										@else
										<span class="badge badge-light-success">Semanal</span>
										@endif
									</span>
								</td>
								<td>
									<span class="text-gray-700 fw-normal">
										@if($content->type == 'mensal')
										{{ $content->date }}
										@else
										{{ date('d/m/Y', strtotime($content->custom_start)) }} até {{ date('d/m/Y', strtotime($content->custom_end)) }} 
										@endif
									</span>
								</td>
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
									<a href="{{ route('challenges.edit', $content->id) }}" class="btn btn-sm btn-light btn-active-light-success btn-icon">
										<i class="fa-solid fa-pen-to-square "></i>
									</a>
									<a href="{{ route('challenges.destroy', $content->id) }}" class="btn btn-sm btn-light btn-active-light-danger btn-icon">
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
				<a href="{{ route('dashboard.index') }}" class="btn btn-sm fw-bold btn-secondary">Voltar</a>
				<a href="{{ route('challenges.create') }}" class="btn btn-sm fw-bold btn-primary btn-active-danger">Adicionar Desafio</a>
			</div>
		</div>
	</div>
@endsection