@if ($contents->count())
@foreach ($contents as $content)
<!-- BEGIN:TASK -->
<div class="draggable bg-white rounded p-0 d-flex align-items-center justify-content-between mb-2 shadow-list dmk-tasks h-45px">
    <div class="d-flex align-items-center justify-content-between w-100 h-100">
        <div class="d-flex align-items-center h-100">
            <div style="background: {{ $content->project->color }}" class="rounded-start h-100 w-40px d-flex align-items-center justify-content-center">
            <div class="form-check form-check-custom form-check-solid">
                <input class="form-check-input w-15px h-15px cursor-pointer check-task" data-task="{{ $content->id }}" type="checkbox" value="1" style="border-radius: 3px" @if($content->checked == true) checked @endif/>
            </div>
            </div>
            <div class="d-flex align-items-center h-100">
            <i class="fa-solid fa-ellipsis-vertical text-hover-primary cursor-pointer py-2 px-3 mx-3 fs-3"></i>
                <div class="d-block min-w-600px">
                    <input type="text" class="text-gray-600 fs-6 lh-1 fw-normal p-0 m-0 border-0 w-100 task-name d-flex" value="{{ $content->name }}" name="name" data-task="{{ $content->id }}">
                    <div class="input-phrase" @if($content->phrase == '') style="display: none;" @endif>
                        <input type="text" class="text-gray-500 fs-6 lh-1 fw-normal p-0 m-0 border-0 w-100 fs-7 d-flex task-phrase z-index-9 h-15px mt-n1" maxlength="255" name="phrase" value="{{ $content->phrase }}" @if($content->phrase == '') style="border-bottom: dashed 1px #bbbdcb63 !important;" @endif data-task="{{ $content->id }}">
                    </div>
                </div>
            </div>
        </div>
        <span>
        <i class="fa-solid fa-font-awesome p-1 text-gray-300"></i>
        <i class="fa-solid fa-font-awesome p-1 text-gray-300"></i>
        <i class="fa-solid fa-font-awesome p-1 text-gray-300 me-3"></i>
        </span>
    </div>
    <div class="d-flex align-items-center h-100">
        <!-- SEPARATOR -->
        <div class="separator-vertical h-100"></div>
        <!-- SEPARATOR -->
        <div class="w-125px text-center">
            <div class="symbol symbol-30px symbol-circle cursor-pointer" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-start">
            <img src="https://blog.unyleya.edu.br/wp-content/uploads/2017/12/saiba-como-a-educacao-ajuda-voce-a-ser-uma-pessoa-melhor.jpeg" class="">
            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-250px py-4" data-kt-menu="true">
                <div class="menu-item px-3">
                    <a href="#" class="menu-link px-3 select-user-drop">
                        <div class="cursor-pointer symbol symbol-25px symbol-md-35px">
                        <img src="https://blog.unyleya.edu.br/wp-content/uploads/2017/12/saiba-como-a-educacao-ajuda-voce-a-ser-uma-pessoa-melhor.jpeg" class="rounded img-cover">
                        </div>
                        <span class="ms-4">
                        {{ $content->project->manager->name }}
                        </span>
                    </a>
                </div>
                @foreach ($users as $user)
                <div class="menu-item px-3">
                    <a href="#" class="menu-link px-3">
                        <div class="cursor-pointer symbol symbol-25px symbol-md-35px">
                        <img src="https://blog.unyleya.edu.br/wp-content/uploads/2017/12/saiba-como-a-educacao-ajuda-voce-a-ser-uma-pessoa-melhor.jpeg" class="rounded img-cover">
                        </div>
                        <span class="ms-4">
                        {{ $user->name }}
                        </span>
                    </a>
                </div>
                @endforeach
            </div>
            </div>
        </div>
        <div class="d-flex p-0 align-items-center justify-content-center cursor-pointer h-100 w-150px rounded-0" style="background: #0eade1">
            <div class="w-100 h-100 d-flex align-items-center justify-content-center" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-start">
            <p class="text-white fw-bold m-0 status-name-1260">Solicitações</p>
            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-250px py-4" data-kt-menu="true" style="">
                <div class="menu-item px-3 mb-2">
                    <a href="https://sulink.com.br/public/core/projetos/tarefas/status" data-task-id="1260" data-status-id="9" class="menu-link px-3 d-block text-center select-status-drop" style="background: #2a2a2d; color: white">
                    <span class="">
                    Solicitações
                    </span>
                    </a>
                </div>
                <div class="menu-item px-3 mb-2">
                    <a href="https://sulink.com.br/public/core/projetos/tarefas/status" data-task-id="1260" data-status-id="100" class="menu-link px-3 d-block text-center select-status-drop" style="background: #0eade1; color: white">
                    <span class="">
                    A Fazer
                    </span>
                    </a>
                </div>
                <div class="menu-item px-3 mb-2">
                    <a href="https://sulink.com.br/public/core/projetos/tarefas/status" data-task-id="1260" data-status-id="24" class="menu-link px-3 d-block text-center select-status-drop" style="background: #0041c2; color: white">
                    <span class="">
                    Em Progresso
                    </span>
                    </a>
                </div>
                <div class="menu-item px-3 mb-2">
                    <a href="https://sulink.com.br/public/core/projetos/tarefas/status" data-task-id="1260" data-status-id="25" class="menu-link px-3 d-block text-center select-status-drop" style="background: #ffa200; color: white">
                    <span class="">
                    Em Testes
                    </span>
                    </a>
                </div>
                <div class="menu-item px-3 mb-2">
                    <a href="https://sulink.com.br/public/core/projetos/tarefas/status" data-task-id="1260" data-status-id="26" class="menu-link px-3 d-block text-center select-status-drop" style="background: #07b013; color: white">
                    <span class="">
                    Finalizado
                    </span>
                    </a>
                </div>
                <div class="menu-item px-3 mb-2">
                    <a href="https://sulink.com.br/public/core/projetos/tarefas/status" data-task-id="1260" data-status-id="27" class="menu-link px-3 d-block text-center select-status-drop" style="background: #b0b0b0; color: white">
                    <span class="">
                    Arquivado
                    </span>
                    </a>
                </div>
            </div>
            </div>
        </div>
        <input type="text" class="form-control border-0 form-control-sm flatpickr w-auto text-center w-200px" placeholder="Prazo da tarefa" name="start_date" value="" required/>
        <!-- SEPARATOR -->
        <div class="separator-vertical h-100"></div>
        <!-- SEPARATOR -->
        <div>
            <i class="fa-solid fa-arrows-to-dot text-hover-primary py-2 px-3 mx-3 fs-6 draggable-handle"></i>
        </div>
    </div>
</div>
<!-- END:TASK -->
@endforeach
@else
    <div class="rounded bg-light d-flex align-items-center justify-content-center h-150px">
        <div class="text-center">
            <p class="m-0 text-gray-600 fw-bold text-uppercase">Sem tarefas ainda nesse projeto</p>
        </div>
    </div>
@endif