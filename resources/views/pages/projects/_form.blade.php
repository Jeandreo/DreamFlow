<div class="row">
    <div class="@if(isset($content)) col-10 @else col @endif">
        <div class="row">
            <div class="col-3 mb-5">
                <label class="required form-label fw-bold">Nome:</label>
                <input type="text" class="form-control form-control-solid" placeholder="Nome 01" name="name" value="{{ $content->name ?? old('name') }}" required/>
            </div>
            <div class="col-3 mb-5">
                <label class="form-label fw-bold">Sub Nome:</label>
                <input type="text" class="form-control form-control-solid" placeholder="Nome 02" name="sub_name" value="{{ $content->sub_name ?? old('sub_name') }}"/>
            </div>
            <div class="col-3 mb-5">
                <label class="required form-label fw-bold">ISBN:</label>
                <input type="text" class="form-control form-control-solid" placeholder="ISBN" name="isbn" value="{{ $content->isbn ?? old('isbn') }}" required/>
            </div>
            <div class="col-3 mb-5">
                <label class="form-label fw-bold required">Categoria:</label>
                <select class="form-select form-select-solid" name="category_id" data-control="select2" data-placeholder="Categoria" required>
                    <option></option>
                    {{-- @if(isset($categories))
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @if(isset($content) && $category->id == $content->category_id) selected @endif>
                            @if ($category->father)
                                {{ $category->father->name }} >
                            @endif
                            {{ $category->name }}
                        </option>
                        @endforeach
                    @endif --}}
                </select>
            </div>
            <div class="col-12 mb-5">
                <label class="form-label fw-bold">Capa:</label>
                <input class="form-control form-control-solid image-to-crop" type="file" name="capa">
                <input type="hidden" name="cutImage">
            </div>
            <div class="col-12 mb-5">
                <label class="form-label fw-bold">Descrição:</label>
                <textarea name="description" class="form-control form-control-solid" placeholder="Alguma observação sobre este livro?">@if(isset($content->description)){{$content->description}}@endif</textarea>
            </div>
        </div>
    </div>
</div>
