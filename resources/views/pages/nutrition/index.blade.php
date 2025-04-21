@extends('layouts.app')
@section('title-page', 'Nutrição')
@section('title-toolbar', 'Nutrição')
@section('content')
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
                    <a href="{{ route('body.edit') }}">
                        <div class="card mb-4">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center">
                                    <div class="h-40px w-40px rounded bg-light-warning d-flex align-items-center justify-content-center">
                                        <i class="fa-solid fa-utensils fs-4 text-warning"></i> <!-- Utensílios para Pratos -->
                                    </div>
                                    <span class="ms-4 fw-bolder fs-7 text-uppercase text-gray-700">
                                        Meu Corpo
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
@endsection
