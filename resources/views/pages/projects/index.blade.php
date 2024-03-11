@extends('layouts.app')

@section('title-page', 'Projetos')

@section('title-toolbar', 'Projetos')

@section('content')
	@include('layouts.title')
	<div class="app-main flex-column flex-row-fluid " id="kt_app_main">
		<div class="d-flex flex-column flex-column-fluid">                             
			<div id="kt_app_content" class="app-content  flex-column-fluid py-6" >
				<div id="kt_app_content_container" class="app-container  container-fluid ">
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-body">
									<table class="table table-striped table-row-bordered gy-3 gs-7 border rounded align-middle dmk-datatables">
										<thead>
											<tr class="fw-bold fs-6 text-gray-800 px-7">
												<th width="4%" class="pe-0 ps-5">ID</th>
												<th>Nome</th>
												<th>Categoria</th>
												<th>Time</th>
												<th>Duração</th>
												<th class="text-center">Status</th>
												<th class="text-center" width="145px">
													<span>Ações</span>
												</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($contents as $content)
											<tr>
												<td class="pe-0 ps-4">
													<span class="fw-normal">
														{{  str_pad($content->id , 4 , '0' , STR_PAD_LEFT)}}
													</span>
												</td>
												<td>
													<a href="{{ route('projects.show', $content->id) }}" class="d-flex align-items-center text-gray-700 text-hover-primary">
														<span class="bullet bullet-dot h-5px w-5px me-2" style="background: {{ $content->color }}"></span>
														{{ $content->name }}
													</a>
												</td>
												<td>
													<span class="text-gray-700">{{ $content->category->name }}</span>
												</td>
												<td>
													<div class="symbol-group symbol-hover flex-nowrap">
														<div class="symbol symbol-30px symbol-circle" data-bs-toggle="tooltip" title="Alan Warden">
																<span class="symbol-label bg-warning text-inverse-warning fw-bold">A</span>
														</div>
														<div class="symbol symbol-30px symbol-circle" data-bs-toggle="tooltip" title="Michael Eberon">
																<img alt="Pic" src="{{ asset('assets/media/avatars/300-11.jpg') }}">
														</div>
														<div class="symbol symbol-30px symbol-circle" data-bs-toggle="tooltip" title="Susan Redwood">
																<span class="symbol-label bg-primary text-inverse-primary fw-bold">S</span>
														</div>
														<div class="symbol symbol-30px symbol-circle" data-bs-toggle="tooltip" title="Barry Walter">
																<img alt="Pic" src="{{ asset('assets/media/avatars/300-11.jpg') }}">
														</div>
														<a href="#" class="symbol symbol-30px symbol-circle" data-bs-toggle="modal" data-bs-target="#kt_modal_view_users">
															<span class="symbol-label bg-dark text-gray-300 fs-8 fw-bold">+3</span>
														</a>
													</div>
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
								<a href="{{ route('index') }}" class="btn btn-sm fw-bold btn-secondary">Voltar</a>
								<a href="{{ route('projects.create') }}" class="btn btn-sm fw-bold btn-primary btn-active-danger">Adicionar Projeto</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection