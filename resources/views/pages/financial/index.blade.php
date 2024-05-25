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
                            <p class="text-capitalize text-gray-600 m-0 fs-4 m-0">{{ \Carbon\Carbon::parse('2024-05-22')->locale('pt_BR')->isoFormat('dddd, D [de] MMMM') }}</p>
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
                                                {{ \Carbon\Carbon::parse('2024-05-22')->locale('pt_BR')->isoFormat('MMMM') }}
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
                                    <input type="text" data-kt-docs-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Search Customers"/>
                                </div>
                                <div class="d-flex justify-content-end" data-kt-docs-table-toolbar="base">
                                    <button type="button" class="btn btn-light-primary me-3" data-bs-toggle="tooltip" title="Coming Soon">
                                        <i class="ki-duotone ki-filter fs-2"><span class="path1"></span><span class="path2"></span></i>
                                        Filter
                                    </button>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" title="Coming Soon">
                                        <i class="ki-duotone ki-plus fs-2"></i>
                                        Add Customer
                                    </button>
                                </div>
                                <div class="d-flex justify-content-end align-items-center d-none" data-kt-docs-table-toolbar="selected">
                                    <div class="fw-bold me-5">
                                        <span class="me-2" data-kt-docs-table-select="selected_count"></span> Selected
                                    </div>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="tooltip" title="Coming Soon">
                                        Selection Action
                                    </button>
                                </div>
                            </div>

                            <table id="kt_datatable_example_1" class="table align-middle table-row-dashed fs-6 gy-5">
                                <thead>
                                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="w-10px pe-2">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                            <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_datatable_example_1 .form-check-input" value="1"/>
                                        </div>
                                    </th>
                                    <th>O que foi</th>
                                    <th>Categoria</th>
                                    <th>Dia</th>
                                    <th>Pago?</th>
                                    <th class="text-end min-w-100px">Ações</th>
                                </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-semibold">
                                    <tr>
                                        <td>
                                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox" value="334">
                                            </div>
                                        </td>
                                        <td>Wren Meegin</td>
                                        <td>wmeegin99@netscape.com</td>
                                        <td>12 Apr 2020, 2:44 am</td>
                                        <td data-filter="american-express">
                                            <img src="{{ asset('assets/media/svg/card-logos/american-express.svg') }}" class="w-35px me-3" alt="american-express">**** 5580</td>
                                                <td class="text-end">
                                                <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                                                    Actions
                                                    <span class="svg-icon fs-5 m-0">
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                                <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="currentColor" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999)"></path>
                                                            </g>
                                                        </svg>
                                                    </span>
                                                </a>
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3" data-kt-docs-table-filter="edit_row">
                                                        Edit
                                                    </a>
                                                </div>
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3" data-kt-docs-table-filter="delete_row">
                                                        Delete
                                                    </a>
                                                </div>
                                            </div>
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
</div>

<div class="modal fade" data-bs-focus="false" id="modal_task">
    <div class="modal-dialog modal-dialog-centered rounded">
        <div class="modal-content rounded bg-transparent" id="load-task">
            {{-- LOAD TASK HERE --}}
            {{-- LOAD TASK HERE --}}
            {{-- LOAD TASK HERE --}}
        </div>
    </div>
</div>
@endsection



@section('custom-footer')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
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