@extends('layouts.app')

@section('title-page', 'Status')

@section('title-toolbar', 'Status')

@section('content')
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<table class="table table-striped table-row-bordered gy-1 gs-7 border rounded align-middle dmk-datatables">
						<thead>
							<tr class="fw-bold fs-6 text-gray-800 px-7">
								<th width="4%" class="pe-0 ps-5">ID</th>
								<th>Projeto</th>
								<th>Status Ativos</th>
								<th>Status Desativados</th>
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
									<a href="{{ route('projects.show', $content->id) }}" class="text-gray-800 text-hover-primary fs-6 fw-normal">
										{{ $content->name }}
									</a>
								</td>
								<td>
									@if ($content->statuses()->where('status', 1)->count())
										@foreach ($content->statuses()->where('status', 1)->get() as $status)
										<a href="{{ route('statuses.edit', $status->id) }}" class="badge" style="background: {{ hex2rgb($status->color, 15) }}; color: {{ $status->color, 100 }}">
											{{ $status->name }}
										</a>
										@endforeach
									@else
										-
									@endif
								</td>
								<td>
									@if ($content->statuses()->where('status', 0)->count())
										@foreach ($content->statuses()->where('status', 1)->get() as $status)
										<a class="badge" style="background: {{ hex2rgb($status->color, 15) }}; color: {{ $status->color, 100 }}">
											{{ $status->name }}
										</a>
										@endforeach
									@else
										-
									@endif
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<div class="d-flex justify-content-between mt-6">
				<a href="{{ route('dashboard.index') }}" class="btn btn-sm fw-bold btn-secondary">Voltar</a>
				<a href="{{ route('statuses.create') }}" class="btn btn-sm fw-bold btn-primary btn-active-danger">Adicionar Status</a>
			</div>
		</div>
	</div>
@endsection