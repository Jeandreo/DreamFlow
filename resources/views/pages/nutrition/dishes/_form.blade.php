<div class="row">
    <div class="col-12 mb-5">
        <label class="required form-label fw-bold">Nome:</label>
        <input type="text" class="form-control form-control-solid" placeholder="Nome do alimento" name="name" value="{{ $content->name ?? old('name') }}" required />
    </div>
    <div class="col-12 mb-5">
        <label class="form-label fw-bold">Descrição:</label>
        <textarea class="form-control form-control-solid" name="description" cols="30" rows="3" placeholder="Observações...">@if(isset($content)){{ $content->description }}@endif</textarea>
    </div>
    <div class="col-12 mb-5">
        <label class="form-label fw-bold">Modo de preparação:</label>
        <textarea class="form-control form-control-solid" name="preparation_method" cols="30" rows="3" placeholder="Observações...">@if(isset($content)){{ $content->preparation_method }}@endif</textarea>
    </div>
</div>
