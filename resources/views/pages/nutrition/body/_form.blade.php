<div class="row">
    <div class="row">
        <div class="col-4 mb-5">
            <label class="required form-label fw-bold">Peso (kg):</label>
            <input type="text" step="0.1" class="form-control form-control-solid input-two" placeholder="Ex: 70.5" name="weight" value="{{ isset($lastBody->weight) ? number_format($lastBody->weight, 2) : old('weight') }}" required/>
        </div>
        <div class="col-4 mb-5">
            <label class="required form-label fw-bold">Altura (cm):</label>
            <input type="number" step="0.1" class="form-control form-control-solid" max="215" placeholder="Ex: 175" name="height" value="{{ $lastBody->height ?? old('height') }}" required/>
        </div>
        <div class="col-4 mb-5">
            <label class="required form-label fw-bold">Idade:</label>
            <input type="number" class="form-control form-control-solid" max="120" placeholder="Ex: 24" name="age" value="{{ $lastBody->age ?? old('age') }}" required/>
        </div>
        <div class="col-4 mb-5">
            <label class="required form-label fw-bold">Gênero:</label>
            <select class="form-select form-select-solid" name="gender" data-control="select2" data-hide-search="true" data-placeholder="Selecione" required>
                <option value="">Selecione</option>
                <option value="male" @if(isset($lastBody) && $lastBody->gender == 'male') selected @endif>Masculino</option>
                <option value="female" @if(isset($lastBody) && $lastBody->gender == 'female') selected @endif>Feminino</option>
            </select>
        </div>
        <div class="col-4 mb-5">
            <label class="required form-label fw-bold">Nível de Atividade Física:</label>
            <select class="form-select form-select-solid" name="activity_level" data-control="select2" data-hide-search="true" data-placeholder="Selecione" required>
                <option value="sedentary" @if(isset($lastBody) && $lastBody->activity_level == 'sedentary') selected @endif>Sedentário</option>
                <option value="light" @if(isset($lastBody) && $lastBody->activity_level == 'light') selected @endif>Levemente Ativo</option>
                <option value="moderate" @if(isset($lastBody) && $lastBody->activity_level == 'moderate') selected @endif>Moderadamente Ativo</option>
                <option value="intense" @if(isset($lastBody) && $lastBody->activity_level == 'intense') selected @endif>Muito Ativo</option>
                <option value="extreme" @if(isset($lastBody) && $lastBody->activity_level == 'extreme') selected @endif>Extremamente Ativo</option>
            </select>
        </div>
        <div class="col-4 mb-5">
            <label class="form-label fw-bold">% Gordura Corporal (opcional):</label>
            <input type="number" step="0.1" class="form-control form-control-solid input-two" placeholder="Ex: 18.5" name="body_fat" value="{{ $lastBody->body_fat ?? old('body_fat') }}"/>
        </div>
    </div>
</div>