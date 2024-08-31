@extends('layouts.app')

@section('title-page', 'Editar ' . $content->name)

@section('title-toolbar', 'Editar ' . $content->name)

@section('content')
	@include('layouts.title')
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<form action="{{ route('catalogs.items.update', $content->id) }}" method="POST" enctype="multipart/form-data">
						@csrf
						@method('PUT')
						@include('pages.catalogs_items._form')
						<div class="d-flex justify-content-between">
							<a href="{{ route('catalogs.items.show', $content->id) }}" class="btn btn-light mt-2">Voltar</a>
							<button type="submit" class="btn btn-primary btn-active-danger mt-2">Atualizar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection