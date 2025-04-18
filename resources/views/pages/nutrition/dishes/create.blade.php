@extends('layouts.app')

@section('title-page', 'Cadastrar Prato')

@section('title-toolbar', 'Cadastrar Prato')

@section('content')
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<form action="{{ route('dishes.store') }}" method="POST" enctype="multipart/form-data">
						@csrf
						@include('pages.nutrition.dishes._form')
						<div class="d-flex justify-content-between">
							<a href="{{ route('dishes.index') }}" class="btn btn-light mt-2">Voltar</a>
							<button type="submit" class="btn btn-primary btn-active-danger mt-2">Cadastrar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection