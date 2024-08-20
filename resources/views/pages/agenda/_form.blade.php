<div class="row py-2">
    <div class="col-3">
        <label class="form-label fs-6 fw-bold text-gray-700 mb-3 required">Título/Cor:</label>
    </div>
    <div class="col-9">
        <div class="row">
            <div class="col-7">
                <input type="text" class="form-control form-control-solid" placeholder="Nome da reunião" name="name" value="{{ $content->name ?? old('name') }}" maxlength="255" required>
            </div>
            <div class="col-5">
                <input type="color" class="form-control form-control-solid form-control-color" style="width: 100%" name="color" @if(isset($content)) value="{{ $content->color ?? old('color') }}" @else value="#182C64" @endif title="Escolha sua cor" required>
            </div>
        </div>
    </div>
</div>
<div class="row py-2">
    <div class="col-3">
        <label class="form-label fs-6 fw-bold text-gray-700 mb-3">Descrição:</label>
    </div>
    <div class="col-9">
        <textarea class="form-control form-control-solid" name="description" cols="30" rows="3" placeholder="Sobre oque será a reunião?">@if(isset($content)){{ $content->description }}@endif</textarea>
    </div>
</div>
<div class="row py-2">
    <div class="col-3">
        <label class="form-label fs-6 fw-bold text-gray-700 mb-3 required">Recorrência: </label>
    </div>
    <div class="col-9">
        <div class="form-check form-check-sm form-check-custom form-check-solid">
            <input class="form-check-input" type="radio" name="recurrent" value="0" @if(!isset($content) || $content->recurrent == 0) checked @endif id="recurrent_false"/>
            <label class="form-check-label me-5" for="recurrent_false">
                Pontual
            </label>
            <input class="form-check-input" type="radio" name="recurrent" value="1" @if(isset($content) && $content->recurrent == 1) checked @endif id="recurrent_true"/>
            <label class="form-check-label" for="recurrent_true">
                Recorrente
            </label>
        </div>
    </div>
</div>
<div class="row py-2 div-pontual" @if(isset($content) && $content->recurrent == 1) style="display: none;" @endif>
    <div class="col-3">
        <label class="form-label fs-6 fw-bold text-gray-700">Início da Reunião: </label>
    </div>
    <div class="col-9">
        <div class="row">
            <div class="col-7">
                <input class="form-control form-control-solid input-date me-4 text-center" maxlength="30" placeholder="00/00/0000" type="text" name="date_start" value="@if(isset($content)){{ date('d/m/Y', strtotime($content->date_start)) }}@else{{ date('d/m/Y') }}@endif">
            </div>
            <div class="col-2">
                <input class="form-control form-control-solid input-time text-center" maxlength="30" placeholder="00:00" type="text" name="hour_start" value="@if(isset($content)){{ date('H:i', strtotime($content->hour_start)) }}@else{{ date('H:i') }}@endif">
            </div>
            <div class="col-1 d-flex align-items-center">
                <p class="text-gray-700 fw-bold text-center mb-0">Até</p>
            </div>
            <div class="col-2">
                <input class="form-control form-control-solid input-time text-center" maxlength="30" placeholder="00:00" type="text" name="hour_end" value="@if(isset($content)){{ date('H:i', strtotime($content->hour_end)) }}@else{{ date('H:i') }}@endif">
            </div>
        </div>
    </div>
</div>
<div class="row py-2 div-recurrent" @if(!isset($content) || $content->recurrent == 0) style="display: none;" @endif>
    <div class="col-3">
        <label class="form-label fs-6 fw-bold text-gray-700 mb-3 required">Dias da semana: </label>
    </div>
    <div class="col-9">
        <div class="d-flex">
            @foreach ([
                'Seg' => 'mo', 
                'Ter' => 'tu', 
                'Qua' => 'we', 
                'Qui' => 'th', 
                'Sex' => 'fr', 
                'Sab' => 'sa', 
                'Dom' => 'su'
            ] as $dayWeek => $rruleDay)
            <div class="form-check form-check-custom form-check-solid me-4">
                <input class="form-check-input" type="checkbox" name="week_days[]" value="{{ $rruleDay }}" id="checkbox_{{ $dayWeek }}" @if(isset($content) && str_contains($content->week_days, $rruleDay)) checked @endif/>
                <label class="form-check-label fw-bold text-gray-600" for="checkbox_{{ $dayWeek }}">
                    {{ $dayWeek }}
                </label>
            </div>
            @endforeach
        </div>
    </div>
