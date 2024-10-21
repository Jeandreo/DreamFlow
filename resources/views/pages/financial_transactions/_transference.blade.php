<div class="row">
    <div class="col-6 mb-5">
        <label class="required form-label fw-bold">Conta que saiu:</label>
        <select class="form-select form-select-solid btn-transaction" name="method_id" data-placeholder="Selecione" data-dropdown-parent="#modal_trasaction_transference"required>
            <option value=""></option>
            @foreach ($wallets as $wallet)
            <option value="{{ $wallet->id }}" @if(isset($content) && $content->wallet_id == $wallet->id) selected @endif data-type="wallet">{{ $wallet->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-6 mb-5">
        <label class="required form-label fw-bold">Conta que vai receber:</label>
        <select class="form-select form-select-solid btn-transaction" name="method_id" data-placeholder="Selecione" data-dropdown-parent="#modal_trasaction_transference"required>
            <option value=""></option>
            @foreach ($wallets as $wallet)
            <option value="{{ $wallet->id }}" @if(isset($content) && $content->wallet_id == $wallet->id) selected @endif data-type="wallet">{{ $wallet->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-12 mb-5">
        <label class="required form-label fw-bold">Valor:</label>
        <input type="text" class="form-control form-control-solid input-money" placeholder="R$ 0,00" name="value" value="{{ $content->value ?? old('value') }}" required/>
    </div>
    <div class="col mb-5">
        <label class="required form-label fw-bold">Data da compra:</label>
        <input type="text" class="form-control form-control-solid flatpickr" placeholder="00/00/0000" name="date_purchase" value="{{ $content->venciment ?? date('Y-m-d') }}" required/>
    </div>
    <div class="col-12 mb-5">
        <label class="required form-label fw-bold">Descrição:</label>
        <input type="text" class="form-control form-control-solid" placeholder="Descreva a compra..." name="name" value="{{ $content->name ?? old('name') }}" required/>
    </div>
</div>

@section('custom-footer')
@parent
<script>
    $(document).ready(function(){

        $(document).on('change', '.btn-transaction', function(){
            // Seleciona o tipo
            var type = $(this).find('option:selected').data('type');

            // Atualiza o tipo de pagamento
            $('[name="method"]').val(type);
        });

    });
</script>
@endsection
