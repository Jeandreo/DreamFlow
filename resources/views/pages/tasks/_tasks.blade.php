@if ($tasks->count())
   @foreach ($tasks as $task)
   <!-- BEGIN:TASK AND SUBTASK -->
   <div class="draggable dmk-div-task" data-task="{{ $task->id }}">
      <div class="d-grid">
         <!-- BEGIN:TASK -->
         <div class="bg-white rounded p-0 d-flex align-items-center justify-content-between mb-2 shadow-list dmk-tasks h-45px task-list task-on-subtask z-index-1" data-task="{{ $task->id }}">
            <div class="d-flex align-items-center justify-content-between w-100 h-100">
               <div class="d-flex align-items-center h-100 w-100">
                  <div style="background: {{ $task->project->color }};" class="rounded-start h-100 d-flex align-items-center color-task task-icons">
                        <div class="form-check form-check-custom form-check-solid py-2 px-5">
                           <input class="form-check-input w-15px h-15px cursor-pointer check-task task-main" data-task="{{ $task->id }}" type="checkbox" value="1" style="border-radius: 3px" @if($task->checked == true) checked @endif/>
                           <i class="fa-solid p-1 fa-list-check fs-5 text-white ms-5 cursor-pointer add-subtasks zoom-hover zoom-hover-03" data-task="{{ $task->id }}" data-project="{{ $task->project->id }}"></i>
                           <i class="fa-solid p-1 fa-copy fs-5 text-white ms-3 cursor-pointer zoom-hover zoom-hover-03"></i>
                           <a href="{{ route('tasks.destroy', $task->id) }}" class="tasks-destroy">
                              <i class="fa-solid p-1 fa-trash-alt fs-5 text-white ms-3 cursor-pointer zoom-hover zoom-hover-03"></i>
                           </a>
                        </div>
                  </div>
                  <div class="d-flex align-items-center h-100 w-100 div-name-task">
                     <label for="rename-task-{{ $task->id }}" class="d-none d-md-flex">
                        <i class="fa-solid fa-pen-to-square text-hover-primary cursor-pointer py-2 w-50px text-center fs-5 edit-name-task" data-task="{{ $task->id }}"></i>
                     </label>
                     <div class="d-block min-w-md-300px w-100 px-3 px-md-0">
                        <p class="text-gray-600 text-hover-primary fs-6 lh-1 fw-normal p-0 mb-1 cursor-pointer border-0 w-100 task-name show-task" style="margin-top: 3px;" data-task="{{ $task->id }}">{{ $task->name }}</p>
                        <input type="text" class="text-gray-600 fs-6 lh-1 fw-normal p-0 m-0 border-0 w-100 input-name" maxlength="80" value="{{ $task->name }}" name="name" data-task="{{ $task->id }}" id="rename-task-{{ $task->id }}" style="display: none; margin-bottom: 1px !important;">
                        <div class="input-phrase" @if($task->phrase == '') style="display: none;" @endif>
                           <input type="text" class="text-gray-500 fs-6 lh-1 fw-normal p-0 m-0 border-0 w-100 fs-7 d-flex task-phrase z-index-9 h-15px mt-n1" maxlength="255" name="phrase" value="{{ $task->phrase }}" @if($task->phrase == '') style="border-bottom: dashed 1px #bbbdcb63 !important;" @endif data-task="{{ $task->id }}">
                        </div>
                     </div>
                  </div>
               </div>
               @if ($task->comments->count())
               <span>
                  <i class="fa-regular fa-comments text-gray-300 p-2 ms-5"></i>
               </span>
               @endif
               <span class="task-priority d-none d-md-flex" data-task="{{ $task->id }}">
               <i class="fa-solid fa-font-awesome p-2 
                  @if ($task->priority == 0)
                  text-gray-300
                  @elseif($task->priority == 1)
                  text-warning
                  @elseif($task->priority == 2)
                  text-info
                  @elseif($task->priority == 3)
                  text-danger
                  @endif
                  cursor-pointer me-5"></i>
               </span>
            </div>
            <div class="d-flex align-items-center h-100 d-none d-md-flex">
               <!-- SEPARATOR -->
               <div class="separator-vertical h-100"></div>
               <!-- SEPARATOR -->
               <div class="w-125px text-center designated-div">
                  <div class="symbol symbol-30px symbol-circle cursor-pointer" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-start">
                     <div class="symbol symbol-25px symbol-circle me-2">
                           <img alt="Pic" src="{{ findImage('users/' . $task->designated_id . '/' . 'perfil-35px.jpg') }}" class="designated">
                     </div>
                     <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-250px py-4" data-kt-menu="true">
                        @foreach ($users as $user)
                        <div class="menu-item px-3">
                           <a href="{{ route('tasks.designated') }}" class="menu-link px-3 py-1 task-designated" data-task="{{ $task->id }}" data-designated="{{ $user->id }}">
                              <div class="cursor-pointer symbol symbol-25px symbol-md-35px">
                                    <div class="symbol symbol-25px symbol-circle me-2">
                                       <img alt="Pic" src="{{ findImage('users/' . $user->id . '/' . 'perfil-35px.jpg') }}">
                                    </div>
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
               <div class="d-flex p-0 align-items-center justify-content-center cursor-pointer h-100 w-150px rounded-0 actual-status" style="background: {{ $task->statusInfo->color }}">
                  <div class="w-100 h-100 d-flex align-items-center justify-content-center" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-start">
                     <p class="text-white fw-bold m-0 status-name">{{ $task->statusInfo->name }}</p>
                     <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-250px py-4" data-kt-menu="true" style="">
                           @foreach ($task->project->statuses as $status)
                           <div class="menu-item px-3 mb-2">
                              <span data-task="{{ $task->id }}" data-status="{{ $status->id }}" class="menu-link px-3 d-block text-center tasks-status" style="background: {{ $status->color }}; color: white">
                              <span class="">{{ $status->name }}</span>
                              </span>
                           </div>
                           @endforeach
                     </div>
                  </div>
               </div>
               <input type="text" class="form-control border-0 form-control-sm flatpickr w-auto text-center w-200px task-date task-date-{{ $task->id }} 
                  
               @if(date('Y-m-d', strtotime($task->date)) == date('Y-m-d'))
                  text-primary
               @elseif(strtotime($task->date) < time())
                  text-danger
               @elseif(\Carbon\Carbon::parse($task->date)->diffInDays() <= 2)
                  text-info
               @else
                  text-gray-700
               @endif" data-task="{{ $task->id }}" placeholder="Prazo da tarefa" value="@if($task->date) {{ date('Y-m-d H:i:s', strtotime($task->date)) }} @endif"/>
               <!-- SEPARATOR -->
               <div class="separator-vertical h-100"></div>
               <!-- SEPARATOR -->
               <div>
                  <i class="fa-solid fa-arrows-to-dot text-hover-primary py-2 px-3 mx-3 fs-6 draggable-handle"></i>
               </div>
            </div>
         </div>
         <!-- END:TASK -->
      </div>
      <!-- BEGIN:SUB-TASK -->
      @foreach ($task->subtasks as $subtask)
      @include('pages.tasks._subtask')
      @endforeach
      </div>
      <!-- END:SUB-TASK -->
   <!-- END:TASK AND SUBTASK -->
   @endforeach
@endif
<div class="no-tasks" @if ($tasks->count()) style="display: none;" @endif>
   <div class="rounded bg-light d-flex align-items-center justify-content-center h-50px">
      <div class="text-center">
         <p class="m-0 text-gray-600 fw-bold text-uppercase">Sem tarefas ainda nesse projeto</p>
      </div>
   </div>
</div>