</div>
<div class="row py-2 div-recurrent" @if(!isset($content) || $content->recurrent == 0) style="display: none;" @endif>
    <div class="col-3">
        <label class="form-label fs-6 fw-bold text-gray-700 mb-3 required">Inicio/Duração: </label>
    </div>
    <div class="col-9">
        <div class="row">
            <div class="col-7">
                <input class="form-control form-control-solid input-time me-4 text-center" placeholder="Começa às" type="text" name="start_at" placeholder="Inicio ás">
            </div>
            <div class="col-5">
                <input class="form-control form-control-solid input-time text-center" placeholder="Ex.: Dura 1h" type="text" name="duration" placeholder="Duração">
            </div>
        </div>
    </div>
</div>
{{-- <div class="row py-2 div-recurrent" @if(!isset($content) || $content->recurrent == 0) style="display: none;" @endif>
    <div class="col-3">
        <label class="form-label fs-6 fw-bold text-gray-700 mb-3">Até (opcional): </label>
    </div>
    <div class="col-9">
        <input class="form-control form-control-solid input-date me-4 text-center" placeholder="00/00/0000" type="text" name="until" placeholder="Vai até">
    </div>
</div> --}}
<div class="row py-2">
    <div class="col-3">
        <label class="form-label fs-6 fw-bold text-gray-700 mb-3 required">Participantes:</label>
    </div>
    <div class="col-9">
        <div class="row align-items-center">
            <div class="form-check form-check-sm form-check-custom form-check-solid mb-4">
                <input class="form-check-input cursor-pointer" type="radio" name="general" @if(isset($content) && $content->general == 1 || !isset($content)) checked @endif value="1" checked id="general"/>
                <label class="form-check-label me-4 cursor-pointer" for="general">
                    Todos
                </label>
                <input class="form-check-input cursor-pointer" type="radio" name="general" @if(isset($content) && $content->general == 0) checked @endif value="0" id="individual"/>
                <label class="form-check-label me-4 cursor-pointer" for="individual">
                    Selecionar
                </label>
            </div>
            <div class="select-div" @if(!isset($content) || $content->general == 1) style="display: none;" @endif>
                <select class="form-select form-select-solid select-paticipants" name="users_id[]" data-placeholder="" multiple>
                    <option></option>
                    @if(isset($users))
                        @foreach ($users as $user)
                        <option value="{{ $user->id }}" data-kt-select2-user="{{ searchImage('users', $user->id) }}" @if(isset($content) && in_array($user->id, $content->usersParticipants->pluck('id')->all())) selected @endif>{{ Str::limit($user->name, 25) }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
    </div>
</div>

@section('custom-footer')
@parent
<script>
    // FORMAT OPTIONS
    var optionFormat = function(item) {
        if ( !item.id ) {
            return item.text;
        }

        var span = document.createElement('span');
        var imgUrl = item.element.getAttribute('data-kt-select2-user');
        var template = '';

        template += '<img src="' + imgUrl + '" class="rounded-circle h-20px me-2" alt="image"/>';
        template += item.text;

        span.innerHTML = template;

        return $(span);
    }

    $(document).ready(function(){
        // SELECT 2
        $('.select-paticipants').select2({
            templateSelection: optionFormat,
            templateResult: optionFormat
        });
    })

    // HIDDEN COLUMNS
    $(document).on('change', '[name="general"]', function(){

        // GET GENERAL
        var general = $(this).val();

        // IF DATE END
        if(general == 0){
            $('.select-div select').prop('required', true);
            $('.select-div').show();
        } else {
            $('.select-div select').prop('required', false);
            $('.select-div').hide()
        }

    });

    $(document).on('change', '[name="recurrent"]', function(){

        // GET GENERAL
        var recurrent = $(this).val();

        // IF DATE END
        if(recurrent == '0'){
            $('.div-recurrent').hide();
            $('.div-pontual').show();
        } else {
            $('.div-recurrent').show()
            $('.div-pontual').hide();
        }

    });

</script>
@endsection