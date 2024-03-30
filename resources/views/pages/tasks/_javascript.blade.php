<script>
    $(document).on('click', '.show-tasks-fileds', function(){
        $('#card-to-fileds').toggle();
    });

    // SEND NEW TASK
    $(document).on('submit', '.send-tasks', function(e){

        // STOP EVENT
        e.preventDefault();

        // GET TITLE OF TASK
        var inputName = $(this).find('[name="name"]');
        var project = $(this).find('[name="project_id"]').val();

        // AJAX
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: 'POST',
            url: "{{ route('tasks.store') }}",
            data: {project_id: project, name: inputName.val()},
            success: function(data){
                inputName.val('');
            }
        });

    });

    // LOAD SOUND
    var audio = new Audio('{{ asset("assets/media/sounds/task-checked.mp3") }}');

    // SAVE STATUS CHECKED
    $(document).on('click', '.check-task', function(){

        // GET TASK
        var taskId = $(this).data('task');
        var isMain = $(this).hasClass('task-main');
        var subtask = $(this).closest('.task-left-side').find('.input-name');
        var checked = $(this).is(':checked');

        // AJAX
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: 'POST',
            url: "{{ route('tasks.check') }}",
            data: {task_id: taskId},
        });

        // IF TASK MAIN
        if(isMain){
            // SELECT DIV OF TASK
            var taskDiv = $(this).closest('.dmk-div-task');

            // ADD ANIMATION AND REMOVE TASK
            taskDiv.addClass('slide-up');
            setTimeout(function() {
                taskDiv.remove();
            }, 500);

        } else {
            subtask.toggleClass('text-decoration-line-through ');
        }

        // IF CHECKED
        if(checked){
            // PLAY SOUND
            audio.play();
        }

    });

    // SAVE STATUS CHECKED
    $(document).on('click', '.edit-name-task', function(){

        var div = $(this).closest('.div-name-task');

        $(this).toggleClass('fa-pen-to-square fa-eye');

        div.find('.task-name').toggle();
        div.find('.input-name').toggle();

    });

    // SAVE STATUS CHECKED
    $(document).on('click', '.add-subtasks', function(){

        // GET TASK
        var taskId = $(this).data('task');
        var projectId = $(this).data('project');

        // DIV
        var divSubtasks = $(this).closest('.draggable');

        // AJAX
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: 'POST',
            url: "{{ route('tasks.subtask') }}",
            data: {task_id: taskId, project_id: projectId},
            success: function(data){
                divSubtasks.append(data);
            }
        });

    });

    // SHOW INPUT PHRASE
    $(document).on('focus', '.input-name', function(){
        $(this).next('.input-phrase').fadeIn();
    });

    // HIDE INPUT PHRASE
    $(document).on('blur', '.input-phrase input', function(){

        var text = $(this).val().trim();
        if(text == ''){
            $(this).closest('.input-phrase').fadeOut().css('border-bottom', 'dashed 1px #bbbdcb63 !important');
        } else {
            $(this).css('border-bottom', '');
        };
    });

    // UPDATE TITLE AND PHRASE
    $(document).on('change', '.input-name, .task-phrase, .task-description', function(){

        // GET DATA
        var input = $(this).attr('name'); 
        var value = $(this).val();
        var taskId = $(this).data('task');
        
        // IF RENAME TASK
        if(input == 'name'){
            $(this).closest('.div-name-task').find('.task-name').text(value);
        }

        // AJAX
        $.ajax({
            type: 'PUT',
            url: "{!! route('tasks.update.ajax', '') !!}/" + taskId,
            data: {_token: @json(csrf_token()), input: input, value: value},
        });

    });

    // UPDATE TITLE AND PHRASE
    $(document).on('click', '.task-priority', function(){

        // GET TEXT
        var taskId = $(this).data('task');

        // SAVE FLAG
        var flagHtml = $(this).find('i');

        // AJAX
        $.ajax({
            type: 'PUT',
            url: "{{ route('tasks.priority') }}",
            data: {_token: @json(csrf_token()), task_id: taskId},
            success: function(data){

                // ALTERA PRIORIDADE
                if (data == 1){
                    flagHtml.removeClass('text-gray-300').addClass('text-warning');
                } else if (data == 2){
                    flagHtml.removeClass('text-warning ').addClass('text-info');
                } else if (data == 3){
                    flagHtml.removeClass('text-info').addClass('text-danger');
                } else {
                    flagHtml.removeClass('text-danger').addClass('text-gray-300');
                }

            }
        });

    });

    // UPDATE DESIGNATED TASK
    $(document).on('click', '.task-designated', function(){

        // GET TEXT
        var taskId = $(this).data('task');
        var designated = $(this).data('designated');

        // SAVE FLAG
        var img = $(this).closest('.designated-div').find('.designated');

        // AJAX
        $.ajax({
            type: 'PUT',
            url: "{{ route('tasks.designated') }}",
            data: {_token: @json(csrf_token()), task_id: taskId, designated_id: designated},
            success: function(data){
                img.attr('src', data);
            }
        });

    });

    // UPDATE STATUS
    $(document).on('click', '.tasks-status', function(e){
        
        // GET DATA
        var taskId = $(this).data('task');
        var statusId = $(this).data('status');

        // GET ACTUAL STATUS
        var status = $(this).closest('.actual-status');

        // AJAX
        $.ajax({
            type:'PUT',
            url: "{{ route('tasks.status') }}",
            data: {_token: @json(csrf_token()), task_id: taskId, status_id: statusId},
            success:function(data) {
                // CHANGE TO NEW COLOR AND NAME STATUS
                status.find('.status-name').text(data['name']);
                status.css('background', data['color']);
            }
        });

    });

    // UPDATE DATE
    $(document).on('change', '.task-date', function(){

        // GET NEW DATE
        var date = $(this).val();
        var taskId = $(this).data('task');

        // GET ACTUAL DATE
        var currentDate = new Date();
        
        // FORMAT DATE
        var taskDate = new Date(date);

        // Obtenha as datas sem as horas, minutos e segundos
        var taskDateWithoutTime = new Date(taskDate.getFullYear(), taskDate.getMonth(), taskDate.getDate());
        var currentDateWithoutTime = new Date(currentDate.getFullYear(), currentDate.getMonth(), currentDate.getDate());

        // GET DIFERENCE
        var difference = Math.floor((taskDateWithoutTime - currentDateWithoutTime) / (1000 * 60 * 60 * 24));

        // REMOVE PREVIOUS CLASS
        $('.task-date-' + taskId).removeClass('text-danger text-primary text-info text-gray-700');

        // VERIIFY DIFERENCE
        if (difference < 0) {
            $('.task-date-' + taskId).addClass('text-danger');
        } else if (difference == 0) {
            $('.task-date-' + taskId).addClass('text-primary');
        } else if (difference <= 2) {
            $('.task-date-' + taskId).addClass('text-info');
        } else {
            $('.task-date-' + taskId).addClass('text-gray-700');
        }

        // AJAX
        $.ajax({
            type:'PUT',
            url: "{{ route('tasks.date') }}",
            data: {_token: @json(csrf_token()), task_id: taskId, date: date},
        });

    });

    function showTask(id){

        // AJAX
        $.ajax({
            type:'POST',
            url: "{{ route('tasks.show') }}",
            data: {_token: @json(csrf_token()), task_id: id},
            success:function(data) {

                //  REPLACE CONTENT
                $('#load-task').html(data);

                // CHANGE TO NEW COLOR AND NAME STATUS
                $('#modal_task').modal('show');

                // LOAD COMMENTS
                loadComments(id);

                // LOAD EDITOR
                loadEditorText();

            }
        });

    }

    function loadComments(id){

        // AJAX
        $.ajax({
            type:'POST',
            url: "{{ route('comments.show') }}",
            data: {_token: @json(csrf_token()), task_id: id},
            success:function(data) {

                //  REPLACE CONTENT
                $('#results-comments').html(data);

            }
        });

    }

    // SHOW TASK
    $(document).on('submit', '#send-comment', function(e){

        // PARA EVENTO
        e.preventDefault();

        // GET DATA
        var taskId = $(this).data('task');
        var text = $(this).find('[name="text"]').val();

        // AJAX
        $.ajax({
            type:'POST',
            url: "{{ route('comments.store') }}",
            data: {_token: @json(csrf_token()), task_id: taskId, text: text},
            success:function(data) {
                loadComments(taskId);
                textarea.setData('');
                $('#results-comments').scrollTop(0);
            }
        });

    });

    // SHOW TASK
    $(document).on('click', '.destroy-comment', function(e){

        // PARA EVENTO
        e.preventDefault();

        // GET DATA
        var url = $(this).attr('href');
        var taskId = $(this).data('task');

        // AJAX
        $.ajax({
            type:'PUT',
            url: url,
            data: {_token: @json(csrf_token())},
            success:function(data) {
                loadComments(taskId);
            }
        });

    });

    // SHOW TASK
    $(document).on('click', '.show-task', function(){

        // GET DATA
        var taskId = $(this).data('task');

        // EXIBE TASK
        showTask(taskId);

    });

    // SHOW TASK
    $(document).on('click', '.check-day', function(){

        // GET DAY
        var day = $(this).data('day');
        var challenge = $(this).data('challenge');
        var type = $(this).data('type');
        var btnDay = $(this);

        // AJAX
        $.ajax({
            type:'POST',
            url: "{{ route('challenges.check') }}",
            data: {_token: @json(csrf_token()), day: day, challenge: challenge, type: type},
            success:function(data) {

                // UPDATE COLORS
                if(data[0] == true){
                    btnDay.removeClass('bg-primary bg-danger').addClass('bg-success');
                } else {
                    btnDay.removeClass('bg-primary bg-success').addClass('bg-danger');
                }

            }
        });

    });

    // MARK AS CHALLENGE
    $(document).on('change', '[name="challenge"]', function(){

        // GET DAY
        var taskId = $(this).data('task');
        var checked = $(this).is(':checked');

        // AJAX
        $.ajax({
            type:'POST',
            url: "{{ route('tasks.challenge') }}",
            data: {_token: @json(csrf_token()), task_id: taskId, checked: checked},
            success:function(data) {
                console.log(data);
            }
        });

    });

    // SHOW SUBTASKS
    $(document).on('click', '.show-subtasks', function(){

        // GET TASK
        var task = $(this).data('task');

        // SHOW ZONE
        $('.subtasks-zone-' + task).toggle();

    });
</script>