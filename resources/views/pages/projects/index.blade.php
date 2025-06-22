@extends('layouts.app')

@section('title-page', 'Lista de tarefas')

@section('title-toolbar', 'Lista de tarefas')

@section('content')
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<table class="table table-striped table-row-bordered gy-1 gs-7 border rounded align-middle dmk-datatables">
						<thead>
							<tr class="fw-bold fs-6 text-gray-800 px-7">
								<th>Nome</th>
								<th>Categoria</th>
								<th>Tipo</th>
								<th>Time</th>
								<th>Duração</th>
								<th class="text-center">Status</th>
								<th class="text-center" width="165px">
									<span>Ações</span>
								</th>
							</tr>
						</thead>
						<tbody>
							@foreach (projects()->get() as $content)
							<tr>
								<td>
									<a href="{{ route('projects.show', $content->id) }}" class="d-flex align-items-center text-gray-800 text-hover-primary fs-6 fw-normal">
										<span class="bullet bullet-dot h-5px w-5px me-2" style="background: {{ $content->color }}"></span>
										{{ $content->name }}
									</a>
								</td>
								<td>
									<span class="text-gray-700">{{ $content->category->name }}</span>
								</td>
								<td>
									<span class="text-gray-700">
										@if ($content->type == 1)
											<span class="badge badge-light-primary">Corporativo</span>
										@else
										<span class="badge badge-light-success">Pessoal</span>
										@endif
									</span>
								</td>
								<td>
									@if ($content->users->count())
									<div class="symbol-group symbol-hover flex-nowrap">
										@foreach ($content->users as $user)
										<div class="symbol symbol-30px symbol-circle" data-bs-toggle="tooltip" title="{{ $user->name }}">
											<img alt="Pic" src="{{ findImage('users/' . $user->id . '/' . 'perfil-35px.jpg') }}">
										</div>
										@endforeach
									</div>
									@else
										<span class="badge badge-light">Sem time</span>
									@endif
								</td>
								<td>
									@if($content->start_date)
									<span class="text-gray-600" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ date('d/m/Y', strtotime($content->start_date)) }} ás {{ date('H:i:s', strtotime($content->start_date)) }}">
										{{ date('d/m/Y', strtotime($content->start_date)) }}
									</span>
									@else
									<span class="badge badge-light">
										-
									</span>
									@endif
									@if($content->end_date)
									<span class="text-gray-600" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ date('d/m/Y', strtotime($content->end_date)) }} ás {{ date('H:i:s', strtotime($content->end_date)) }}">
										{{ date('d/m/Y', strtotime($content->end_date)) }}
									</span>
									@endif
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
									<a href="{{ route('projects.reminder', $content->id) }}" class="btn btn-sm btn-light btn-active-light-primary btn-icon">
										<i class="fa-solid fa-star @if($content->reminder) text-warning @endif"></i>
									</a>
									<a href="{{ route('projects.show', $content->id) }}" class="btn btn-sm btn-light btn-active-light-primary btn-icon">
										<i class="fa-solid fa-eye"></i>
									</a>
									<a href="{{ route('projects.edit', $content->id) }}" class="btn btn-sm btn-light btn-active-light-success btn-icon">
										<i class="fa-solid fa-pen-to-square "></i>
									</a>
									<a href="{{ route('projects.destroy', $content->id) }}" class="btn btn-sm btn-light btn-active-light-danger btn-icon">
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
				<a href="{{ route('projects.create') }}" class="btn btn-sm fw-bold btn-primary btn-active-danger">Adicionar Projeto</a>
			</div>
		</div>
	</div>
@endsection
