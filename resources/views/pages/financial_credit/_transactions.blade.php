
<div class="table-responsive">
	<table class="table table-striped table-row-bordered gy-5 gs-7">
		<thead>
			<tr class="fw-semibold fs-6 text-gray-800">
				<th class="">Quando</th>
				<th class="">Descrição</th>
				<th class="">Valor</th>
				<th class="">Categoria</th>
			</tr>
		</thead>
		<tbody>@foreach ($transactions as $transaction)
			<tr>
				<td>
					<span class="fw-bold text-gray-600">{{ date('d/m/Y', strtotime($transaction->date_purchase)) }}</span>
				</td>
				<td>
					<span>{{ $transaction->name }}</span>
				</td>
				<td>
					<span class="{{ $transaction->value < 0 ? 'text-danger' : 'text-success' }} fw-bolds">R$ {{ number_format($transaction->value, 2, ',', '.') }}</span>
				</td>
				<td>
					<span>{{ $transaction->category->name }}</span>
				</td>
			</tr>
		</tbody>
		@endforeach
	</table>
</div>