@extends('layouts.app')

@section('title-page', 'Adicionar Status')

@section('title-toolbar', 'Adicionar Status')

@section('content')
	@include('layouts.title')
	<div class="row">
		<div class="col-6 offset-3">
			<div class="card">
				<div class="card-body">
					<form action="{{ route('statuses.store') }}" method="POST" enctype="multipart/form-data">
						@csrf
						@include('pages.statuses._form')
						<div class="d-flex justify-content-between">
							<a href="{{ route('statuses.index') }}" class="btn btn-light mt-2">Voltar</a>
							<button type="submit" class="btn btn-primary btn-active-danger mt-2">Cadastrar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection