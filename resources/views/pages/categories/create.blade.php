@extends('layouts.app')

@section('title-page', 'Adicionar Categoria')

@section('title-toolbar', 'Adicionar Categoria')

@section('content')
	<div class="row">
		<div class="col-3">
		</div>
		<div class="col-6">
			<div class="card">
				<div class="card-body">
					<form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
						@csrf
						@include('pages.categories._form')
						<div class="d-flex justify-content-between">
							<a href="{{ route('categories.index') }}" class="btn btn-light mt-2">Voltar</a>
							<button type="submit" class="btn btn-primary btn-active-danger mt-2">Cadastrar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection