<div class="row">
    <div class="col-6 mb-5">
        <label class="required form-label fw-bold">Nome:</label>
        <input type="text" class="form-control form-control-solid" placeholder="Nome" name="name" value="{{ $content->name ?? old('name') }}" required/>
    </div>
    <div class="col-6 mb-5">
        <label class="required form-label fw-bold">Limite:</label>
        <input type="text" class="form-control form-control-solid input-money" placeholder="R$ 0.000,00" name="value" value="{{ $content->value ?? old('value') }}" required/>
    </div>
    <div class="col-12 mb-5">
        <label class="form-label fw-bold">Descrição:</label>
        <textarea name="description" class="form-control form-control-solid" placeholder="Alguma observação sobre este cartão?">@if(isset($content->description)){{$content->description}}@endif</textarea>
    </div>
</div>