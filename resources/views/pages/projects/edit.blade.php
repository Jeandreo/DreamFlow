@extends('layouts.app')

@section('title-page', 'Editar Projeto')
@section('title-toolbar', 'Editar Projeto')

@section('content')
@include('layouts.title')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
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
@endsection

@section('custom-footer')
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script>
	loadDataTable();
</script>
@endsection