@extends('layouts.app')
@section('title-page', 'Projetos')
@section('title-toolbar', 'Projetos')

@section('content')
<div class="content d-flex flex-column flex-column-fluid">
	<!--begin::Post-->
	<div class="post">
		<!--begin::Container-->
		<div class="container">
			<!--begin::Row-->
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<table class="table table-striped table-row-bordered gy-5 gs-7 border rounded dmk-datatables">
								<thead>
									<tr class="fw-bold fs-6 text-gray-800 px-7">
										<th>Nome</th>
										<th>Position</th>
										<th>Salary</th>
										<th>Office</th>
										<th>Extn.</th>
										<th>E-mail</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Tiger Nixon</td>
										<td>System Architect</td>
										<td>Edinburgh</td>
										<td>61</td>
										<td>2011/04/25</td>
										<td>$320,800</td>
									</tr>
									<tr>
										<td>Garrett Winters</td>
										<td>Accountant</td>
										<td>Tokyo</td>
										<td>63</td>
										<td>2011/07/25</td>
										<td>$170,750</td>
									</tr>
								</tbody>
							</table>
							<div class="d-flex justify-content-between">
								<a href="{{ route('index') }}" class="btn btn-light mt-6">Voltar</a>
								<a href="{{ route('projects.create') }}" class="btn btn-primary btn-active-danger mt-6">Adicionar Projeto</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--end::Row-->
		</div>
		<!--end::Container-->
	</div>
	<!--end::Post-->
</div>
@endsection

@section('custom-footer')
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script>
	loadDataTable();
</script>
@endsection