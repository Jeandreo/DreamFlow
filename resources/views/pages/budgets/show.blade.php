@extends('layouts.app')

@section('title-page', $contents->name)

@section('title-toolbar', $contents->name)

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        Terminar, criar uma lista de itens a comprar, com valor previsto.
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <a href="{{ route('budgets.index') }}" class="btn btn-light mt-2">Voltar</a>
                <a href="{{ route('budgets.create', $contents->id) }}" class="btn btn-primary btn-active-danger mt-2">Cadastrar Item</a>
            </div>
        </div>
    </div>
@endsection