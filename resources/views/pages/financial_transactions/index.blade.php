@extends('layouts.app')
@section('title-page', 'Transações')
@section('title-toolbar', 'Transações')
@section('content')
<div class="row pb-12 m-0 background-dashboard">
    <div class="col-12">
        <div class="toolbar py-15" id="kt_toolbar">
            <!--begin::Container-->
            <div id="kt_toolbar_container" class=" container-xxl  d-flex justify-content-center">
                <!--begin::Page title-->
                <div class="page-title">
                    <!--begin::Title-->
                    <h1 class="text-white fw-bold my-1 fs-2x text-center">
                        Financeiro Furquim
                    </h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-6 my-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-white fs-5 opacity-75">
                            “Se você realmente quer algo, não espere. Ensine a si mesmo a ser impaciente.” – Gurbaksh Chahal
                        </li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
            </div>
            <!--end::Container-->
        </div>
    </div>
</div>
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_content" class="app-content  flex-column-fluid py-6" >
        <div id="kt_app_content_container" class="app-container container-fluid ">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="d-flex align-items-center position-relative my-1">
                                        <i class="ki-duotone ki-magnifier fs-1 position-absolute ms-6"><span class="path1"></span><span class="path2"></span></i>
                                        <input type="text" class="form-control form-control-solid w-250px ps-15" placeholder="Procurar transações" id="search-in-datatable"/>
                                    </div>
                                </div>
                                <div class="col-4 text-center">
                                    <div class="d-flex jusify-content-center align-items-center">
                                        <input class="form-control form-control-solid w-200px text-center cursor-pointer flatpickr rounded-pill input-date-transaction date-begin" placeholder="Início" value="{{ date("Y-m-01") }}"/>
                                        <span class="text-gray-600 fs-5 text-uppercase fw-bold px-8">Até</span>
                                        <input class="form-control form-control-solid w-200px text-center cursor-pointer flatpickr rounded-pill input-date-transaction date-end" placeholder="Fim"  value="{{ date("Y-m-t") }}"/>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <button type="button" class="btn btn-light-primary me-3">
                                            <i class="ki-duotone ki-filter fs-2"><span class="path1"></span><span class="path2"></span></i>
                                            Filtrar
                                        </button>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_trasaction">
                                            <i class="ki-duotone ki-plus fs-2"></i>
                                            Adicionar Transação
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <table id="datatables-transactions" class="table align-middle table-row-dashed fs-6 gy-3 table-odd-light">
                                <thead>
                                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="w-10px pe-2">-</th>
                                        <th class="w-100px">Dia</th>
                                        <th>O que foi</th>
                                        <th>Categoria</th>
                                        <th>Valor</th>
                                        <th>Conta/Cartão</th>
                                        <th class="text-end">Ações</th>
                                    </tr>
                                </thead>
                                <tbody class="table-pd text-gray-600 fw-semibold">
                                    {{-- RESULTS HERE --}}
                                    {{-- RESULTS HERE --}}
                                    {{-- RESULTS HERE --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="modal_trasaction">
    <div class="modal-dialog modal-dialog-centered rounded mw-750px">
        <form action="{{ route('financial.transactions.store') }}" method="POST" enctype="multipart/form-data" id="send-transactions">
            @csrf
            <input type="hidden" name="type" value="expense">
            <div class="modal-content rounded">
                <div class="modal-header">
                    <h3 class="modal-title">Adicionar Despesa</h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6 mb-5">
                            <label class="required form-label fw-bold">Descrição:</label>
                            <input type="text" class="form-control form-control-solid" placeholder="Descreva a compra..." name="name" value="{{ $content->name ?? old('name') }}" required/>
                        </div>
                        <div class="col-6 mb-5">
                            <label class="required form-label fw-bold">Valor:</label>
                            <input type="text" class="form-control form-control-solid input-money" placeholder="R$ 0,00" name="value" value="{{ $content->value ?? old('value') }}" required/>
                        </div>
                        <div class="col-4 mb-5">
                            <label class="required form-label fw-bold">Data:</label>
                            <input type="text" class="form-control form-control-solid flatpickr" placeholder="00/00/0000" name="date_venciment" value="{{ $content->venciment ?? date('Y-m-d') }}" required/>
                        </div>
                        <div class="col-4 mb-5">
                            <label class="required form-label fw-bold">Conta/Cartão:</label>
                            <select class="form-select form-select-solid" name="wallet_id" data-control="select2" data-placeholder="Selecione" required>
                                <option value=""></option>
                                @foreach ($wallets as $wallet)
                                <option value="{{ $wallet->id }}" @if(isset($content) && $content->wallet_id == $wallet->id) selected @endif>{{ $wallet->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4 mb-5">
                            <label class="required form-label fw-bold">Categoria:</label>
                            <select class="form-select form-select-solid" name="category_id" data-control="select2" data-placeholder="Selecione" required>
                                <option value=""></option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if(isset($content) && $content->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 mb-5">
                            <label class="form-label fw-bold">Descrição:</label>
                            <textarea name="description" class="form-control form-control-solid" placeholder="Alguma observação sobre este cartão?">@if(isset($content->description)){{$content->description}}@endif</textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Adicionar</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('custom-footer')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

    // DEFINE AS VARIAVEIS
    var dateBegin = $('.date-begin').val();
    var dateEnd = $('.date-end').val();

    // ON CHANGE
    $('.input-date-transaction').change(function() {
        // RELOAD WITH PARAMETERS
        table.DataTable().ajax.reload();
    });

    // INPUT OF SEARCH
    const searchInput = $('#search-in-datatable');

    // SELECT TABLE
    const table = $('#datatables-transactions');

    // CONFIG TABLE
    const dataTableOptions = {
        serverSide: true,
        ajax: {
            url: '{{ route("financial.transactions.processing") }}',
            data: function (data) {
                data.searchBy = searchInput.val();
                data.order_by = data.columns[data.order[0].column].data;
                data.per_page = data.length;
                data.date_begin = $('.date-begin').val();
                data.date_end = $('.date-end').val();
            },
        },
        buttons: false,
        searching: true,
        order: [[1, 'DESC']],
        pageLength: 100,
        lengthMenu: [100, 250, 500, 1000],
        columns: [
            { targets: 0, data: "checked", orderable: false},
            { targets: 1, data: "date" },
            { targets: 2, data: "name" },
            { targets: 3, data: "category_id" },
            { targets: 4, data: "value" },
            { targets: 5, data: "wallet_credit", orderable: false},
            { targets: 6, data: "actions", orderable: false},
        ],
        language: {
            "search": "Pesquisar:",
            "lengthMenu": "Mostrando _MENU_ registros por página",
            "zeroRecords": "Ops, não encontramos nenhum resultado :(",
            "info": "Mostrando _START_ até _END_ de _TOTAL_ registros",
            "infoEmpty": "Nenhum registro disponível",
            "infoFiltered": "(Filtrando _MAX_ registros)",
            "processing": "Filtrando dados",
            "paginate": {
                "previous": "Anterior",
                "next": "Próximo",
            }
        },
        dom:

            "<'table-responsive'tr>" +

            "<'row'" +
            "<'col-sm-6 d-flex align-items-center justify-conten-start h-30px mt-2 text-gray-600'l>" +
            "<'col-sm-6 d-flex align-items-center justify-content-center justify-content-md-end h-30px text-gray-600'i>" +
            "<'col-sm-12 d-flex align-items-center justify-content-center h-30px text-gray-600'p>" +
            ">" ,
        columnDefs: [
            {   
                targets: 2,
                className: 'cursor-pointer',
            },
            {   
                targets: 6,
                className: 'text-end',
            },
        ],
        createdRow: function (row, data, dataIndex) {
            $(row).addClass(data.trClass);
        },
    };

    // Adicione um ouvinte para o evento 'xhr.dt'
    table.on('xhr.dt', function (e, settings, json) {
        // Os dados retornados estão disponíveis em 'json'
        console.log('Tabela atualizada', json);
    });

    // MAKE TABLE
    table.DataTable(dataTableOptions);

    let timeout;

    searchInput.on('keyup', function() {
        clearTimeout(timeout);
        timeout = setTimeout(function() {
            table.DataTable().ajax.reload();
        }, 200);
    });

    
    // REGISTER TRANSACTION
    $('#send-transactions').submit(function(e){

        e.preventDefault();

        // GET VALUES
        var form = $(this)
        var name  = form.find('[name="name"]').val();
        var value = form.find('[name="value"]').val();
        var date  = form.find('[name="date_venciment"]').val();
        var wallet = form.find('[name="wallet_id"]').val();
        var category = form.find('[name="category_id"]').val();
        var description = form.find('[name="description"]').val();

        // AJAX
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:'POST',
            url: "{{ route('financial.transactions.store') }}",
            data: {
                _token: @json(csrf_token()), 
                name: name, 
                value: value, 
                date_venciment: date,
                wallet_id: wallet,
                category_id: category,
                description: description,
            },
            success: function(response){


                // HIDE MODAL
                $('#modal_trasaction').modal('hide');

                // RELOAD TABLE
                table.DataTable().ajax.reload();

            }
        });

    });

    $(document).on('click', 'td:nth-child(3)', function(){
        
        // GET ID OF TRANSACTIONS
        var id = $(this).find('.show').data('id');
        
        alert('Axooo ' + id);
    });

    // Inicia Flatpicker
    generateFlatpickr();

</script>
@endsection