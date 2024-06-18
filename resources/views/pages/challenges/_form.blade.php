<div class="row">
    <div class="col-6 mb-5">
        <label class="required form-label fw-bold">Nome:</label>
        <input type="text" class="form-control form-control-solid get-to-url" placeholder="Qual desafio você vai encarar?" name="name" value="{{ $content->name ?? old('name') }}" required/>
    </div>
    <div class="col-6 mb-5">
        <label class="required form-label fw-bold">URL:</label>
        <input type="text" class="form-control form-control-solid only-url" placeholder="URL" name="url" value="{{ $content->url ?? old('url') }}" required/>
    </div>
    <div class="col mb-5">
        <label class="required form-label fw-bold">Será um desafio:</label>
        <select class="form-select form-select-solid" name="type" data-control="select2" data-hide-search="true" data-placeholder="Selecione" required>
            <option value=""></option>
            <option value="mensal" @if(isset($content) && $content->type == 'mensal') selected @endif>Mensal</option>
            <option value="semanal" @if(isset($content) && $content->type == 'semanal') selected @endif>Semanal</option>
        </select>
    </div>
    <div class="col mb-5">
        <label class="required form-label fw-bold">Ano:</label>
        <select class="form-select form-select-solid" name="year" data-control="select2" data-hide-search="true" data-placeholder="Selecione" required>
            <option value=""></option>
            @for ($i = 24; $i < 30; ++$i)
            <option value="20{{ $i }}" @if(20 . $i == date('Y')) selected @endif>20{{ $i }}</option>
            @endfor
        </select>
    </div>
    <div class="col mb-5 challenge-month">
        <label class="required form-label fw-bold">Mês:</label>
        <select class="form-select form-select-solid" name="month" data-control="select2" data-hide-search="true" data-placeholder="Selecione">
            <option value=""></option>
            <option value="1" @if(1 == date("n")) selected @endif>Janeiro</option>
            <option value="2" @if(2 == date("n")) selected @endif>Fevereiro</option>
            <option value="3" @if(3 == date("n")) selected @endif>Março</option>
            <option value="4" @if(4 == date("n")) selected @endif>Abril</option>
            <option value="5" @if(5 == date("n")) selected @endif>Maio</option>
            <option value="6" @if(6 == date("n")) selected @endif>Junho</option>
            <option value="7" @if(7 == date("n")) selected @endif>Julho</option>
            <option value="8" @if(8 == date("n")) selected @endif>Agosto</option>
            <option value="9" @if(9 == date("n")) selected @endif>Setembro</option>
            <option value="10" @if(10 == date("n")) selected @endif>Outubro</option>
            <option value="11" @if(11 == date("n")) selected @endif>Novembro</option>
            <option value="12" @if(12 == date("n")) selected @endif>Dezembro</option>
        </select>
    </div>
    <div class="col mb-5 challenge-period" style="display: none;">
        <label class="required form-label fw-bold">Período:</label>
        <input type="text" class="form-control form-control-solid flatpickr-range cursor-pointer" placeholder="Início e Fim" name="days_week" value="{{ $content->days_week ?? old('days_week') }}"/>
    </div>
</div>

@section('custom-footer')
<script>
    $(document).ready(function(){

        $('.flatpickr-range').flatpickr({
            altInput: true,
            altFormat: "d/m",
            dateFormat: "-m-d",
            locale: "pt",
            mode: "range",
        });

        // CHANGE TYPE
        $('[name="type"]').change(function(){

            // GET TYPE
            var type = $(this).val();
            
            // IF 'MENSAL'
            if(type == 'mensal'){
                $('.challenge-period').hide()
                $('.challenge-month').show();
            } else {
                $('.challenge-period').show();
                $('.challenge-month').hide()
            }

        });
    });
</script>
@endsection