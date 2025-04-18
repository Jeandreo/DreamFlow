@extends('layouts.app')

@section('title-page', 'Adicionar Catálogo')

@section('title-toolbar', 'Adicionar Catálogo')

@section('content')
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<form action="{{ route('catalogs.store') }}" method="POST" enctype="multipart/form-data">
						@csrf
						@include('pages.catalogs._form')
						<div class="d-flex justify-content-between">
							<a href="{{ route('catalogs.index') }}" class="btn btn-light mt-2">Voltar</a>
							<button type="submit" class="btn btn-primary btn-active-danger mt-2">Cadastrar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection