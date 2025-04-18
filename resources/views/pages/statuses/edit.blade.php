@extends('layouts.app')

@section('title-page', 'Editar Status')

@section('title-toolbar', 'Editar Status')

@section('content')
	<div class="row">
		<div class="col-3">
		</div>
		<div class="col-6">
			<div class="card">
				<div class="card-body">
					<form action="{{ route('statuses.update', $content->id) }}" method="POST" enctype="multipart/form-data">
						@csrf
						@method('PUT')
						@include('pages.statuses._form')
						<div class="d-flex justify-content-between">
							<a href="{{ route('statuses.index') }}" class="btn btn-light mt-2">Voltar</a>
							<button type="submit" class="btn btn-primary btn-active-danger mt-2">Editar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection