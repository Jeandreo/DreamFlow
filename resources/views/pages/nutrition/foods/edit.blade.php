@extends('layouts.app')

@section('title-page', 'Editar Alimento')

@section('title-toolbar', 'Editar Alimento')

@section('content')
	@include('layouts.title')
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<form action="{{ route('foods.update', $content->id) }}" method="POST" enctype="multipart/form-data">
						@csrf
						@method('PUT')
						@include('pages.nutrition.foods._form')
						<div class="d-flex justify-content-between">
							<a href="{{ route('foods.index') }}" class="btn btn-light mt-2">Voltar</a>
							<button type="submit" class="btn btn-primary btn-active-danger mt-2">Atualizar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection