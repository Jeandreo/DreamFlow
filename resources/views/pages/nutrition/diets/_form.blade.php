<div class="row">
    <div class="col-12 mb-5">
        <label class="required form-label fw-bold">Nome da Dieta:</label>
        <input type="text" 
               class="form-control form-control-solid" 
               placeholder="Nome da dieta" 
               name="name" 
               value="{{ $content->name ?? old('name') }}" 
               required />
    </div>
    <div class="col-12 mb-5">
        <label class="form-label fw-bold required">Objetivo:</label>
        <textarea class="form-control form-control-solid" 
                name="goal" 
                cols="30" 
                rows="3" 
                required
                placeholder="Ex: Emagrecimento, ganho de massa, manutenção...">@if(isset($content)){{ $content->goal }}@endif</textarea>
    </div>
</div>
