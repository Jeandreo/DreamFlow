@extends('layouts.app')

@section('title-page', 'Usuários')

@section('title-toolbar', 'Usuários')

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
												<th>Cargo</th>
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
													<a href="{{ route('users.edit', $content->id) }}" class="d-flex align-items-center text-gray-700 text-hover-primary">
														<div class="symbol symbol-25px symbol-circle me-2">
															<img alt="Pic" src="{{ findImage('users/' . $content->id . '/' . 'perfil-35px.jpg') }}">
														</div>
														{{ $content->name }}
													</a>
												</td>
												<td>
													<span class="badge badge-light-danger">Administrador</span>
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
													<a href="{{ route('users.edit', $content->id) }}" class="btn btn-sm btn-light btn-active-light-success btn-icon">
														<i class="fa-solid fa-pen-to-square "></i>
													</a>
													<a href="{{ route('users.destroy', $content->id) }}" class="btn btn-sm btn-light btn-active-light-danger btn-icon">
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
								<a href="{{ route('users.create') }}" class="btn btn-sm fw-bold btn-primary btn-active-danger">Adicionar Projeto</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection