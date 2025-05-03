<div id="meals-today">
    {{-- RESULTS HERE --}}
    {{-- RESULTS HERE --}}
    {{-- RESULTS HERE --}}
</div>

@section('modals')
@parent
<div class="modal fade" data-bs-focus="false" id="modal_add_food">
    <div class="modal-dialog w-md-500px modal-dialog-centered rounded">
        <div class="modal-content">
            <div class="modal-header py-3 bg-dark">
                <h5 class="modal-title text-white">Adicionar alimento</h5>
                <div class="btn btn-icon bg-dark ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x fw-bolder">X</span>
                </div>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" id="send-food-extra">
                    @csrf
                    <input type="hidden" name="meal_id" id="meal-extra-food">
                    <select class="form-select form-select-solid select-ajax mb-2" name="food_id" data-placeholder="Adicionar alimento ao dia">
                        <option></option>
                        {{-- RESULTS HERE --}}
                        {{-- RESULTS HERE --}}
                        {{-- RESULTS HERE --}}
                    </select>
                    <button class="btn btn-success w-100" type="submit">
                        Adicionar Alimento
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-footer')
<script>
    $(document).ready(function(){

        // Carrega seletor AJAX
        selectOptionsAjax();

        loadTodayMeals()

        function loadTodayMeals(){

            // AJAX
            $.ajax({
                type:'GET',
                url: "{{ route('diets.items.index') }}",
                success:function(response) {
                    $('#meals-today').html(response);
                }
            });

        }

        // Desmarca ou marca
        $(document).on('change', '.check-eat', function(){

            // Obtém item da dieta
            var itemId = $(this).val();
            var mealId = $(this).data('meal');
            var eaten = $(this).is(':checked');

            // AJAX
            $.ajax({
                type:'POST',
                url: "{{ route('foods.eat') }}",
                data: {
                    _token: @json(csrf_token()),
                    itemId: itemId,
                    mealId: mealId,
                    eaten: eaten,
                },
                success:function(response) {
                    toastr.success('Olhaaa o shapee vindoo!!!');
                }
            });

        });

        $(document).on('click', '.meal-extra', function(e){

            var mealId = $(this).data('meal');

            $('#meal-extra-food').val(mealId);

        });

        // Desmarca ou marca
        $(document).on('submit', '#send-food-extra', function(e){

            // Para formulário
            e.preventDefault();

            // Obtém item da dieta
            var form = $(this);
            var foodId = $(this).find('[name="food_id"]').val();
            var mealId = $(this).find('[name="meal_id"]').val();

            // AJAX
            $.ajax({
                type:'POST',
                url: "{{ route('foods.eat') }}",
                data: {
                    _token: @json(csrf_token()),
                    itemId: foodId,
                    mealId: mealId,
                    eaten: true,
                    planned: false,
                },
                success:function(response) {
                    $('#modal_add_food').modal('hide');
                    loadTodayMeals();
                }
            });

        });

    });
</script>
@endsection