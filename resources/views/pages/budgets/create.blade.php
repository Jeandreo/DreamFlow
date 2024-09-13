@extends('layouts.app')

@section('title-page', 'Orçamento')

@section('title-toolbar', 'Criar Orçamento')

@section('content')
	@include('layouts.title')
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<form action="{{ route('budgets.store') }}" method="POST" enctype="multipart/form-data">
						@csrf
						@include('pages.budgets._form')
						<div class="d-flex justify-content-between">
							<a href="{{ route('budgets.index') }}" class="btn btn-light mt-2">Voltar</a>
							<button type="submit" class="btn btn-primary btn-active-danger mt-2">Cadastrar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection