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
        <label class="form-label fw-bold">Objetivo:</label>
        <textarea class="form-control form-control-solid" 
                  name="goal" 
                  cols="30" 
                  rows="3" 
                  placeholder="Ex: Emagrecimento, ganho de massa, manutenção...">@if(isset($content)){{ $content->goal }}@endif</textarea>
    </div>

    <div class="col-12 mb-5">
        <label class="form-label fw-bold">Refeições:</label>
        <select class="form-select form-select-solid" 
                name="meals[]" 
                data-control="select2" 
                data-placeholder="Selecione os pratos" 
                data-allow-clear="true" 
                multiple>
            <option value=""></option>
            @foreach ($meals as $meal)
                <option value="{{ $meal->id }}" @if(isset($content) && $content->meals->flatMap->meals->pluck('id')->contains($meal->id)) selected @endif>
                    {{ $meal->name }}
                </option>
            @endforeach
        </select>
        <div class="form-text mt-2">Você poderá definir os horários e dias da semana após criar a dieta.</div>
    </div>
</div>
