<div class="row">
    <div class="col-3 mb-5">
        <label class="form-label fw-bold">Banco:</label>
        <select class="form-select form-select-solid" name="institution_id" data-control="select2" data-placeholder="Selecione" data-allow-clear="true">
            <option value=""></option>
            <option value="1" @if(isset($content) && $content->institution_id == 1) selected @endif>NuBank</option>
            <option value="2" @if(isset($content) && $content->institution_id == 2) selected @endif>Itaú</option>
            <option value="3" @if(isset($content) && $content->institution_id == 3) selected @endif>Mercado Pago</option>
            <option value="4" @if(isset($content) && $content->institution_id == 4) selected @endif>C6 Bank</option>
            <option value="5" @if(isset($content) && $content->institution_id == 5) selected @endif</option>
            <option value="6" @if(isset($content) && $content->institution_id == 6) selected @endif>Banco do Brasil</option>
            <option value="7" @if(isset($content) && $content->institution_id == 7) selected @endif>Bradesco</option>
            <option value="8" @if(isset($content) && $content->institution_id == 8) selected @endif>Santander</option>
            <option value="9" @if(isset($content) && $content->institution_id == 9) selected @endif>Caixa Econômica Federal</option>
            <option value="10" @if(isset($content) && $content->institution_id == 10) selected @endif>Banco Inter</option>
            <option value="11" @if(isset($content) && $content->institution_id == 11) selected @endif>BTG Pactual</option>
            <option value="12" @if(isset($content) && $content->institution_id == 12) selected @endif>XP Investimentos</option>
            <option value="13" @if(isset($content) && $content->institution_id == 13) selected @endif>Banco Neon</option>
            <option value="14" @if(isset($content) && $content->institution_id == 14) selected @endif>Banco Original</option>
            <option value="15" @if(isset($content) && $content->institution_id == 15) selected @endif>Banrisul</option>
            <option value="16" @if(isset($content) && $content->institution_id == 16) selected @endif>Sicredi</option>
            <option value="17" @if(isset($content) && $content->institution_id == 17) selected @endif>PicPay</option>
            <option value="18" @if(isset($content) && $content->institution_id == 18) selected @endif>Ame Digital</option>
            <option value="19" @if(isset($content) && $content->institution_id == 19) selected @endif>Banco Pan</option>
            <option value="20" @if(isset($content) && $content->institution_id == 20) selected @endif>BMG</option>
            <option value="21" @if(isset($content) && $content->institution_id == 21) selected @endif>Outro</option>
        </select>
    </div>
    <div class="col-3 mb-5">
        <label class="required form-label fw-bold">Nome:</label>
        <input type="text" class="form-control form-control-solid get-to-url" placeholder="Nome do Projeto" name="name" value="{{ $content->name ?? old('name') }}" required/>
    </div>
    <div class="col-3 mb-5">
        <label class="required form-label fw-bold">URL:</label>
        <input type="text" class="form-control form-control-solid only-url" placeholder="URL" name="url" value="{{ $content->url ?? old('url') }}" required/>
    </div>
    <div class="col-3 mb-5">
        <label class="form-label fw-bold">Cor:</label>
        <input type="color" class="form-control form-control-solid" placeholder="Selecione uma cor" name="color" value="{{ $content->color ?? '#009ef7' }}"/>
    </div>
    <div class="col-12 mb-5">
        <label class="form-label fw-bold">Descrição:</label>
        <textarea name="description" class="form-control form-control-solid" placeholder="Alguma observação sobre este projeto?">@if(isset($content->description)){{$content->description}}@endif</textarea>
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