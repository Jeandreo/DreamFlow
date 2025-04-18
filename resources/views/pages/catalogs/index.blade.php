@extends('layouts.app')

@section('title-page', 'Catálogos')

@section('title-toolbar', 'Catálogos')

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
									<a href="{{ route('catalogs.show', $content->id) }}" class="d-flex align-items-center text-gray-800 text-hover-primary fs-6 fw-normal">
										<i class="{{ $content->icon }} me-2" style="color: {{ $content->color }}"></i>
										{{ $content->name }}
									</a>
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
									<a href="{{ route('catalogs.show', $content->id) }}" class="btn btn-sm btn-light btn-active-light-primary btn-icon">
										<i class="fa-solid fa-eye"></i>
									</a>
									<a href="{{ route('catalogs.edit', $content->id) }}" class="btn btn-sm btn-light btn-active-light-success btn-icon">
										<i class="fa-solid fa-pen-to-square "></i>
									</a>
									<a href="{{ route('catalogs.destroy', $content->id) }}" class="btn btn-sm btn-light btn-active-light-danger btn-icon">
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
				<a href="{{ route('catalogs.create') }}" class="btn btn-sm fw-bold btn-primary btn-active-danger">Adicionar Catálogo</a>
			</div>
		</div>
	</div>
@endsection