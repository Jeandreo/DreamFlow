<div class="row">
    <div class="col-4 mb-5">
        <label class="required form-label fw-bold required">Nome:</label>
        <input type="text" class="form-control form-control-solid" placeholder="Nome do alimento" name="name" value="{{ $content->name ?? old('name') }}" required />
    </div>
    <div class="col-4 mb-5">
        <label class="required form-label fw-bold required">Tipo:</label>
        <select class="form-select form-select-solid" name="type" data-control="select2" data-hide-search="true" data-placeholder="Selecione" required>
            <option value=""></option>
            <option value="unidade" @if(isset($content) && $content->type == 'unidade' || !isset($content)) selected @endif>Unidade</option>
            <option value="peso" @if(isset($content) && $content->type == 'peso') selected @endif>Peso</option>
        </select>
    </div>
    <div class="col-4 mb-5">
        <label class="form-label fw-bold required">Quantidade:</label>
        <input type="number" class="form-control form-control-solid" placeholder="100g, 1 unidade, 2 quadradinhos" name="quantity" value="{{ $content->quantity ?? old('quantity') }}" required/>
    </div>
    <div class="col-2 mb-5">
        <label class="form-label fw-bold required">Calorias:</label>
        <input type="texta" class="form-control form-control-solid input-one" placeholder="Ex: 150" name="calories" value="{{ isset($content) ? number_format($content->calories, 1, '.', '') : old('calories') }}" required/>
    </div>
    <div class="col-2 mb-5">
        <label class="form-label fw-bold">Proteínas (g):</label>
        <input type="texta" step="0.1" class="form-control form-control-solid input-one" placeholder="Ex: 10.5" name="proteins" value="{{ isset($content) ? number_format($content->proteins, 1, '.', '') : old('proteins') }}" />
    </div>
    <div class="col-2 mb-5">
        <label class="form-label fw-bold">Carboidratos (g):</label>
        <input type="texta" step="0.1" class="form-control form-control-solid input-one" placeholder="Ex: 20.3" name="carbohydrates" value="{{ isset($content) ? number_format($content->carbohydrates, 1, '.', '') : old('carbohydrates') }}" />
    </div>
    <div class="col-2 mb-5">
        <label class="form-label fw-bold">Gorduras (g):</label>
        <input type="texta" step="0.1" class="form-control form-control-solid input-one" placeholder="Ex: 5.7" name="fats" value="{{ isset($content) ? number_format($content->fats, 1, '.', '') : old('fats') }}" />
    </div>
    <div class="col-2 mb-5">
        <label class="form-label fw-bold">Sódio:</label>
        <input type="texta" class="form-control form-control-solid input-one" placeholder="Ex: 150" name="sodium" value="{{ isset($content) ? number_format($content->sodium, 1, '.', '') : old('sodium') }}" />
    </div>
    <div class="col-2 mb-5">
        <label class="form-label fw-bold">Fibras:</label>
        <input type="texta" class="form-control form-control-solid input-one" placeholder="Ex: 150" name="fiber" value="{{ isset($content) ? number_format($content->fiber, 1, '.', '') : old('fiber') }}" />
    </div>
    <div class="col-12 mb-5">
        <label class="form-label fw-bold">Observações:</label>
        <textarea class="form-control form-control-solid" name="notes" cols="30" rows="3" placeholder="Observações...">@if(isset($content)){{ $content->notes }}@endif</textarea>
    </div>
</div>
