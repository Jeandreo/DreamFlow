@extends('layouts.app')

@section('title-page', 'Editar Dieta')

@section('title-toolbar', 'Editar Dieta')

@section('content')
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<form action="{{ route('diets.update', $content->id) }}" method="POST" enctype="multipart/form-data">
						@csrf
						@method('PUT')
						@include('pages.nutrition.diets._form')
						<div class="d-flex justify-content-between">
							<a href="{{ route('diets.index') }}" class="btn btn-light mt-2">Voltar</a>
							<button type="submit" class="btn btn-primary btn-active-danger mt-2">Atualizar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection