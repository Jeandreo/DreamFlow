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
            <div class="row mt-n20">
                <div class="col-2">
                </div>
                <div class="col">
                    <div class="card mb-4 shadow">
                        <div class="card-body">
                            <h3 class="fs-1 text-uppercase text-gray-700 fw-normal mb-0" id="total-revenue">
                                R$ 0,00
                            </h3>
                            <h2 class="fs-5 text-uppercase text-primary mb-0">
                                Entrada
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mb-4 shadow">
                        <div class="card-body">
                            <h3 class="fs-1 text-uppercase text-gray-700 fw-normal mb-0" id="total-expense">
                                R$ 0,00
                            </h3>
                            <h2 class="fs-5 text-uppercase text-primary mb-0">
                                Saída
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mb-4 shadow">
                        <div class="card-body">
                            <h3 class="fs-1 text-uppercase text-gray-700 fw-normal mb-0" id="total">
                                R$ 0,00
                            </h3>
                            <h2 class="fs-5 text-uppercase text-primary mb-0">
                                Resultado
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="d-flex align-items-center position-relative my-1">
                                        <i class="ki-duotone ki-magnifier fs-1 position-absolute ms-6"><span class="path1"></span><span class="path2"></span></i>
                                        <input type="text" class="form-control form-control-solid w-250px ps-15" placeholder="Procurar transações" id="search-in-datatable"/>
                                        <button type="button" class="btn btn-light-primary ms-2">
                                            <i class="ki-duotone ki-filter fs-2"><span class="path1"></span><span class="path2"></span></i>
                                            Filtrar
                                        </button>
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
                                        <button type="button" class="btn btn-primary me-2 add-transaction" data-type="transference">
                                            <i class="ki-duotone ki-plus fs-2"></i>
                                            Trânsferencia
                                        </button>
                                        <button type="button" class="btn btn-success me-2 add-transaction" data-type="renevue">
                                            <i class="ki-duotone ki-plus fs-2"></i>
                                            Receita
                                        </button>
                                        <button type="button" class="btn btn-danger me-2 add-transaction" data-type="expense">
                                            <i class="ki-duotone ki-plus fs-2"></i>
                                            Desepesa
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
                                <tbody class="table-pd text-gray-600 fw-semibold cursor-pointer">
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
        <form action="{{ route('financial.transactions.store') }}" method="POST" enctype="multipart/form-data" id="create-transaction">
            @csrf
            <div class="modal-content rounded">
                <div class="modal-header">
                    <h3 class="modal-title">Adicionar Trasação</h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                </div>
                <div class="modal-body">
                    @include('pages.financial_transactions._form')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Adicionar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="edit_trasaction">
    <div class="modal-dialog modal-dialog-centered rounded mw-750px">
        <form action="" method="POST" enctype="multipart/form-data" id="update-transaction">
            @csrf
            @method('PUT')
            <div class="modal-content rounded">
                <div class="modal-header">
                    <h3 class="modal-title">Editar Transação</h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                </div>
                <div class="modal-body" id="load-transaction">
                    {{-- LOAD TRANSACTION HERE --}}
                    {{-- LOAD TRANSACTION HERE --}}
                    {{-- LOAD TRANSACTION HERE --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('custom-footer')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

    function formatBRL(number){
        return 'R$ '+ number.toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

     // Função para formatar a data para o formato DD/MM/YYYY
     function formatDate(dateString) {
        const date = new Date(dateString);
        const day = String(date.getDate()).padStart(2, '0');
        const month = String(date.getMonth() + 1).padStart(2, '0'); // Month is zero-indexed
        const year = date.getFullYear();
        return `${day}/${month}/${year}`;
    }

    // Recuperar valores do Local Storage ao carregar a página
    if(localStorage.getItem('date-begin')) {
        $('.date-begin').val(localStorage.getItem('date-begin'));
    }
    if(localStorage.getItem('date-end')) {
        $('.date-end').val(localStorage.getItem('date-end'));
    }

    // Salvar valores no Local Storage ao alterar os campos
    $('.date-begin').on('change', function() {
        localStorage.setItem('date-begin', $(this).val());
    });
    $('.date-end').on('change', function() {
        localStorage.setItem('date-end', $(this).val());
    });

    // Adiciona transação
    $('.add-transaction').click(function(){

        // Obtém o tipo
        var type = $(this).data('type');
        
        // Inser qual o tipo no modal de transação
        $('#type-transaction').val(type);

        // Abre modal
        $('#modal_trasaction').modal('show');

    });

    // Exibe ou esconde as trasações da fatura
    $(document).on('click', '.show-sub-transactions', function(){

        // Obtém botão
        var btn = $(this);

        // Troca o botão
        var open = btn.find('i').hasClass('fa-circle-plus');

        // Obtém linha
        var tr = btn.closest('tr');

        // Se for para abrir as transações
        if(open){
            
            // Altera botão
            btn.find('i').removeClass('fa-circle-plus').addClass('fa-circle-minus');

            // Obtém transações
            var transactions = btn.data('transactions');

            // Se tiver transações
            if(transactions && transactions.length > 0) {
                var newRow = '';
                $.each(transactions, function(index, transaction) {

                    // Verifica se a categoria possui pai
                    if(transaction.has_father){
                        var color = transaction.father_color;
                    } else {
                        var color = transaction.category_color;
                    }

                    newRow += '<tr class="text-gray-700 sub-transaction open-transaction fature-' + transaction.has_credit + '-' + transaction.date_payment + '">';
                        newRow += '<td class="w-30px"></td>';
                        newRow += '<td>' + formatDate(transaction.date_purchase) + '</td>';
                        newRow += '<td>' + transaction.name + '</td>';
                        newRow += '<td><span class="d-flex align-items-center fs-6 fw-normal"> <div class="w-10px h-10px rounded-circle d-flex justify-content-center align-items-center me-2" style="background: ' + color + ';"></div> <span class="text-gray-600">' + transaction.category + '</span> </span></td>';
                        newRow += '<td>' + formatBRL(transaction.value) + '</td>';
                        newRow += '<td>-</td>';
                        newRow += '<td></td>';
                    newRow += '</tr>';
                });
                newRow += '';

                tr.after(newRow);
            }

        } else {

            // Obtém fatura
            var fature = btn.data('fature');

            $('.fature-' + fature).remove();

            // Altera botão
            btn.find('i').removeClass('fa-circle-minus').addClass('fa-circle-plus');
        }

    });

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
                    targets: [1, 2, 3, 4, 5],
                    className: 'open-transaction',
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
        $('#total-revenue').text(formatBRL(json.totalRevenue));
        $('#total-expense').text(formatBRL(json.totalExpense));
        $('#total').text(formatBRL(json.totalSum));
    });

    // MAKE TABLE
    table.DataTable(dataTableOptions);

    // TIMER
    let timeout;

    // ON END SEARCH
    searchInput.on('keyup', function() {
        clearTimeout(timeout);
        timeout = setTimeout(function() {
            table.DataTable().ajax.reload();
        }, 200);
    });

    
    // REGISTER TRANSACTION
    $('#create-transaction').submit(function(e){

        e.preventDefault();

        // GET VALUES
        var form = $(this);
        var formData = {};

        form.find('input, select, textarea').each(function() {
            var input = $(this);
            var name = input.attr('name');
            var value = input.val();
            formData[name] = value;
        });

        // AJAX
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:'POST',
            url: "{{ route('financial.transactions.store') }}",
            data: formData,
            success: function(response){

                // HIDE MODAL
                $('#modal_trasaction').modal('hide');

                // RELOAD TABLE
                table.DataTable().ajax.reload();

            }
        });

    });
        
    // UPDATE TRANSACTION
    $('#update-transaction').submit(function(e){

        e.preventDefault();

        // GET VALUES
        var form = $(this);
        var formData = {};
        
        // GET URL
        var url = $(this).attr('action');

        form.find('input, select, textarea').each(function() {
            var input = $(this);
            var name = input.attr('name');
            var value = input.val();
            formData[name] = value;
        });

        // AJAX
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:'PUT',
            url: url,
            data: formData,
            success: function(response){

                // HIDE MODAL
                $('#edit_trasaction').modal('hide');

                // RELOAD TABLE
                table.DataTable().ajax.reload();

            }
        });

    });


    $(document).on('click', '.transaction-paid', function(e){

        // GET ID OF TRANSACTIONS
        var task    = $(this).closest('tr').find('.show');
        var id      = task.data('id');
        var preview = task.data('preview');
        var type    = task.data('type');
        var date    = task.data('date');

        // SAVE WITH CHECKED
        var paid = $(e.target).is(':checked');

        checkPayment(id, date, paid, preview, type);

    });

    $(document).on('click', '.open-transaction', function(){

        // GET ID OF TRANSACTIONS
        var task    = $(this).closest('tr').find('.show');
        var id      = task.data('id');
        var preview = task.data('preview');
        var date    = task.data('date');
        
        // AJAX
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:'GET',
            url: "{{ route('financial.transactions.edit', '') }}/" + id,
            success: function(response){

                // MAKE NEW URL
                var url = "{{ route('financial.transactions.update', '') }}/" + id;

                // UPDATE URL EDIT
                $('#update-transaction').attr('action', url);

                // REPLACE CONTENT
                $('#load-transaction').html(response);

                // RELOAD SELECTS
                $('#load-transaction select').select2({
                    dropdownParent: $('#edit_trasaction')
                });

                Inputmask(["R$ 9", "R$ 99", "R$ 9,99", "R$ 99,99", "R$ 999,99", "R$ 9.999,99", "R$ 99.999,99", "R$ 999.999,99", "R$ 9.999.999,99"], {
                    "numericInput": true,
                    "clearIncomplete": true,
                }).mask(".input-money");

                // SET IS PREVIEW OR NOT
                $('[name="preview"]').val(preview);

                // SET DATE
                $('#edit_trasaction [name="date_purchase"]').val(date);

                // START FLATPICKR
                generateFlatpickr();

                // HIDE MODAL
                $('#edit_trasaction').modal('show');

            }
        });
        
    });


    // DATE CHECKED
    function checkPayment(id, date, paid, preview, type){
        // AJAX
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:'POST',
            url: "{{ route('financial.transactions.checked') }}",
            data: {id: id, date: date, paid: paid, preview: preview, type: type},
            success: function(response){
                // RELOAD TABLE
                table.DataTable().ajax.reload();
            }
        });
    }

    // Inicia Flatpicker
    generateFlatpickr();

</script>
@endsection