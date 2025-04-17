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
    <div class="col-12 mb-5">
        <label class="form-label fw-bold">Alimentos:</label>
        <select class="form-select form-select-solid" name="dishes[]" data-control="select2" data-placeholder="Selecione" data-allow-clear="true" multiple>
            <option value=""></option>
            @foreach ($dishes as $dish)
            <option value="{{ $dish->id }}" @if(isset($content) && $content->dishes->contains($dish->id)) selected @endif>{{ $dish->name }}</option>
            @endforeach
        </select>
    </div>
</div>
