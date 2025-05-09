@extends('layouts.app')
@section('title-page', 'Transações')
@section('title-toolbar', 'Transações')
@section('content')
    <div class="row">
        <div class="col-12 col-md-2 offset-md-5">
            <div class="card mb-4 shadow-light">
                <div class="card-body">
                    <h2 class="fs-5 text-center text-uppercase text-gray-700">
                        Resultado do mês
                    </h2>
                    <p class="m-0 d-flex justify-content-between">
                        <span class="fw-semibold text-gray-700">
                            Entrada Prevista
                        </span>
                        <span class="text-uppercase text-success fw-normal mb-0" id="current-month-revenue">
                            R$ 0,00
                        </span>
                    </p>
                    <p class="m-0 d-flex justify-content-between">
                        <span class="fw-semibold text-gray-700">
                            Saída Prevista
                        </span>
                        <span class="text-uppercase text-danger fw-normal mb-0">
                            -<span id="current-month-expense">R$ 0,00</span>
                        </span>
                    </p>
                    <div class="separator separator-dashed my-2"></div>
                    <p class="m-0 d-flex justify-content-between">
                        <span class="fw-bold text-gray-700">
                            Resultado do mês
                        </span>
                        <span class="text-uppercase text-primary fw-normal mb-0" id="current-month-result">
                            R$ 0,00
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <div class="d-flex align-items-center position-relative my-1">
                                <i class="ki-duotone ki-magnifier fs-1 position-absolute ms-6"><span
                                        class="path1"></span><span class="path2"></span></i>
                                <input type="text" class="form-control form-control-solid w-225px ps-15"
                                    placeholder="Procurar transações" id="search-in-datatable" />
                                {{-- <button type="button" class="btn btn-light-primary ms-2">
                                <i class="ki-duotone ki-filter fs-2"><span class="path1"></span><span class="path2"></span></i>
                                Filtrar
                            </button> --}}
                                <button type="button"
                                        class="btn btn-light-primary btn-icon ms-2 change-calendar-picker">
                                    <i class="fa-solid fa-calendar-days"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 text-center">
                            <div class="calendar-dates" style="display: none;">
                                <div class="d-flex justify-content-center align-items-center">
                                    <input class="form-control form-control-solid w-200px text-center cursor-pointer flatpickr rounded-pill input-date-transaction date-begin"
                                        placeholder="Início" value="{{ date('Y-m-01') }}" />
                                    <span class="text-gray-600 fs-5 text-uppercase fw-bold px-8">Até</span>
                                    <input class="form-control form-control-solid w-200px text-center cursor-pointer flatpickr rounded-pill input-date-transaction date-end"
                                        placeholder="Fim" value="{{ date('Y-m-t') }}" />
                                </div>
                            </div>
                            <div class="calendar-months">
                                <div class="d-flex justify-content-center align-items-center my-7 my-md-0">
                                    <span class="badge badge-light-primary cursor-pointer"
                                        id="previous-month">RETROCEDER</span>
                                    <span id="current-month"
                                        class="text-gray-600 fs-5 text-uppercase fw-bold px-8">{{ ucfirst(\Carbon\Carbon::parse(date('Y-m-d'))->locale('pt_BR')->isoFormat('MMMM')) }}
                                        de {{ date('Y') }}</span>
                                    <input type="hidden" id="date_to_filter" name="date_to_filter"
                                        value="{{ date('Y-m-d') }}">
                                    <span class="badge badge-light-primary cursor-pointer"
                                        id="next-month">AVANÇAR</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="d-none d-md-flex justify-content-end">
                                <button type="button"
                                        class="btn btn-primary me-2 add-transaction text-uppercase fw-bold"
                                        data-type="transference">
                                    Trânsferencia
                                </button>
                                <button type="button"
                                        class="btn btn-success me-2 add-transaction text-uppercase fw-bold"
                                        data-type="revenue">
                                    Receita
                                </button>
                                <button type="button"
                                        class="btn btn-danger me-2 add-transaction text-uppercase fw-bold"
                                        data-type="expense">
                                    Despesas
                                </button>
                            </div>
                            <div class="d-flex d-md-none justify-content-end position-fixed z-index-9" style="right: 30px; bottom: 20px;">
                                <button type="button"
                                        class="btn btn-primary btn-icon me-2 add-transaction text-uppercase fw-bold"
                                        data-type="transference">
                                    <i class="fa-solid fa-right-left"></i>
                                </button>
                                <button type="button"
                                        class="btn btn-success btn-icon me-2 add-transaction text-uppercase fw-bold"
                                        data-type="revenue">
                                    <i class="fa-solid fa-arrow-up"></i>
                                </button>
                                <button type="button"
                                        class="btn btn-danger btn-icon me-2 add-transaction text-uppercase fw-bold"
                                        data-type="expense">
                                    <i class="fa-solid fa-arrow-down"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <table id="datatables-transactions"
                        class="table table-striped align-middle table-row-dashed fs-6 gy-1 table-odd-light dataTable no-footer">
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
    <div class="modal fade" tabindex="-1" id="load_fature">
        <div class="modal-dialog modal-dialog-centered rounded mw-750px">
            <div class="modal-content rounded">
                <div class="modal-header py-3 bg-light rounded-top">
                    <h3 class="modal-title">Transações</h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                </div>
                <div id="load-fature">
                    {{-- LOAD TRANSACTION HERE --}}
                    {{-- LOAD TRANSACTION HERE --}}
                    {{-- LOAD TRANSACTION HERE --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="modal_trasaction_transference">
        <div class="modal-dialog modal-dialog-centered rounded mw-750px">
            <div class="modal-content rounded">
                <form action="{{ route('financial.transactions.store') }}" method="POST" enctype="multipart/form-data"
                        class="create-transaction">
                    @csrf
                    <div class="modal-header py-3 bg-light rounded-top bg-header">
                        <h3 class="text-white m-0">Trânsferencia em Contas</h3>
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                                aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                        class="path2"></span></i>
                        </div>
                    </div>
                    <div class="modal-body">
                        @include('pages.financial_transactions._transference')
                    </div>
                    <div class="modal-footer bg-light py-3 rounded-bottom">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-success btn-active-primary fw-bold">Adicionar Nova
                            Receita</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="modal_trasaction_revenue">
        <div class="modal-dialog modal-dialog-centered rounded mw-750px">
            <div class="modal-content rounded">
                <form action="{{ route('financial.transactions.store') }}" method="POST" enctype="multipart/form-data"
                        class="create-transaction">
                    @csrf
                    <div class="modal-header py-3 bg-light rounded-top bg-header">
                        <h3 class="text-white m-0">Adicionar Receita</h3>
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                                aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                        class="path2"></span></i>
                        </div>
                    </div>
                    <div class="modal-body">
                        @include('pages.financial_transactions._form', [
                            'type' => 'revenue',
                            'modal' => '#modal_trasaction_revenue',
                        ])
                    </div>
                    <div class="modal-footer bg-light py-3 rounded-bottom">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-success btn-active-primary fw-bold">Adicionar Nova
                            Receita</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="modal_trasaction_expense">
        <div class="modal-dialog modal-dialog-centered rounded mw-750px">
            <div class="modal-content rounded">
                <form action="{{ route('financial.transactions.store') }}" method="POST" enctype="multipart/form-data"
                        class="create-transaction">
                    @csrf
                    <div class="modal-header py-3 bg-light rounded-top bg-header">
                        <h3 class="text-white m-0">Adicionar Despesa</h3>
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                                aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                        class="path2"></span></i>
                        </div>
                    </div>
                    <div class="modal-body">
                        @include('pages.financial_transactions._form', [
                            'type' => 'expense',
                            'modal' => '#modal_trasaction_expense',
                        ])
                    </div>
                    <div class="modal-footer bg-light py-3 rounded-bottom">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-danger btn-active-primary fw-bold">Adicionar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="edit_trasaction">
        <div class="modal-dialog modal-dialog-centered rounded mw-750px">
            <div class="modal-content rounded">
                <form action="" method="POST" enctype="multipart/form-data" id="update-transaction">
                    @csrf
                    @method('PUT')
                    <div class="modal-header py-3 bg-light rounded-top">
                        <h3 class="modal-title">Editar Transação</h3>
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                                aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                        class="path2"></span></i>
                        </div>
                    </div>
                    <div class="modal-body" id="load-transaction">
                        {{-- LOAD TRANSACTION HERE --}}
                        {{-- LOAD TRANSACTION HERE --}}
                        {{-- LOAD TRANSACTION HERE --}}
                    </div>
                    <div class="modal-footer bg-light py-3 rounded-bottom">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Atualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('custom-footer')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).on('click', '.change-calendar-picker', function() {
            $('.calendar-months, .calendar-dates').toggle();
        });

        // DEFINE AS VARIAVEIS
        var dateBegin = $('.date-begin').val();
        var dateEnd = $('.date-end').val();

        // Função para atualizar o display do mês
        function updateMonthDisplay(date) {
            let options = {
                year: 'numeric',
                month: 'long'
            };
            $('#current-month').text(date.toLocaleDateString('pt-BR', options));
            $('#date_to_filter').val(date.toISOString().split('T')[0]);
        }

        // Função para obter a data atual do campo hidden
        function getCurrentDate() {
            var dateString = $('#date_to_filter').val();
            var dateFormated = new Date(dateString + "T00:00:00");
            return dateFormated;
        }

        var currentDate = getCurrentDate();
        // Evento ao clicar em "Retroceder"
        $('#previous-month').click(function() {

            currentDate.setMonth(currentDate.getMonth() - 1);
            updateMonthDisplay(currentDate);

            // Adicione nesses campos o primeiro e último dia do currentDate
            dateBegin = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1).toISOString().split('T')[0];
            dateEnd = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0).toISOString().split('T')[
            0];

            $('.date-begin').val(dateBegin);
            $('.date-end').val(dateEnd);

            // RELOAD TABLE
            table.DataTable().ajax.reload();

        });

        // Evento ao clicar em "Avançar"
        $('#next-month').click(function() {

            currentDate.setMonth(currentDate.getMonth() + 1);
            updateMonthDisplay(currentDate);

            // Adicione nesses campos o primeiro e último dia do currentDate
            dateBegin = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1).toISOString().split('T')[0];
            dateEnd = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0).toISOString().split('T')[
            0];

            $('.date-begin').val(dateBegin);
            $('.date-end').val(dateEnd);

            // RELOAD TABLE
            table.DataTable().ajax.reload();

        });


        function formatBRL(number) {
            return 'R$ ' + number.toLocaleString('pt-BR', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }

        // Função para formatar a data para o formato DD/MM/YYYY
        function formatDate(dateString) {
            const date = new Date(dateString);
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0'); // Month is zero-indexed
            const year = date.getFullYear();
            return `${day}/${month}/${year}`;
        }

        // Adiciona transação
        $('.add-transaction').click(function() {

            // Obtém o tipo
            var type = $(this).data('type');

            // Seleciona modal a ser aberto
            if (type == 'revenue') {
                var modal = '#modal_trasaction_revenue';
            } else if (type == 'expense') {
                var modal = '#modal_trasaction_expense';
            } else if (type == 'transference') {
                var modal = '#modal_trasaction_transference';
            }

            // Abre modal
            $(modal).modal('show');

        });


        // Remove transação
        $(document).on('click', '.remove-transaction', function() {

            // Obtém ID da transação
            var transactionID = $(this).data('transaction');

            // AJAX
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'PUT',
                url: "{{ route('financial.transactions.destroy', '') }}/" + transactionID,
                success: function(response) {
                    table.DataTable().ajax.reload();
                }
            });

        });

        // Exibe ou esconde as trasações da fatura
        $(document).on('click', '.show-sub-transactions', function() {

            // Credit Card
            var card = $(this).data('credit-card');

            loadFatureTransactions(card);

        });

        function loadFatureTransactions(card) {
            // AJAX
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: "{{ route('financial.credit.cards.transactions') }}",
                data: {
                    credit_card_id: card,
                    dateBegin: dateBegin,
                    dateEnd: dateEnd
                },
                success: function(response) {

                    $('#load-fature').html(response);

                    $('#load_fature').modal('show');

                }
            });
        }

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
                url: '{{ route('financial.transactions.processing') }}',
                data: function(data) {
                    data.searchBy = searchInput.val();
                    data.order_by = data.order?.length ? data.columns[data.order[0].column].data : null;
                    data.per_page = data.length;
                    data.date_begin = $('.date-begin').val();
                    data.date_end = $('.date-end').val();
                },
            },
            buttons: false,
            searching: true,
            aaSorting: [],
            pageLength: 100,
            lengthMenu: [100, 250, 500, 1000],
            columns: [{
                    targets: 0,
                    data: "checked",
                    orderable: false
                },
                {
                    targets: 1,
                    data: "date"
                },
                {
                    targets: 2,
                    data: "name"
                },
                {
                    targets: 3,
                    data: "value"
                },
                {
                    targets: 4,
                    data: "category_id"
                },
                {
                    targets: 5,
                    data: "wallet_credit",
                    orderable: false
                },
                {
                    targets: 6,
                    data: "actions",
                    orderable: false
                },
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
                ">",
            columnDefs: [{
                    targets: [1, 2, 3, 4, 5],
                    className: 'open-transaction',
                },
                {
                    targets: 6,
                    className: 'd-flex justify-content-end',
                },
            ],

            createdRow: function(row, data, dataIndex) {
                $(row).addClass(data.trClass);
            },
        };

        // Adicione um ouvinte para o evento 'xhr.dt'
        table.on('xhr.dt', function(e, settings, json) {
            $('#current-month-revenue').text(formatBRL(json.current.revenue)).attr('title', 'Previsto até o mês: ' + formatBRL(json.expected.revenue));
            $('#current-month-expense').text(formatBRL(json.current.expense)).attr('title', 'Previsto até o mês: ' + formatBRL(json.expected.expense));
            $('#current-month-result').text(formatBRL(json.current.total)).attr('title', 'Previsto até o mês: ' + formatBRL(json.expected.total));
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
        $('.create-transaction').submit(function(e) {

            // Para evento
            e.preventDefault();

            var btn = $(this).find('[type="submit"]').prop('disabled', true);

            // GET VALUES
            var form = $(this);
            var formId = form.closest('.modal').attr('id')
            var formData = {};

            form.find('input, select, textarea').each(function() {
                var input = $(this);
                var name = input.attr('name');
                var value = input.val();
                formData[name] = value;
            });

            // AJAX
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: "{{ route('financial.transactions.store') }}",
                data: formData,
                success: function(response) {

                    // HIDE MODAL
                    $('#' + formId).modal('hide');

                    // RELOAD TABLE
                    table.DataTable().ajax.reload();

                    setTimeout(() => {
                        btn.prop('disabled', false);
                    }, 250);

                }
            });

        });

        // UPDATE TRANSACTION
        $('#update-transaction').submit(function(e) {

            e.preventDefault();

            var btn = $(this).find('[type="submit"]').prop('disabled', true);

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
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'PUT',
                url: url,
                data: formData,
                success: function(response) {

                    // HIDE MODAL
                    $('#edit_trasaction').modal('hide');

                    // RELOAD TABLE
                    table.DataTable().ajax.reload();

                    setTimeout(() => {
                        btn.prop('disabled', false);
                    }, 250);

                }
            });

        });

        // Se for parcelado
        $(document).on('change', '[name="installments"]', function() {

            // Obtém o valor
            var value = $(this).val();

            // Se for parcelado
            if (value == true) {
                allowInstalltments(true);
                allowReccurent(false);
            } else {
                allowReccurent(true);
                allowInstalltments(false);
            }

        });

        // Libera ou bloqueia reccorencia
        function allowReccurent(allow = true) {
            if (allow) {
                $('.recurrent-div').show();
                $('[name="recurrent"]').prop('required', true);
            } else {
                $('.recurrent-div').hide();
                $('[name="recurrent"]').prop('required', false);
            }
        }

        // Libera ou bloqueia parcelamento
        function allowInstalltments(allow = true) {
            if (allow) {
                $('.installments-quantity-div').show();
                $('[name="installments_quantity"]').prop('required', true);
            } else {
                $('.installments-quantity-div').hide();
                $('[name="installments_quantity"]').prop('required', false);
            }
        }

        $(document).on('click', '.transaction-paid', function(e) {

            // GET ID OF TRANSACTIONS
            var task = $(this).closest('tr').find('.show');
            var id = task.data('id');
            var preview = task.data('preview');
            var type = task.data('type');
            var date = task.data('date');

            // SAVE WITH CHECKED
            var paid = $(e.target).is(':checked');

            checkPayment(id, date, paid, preview, type);

        });

        $(document).on('click', 'tbody .open-transaction', function() {


            // GET ID OF TRANSACTIONS
            var task = $(this).closest('tr').find('.show');
            var id = task.data('id');
            var preview = task.data('preview');
            var date = task.data('date');
            var fature = task.data('fature');

            if (fature) {
                var card = $(this).closest('tr').find('.show-sub-transactions').data('credit-card');
                return loadFatureTransactions(card);
            }

            // AJAX
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'GET',
                url: "{{ route('financial.transactions.edit', '') }}/" + id,
                success: function(response) {

                    // MAKE NEW URL
                    var url = "{{ route('financial.transactions.update', '') }}/" + id;

                    // UPDATE URL EDIT
                    $('#update-transaction').attr('action', url);

                    // REPLACE CONTENT
                    $('#load-transaction').html(response);

                    Inputmask(["R$ 9", "R$ 99", "R$ 9,99", "R$ 99,99", "R$ 999,99", "R$ 9.999,99",
                        "R$ 99.999,99", "R$ 999.999,99", "R$ 9.999.999,99"
                    ], {
                        "numericInput": true,
                        "clearIncomplete": true,
                    }).mask(".input-money");

                    // SET IS PREVIEW OR NOT
                    $('[name="preview"]').val(preview);

                    // SET DATE
                    $('#edit_trasaction [name="date_purchase"]').val(date);

                    // RELOAD SELECTS
                    select2WalletsCards();
                    select2Categories('.select-categories', true);

                    // START FLATPICKR
                    generateFlatpickr();

                    // HIDE MODAL
                    $('#edit_trasaction').modal('show');

                }
            });

        });


        // DATE CHECKED
        function checkPayment(id, date, paid, preview, type) {
            // AJAX
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: "{{ route('financial.transactions.checked') }}",
                data: {
                    id: id,
                    date: date,
                    paid: paid,
                    preview: preview,
                    type: type
                },
                success: function(response) {
                    // RELOAD TABLE
                    table.DataTable().ajax.reload();
                }
            });
        }

        // Inicia Flatpicker
        generateFlatpickr();
    </script>
@endsection
