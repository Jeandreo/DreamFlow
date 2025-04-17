<div class="row">
    <div class="col-4 mb-5">
        <label class="required form-label fw-bold">Nome:</label>
        <input type="text" class="form-control form-control-solid" placeholder="Nome do alimento" name="name" value="{{ $content->name ?? old('name') }}" required />
    </div>
    <div class="col-4 mb-5">
        <label class="required form-label fw-bold">Categoria:</label>
        <input type="text" class="form-control form-control-solid" placeholder="Ex: Legume, Fruta, Carne..." name="category" value="{{ $content->category ?? old('category') }}" required />
    </div>
    <div class="col-4 mb-5">
        <label class="form-label fw-bold">Quantidadee:</label>
        <input type="text" class="form-control form-control-solid input-calorias" placeholder="100g, 1 unidade, 2 quadradinhos" name="base_quantity" value="{{ $content->base_quantity ?? old('base_quantity') }}" />
    </div>
    <div class="col-3 mb-5">
        <label class="form-label fw-bold">Calorias:</label>
        <input type="number" class="form-control form-control-solid input-calorias" placeholder="Ex: 150" name="calories" value="{{ $content->calories ?? old('calories') }}" />
    </div>
    <div class="col-3 mb-5">
        <label class="form-label fw-bold">Proteínas (g):</label>
        <input type="number" step="0.1" class="form-control form-control-solid input-calorias" placeholder="Ex: 10.5" name="proteins" value="{{ $content->proteins ?? old('proteins') }}" />
    </div>
    <div class="col-3 mb-5">
        <label class="form-label fw-bold">Carboidratos (g):</label>
        <input type="number" step="0.1" class="form-control form-control-solid input-calorias" placeholder="Ex: 20.3" name="carbohydrates" value="{{ $content->carbohydrates ?? old('carbohydrates') }}" />
    </div>
    <div class="col-3 mb-5">
        <label class="form-label fw-bold">Gorduras (g):</label>
        <input type="number" step="0.1" class="form-control form-control-solid input-calorias" placeholder="Ex: 5.7" name="fats" value="{{ $content->fats ?? old('fats') }}" />
    </div>
    <div class="col-12 mb-5">
        <label class="form-label fw-bold">Observações:</label>
        <textarea class="form-control form-control-solid" name="notes" cols="30" rows="3" placeholder="Observações...">@if(isset($content)){{ $content->notes }}@endif</textarea>
    </div>
</div>
