@extends('layouts.app')

@section('title-page', 'Orçamentos')

@section('title-toolbar', 'Orçamentos')

@section('content')
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<table class="table table-striped table-row-bordered gy-1 gs-7 border rounded align-middle dmk-datatables">
						<thead>
							<tr class="fw-bold fs-6 text-gray-800 px-7">
								<th width="4%" class="pe-0 ps-5">ID</th>
								<th>Nome</th>
								<th>Descrição</th>
								<th>Valor Previsto</th>
								<th>Valor Gasto</th>
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
									<a href="{{ route('budgets.show', $content->id) }}" class="text-gray-800 text-hover-primary fs-6 fw-normal">
										{{ $content->name }}
									</a>
								</td>
								<td>
									@if ($content->description)
									<span class="text-gray-600 fs-7">
										{{ Str::limit($content->description, 80) }}
									</span>
									@else
										<span class="badge badge-light">-</span>
									@endif
								</td>
								<td>
									<span class="text-gray-800 fs-6 fw-normal">
										R$ {{ number_format($content->total_expected, 2, ',', '.') }}
									</span>
								</td>
								<td>
									<span class="text-gray-800 fs-6 fw-normal">
										R$ {{ number_format($content->value, 2, ',', '.') }}
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
									<a href="{{ route('budgets.edit', $content->id) }}" class="btn btn-sm btn-light btn-active-light-success btn-icon">
										<i class="fa-solid fa-pen-to-square "></i>
									</a>
									<a href="{{ route('budgets.destroy', $content->id) }}" class="btn btn-sm btn-light btn-active-light-danger btn-icon">
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
				<a href="{{ route('budgets.create') }}" class="btn btn-sm fw-bold btn-primary btn-active-danger">Adicionar Orçamento</a>
			</div>
		</div>
	</div>
@endsection