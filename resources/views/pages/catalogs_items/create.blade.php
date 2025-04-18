@extends('layouts.app')

@section('title-page', 'Adicionar ' . $catalog->name)

@section('title-toolbar', 'Adicionar ' . $catalog->name)

@section('content')
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<form action="{{ route('catalogs.items.store', $catalog->id) }}" method="POST" enctype="multipart/form-data">
						@csrf
						@include('pages.catalogs_items._form')
						<div class="d-flex justify-content-between">
							<a href="{{ route('catalogs.items.show', $catalog->id) }}" class="btn btn-light mt-2">Voltar</a>
							<button type="submit" class="btn btn-primary btn-active-danger mt-2">Cadastrar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection