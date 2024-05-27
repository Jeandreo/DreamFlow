@extends('layouts.app')
@section('title-page', 'Dashboard')
@section('title-toolbar', 'Dashboard')
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
        <div id="kt_app_content_container" class="app-container  container-fluid ">
            <div class="row mt-n20">
                <div class="col-2">
                </div>
                <div class="col">
                    <div class="card mb-4 shadow">
                        <div class="card-body">
                            <h3 class="fs-1 text-uppercase text-gray-700 fw-normal mb-0">
                                R$ 1220,98
                            </h3>
                            <h2 class="fs-5 text-uppercase text-primary mb-0">
                                Saldo disponível
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mb-4 shadow">
                        <div class="card-body">
                            <h3 class="fs-1 text-uppercase text-gray-700 fw-normal mb-0">
                                R$ 1220,98
                            </h3>
                            <h2 class="fs-5 text-uppercase text-primary mb-0">
                                Reserva de emergencia
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mb-4 shadow">
                        <div class="card-body">
                            <h3 class="fs-1 text-uppercase text-gray-700 fw-normal mb-0">
                                R$ 1220,98
                            </h3>
                            <h2 class="fs-5 text-uppercase text-primary mb-0">
                                Patrimônio
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <div class="card mb-4 shadow">
                        <div class="card-body">
                            <h2 class="fs-2x text-uppercase text-gray-700 mb-0">
                                {{ date('H:m') }}
                            </h2>
                            <p class="text-capitalize text-gray-600 m-0 fs-4 m-0">{{ \Carbon\Carbon::parse(now())->locale('pt_BR')->isoFormat('dddd, D [de] MMMM') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-10">
                    <div class="card mb-4 shadow">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col">
                                            <h2 class="fs-3 text-uppercase text-gray-600 fw-normal mb-0">
                                                {{ \Carbon\Carbon::parse(now())->locale('pt_BR')->isoFormat('MMMM') }}
                                            </h2>
                                            <h2 class="fs-2x text-uppercase text-gray-700 mb-0">
                                                Previsto
                                            </h2>
                                        </div>
                                        <div class="col">
                                            <div class="d-flex justify-content-between me-12">
                                                <h2 class="fs-4 text-gray-700 fw-normal mb-1">
                                                    (+) Entrada
                                                </h2>
                                                <span class="text-gray-400">(100%)</span>
                                            </div>
                                            <div class="col">
                                                <h2 class="fs-1 text-uppercase text-success mb-0">
                                                    R$ 6000,00
                                                </h2>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <h2 class="fs-4 text-gray-700 fw-normal mb-1">
                                                (-) Saída
                                            </h2>
                                            <div class="col">
                                                <h2 class="fs-1 text-uppercase text-danger mb-0">
                                                    R$ 6000,00
                                                </h2>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <h2 class="fs-4 text-gray-700 fw-normal mb-1">
                                                (%) Aporte
                                            </h2>
                                            <div class="col">
                                                <h2 class="fs-1 text-uppercase text-primary mb-0">
                                                    R$ 6000,00
                                                </h2>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <h2 class="fs-4 text-gray-700 fw-normal mb-1">
                                                (=) Resultado
                                            </h2>
                                            <div class="col">
                                                <h2 class="fs-1 text-uppercase text-gray-700 mb-0">
                                                    R$ 6000,00
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div id="tasksChart" style="height: 350px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="d-flex flex-stack mb-5">
                                <div class="d-flex align-items-center position-relative my-1">
                                    <i class="ki-duotone ki-magnifier fs-1 position-absolute ms-6"><span class="path1"></span><span class="path2"></span></i>
                                    <input type="text" data-kt-docs-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Procurar transações"/>
                                </div>
                                <div class="d-flex justify-content-end" data-kt-docs-table-toolbar="base">
                                    <button type="button" class="btn btn-light-primary me-3">
                                        <i class="ki-duotone ki-filter fs-2"><span class="path1"></span><span class="path2"></span></i>
                                        Filtrar
                                    </button>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_trasaction">
                                        <i class="ki-duotone ki-plus fs-2"></i>
                                        Adicionar Transação
                                    </button>
                                </div>
                                <div class="d-flex justify-content-end align-items-center d-none" data-kt-docs-table-toolbar="selected">
                                    <div class="fw-bold me-5">
                                        <span class="me-2" data-kt-docs-table-select="selected_count"></span> Selected
                                    </div>
                                    <button type="button" class="btn btn-danger">
                                        Selection Action
                                    </button>
                                </div>
                            </div>
                            <table id="datatables-transactions" class="table align-middle table-row-dashed fs-6 gy-3">
                                <thead>
                                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="w-10px pe-2">-</th>
                                        <th class="w-100px">Dia</th>
                                        <th>O que foi</th>
                                        <th>Categoria</th>
                                        <th>Valor</th>
                                        <th>Ações</th>
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

<div class="modal fade" data-bs-focus="false" id="modal_trasaction">
    <div class="modal-dialog modal-dialog-centered rounded mw-750px">
        <form action="{{ route('financial.transactions.store') }}" method="POST" enctype="multipart/form-data">
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
                            <input type="text" class="form-control form-control-solid input-money" placeholder="R$ 00,00" name="value" value="{{ $content->value ?? old('value') }}" required/>
                        </div>
                        <div class="col-4 mb-5">
                            <label class="required form-label fw-bold">Data:</label>
                            <input type="text" class="form-control form-control-solid flatpickr" placeholder="00/00/0000" name="venciment" value="{{ $content->venciment ?? old('venciment') }}" required/>
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

    // SELECT TABLE
    const table = $('#datatables-transactions');

    // CONFIG TABLE
    const dataTableOptions = {
        serverSide: true,
        ajax: {
            url: '{{ route("financial.processing") }}',
            data: function (data) {
                data.searchBy = data.search.value;
                data.order_by = data.columns[data.order[0].column].data;
                data.per_page = data.length;
            },
        },
        buttons: false,
        searching: true,
        order: [[1, 'DESC']],
        pageLength: 25,
        columns: [
            { targets: 0, data: "checked" },
            { targets: 1, data: "date" },
            { targets: 2, data: "name" },
            { targets: 3, data: "category_id" },
            { targets: 4, data: "value" },
            { targets: 5, data: "actions" },
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
            "<'row'" +
            "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
            "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
            ">" +

            "<'table-responsive'tr>" +

            "<'row'" +
            "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
            "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
            ">" ,
        columnDefs: [
            {   
                targets: 1,
                className: '',
            },
        ],
        createdRow: function (row, data, dataIndex) {
            $(row).addClass(data.trClass);
        },
    };

    // MAKE TABLE
    table.DataTable(dataTableOptions);

    // Inicia Flatpicker
    generateFlatpickr();

    // CONFIGS CHARTS
    var element = document.getElementById('tasksChart');
    var height = parseInt(KTUtil.css(element, 'height'));

    var options = {
        series: {!! json_encode($series) !!},
        chart: {
            fontFamily: 'inherit',
            type: 'area',
            height: height,
            toolbar: {
                show: false
            }
        },
        legend: {
            show: true,
        },
        dataLabels: {
            enabled: false
        },
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'light',
                type: 'vertical',
                inverseColors: false,
                opacityFrom: 0.6,
                opacityTo: 0,
                stops: [0, 80, 100]
            }
        },
        xaxis: {
            categories: {!! json_encode($monthNames) !!},
            axisBorder: {
                show: false,
            },
            axisTicks: {
                show: false
            },
            labels: {
                style: {
                    colors: '#333',
                    fontSize: '12px'
                }
            },
            crosshairs: {
                position: 'front',
                stroke: {
                    color: '#aaa',
                    width: 1,
                    dashArray: 3
                }
            },
            tooltip: {
                enabled: false,
            }
        },
        yaxis: {
            labels: {
                style: {
                    colors: '#333',
                    fontSize: '12px'
                }
            }
        },
        states: {
            normal: {
                filter: {
                    type: 'none',
                    value: 0
                }
            },
            hover: {
                filter: {
                    type: 'none',
                    value: 0
                }
            },
            active: {
                allowMultipleDataPointsSelection: false,
                filter: {
                    type: 'none',
                    value: 0
                }
            }
        },
        tooltip: {
            style: {
                fontSize: '12px'
            },
            y: {
                formatter: function (val) {
                    return val + ' tarefas'
                }
            }
        },
        grid: {
            borderColor: '#ddd',
            strokeDashArray: 4,
            yaxis: {
                lines: {
                    show: true
                }
            }
        },
        markers: {
            strokeColor: '#4CAF50',
            strokeWidth: 3
        }
    };

    var chart = new ApexCharts(element, options);
    chart.render();
</script>
@endsection