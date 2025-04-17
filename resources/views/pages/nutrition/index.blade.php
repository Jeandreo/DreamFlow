@extends('layouts.app')
@section('title-page', 'Dashboard')
@section('title-toolbar', 'Dashboard')
@section('content')
<div class="row m-0 background-dashboard" style="background-image: url('{{ asset('assets/media/logos/background-pattern.webp') }}'); background-size: cover;">
    <div style="background: linear-gradient(0deg, #090c11, #18202bf0);">
        <div class="col-12">
            <div class="toolbar py-20 mb-10" id="kt_toolbar">
                <div id="kt_toolbar_container" class="container-xxl d-flex justify-content-center">
                    @include('includes.nav-admin', ['title' => "Alimentação da família!", 'phrase' => "“Se você realmente quer algo, não espere. Ensine a si mesmo a ser impaciente.” – Gurbaksh Chahal"])
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container py-6">
    <div class="row">
        <div class="col-12 order-1">
            <div class="row">
                <div class="col-6 col-md-3">
                    <a href="{{ route('foods.index') }}">
                        <div class="card mb-4">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center">
                                    <div class="h-40px w-40px rounded bg-light-success d-flex align-items-center justify-content-center">
                                        <i class="fa-solid fa-apple-alt fs-4 text-success"></i> <!-- Maçã para Alimentos -->
                                    </div>
                                    <span class="ms-4 fw-bolder fs-7 text-uppercase text-gray-700">
                                        Alimentos
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ route('dishes.index') }}">
                        <div class="card mb-4">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center">
                                    <div class="h-40px w-40px rounded bg-light-warning d-flex align-items-center justify-content-center">
                                        <i class="fa-solid fa-utensils fs-4 text-warning"></i> <!-- Utensílios para Pratos -->
                                    </div>
                                    <span class="ms-4 fw-bolder fs-7 text-uppercase text-gray-700">
                                        Pratos
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ route('meals.index') }}">
                        <div class="card mb-4">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center">
                                    <div class="h-40px w-40px rounded bg-light-danger d-flex align-items-center justify-content-center">
                                        <i class="fa-solid fa-bowl-food fs-4 text-danger"></i> <!-- Bowl de comida para Refeições -->
                                    </div>
                                    <span class="ms-4 fw-bolder fs-7 text-uppercase text-gray-700">
                                        Refeições
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ route('diets.index') }}">
                        <div class="card mb-4">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center">
                                    <div class="h-40px w-40px rounded bg-light-primary d-flex align-items-center justify-content-center">
                                        <i class="fa-solid fa-balance-scale fs-4 text-primary"></i> <!-- Balança para Dietas -->
                                    </div>
                                    <span class="ms-4 fw-bolder fs-7 text-uppercase text-gray-700">
                                        Dietas
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
