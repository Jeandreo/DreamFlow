<div id="kt_app_sidebar" class="app-sidebar  flex-column " style="backgroundw: url('{{ asset('assets/media/images/bg_colors.jpg') }}'); background-size: cover;"
   data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="325px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#open_sidebar"      
   >
   <!--begin::Logo-->
   <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
      <!--begin::Logo image-->
      <a href="{{ route('index') }}">
      <img alt="Logo" src="{{ asset('/assets/media/logos/dreamflow-pb.webp') }}" class="h-35px app-sidebar-logo-default"/>
      <img alt="Logo" src="{{ asset('/assets/media/logos/favicon-pb.webp') }}" class="h-25px app-sidebar-logo-minimize"/>
      </a>
      <!--end::Logo image-->
      <!--begin::Sidebar toggle-->
      <div 
         id="kt_app_sidebar_toggle" 
         class="toggle-sidebar app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary h-30px w-30px position-absolute top-50 start-100 translate-middle rotate @if(Auth::user()->sidebar == false){{ 'active' }}@endif" 
         data-kt-toggle="true" 
         data-kt-toggle-state="active" 
         data-kt-toggle-target="body" 
         data-kt-toggle-name="app-sidebar-minimize"
         >
         <i class="ki-duotone ki-black-left-line fs-3 rotate-180"><span class="path1"></span><span class="path2"></span></i>        
      </div>
      <!--end::Sidebar toggle-->
   </div>
   <!--end::Logo-->
   <!--begin::sidebar menu-->
   <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
      <!--begin::Menu wrapper-->
      <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
         <!--begin::Scroll wrapper-->
         <div
            id="kt_app_sidebar_menu_scroll"
            class="scroll-y my-5 mx-3 overflow-x-hidden"       
            data-kt-scroll="true"
            data-kt-scroll-activate="true"
            data-kt-scroll-height="auto"     
            data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
            data-kt-scroll-wrappers="#kt_app_sidebar_menu" 
            data-kt-scroll-offset="5px"
            data-kt-scroll-save-state="true"
            >
            <!--begin::Menu-->
            <div 
               class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6"       
               id="#kt_app_sidebar_menu"                     
               data-kt-menu="true" 
               data-kt-menu-expand="false"
               >
               <!--begin::Avatar-->
               <div class="aside-user d-flex align-items-sm-center justify-content-center py-5">
                  <!--begin::Symbol-->
                  <div class="symbol symbol-40px mx-2">             
                     <img src="{{ findImage('users/' . Auth::id() . '/' . 'perfil-300px.jpg') }}" alt="">         
                  </div>
                  <!--end::Symbol-->
                  <!--begin::Wrapper-->
                  <div class="aside-user-info flex-row-fluid flex-wrap ms-5">
                     <!--begin::Section-->
                     <div class="d-flex">
                        <!--begin::Info-->                  
                        <div class="flex-grow-1 me-2">
                           <!--begin::Username-->
                           <a href="{{ route('users.edit', Auth::id()) }}" class="text-white text-hover-primary fs-6 fw-bold">{{ Auth::user()->name }}</a>
                           <!--end::Username-->
                           <!--begin::Description-->
                           <span class="text-gray-600 fw-semibold d-block fs-8 mb-1">BORAAAAAAAAA!</span>
                           <!--end::Description-->
                        </div>
                        <!--end::Info-->                   
                        <!--begin::User menu-->        
                        <div class="me-n2">
                           <!--begin::Action-->        
                           <a href="#" class="btn btn-icon btn-sm btn-active-color-primary mt-n2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" data-kt-menu-overflow="true">
                           <i class="ki-duotone ki-setting-2 text-muted fs-1"><span class="path1"></span><span class="path2"></span></i>            
                           </a> 
                           <!--begin::User account menu-->
                           <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
                              <!--begin::Menu item-->
                              <div class="menu-item px-5">
                                 <a href="{{ route('users.edit', Auth::id()) }}" class="menu-link px-5">
                                 Meu Perfil
                                 </a>
                              </div>
                              <!--end::Menu item-->
                              <!--begin::Menu item-->
                              <div class="menu-item px-5">
                                 <a href="{{ route('logout') }}" class="menu-link px-5">
                                 Sair
                                 </a>
                              </div>
                              <!--end::Menu item-->
                           </div>
                           <!--end::User account menu-->
                           <!--end::Action-->
                        </div>
                        <!--end::User menu-->      
                     </div>
                     <!--end::Section-->   
                  </div>
                  <!--end::Wrapper-->                
               </div>
               <!--end::Avatar-->
               <!--begin:Menu item-->
               <div  class="menu-item">
                  <!--begin:Menu link--><a class="menu-link active"  href="{{ route('index') }}"  ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Painél de controle</span></a><!--end:Menu link-->
               </div>
               <!--end:Menu item-->
               <!--begin:Menu item-->
               <div  class="menu-item">
                  <!--begin:Menu link--><a class="menu-link"  href="{{ route('projects.show') }}"  ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Projetos</span></a><!--end:Menu link-->
               </div>
               <!--end:Menu item-->
               <div class="menu menu-rounded menu-column">
                  <!--begin::Heading-->
                  <!--begin:Menu item-->
                  <div  class="menu-item pt-5" >
                     <!--begin:Menu content-->
                     <div  class="menu-content" ><span class="menu-heading fw-bold text-uppercase fs-7">Negócios</span></div>
                     <!--end:Menu content-->
                  </div>
                  <!--end:Menu item-->
                  <!--end::Heading-->
                  @foreach (projects()->where('reminder', false)->where('type', 1)->get() as $project)
                  <!--begin::Menu Item-->
                  <div class="menu-item">
                     <!--begin::Menu link-->
                     <a class="menu-link" href="{{ route('projects.show', $project->id) }}">
                        <!--begin::Bullet--> 
                        <span class="menu-icon">
                        <span class="bullet bullet-dot h-10px w-10px" style="background: {{ $project->color }};">
                        </span>
                        </span>                      
                        <!--end::Bullet--> 
                        <!--begin::Title-->
                        <span class="menu-title">
                        {{ $project->name }}                </span>
                        <!--end::Title-->
                        <!--begin::Badge--> 
                        {{-- <span class="menu-badge">
                           <span class="badge badge-primary">
                              6
                           </span>
                        </span>                       --}}
                        <!--end::Badge-->                                      
                     </a>
                     <!--end::Menu link-->                
                  </div>
                  <!--end::Menu Item-->
                  @endforeach
               </div>
               <!--begin:Menu item-->
               <!--end:Menu item-->
               <div class="menu menu-rounded menu-column mb-6">
                  <!--begin::Heading-->
                  <!--begin:Menu item-->
                  <div  class="menu-item pt-5" >
                     <!--begin:Menu content-->
                     <div  class="menu-content" ><span class="menu-heading fw-bold text-uppercase fs-7">Crescimento</span></div>
                     <!--end:Menu content-->
                  </div>
                  <!--end:Menu item-->
                  <!--end::Heading-->
                  @foreach (projects()->where('reminder', false)->where('type', 2)->get() as $project)
                  <!--begin::Menu Item-->
                  <div class="menu-item">
                     <!--begin::Menu link-->
                     <a class="menu-link" href="{{ route('projects.show', $project->id) }}">
                        <!--begin::Bullet--> 
                        <span class="menu-icon">
                        <span class="bullet bullet-dot h-10px w-10px" style="background: {{ $project->color }};">
                        </span>
                        </span>                      
                        <!--end::Bullet--> 
                        <!--begin::Title-->
                        <span class="menu-title">
                        {{ $project->name }}                </span>
                        <!--end::Title-->
                        <!--begin::Badge--> 
                        <span class="menu-badge">
                        <span class="badge badge-custom">
                        6                    </span>
                        </span>                      
                        <!--end::Badge-->                                      
                     </a>
                     <!--end::Menu link-->                
                  </div>
                  <!--end::Menu Item-->
                  @endforeach
               </div>
               <!--begin:Menu item-->  
               <!--begin:Menu item-->
               <div  data-kt-menu-trigger="click"  class="menu-item menu-accordion" >
                  <!--begin:Menu link-->
                  <span class="menu-link"  >
                     <span  class="menu-icon" >
                        <i class="ki-duotone ki-element-11 fs-2">
                           <span class="path1"></span>
                           <span class="path2"></span>
                           <span class="path3"></span>
                           <span class="path4"></span>
                        </i>
                     </span>
                     <span  class="menu-title" >
                        Configurações
                     </span>
                     <span  class="menu-arrow" ></span>
                  </span>
                  <!--end:Menu link-->
                  <!--begin:Menu sub-->
                  <div  class="menu-sub menu-sub-accordion">
                     <!--begin:Menu item-->
                     <div  class="menu-item">
                        <!--begin:Menu link--><a class="menu-link"  href="{{ route('projects.index') }}"  ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Projetos</span></a><!--end:Menu link-->
                     </div>
                     <!--end:Menu item-->
                     <!--begin:Menu item-->
                     <div  class="menu-item" >
                        <!--begin:Menu link--><a class="menu-link"  href="{{ route('statuses.index') }}"  ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Status</span></a><!--end:Menu link-->
                     </div>
                     <!--end:Menu item-->
                     <!--begin:Menu item-->
                     <div  class="menu-item" >
                        <!--begin:Menu link--><a class="menu-link"  href="{{ route('categories.index') }}"  ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Categorias</span></a><!--end:Menu link-->
                     </div>
                     <!--end:Menu item-->
                     <!--begin:Menu item-->
                     <div  class="menu-item" >
                        <!--begin:Menu link--><a class="menu-link"  href="{{ route('challenges.index') }}"  ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Desafios M/S</span></a><!--end:Menu link-->
                     </div>
                     <!--end:Menu item-->
                     <!--begin:Menu item-->
                     <div  class="menu-item" >
                        <!--begin:Menu link--><a class="menu-link"  href="{{ route('index') }}"  ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Objetivos e Missões</span></a><!--end:Menu link-->
                     </div>
                     <!--end:Menu item--><!--begin:Menu item-->
                     <div  class="menu-item" >
                        <!--begin:Menu link--><a class="menu-link"  href="{{ route('index') }}"  ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Metas Semanais e Mensais</span></a><!--end:Menu link-->
                     </div>
                     <!--end:Menu item--><!--begin:Menu item-->
                     <div  class="menu-item" >
                        <!--begin:Menu link--><a class="menu-link"  href="{{ route('users.index') }}"  ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Usuários</span></a><!--end:Menu link-->
                     </div>
                     <!--end:Menu item-->
                     <div class="row mt-4">
                        <div class="col-6">
                           <a href="{{ route('tasks.others', 'ideias') }}" class="btn btn-dark btn-sm w-100">Ideias</a>
                        </div>
                        <div class="col-6">
                           <a href="{{ route('tasks.others', 'excluidas') }}" class="btn btn-dark btn-sm w-100">Excluídas</a>
                        </div>
                     </div> 
                  </div>
                  <!--end:Menu sub-->
               </div>
               <!--end:Menu item-->     
            </div>
            <!--end::Menu-->
         </div>
         <!--end::Scroll wrapper-->
      </div>
      <!--end::Menu wrapper-->
   </div>
   <!--end::sidebar menu-->
   @if (projects()->where('reminder', true)->first())
   <!--begin::Footer-->
   <div class="app-sidebar-footer flex-column-auto pt-2 pb-6 px-6" id="kt_app_sidebar_footer">
      <a href="{{ route('projects.show', projects()->where('reminder', true)->first()->id) }}" class="btn btn-flex flex-center btn-custom btn-primary overflow-hidden text-nowrap px-0 h-40px w-100">
         <span class="btn-label text-uppercase">
            {{ projects()->where('reminder', true)->first()->name }}
         </span>
         <i class="ki-duotone ki-document btn-icon fs-2 m-0"><span class="path1"></span><span class="path2"></span></i>
      </a>
   </div>
   <!--end::Footer-->   
   @endif 
</div>