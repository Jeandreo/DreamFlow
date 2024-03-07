@extends('layouts.app')

@section('title-page', 'Adicionar Projeto')

@section('content')
<div class="content d-flex flex-column flex-column-fluid">
	<div class="post">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<p class="text-center fw-bolder text-gray-800 fs-1 mb-10 text-uppercase">
								@yield('title-page')
							</p>
							<form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
								@include('pages.projects._form')
								<div class="d-flex justify-content-between">
									<a href="{{ route('index') }}" class="btn btn-light mt-2">Voltar</a>
									<button type="submit" class="btn btn-primary btn-active-danger mt-2">Cadastrar</button>
								</div>
                            </form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('custom-footer')
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script>
	loadDataTable();
</script>
@endsection