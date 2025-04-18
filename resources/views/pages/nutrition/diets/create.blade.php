@extends('layouts.app')

@section('title-page', 'Cadastrar Dieta')

@section('title-toolbar', 'Cadastrar Dieta')

@section('content')
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<form action="{{ route('diets.store') }}" method="POST" enctype="multipart/form-data">
						@csrf
						@include('pages.nutrition.diets._form')
						<div class="d-flex justify-content-between">
							<a href="{{ route('diets.index') }}" class="btn btn-light mt-2">Voltar</a>
							<button type="submit" class="btn btn-primary btn-active-danger mt-2">Cadastrar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection