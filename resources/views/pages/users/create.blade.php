@extends('layouts.app')

@section('title-page', 'Adicionar Usuário')

@section('title-toolbar', 'Adicionar Usuário')

@section('content')
	<div class="row">
		<div class="col-12 col-md-6 offset-md-3">
			<div class="card">
				<div class="card-body">
					<form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
						@csrf
						@include('pages.users._form')
						<div class="d-flex justify-content-between">
							<a href="{{ route('users.index') }}" class="btn btn-light mt-2">Voltar</a>
							<button type="submit" class="btn btn-primary btn-active-danger mt-2">Cadastrar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection