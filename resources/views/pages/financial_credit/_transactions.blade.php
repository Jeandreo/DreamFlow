
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
			<tr class="open-transaction">
				<td>
					<span class="fw-bold text-gray-600 fs-6 show" data-id="{{ $transaction->id }}" data-preview='false'>{{ date('d/m/Y', strtotime($transaction->date_purchase)) }}</span>
				</td>
				<td>
					<span class="fw-bold text-gray-600 fs-6">{{ $transaction->name }}</span>
				</td>
				<td>
					<span class="{{ $transaction->value < 0 ? 'text-danger' : 'text-success' }} fw-bolds">R$ {{ number_format($transaction->value, 2, ',', '.') }}</span>
				</td>
				<td>
					<span class='d-flex align-items-center fs-6 fw-normal'>
						<div class='w-25px h-25px rounded-circle d-flex justify-content-center align-items-center me-2' style='background: {{ $transaction->category->father_id ? $transaction->category->father->color  : $transaction->category->color }};'>
							<i class='{{ $transaction->category->father_id ? $transaction->category->father->icon  : $transaction->category->icon }} fs-7 text-white'></i>
						</div>
						<span class='text-gray-600'>{{ $transaction->category->name }}</span>
					</span>
				</td>
			</tr>
		</tbody>
		@endforeach
	</table>
</div>