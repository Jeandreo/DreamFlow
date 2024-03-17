<div id="kt_app_sidebar" class="app-sidebar  flex-column " style="backgroundw: url('{{ asset('assets/media/images/bg_colors.jpg') }}'); background-size: cover;"
   data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle"      
   >
   <!--begin::Logo-->
   <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
      <!--begin::Logo image-->
      <a href="{{ route('index') }}">
      <img alt="Logo" src="{{ asset('/assets/media/logos/default-dark.svg') }}" class="h-25px app-sidebar-logo-default"/>
      <img alt="Logo" src="{{ asset('/assets/media/logos/default-small.svg') }}" class="h-20px app-sidebar-logo-minimize"/>
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
            class="scroll-y my-5 mx-3"       
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
               <!--begin:Menu item-->
               <div  data-kt-menu-trigger="click"  class="menu-item here show menu-accordion" >
                  <!--begin:Menu link--><span class="menu-link"  ><span  class="menu-icon" ><i class="ki-duotone ki-element-11 fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i></span><span  class="menu-title" >Painéis</span><span  class="menu-arrow" ></span></span><!--end:Menu link--><!--begin:Menu sub-->
                  <div  class="menu-sub menu-sub-accordion">
                     <!--begin:Menu item-->
                     <div  class="menu-item">
                        <!--begin:Menu link--><a class="menu-link active"  href="{{ route('projects.index') }}"  ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Projetos</span></a><!--end:Menu link-->
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
                     <div class="menu-inner flex-column collapse " id="kt_app_sidebar_menu_dashboards_collapse">
                        <!--begin:Menu item-->
                        <div  class="menu-item" >
                           <!--begin:Menu link--><a class="menu-link"  href="{{ route('index') }}"  ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Bidding</span></a><!--end:Menu link-->
                        </div>
                        <!--end:Menu item--><!--begin:Menu item-->
                        <div  class="menu-item" >
                           <!--begin:Menu link--><a class="menu-link"  href="{{ route('index') }}"  ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >POS System</span></a><!--end:Menu link-->
                        </div>
                        <!--end:Menu item--><!--begin:Menu item-->
                        <div  class="menu-item" >
                           <!--begin:Menu link--><a class="menu-link"  href="{{ route('index') }}"  ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Call Center</span></a><!--end:Menu link-->
                        </div>
                        <!--end:Menu item--><!--begin:Menu item-->
                        <div  class="menu-item" >
                           <!--begin:Menu link--><a class="menu-link"  href="{{ route('index') }}"  ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Logistics</span></a><!--end:Menu link-->
                        </div>
                        <!--end:Menu item--><!--begin:Menu item-->
                        <div  class="menu-item" >
                           <!--begin:Menu link--><a class="menu-link"  href="{{ route('index') }}"  ><span  class="menu-bullet" ><span class="bullet bullet-dot"></span></span><span  class="menu-title" >Website Analytics</span></a><!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                     </div>
                     <div class="menu-item">
                        <div class="menu-content">
                           <a class="btn btn-flex btn-color-primary d-flex flex-stack fs-base p-0 ms-2 mb-2 toggle collapsible collapsed" data-bs-toggle="collapse" href="#kt_app_sidebar_menu_dashboards_collapse" data-kt-toggle-text="Show Less">
                           <span data-kt-toggle-text-target="true">Show 12 More</span> <i class="ki-duotone ki-minus-square toggle-on fs-2 me-0"><span class="path1"></span><span class="path2"></span></i><i class="ki-duotone ki-plus-square toggle-off fs-2 me-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>                        
                           </a>
                        </div>
                     </div>
                  </div>
                  <!--end:Menu sub-->
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
                  @foreach (projects()->where('type', 1)->get() as $project)
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
               <!--end:Menu item-->
               <div class="menu menu-rounded menu-column">
                  <!--begin::Heading-->
                  <!--begin:Menu item-->
                  <div  class="menu-item pt-5" >
                     <!--begin:Menu content-->
                     <div  class="menu-content" ><span class="menu-heading fw-bold text-uppercase fs-7">Crescimento</span></div>
                     <!--end:Menu content-->
                  </div>
                  <!--end:Menu item-->
                  <!--end::Heading-->
                  @foreach (projects()->where('type', 2)->get() as $project)
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
               <div  class="menu-item pt-5" >
                  <!--begin:Menu content-->
                  <div  class="menu-content" ><span class="menu-heading fw-bold text-uppercase fs-7">Configurações</span></div>
                  <!--end:Menu content-->
               </div>
               <!--end:Menu item--><!--begin:Menu item-->
               <div  class="menu-item" >
                  <!--begin:Menu link--><a class="menu-link"  href="https://preview.keenthemes.com/html/metronic/docs/base/utilities"><span  class="menu-icon" ><i class="ki-duotone ki-rocket fs-2"><span class="path1"></span><span class="path2"></span></i></span><span  class="menu-title" >Objetivos e Missões</span></a><!--end:Menu link-->
               </div><!--begin:Menu item-->
               <div  class="menu-item" >
                  <!--begin:Menu link--><a class="menu-link"  href="https://preview.keenthemes.com/html/metronic/docs/base/utilities"><span  class="menu-icon" ><i class="ki-duotone ki-rocket fs-2"><span class="path1"></span><span class="path2"></span></i></span><span  class="menu-title" >Metas Semanais e Mensais</span></a><!--end:Menu link-->
               </div>
               <!--end:Menu item--><!--begin:Menu item-->
               <div  class="menu-item" >
                  <!--begin:Menu link--><a class="menu-link"  href="{{ route('users.index') }}"><span  class="menu-icon" ><i class="ki-duotone ki-abstract-26 fs-2"><span class="path1"></span><span class="path2"></span></i></span><span  class="menu-title" >Usuários</span></a><!--end:Menu link-->
               </div>
               <!--end:Menu item--><!--begin:Menu item-->
               <div  class="menu-item" >
                  <!--begin:Menu link--><a class="menu-link"  href="{{ route('logout') }}"><span  class="menu-icon" ><i class="ki-duotone ki-code fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i></span><span  class="menu-title" >Sair do sistema</span></a><!--end:Menu link-->
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
   <!--begin::Footer-->
   <div class="app-sidebar-footer flex-column-auto pt-2 pb-6 px-6" id="kt_app_sidebar_footer">
      <a 
         href="https://preview.keenthemes.com/html/metronic/docs" 
         class="btn btn-flex flex-center btn-custom btn-primary overflow-hidden text-nowrap px-0 h-40px w-100" 
         data-bs-toggle="tooltip" 
         data-bs-trigger="hover" 
         data-bs-dismiss-="click" 
         title="200+ in-house components and 3rd-party plugins">
      <span class="btn-label">
      Docs & Components
      </span>
      <i class="ki-duotone ki-document btn-icon fs-2 m-0"><span class="path1"></span><span class="path2"></span></i>    </a>
   </div>
   <!--end::Footer-->    
</div>