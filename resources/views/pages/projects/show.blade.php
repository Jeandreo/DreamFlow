@extends('layouts.app')

@section('title-page', 'Adicionar Projeto')
@section('title-toolbar', 'Adicionar Projeto')

@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="draggable-zone row ps-3 pe-6">
					<div class="col-12 bg-light rounded px-1 mt-2 opacity-1 draggable">
						<table class="table table-row-gray-300 gy-2 m-0">
							<tbody>
								<tr>
									<td style="width: 35px;">
										<label class="form-check form-check-custom form-check-solid">
											<input class="form-check-input cursor-pointer" type="checkbox"/>
										</label>
									</td>
									<td class="px-0">
										<inputx class="form-control form-control-sm text-tasks title-subtask-input p-0 border-0 bg-light"></inputx>
									</td>
									<td class="p-0 ps-2" style="width: 25px">
										<a href="" class="url-subtask opacity-0">
											<i class="fa-solid fa-trash-can text-gray-400 cursor-pointer text-hover-danger fs-5" style="margin-top: 3px;"></i>
										</a>
									</td>
									<td style="width: 50px">
										<div class="cursor-pointer symbol symbol-25px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
											sad
										</div>
									</td>
									<td class="px-0" style="width: 80px;">
										<input class="form-control-sm input-clean text-center flatpickr-subtasks p-0" placeholder="00/00/0000"/>
									</td>
									<td style="width: 35px; padding: 0;">
										<a href="#" class="btn btn-icon btn-sm btn-hover-light-primary draggable-handle">
											<i class="fa-solid fa-up-down-left-right"></i>
										</a>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('custom-footer')
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script>
	loadDataTable();
</script>
@endsection