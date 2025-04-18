@extends('layouts.app')

@section('title-page', 'Adicionar Cartão')

@section('title-toolbar', 'Adicionar Cartão')

@section('content')
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<form action="{{ route('financial.credit.cards.store') }}" method="POST" enctype="multipart/form-data">
						@csrf
						@include('pages.financial_credit._form')
						<div class="d-flex justify-content-between">
							<a href="{{ route('financial.credit.cards.index') }}" class="btn btn-light mt-2">Voltar</a>
							<button type="submit" class="btn btn-primary btn-active-danger mt-2">Cadastrar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection