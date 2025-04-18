@extends('layouts.app')

@section('title-page', 'Editar Desafio')

@section('title-toolbar', 'Editar Desafio')

@section('content')
	<div class="row">
		<div class="col-6 offset-3">
			<div class="card">
				<div class="card-body">
					<form action="{{ route('challenges.update', $content->id) }}" method="POST" enctype="multipart/form-data">
						@csrf
						@method('PUT')
						@include('pages.challenges._form')
						<div class="d-flex justify-content-between">
							<a href="{{ route('challenges.index') }}" class="btn btn-light mt-2">Voltar</a>
							<button type="submit" class="btn btn-primary btn-active-danger mt-2">Editar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection