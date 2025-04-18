@extends('layouts.app')

@section('title-page', $contents->name)

@section('title-toolbar', $contents->name)

@section('content')
	<div class="row">
		<div class="col-12">
			<div class="row">
				@if($contents->items->count())
				@foreach ($contents->items as $item)
				<div class="col-3">
					<a href="{{ route('catalogs.items.show', $item->id) }}">
						<div class="rounded mb-6 shadow zoom-hover zoom-hover-01 p-2">
							<img src="{{ findImage('catalogos/' .$contents->id . '/' . $item->id . '/capa-600px.jpg', 'landscape') }}" alt="" class="rounded-top h-200px w-100 object-fit-cover">
							<p class="text-gray-700 text-center fw-bold fs-3 my-0 py-3">{{ $item->name }}</p>
						</div>
					</a>
				</div>										
				@endforeach
				@else
				<div class="card">
					<div class="card-body">
						<div class="rounded bg-light d-flex align-items-center justify-content-center h-200px h-md-200px">
							<div class="text-center">
								<p class="m-0 fs-3x">🧐</p>
								<p class="m-0 text-gray-600 fw-bold text-uppercase">Esse catalogo ainda não possui items!</p>
								<p class="m-0 fs-6 text-gray-500">Para adicionar conteúdo a esse item, clique no botão cadastrar abaixo.</p>
							</div>
							</div>
					</div>
				</div>
				@endif
			</div>
			<div class="d-flex justify-content-between">
				<a href="{{ route('catalogs.index') }}" class="btn btn-light mt-2">Voltar</a>
				<a href="{{ route('catalogs.items.create', $contents->id) }}" class="btn btn-primary btn-active-danger mt-2">Cadastrar Item</a>
			</div>
		</div>
	</div>
@endsection