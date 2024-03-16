@if ($contents->count())
   @foreach ($contents as $content)
   <!-- BEGIN:TASK AND SUBTASK -->
   <div class="draggable" data-task="{{ $content->id }}">
      <div class="d-grid">
         <!-- BEGIN:TASK -->
         <div class="bg-white rounded p-0 d-flex align-items-center justify-content-between mb-2 shadow-list dmk-tasks h-45px task-list task-on-subtask z-index-1" data-task="{{ $content->id }}">
            <div class="d-flex align-items-center justify-content-between w-100 h-100">
               <div class="d-flex align-items-center h-100 w-100">
                  <div style="background: {{ $content->project->color }};" class="rounded-start h-100 d-flex align-items-center color-task task-icons">
                        <div class="form-check form-check-custom form-check-solid py-3 px-5">
                           <input class="form-check-input w-15px h-15px cursor-pointer check-task task-main" data-task="{{ $content->id }}" type="checkbox" value="1" style="border-radius: 3px" @if($content->checked == true) checked @endif/>
                           <i class="fa-solid fa-list-check fs-5 text-white ms-5 cursor-pointer add-subtasks" data-task="{{ $content->id }}" data-project="{{ $content->project->id }}"></i>
                           <i class="fa-solid fa-copy fs-5 text-white ms-3 cursor-pointer"></i>
                           <i class="fa-solid fa-trash-alt fs-5 text-white ms-3 cursor-pointer"></i>
                        </div>
                  </div>
                  <div class="d-flex align-items-center h-100 w-100">
                     <i class="fa-solid fa-ellipsis-vertical text-hover-primary cursor-pointer py-2 px-3 mx-3 fs-3 show-task" data-task="{{ $content->id }}"></i>
                     <div class="d-block min-w-300px w-100">
                        <input type="text" class="text-gray-600 fs-6 lh-1 fw-normal p-0 m-0 border-0 w-100 task-name d-flex" maxlength="80" value="{{ $content->name }}" name="name" data-task="{{ $content->id }}">
                        <div class="input-phrase" @if($content->phrase == '') style="display: none;" @endif>
                           <input type="text" class="text-gray-500 fs-6 lh-1 fw-normal p-0 m-0 border-0 w-100 fs-7 d-flex task-phrase z-index-9 h-15px mt-n1" maxlength="255" name="phrase" value="{{ $content->phrase }}" @if($content->phrase == '') style="border-bottom: dashed 1px #bbbdcb63 !important;" @endif data-task="{{ $content->id }}">
                        </div>
                     </div>
                  </div>
               </div>
               <span class="task-priority" data-task="{{ $content->id }}">
               <i class="fa-solid fa-font-awesome p-2 
                  @if ($content->priority == 0)
                  text-gray-300
                  @elseif($content->priority == 1)
                  text-warning
                  @elseif($content->priority == 2)
                  text-info
                  @elseif($content->priority == 3)
                  text-danger
                  @endif
                  cursor-pointer me-5"></i>
               </span>
            </div>
            <div class="d-flex align-items-center h-100">
               <!-- SEPARATOR -->
               <div class="separator-vertical h-100"></div>
               <!-- SEPARATOR -->
               <div class="w-125px text-center designated-div">
                  <div class="symbol symbol-30px symbol-circle cursor-pointer" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-start">
                     <div class="symbol symbol-25px symbol-circle me-2">
                           <img alt="Pic" src="{{ findImage('users/' . $content->designated_id . '/' . 'perfil-35px.jpg') }}" class="designated">
                     </div>
                     <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-250px py-4" data-kt-menu="true">
                        @foreach ($users as $user)
                        <div class="menu-item px-3">
                           <a href="{{ route('tasks.designated') }}" class="menu-link px-3 py-1 task-designated" data-task="{{ $content->id }}" data-designated="{{ $user->id }}">
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
               <div class="d-flex p-0 align-items-center justify-content-center cursor-pointer h-100 w-150px rounded-0 actual-status" style="background: {{ $content->statusInfo->color }}">
                  <div class="w-100 h-100 d-flex align-items-center justify-content-center" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-start">
                     <p class="text-white fw-bold m-0 status-name">{{ $content->statusInfo->name }}</p>
                     <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-250px py-4" data-kt-menu="true" style="">
                           @foreach ($content->project->statuses as $status)
                           <div class="menu-item px-3 mb-2">
                              <span data-task="{{ $content->id }}" data-status="{{ $status->id }}" class="menu-link px-3 d-block text-center tasks-status" style="background: {{ $status->color }}; color: white">
                              <span class="">{{ $status->name }}</span>
                              </span>
                           </div>
                           @endforeach
                     </div>
                  </div>
               </div>
               <input type="text" class="form-control border-0 form-control-sm flatpickr w-auto text-center w-200px task-date" data-task="{{ $content->id }}" placeholder="Prazo da tarefa" value="@if($content->date) {{ date('Y-m-d H:i:s', strtotime($content->date)) }} @endif"/>
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
      <!-- END:SUB-TASK -->
      @foreach ($content->subtasks as $subtask)
      @include('pages.tasks._subtask')
      @endforeach
      </div>
      <!-- END:SUB-TASK -->
   </div>
   <!-- END:TASK AND SUBTASK -->
   @endforeach
@endif
<div class="no-tasks" @if ($contents->count()) style="display: none;" @endif>
   <div class="rounded bg-light d-flex align-items-center justify-content-center h-50px">
      <div class="text-center">
         <p class="m-0 text-gray-600 fw-bold text-uppercase">Sem tarefas ainda nesse projeto</p>
      </div>
   </div>
</div>