<div class="row">
    <div class="col-4 mb-5">
        <label class="required form-label fw-bold">Descrição:</label>
        <input type="text" class="form-control form-control-solid" placeholder="Descreva a compra..." name="name" value="{{ $content->name ?? old('name') }}" required/>
    </div>
    <div class="col-4 mb-5">
        <label class="required form-label fw-bold">Tipo:</label>
        <select class="form-select form-select-solid" name="type" data-control="select2" data-placeholder="Selecione" @if(!isset($content)) data-dropdown-parent="#modal_trasaction" @endif required>
            <option value=""></option>
            <option value="revenue">Receita</option>
            <option value="expense" @if(!isset($content)) selected @endif>Despesa</option>
        </select>
    </div>
    <div class="col-4 mb-5">
        <label class="required form-label fw-bold">Valor:</label>
        <input type="text" class="form-control form-control-solid input-money" placeholder="R$ 0,00" name="value" value="{{ $content->value ?? old('value') }}" required/>
    </div>
    <div class="col-4 mb-5">
        <label class="required form-label fw-bold">Data:</label>
        <input type="text" class="form-control form-control-solid flatpickr" placeholder="00/00/0000" name="date_venciment" value="{{ $content->venciment ?? date('Y-m-d') }}" required/>
    </div>
    <div class="col-4 mb-5">
        <label class="required form-label fw-bold">Categoria:</label>
        <select class="form-select form-select-solid" name="category_id" data-control="select2" data-placeholder="Selecione" @if(!isset($content)) data-dropdown-parent="#modal_trasaction" @endif required>
            <option value=""></option>
            @foreach ($categories as $category)
            <option value="{{ $category->id }}" @if(isset($content) && $content->category_id == $category->id) selected @endif>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-4 mb-5">
        <label class="required form-label fw-bold">Recorrete:</label>
        <select class="form-select form-select-solid" name="recurrent" data-control="select2" data-hide-search="true" data-placeholder="Selecione" required>
            <option value=""></option>
            <option value="1">Sim</option>
            <option value="0">Não</option>
        </select>
    </div>
    <div class="col-12 mb-5">
        <label class="form-label fw-bold">Observação:</label>
        <textarea name="description" class="form-control form-control-solid" placeholder="Alguma observação sobre este cartão?">@if(isset($content->description)){{$content->description}}@endif</textarea>
    </div>
</div>