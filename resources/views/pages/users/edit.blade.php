@extends('layouts.app')

@section('title-page', 'Editar Usuário')

@section('title-toolbar', 'Editar Usuário')

@section('content')
	<div class="row">
		<div class="col-12 col-md-6 offset-md-3">
			<div class="card">
				<div class="card-body">
					<form action="{{ route('users.update', $content->id) }}" method="POST" enctype="multipart/form-data">
						@csrf
						@method('PUT')
						@include('pages.users._form')
						<div class="d-flex justify-content-between">
							<a href="{{ route('users.index') }}" class="btn btn-light mt-2">Voltar</a>
							<button type="submit" class="btn btn-primary btn-active-danger mt-2">Editar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection