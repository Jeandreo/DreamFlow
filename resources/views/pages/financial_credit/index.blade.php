@extends('layouts.app')

@section('title-page', 'Cartões de Crédito')

@section('title-toolbar', 'Cartões de Crédito')

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
								<th>Últimos dig.</th>
								<th>Descrição</th>
								<th>Fechamento</th>
								<th>Vencimento</th>
								<th>Limite</th>
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
									<a href="{{ route('financial.credit.cards.edit', $content->id) }}" class="text-gray-800 text-hover-primary fs-6 fw-normal">
										{{ $content->name }}
									</a>
								</td>
								<td>
									<a class="text-gray-700 fs-6 fw-normal">
										{{ $content->last_numbers }}
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
									<span class="text-gray-600 fs-7">
										{{ $content->closing_day }}
									</span>
								</td>
								<td>
									<span class="text-gray-600 fs-7">
										{{ $content->due_day }}
									</span>
								</td>
								<td>
									<span class="text-gray-800 fs-6 fw-normal">
										R$ {{ number_format($content->limit, 2, ',', '.') }}
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
									<a href="{{ route('financial.credit.cards.edit', $content->id) }}" class="btn btn-sm btn-light btn-active-light-success btn-icon">
										<i class="fa-solid fa-pen-to-square "></i>
									</a>
									<a href="{{ route('financial.credit.cards.destroy', $content->id) }}" class="btn btn-sm btn-light btn-active-light-danger btn-icon">
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
				<a href="{{ route('financial.credit.cards.create') }}" class="btn btn-sm fw-bold btn-primary btn-active-danger">Adicionar Cartão</a>
			</div>
		</div>
	</div>
@endsection