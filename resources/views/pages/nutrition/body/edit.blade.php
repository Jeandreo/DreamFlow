@extends('layouts.app')

@section('title-page', 'Meu Corpo')

@section('title-toolbar', 'Meu Corpo')

@section('content')
	<div class="row">
		<div class="col-6 offset-3">
			<div class="card mb-4">
				<div class="card-body">
					<form action="{{ route('body.store') }}" method="POST" enctype="multipart/form-data">
						@csrf
						@include('pages.nutrition.body._form')
						<div class="d-flex justify-content-between">
							<a href="{{ route('nutrition.index') }}" class="btn btn-light mt-2">Voltar</a>
							<button type="submit" class="btn btn-primary btn-active-danger mt-2">Atualizar</button>
						</div>
					</form>
				</div>
			</div>
			@if(isset($lastBody))
			<div class="row">
				<div class="col-6">
					<div class="card mb-4">
						<div class="card-body">
							<p class="fw-bold text-gray-700 mb-1">Sua Taxa Metabólica Basal: <span class="fw-bolder text-success">{{ $lastBody->bmr }}</span></p>
							<p class="text-gray-600 mb-0">É a quantidade de calorias que seu corpo gasta em repouso absoluto para manter funções básicas vitais.</p>
						</div>
					</div>
				</div>
				<div class="col-6">
					<div class="card mb-4">
						<div class="card-body">
							<p class="fw-bold text-gray-700 mb-1">Gasto Energético Diário: <span class="fw-bolder text-danger">{{ $lastBody->total_calories }}</span><span class="fw-normal text-gray-600 fs-8">/kcal</span></p>
							<p class="text-gray-600 mb-0">É o total de calorias que seu corpo gasta considerando a taxa base + quantidade gasta por exercícios.</p>
						</div>
					</div>
				</div>
			</div>
			@endif
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-12">
							<h2 class="form-label fw-bold text-center mb-4">Fatores de Atividade Física (FA):</h2>
							<div class="table-responsive">
								<table class="table table-bordered table-sm align-middle text-center">
									<thead class="fw-bold text-muted bg-light">
										<tr>
											<th style="width: 20%">Fator</th>
											<th style="width: 25%">Nível</th>
											<th style="width: 55%">Descrição</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1,2</td>
											<td>Sedentário</td>
											<td>Pouca ou nenhuma atividade física</td>
										</tr>
										<tr>
											<td>1,375</td>
											<td>Levemente Ativo</td>
											<td>Atividade leve 1 a 3x por semana</td>
										</tr>
										<tr>
											<td>1,55</td>
											<td>Moderadamente Ativo</td>
											<td>Atividade moderada 3 a 5x por semana</td>
										</tr>
										<tr>
											<td>1,725</td>
											<td>Muito Ativo</td>
											<td>Exercício intenso 6 a 7x por semana</td>
										</tr>
										<tr>
											<td>1,9</td>
											<td>Extremamente Ativo</td>
											<td>2 treinos por dia ou rotina muito intensa</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection