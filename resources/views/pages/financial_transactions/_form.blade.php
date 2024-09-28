@if(isset($content))
<input type="hidden" name="type" value="{{ $content->value < 0 ? 'expense' : 'revenue' }}">
<input type="hidden" name="preview" value="">
@endif
<div class="row">
    @if(!isset($content))<input type="hidden" name="type" value="@if(isset($type)){{ $type }}@endif">@endif
    <div class="col mb-5">
        <label class="required form-label fw-bold">Descrição:</label>
        <input type="text" class="form-control form-control-solid" placeholder="Descreva a compra..." name="name" value="{{ $content->name ?? old('name') }}" required/>
    </div>
    <div class="col-4 mb-5">
        <label class="required form-label fw-bold">Método:</label>
        <select class="form-select form-select-solid select-method" name="method_id" data-placeholder="Selecione" @if(!isset($content)) data-dropdown-parent="{{ $modal }}" @endif required>
            <option value=""></option>
            @foreach ($wallets as $wallet)
            <option value="{{ $wallet->id }}" @if(isset($content) && $content->wallet_id == $wallet->id) selected @endif data-type="wallet">{{ $wallet->name }}</option>
            @endforeach
            @foreach ($credits as $credit)
            <option value="{{ $credit->id }}" @if(isset($content) && $content->credit_card_id == $credit->id) selected @endif data-type="credit">{{ $credit->name }}</option>
            @endforeach
        </select>
    </div>
    <input type="hidden" name="method" value="@if(isset($content) && $content->credit_card_id){{'credit'}}@endif">
    <div class="col mb-5">
        <label class="required form-label fw-bold">Valor:</label>
        <input type="text" class="form-control form-control-solid input-money" placeholder="R$ 0,00" name="value" value="{{ $content->value ?? old('value') }}" required/>
    </div>
</div>
<div class="row">
    <div class="col mb-5">
        <label class="required form-label fw-bold">Data da compra:</label>
        <input type="text" class="form-control form-control-solid flatpickr" placeholder="00/00/0000" name="date_purchase" value="{{ $content->venciment ?? date('Y-m-d') }}" required/>
    </div>
        @if (!isset($content) || $content->adjustment === 0 && $content->fature === 0)
        <div class="col-6 mb-5">
            <label class="required form-label fw-bold">Categoria:</label>
            <select class="form-select form-select-solid select-categories" name="category_id" data-placeholder="Selecione" @if(!isset($content)) data-dropdown-parent="{{ $modal }}" @endif required>
                <option></option>
                @if(isset($type) && $type == 'revenue')
                    @foreach ($categories->where('type', 'revenue') as $category)
                    <option value="{{ $category->id }}" @if(isset($content) && $content->category_id == $category->id) selected @endif data-color="@if($category->father){{ $category->father->color }}@else{{ $category->color }}@endif" data-icon="@if($category->father){{ str_replace(' ', ',', $category->father->icon) }}@else{{ str_replace(' ', ',', $category->icon) }}@endif">{{ $category->name }}</option>
                    @endforeach
                @else
                    @foreach ($categories->where('type', 'expense') as $category)
                    <option value="{{ $category->id }}" @if(isset($content) && $content->category_id == $category->id) selected @endif data-color="@if($category->father){{ $category->father->color }}@else{{ $category->color }}@endif" data-icon="@if($category->father){{ str_replace(' ', ',', $category->father->icon) }}@else{{ str_replace(' ', ',', $category->icon) }}@endif">{{ $category->name }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        @endif
</div>
@if (!isset($content))
<div class="row">
    <div class="col mb-5">
        <label class="required form-label fw-bold">Parcelamento:</label>
        <select class="form-select form-select-solid" name="installments" data-control="select2" data-hide-search="true" data-placeholder="Selecione" required>
            <option value=""></option>
            <option value="1">Sim</option>
            <option value="0" selected>Não</option>
        </select>
    </div>
    <div class="col-4 mb-5 installments-quantity-div" style="display: none;">
        <label class="required form-label fw-bold">Parcelas:</label>
        <input type="number" class="form-control form-control-solid" placeholder="2" min="2" max="999" name="installments_quantity" value=""/>
    </div>
    <div class="col mb-5 recurrent-div">
        <label class="required form-label fw-bold">Recorrente:</label>
        <select class="form-select form-select-solid" name="recurrent" data-control="select2" data-hide-search="true" data-placeholder="Selecione" required>
            <option value=""></option>
            <option value="1">Sim</option>
            <option value="0" selected>Não</option>
        </select>
    </div>
</div>
@endif
<div class="col-12 mb-5">
    <label class="form-label fw-bold">Observação:</label>
    <textarea name="description" class="form-control form-control-solid" placeholder="Alguma observação sobre este cartão?">@if(isset($content->description)){{$content->description}}@endif</textarea>
</div>

@section('custom-footer')
@parent
<script>
    $(document).ready(function(){

        $(document).on('change', '.select-method', function(){
            // Seleciona o tipo
            var type = $(this).find('option:selected').data('type');

            // Atualiza o tipo de pagamento
            $('[name="method"]').val(type);
        });

    });
</script>
@endsection