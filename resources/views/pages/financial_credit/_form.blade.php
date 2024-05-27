<div class="row">
    <div class="col mb-5">
        <label class="required form-label fw-bold">Nome:</label>
        <input type="text" class="form-control form-control-solid" placeholder="Nome" name="name" value="{{ $content->name ?? old('name') }}" required/>
    </div>
    <div class="col mb-5">
        <label class="required form-label fw-bold">Limite:</label>
        <input type="text" class="form-control form-control-solid input-money" placeholder="R$ 0.000,00" name="limit" value="{{ $content->limit ?? old('limit') }}" required/>
    </div>
    <div class="col mb-5">
        <label class="required form-label fw-bold">Fechamento:</label>
        <input type="number" class="form-control form-control-solid" placeholder="01" max="31" name="closing_day" value="{{ $content->closing_day ?? old('closing_day') }}" required/>
    </div>
    <div class="col mb-5">
        <label class="required form-label fw-bold">Vencimento:</label>
        <input type="number" class="form-control form-control-solid" placeholder="01" max="31" name="due_day" value="{{ $content->due_day ?? old('due_day') }}" required/>
    </div>
    <div class="col mb-5">
        <label class="required form-label fw-bold">Carteira de pagamento:</label>
        <select class="form-select form-select-solid" name="wallet_id" data-control="select2" data-placeholder="Selecione" required>
            <option value=""></option>
            @foreach ($wallets as $wallet)
            <option value="{{ $wallet->id }}" @if(isset($content) && $content->wallet_id == $wallet->id) selected @endif>{{ $wallet->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-12 mb-5">
        <label class="form-label fw-bold">Descrição:</label>
        <textarea name="description" class="form-control form-control-solid" placeholder="Alguma observação sobre este cartão?">@if(isset($content->description)){{$content->description}}@endif</textarea>
    </div>
</div>

@section('custom-footer')
<script>
    // REPLACE NAME OF INSTITUTION
    $('[name="institution_id"]').change(function(){

        // GET NAME
        var name = $(this).find('option:selected').text().trim();

        // REPLACE IN NAME
        $('[name="name"]').val(name);

    });
</script>
@endsection