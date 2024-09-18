@extends('layouts.app')
@section('title-page', 'Dashboard')
@section('title-toolbar', 'Dashboard')
@section('content')
<div class="row m-0 background-dashboard" style="background-image: url('{{ asset('assets/media/logos/background-pattern.webp') }}'); background-size: cover;">
    <div style="background: linear-gradient(0deg, #090c11, #18202bf0);">
        <div class="col-12">
            <div class="toolbar py-20 mb-10" id="kt_toolbar">
                <div id="kt_toolbar_container" class=" container-xxl  d-flex justify-content-center">
                    @include('includes.nav-admin', ['title' => "Financeiro Furquim!", 'phrase' => "“Se você realmente quer algo, não espere. Ensine a si mesmo a ser impaciente.” – Gurbaksh Chahal"])
                </div>
            </div>
        </div>
    </div>
</div>
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_content" class="app-content  flex-column-fluid py-6" >
        <div id="kt_app_content_container" class="app-container  container-fluid ">
            <div class="row mt-n20">
                <div class="col-12 col-md-3">
                </div>
                <div class="col">
                    <div class="card mb-4 shadow-light">
                        <div class="card-body">
                            <h3 class="fs-1 text-uppercase text-gray-700 fw-normal mb-0">
                                R$ {{ number_format($balance, 2, ',', '.') }}
                            </h3>
                            <h2 class="fs-5 text-uppercase text-primary mb-0">
                                Saldo disponível
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mb-4 shadow-light">
                        <div class="card-body">
                            <h3 class="fs-1 text-uppercase text-gray-700 fw-normal mb-0">
                                R$ 0,00
                            </h3>
                            <h2 class="fs-5 text-uppercase text-primary mb-0">
                                Res. de Emergencia
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mb-4 shadow-light">
                        <div class="card-body">
                            <h3 class="fs-1 text-uppercase text-gray-700 fw-normal mb-0">
                                R$ 0,00
                            </h3>
                            <h2 class="fs-5 text-uppercase text-primary mb-0">
                                Patrimônio
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <div class="card mb-4 shadow-light">
                        <div class="card-body">
                            <h2 class="fs-2x text-uppercase text-gray-700 mb-0">
                                {{ date('H:m') }}
                            </h2>
                            <p class="text-capitalize text-gray-600 m-0 fs-4 m-0">{{ \Carbon\Carbon::parse(now())->locale('pt_BR')->isoFormat('dddd, D [de] MMMM') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-9">
                    <div class="card mb-4 shadow-light">
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
                                                <span class="text-gray-400">-</span>
                                            </div>
                                            <div class="col">
                                                <h2 class="fs-1 text-uppercase text-success mb-0">
                                                    R$ {{ number_format($values['revenues'], 2, ',', '.') }}
                                                </h2>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="d-flex justify-content-between me-12">
                                                <h2 class="fs-4 text-gray-700 fw-normal mb-1">
                                                    (-) Saída
                                                </h2>
                                                {{-- <span class="text-gray-400">({{ $values['expenses'] != 0 && $values['revenues'] != 0 ? ($values['expenses'] / $values['revenues']) * 100 : 0}}%)</span> --}}
                                            </div>
                                            <div class="col">
                                                <h2 class="fs-1 text-uppercase text-danger mb-0">
                                                    R$ {{ number_format($values['expenses'], 2, ',', '.') }}
                                                </h2>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="d-flex justify-content-between me-12">
                                                <h2 class="fs-4 text-gray-700 fw-normal mb-1">
                                                    (%) Aporte
                                                </h2>
                                                {{-- <span class="text-gray-400">0%</span> --}}
                                            </div>
                                            <div class="col">
                                                <h2 class="fs-1 text-uppercase text-primary mb-0">
                                                    R$ 0,00
                                                </h2>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <h2 class="fs-4 text-gray-700 fw-normal mb-1">
                                                (=) Resultado
                                            </h2>
                                            <div class="col">
                                                <h2 class="fs-1 text-uppercase text-gray-700 mb-0">
                                                    R$ {{ number_format($values['difference'], 2, ',', '.') }}
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
                <div class="col-3 mb-4">
                    <div class="card shadow-light">
                        <div class="card-body py-5">
                            @foreach ($wallets as $wallet)
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex">
                                    <img src="{{ findImage('instituicoes/' .$wallet->institution_id . '/logo-150px.jpg', 'image') }}" class="h-40px w-40px me-3 rounded-sm" alt="">
                                    <div>
                                        <a href="{{ route('financial.wallets.edit', $wallet->id) }}" class="text-gray-700 text-hover-primary fw-bold mb-0">
                                            {{ $wallet->name }}
                                        </a>
                                        <p class="text-gray-600 mb-0">
                                           Carteira
                                        </p>
                                    </div>
                                </div>
                                <p class="text-primary fs-6 fw-bold mb-0 text-end">
                                    R$ {{ number_format($wallet->total(), 2, ',', '.') }}
                                </p>
                            </div>
                            @if (!$loop->last)
                                <div class="separator my-3"></div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-3 mb-4">
                    <div class="card shadow-light">
                        <div class="card-body py-5">
                            @foreach ($credits as $credit)
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex">
                                    <img src="{{ findImage('instituicoes/' .$credit->institution_id . '/logo-150px.jpg', 'image') }}" class="h-40px w-40px me-3 rounded-sm" alt="">
                                    <div>
                                        <p class="fw-bold mb-0">
                                            {{ $credit->name }}
                                        </p>
                                        <p class="text-gray-600 mb-0">
                                           Cartões de crédito
                                        </p>
                                    </div>
                                </div>
                                <p class="text-primary fs-6 fw-bold mb-0 text-end">
                                    R$ {{ number_format($credit->total(), 2, ',', '.') }}
                                </p>
                            </div>
                            @if (!$loop->last)
                                <div class="separator my-3"></div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-4">
                            <a href="{{ route('financial.wallets.index') }}">
                                <div class="card mb-4">
                                    <div class="card-body p-3">
                                        <div class="d-flex align-items-center">
                                            <div class="h-40px w-40px rounded bg-light-primary d-flex align-items-center justify-content-center">
                                                <i class="fa-solid fa-wallet fs-4 text-primary"></i>
                                            </div>
                                            <span class="ms-4 fw-bolder fs-7 text-uppercase text-gray-700">
                                                Carteiras
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-4">
                            <a href="{{ route('financial.transactions.index') }}">
                                <div class="card mb-4">
                                    <div class="card-body p-3">
                                        <div class="d-flex align-items-center">
                                            <div class="h-40px w-40px rounded bg-light-success d-flex align-items-center justify-content-center">
                                                <i class="fa-solid fa-exchange-alt fs-4 text-success"></i>
                                            </div>
                                            <span class="ms-4 fw-bolder fs-7 text-uppercase text-gray-700">
                                                Transações
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-4">
                            <a href="{{ route('financial.institutions.index') }}">
                                <div class="card mb-4">
                                    <div class="card-body p-3">
                                        <div class="d-flex align-items-center">
                                            <div class="h-40px w-40px rounded bg-light-warning d-flex align-items-center justify-content-center">
                                                <i class="fa-solid fa-bank fs-4 text-warning"></i>
                                            </div>
                                            <span class="ms-4 fw-bolder fs-7 text-uppercase text-gray-700">
                                                Instituições
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-4">
                            <a href="{{ route('financial.credit.cards.index') }}">
                                <div class="card mb-4">
                                    <div class="card-body p-3">
                                        <div class="d-flex align-items-center">
                                            <div class="h-40px w-40px rounded bg-light-danger d-flex align-items-center justify-content-center">
                                                <i class="fa-solid fa-credit-card fs-4 text-danger"></i>
                                            </div>
                                            <span class="ms-4 fw-bolder fs-7 text-uppercase text-gray-700">
                                                Cartões de Crédito
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-4">
                            <a href="{{ route('financial.categories.index') }}">
                                <div class="card mb-4">
                                    <div class="card-body p-3">
                                        <div class="d-flex align-items-center">
                                            <div class="h-40px w-40px rounded bg-light-info d-flex align-items-center justify-content-center">
                                                <i class="fa-solid fa-list fs-4 text-info"></i>
                                            </div>
                                            <span class="ms-4 fw-bolder fs-7 text-uppercase text-gray-700">
                                                Categorias
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-4">
                            <a href="{{ route('financial.debits.index') }}">
                                <div class="card mb-4">
                                    <div class="card-body p-3">
                                        <div class="d-flex align-items-center">
                                            <div class="h-40px w-40px rounded bg-light-secondary d-flex align-items-center justify-content-center">
                                                <i class="fa-solid fa-file-invoice-dollar fs-4 text-gray-500"></i>
                                            </div>
                                            <span class="ms-4 fw-bolder fs-7 text-uppercase text-gray-700">
                                                Débitos
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-4">
                            <a href="{{ route('budgets.index') }}">
                                <div class="card mb-4">
                                    <div class="card-body p-3">
                                        <div class="d-flex align-items-center">
                                            <div class="h-40px w-40px rounded bg-light-dark d-flex align-items-center justify-content-center">
                                                <i class="fa-solid fa-shopping-cart fs-4 text-gray-700"></i>
                                            </div>
                                            <span class="ms-4 fw-bolder fs-7 text-uppercase text-gray-700">
                                                Orçamentos
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-light mb-4">
                        <div class="card-body">
                            <div id="tasksChart" style="height: 350px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-footer')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

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
        colors: ['#50CD89', '#F1416C', '#009EF7'],
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
                    return 'R$ ' + val.toFixed(2).replace('.', ',');
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