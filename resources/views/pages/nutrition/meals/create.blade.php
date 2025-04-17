@extends('layouts.app')

@section('title-page', 'Cadastrar Refeição')

@section('title-toolbar', 'Cadastrar Refeição')

@section('content')
	@include('layouts.title')
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<form action="{{ route('meals.store') }}" method="POST" enctype="multipart/form-data">
						@csrf
						@include('pages.nutrition.meals._form')
						<div class="d-flex justify-content-between">
							<a href="{{ route('meals.index') }}" class="btn btn-light mt-2">Voltar</a>
							<button type="submit" class="btn btn-primary btn-active-danger mt-2">Cadastrar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection