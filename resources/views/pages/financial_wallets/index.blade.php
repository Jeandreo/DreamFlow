@extends('layouts.app')

@section('title-page', 'Carteiras')

@section('title-toolbar', 'Carteiras')

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
								<th>Preview</th>
								<th>Instituição</th>
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
									<a href="{{ route('financial.wallets.edit', $content->id) }}" class="text-gray-800 text-hover-primary fs-6 fw-normal">
										{{ $content->name }}
									</a>
								</td>
								<td>
									<span class="badge py-2 fw-bold fs-8 px-3" style="background: {{ hex2rgb($content->color, 7) }}; color: {{ $content->color, 100 }}">{{ $content->name }}</span>
								</td>
								<td>
									<span class="text-gray-700">
										{{ $content->institution->name }}
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
									<a href="{{ route('financial.wallets.edit', $content->id) }}" class="btn btn-sm btn-light btn-active-light-success btn-icon">
										<i class="fa-solid fa-pen-to-square "></i>
									</a>
									<a href="{{ route('financial.wallets.destroy', $content->id) }}" class="btn btn-sm btn-light btn-active-light-danger btn-icon">
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
				<a href="{{ route('financial.wallets.create') }}" class="btn btn-sm fw-bold btn-primary btn-active-danger">Adicionar Carteira</a>
			</div>
		</div>
	</div>
@endsection