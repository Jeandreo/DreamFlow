<div class="row">
    <div class="col-4 mb-5">
        <label class="required form-label fw-bold">Nome:</label>
        <input type="text" class="form-control form-control-solid" placeholder="Nome" name="name" value="{{ $content->name ?? old('name') }}" required/>
    </div>
    <div class="col-4 mb-5">
        <label class="required form-label fw-bold">Valor esperado:</label>
        <input type="text" class="form-control form-control-solid input-money" placeholder="R$ 0.000,00" name="total_expected" value="{{ $content->total_expected ?? old('total_expected') }}" required/>
    </div>
    <div class="col-4 mb-5">
        <label class="form-label fw-bold">Validade do orçamento:</label>
        <input type="text" class="form-control form-control-solid flatpickr" placeholder="Prazo do orçamento" value="@if(isset($content) && $content->valid) {{ date('Y-m-d', strtotime($content->valid)) }} @endif"/>
    </div>
    <div class="col-12 mb-5">
        <label class="form-label fw-bold">Descrição:</label>
        <textarea name="description" class="form-control form-control-solid" placeholder="Alguma observação sobre este orçamento?">@if(isset($content->description)){{$content->description}}@endif</textarea>
    </div>
</div>