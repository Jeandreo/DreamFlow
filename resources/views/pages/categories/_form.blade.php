<div class="row">
    <div class="col mb-5">
        <label class="required form-label fw-bold">Nome:</label>
        <input type="text" class="form-control form-control-solid" placeholder="Nome da Categoria" name="name" value="{{ $content->name ?? old('name') }}" required/>
    </div>
    <div class="col mb-5">
        <label class="required form-label fw-bold">Tipo:</label>
        <select class="form-select form-select-solid" name="type" data-control="select2" data-hide-search="true" data-placeholder="Selecione" required>
            <option value=""></option>
            <option value="1" @if(isset($content) && $content->type == 1) selected @endif>Corporativo</option>
            <option value="2" @if(isset($content) && $content->type == 2) selected @endif>Pessoal</option>
        </select>
    </div>
</div>