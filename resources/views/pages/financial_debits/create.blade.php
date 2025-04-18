@extends('layouts.app')

@section('title-page', 'Débitos')

@section('title-toolbar', 'Adicionar Débito')

@section('content')
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<form action="{{ route('financial.debits.store') }}" method="POST" enctype="multipart/form-data">
						@csrf
						@include('pages.financial_debits._form')
						<div class="d-flex justify-content-between">
							<a href="{{ route('financial.debits.index') }}" class="btn btn-light mt-2">Voltar</a>
							<button type="submit" class="btn btn-primary btn-active-danger mt-2">Cadastrar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection