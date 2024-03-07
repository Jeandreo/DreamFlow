<div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'320px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
    <!--begin::Brand-->
    <div class="aside-logo flex-column-auto" id="kt_aside_logo">
       <!--begin::Logo-->
       <a href="../../demo1/dist/index.html">
       <img alt="Logo" src="{{ asset('assets/media/logos/logo-1-dark.svg') }}" class="h-25px logo" />
       </a>
       <!--end::Logo-->
       <!--begin::Aside toggler-->
       <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="aside-minimize">
          <!--begin::Svg Icon | path: icons/duotune/arrows/arr079.svg-->
          <span class="svg-icon svg-icon-1 rotate-180">
             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path opacity="0.5" d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z" fill="black" />
                <path d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z" fill="black" />
             </svg>
          </span>
          <!--end::Svg Icon-->
       </div>
       <!--end::Aside toggler-->
    </div>
    <!--end::Brand-->
    <!--begin::Aside menu-->
    <div class="aside-menu flex-column-fluid">
       <!--begin::Aside Menu-->
       <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">
          <!--begin::Menu-->
          <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true">
             <div class="menu-item">
                <div class="menu-content pb-2">
                   <span class="menu-section text-muted text-uppercase fs-8 ls-1">Dashboard</span>
                </div>
             </div>
             <div class="menu-item">
                <a class="menu-link active" href="{{ route('projects.index') }}">
                   <span class="menu-icon">
                      <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                      <span class="svg-icon svg-icon-2">
                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect x="2" y="2" width="9" height="9" rx="2" fill="black" />
                            <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="black" />
                            <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="black" />
                            <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="black" />
                         </svg>
                      </span>
                      <!--end::Svg Icon-->
                   </span>
                   <span class="menu-title">Painel de Controle</span>
                </a>
             </div>
             <div class="menu-item">
                <a class="menu-link" href="{{ route('projects.index') }}">
                   <span class="menu-icon">
                      <!--begin::Svg Icon | path: icons/duotune/art/art002.svg-->
                      <span class="svg-icon svg-icon-2">
                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                            <path opacity="0.3" d="M8.9 21L7.19999 22.6999C6.79999 23.0999 6.2 23.0999 5.8 22.6999L4.1 21H8.9ZM4 16.0999L2.3 17.8C1.9 18.2 1.9 18.7999 2.3 19.1999L4 20.9V16.0999ZM19.3 9.1999L15.8 5.6999C15.4 5.2999 14.8 5.2999 14.4 5.6999L9 11.0999V21L19.3 10.6999C19.7 10.2999 19.7 9.5999 19.3 9.1999Z" fill="black" />
                            <path d="M21 15V20C21 20.6 20.6 21 20 21H11.8L18.8 14H20C20.6 14 21 14.4 21 15ZM10 21V4C10 3.4 9.6 3 9 3H4C3.4 3 3 3.4 3 4V21C3 21.6 3.4 22 4 22H9C9.6 22 10 21.6 10 21ZM7.5 18.5C7.5 19.1 7.1 19.5 6.5 19.5C5.9 19.5 5.5 19.1 5.5 18.5C5.5 17.9 5.9 17.5 6.5 17.5C7.1 17.5 7.5 17.9 7.5 18.5Z" fill="black" />
                         </svg>
                      </span>
                      <!--end::Svg Icon-->
                   </span>
                   <span class="menu-title">Metas</span>
                </a>
             </div>
             <div class="menu-item">
                <a class="menu-link" href="{{ route('projects.index') }}">
                   <span class="menu-icon">
                      <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
                      <span class="svg-icon svg-icon-2">
                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z" fill="black" />
                            <path d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z" fill="black" />
                         </svg>
                      </span>
                      <!--end::Svg Icon-->
                   </span>
                   <span class="menu-title">Objetivos</span>
                </a>
             </div>
             <div class="menu-item">
                <a class="menu-link" href="{{ route('projects.index') }}">
                   <span class="menu-icon">
                      <!--begin::Svg Icon | path: icons/duotune/layouts/lay010.svg-->
                      <span class="svg-icon svg-icon-2">
                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M20 21H3C2.4 21 2 20.6 2 20V10C2 9.4 2.4 9 3 9H20C20.6 9 21 9.4 21 10V20C21 20.6 20.6 21 20 21Z" fill="black" />
                            <path d="M20 7H3C2.4 7 2 6.6 2 6V3C2 2.4 2.4 2 3 2H20C20.6 2 21 2.4 21 3V6C21 6.6 20.6 7 20 7Z" fill="black" />
                         </svg>
                      </span>
                      <!--end::Svg Icon-->
                   </span>
                   <span class="menu-title">Métricas</span>
                </a>
             </div>
             <div class="menu-item">
                <a class="menu-link" href="{{ asset('../../demo1/dist/landing.html') }}">
                   <span class="menu-icon">
                      <!--begin::Svg Icon | path: icons/duotune/communication/com001.svg-->
                      <span class="svg-icon svg-icon-2">
                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" fill="black" />
                            <path d="M19 10.4C19 10.3 19 10.2 19 10C19 8.9 18.1 8 17 8H16.9C15.6 6.2 14.6 4.29995 13.9 2.19995C13.3 2.09995 12.6 2 12 2C11.9 2 11.8 2 11.7 2C12.4 4.6 13.5 7.10005 15.1 9.30005C15 9.50005 15 9.7 15 10C15 11.1 15.9 12 17 12C17.1 12 17.3 12 17.4 11.9C18.6 13 19.9 14 21.4 14.8C21.4 14.8 21.5 14.8 21.5 14.9C21.7 14.2 21.8 13.5 21.9 12.7C20.9 12.1 19.9 11.3 19 10.4Z" fill="black" />
                            <path d="M12 15C11 13.1 10.2 11.2 9.60001 9.19995C9.90001 8.89995 10 8.4 10 8C10 7.1 9.40001 6.39998 8.70001 6.09998C8.40001 4.99998 8.20001 3.90005 8.00001 2.80005C7.30001 3.10005 6.70001 3.40002 6.20001 3.90002C6.40001 4.80002 6.50001 5.6 6.80001 6.5C6.40001 6.9 6.10001 7.4 6.10001 8C6.10001 9 6.80001 9.8 7.80001 10C8.30001 11.6 9.00001 13.2 9.70001 14.7C7.10001 13.2 4.70001 11.5 2.40001 9.5C2.20001 10.3 2.10001 11.1 2.10001 11.9C4.60001 13.9 7.30001 15.7 10.1 17.2C10.2 18.2 11 19 12 19C12.6 20 13.2 20.9 13.9 21.8C14.6 21.7 15.3 21.5 15.9 21.2C15.4 20.5 14.9 19.8 14.4 19.1C15.5 19.5 16.5 19.9 17.6 20.2C18.3 19.8 18.9 19.2 19.4 18.6C17.6 18.1 15.7 17.5 14 16.7C13.9 15.8 13.1 15 12 15Z" fill="black" />
                         </svg>
                      </span>
                      <!--end::Svg Icon-->
                   </span>
                   <span class="menu-title">Resultados</span>
                </a>
             </div>
             <div class="menu-item">
                 <div class="menu-content pt-8 pb-2">
                    <span class="menu-section text-muted text-uppercase fs-8 ls-1">Projetos</span>
                 </div>
             </div>
             <div class="menu menu-rounded menu-column px-4">
                <!--begin::Heading-->
                <!--end::Heading-->
                <!--begin::Menu Item-->
                <div class="menu-item">
                   <!--begin::Menu link-->
                   <a class="menu-link" href="/metronic8/demo36/apps/projects/project.html">
                      <!--begin::Bullet--> 
                      <span class="menu-icon">
                      <span class="bullet bullet-dot h-10px w-10px bg-primary">
                      </span>
                      </span>                      
                      <!--end::Bullet--> 
                      <!--begin::Title-->
                      <span class="menu-title">
                      Google Ads                </span>
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
                <!--begin::Menu Item-->
                <div class="menu-item">
                   <!--begin::Menu link-->
                   <a class="menu-link" href="/metronic8/demo36/apps/projects/targets.html">
                      <!--begin::Bullet--> 
                      <span class="menu-icon">
                      <span class="bullet bullet-dot h-10px w-10px bg-success">
                      </span>
                      </span>                      
                      <!--end::Bullet--> 
                      <!--begin::Title-->
                      <span class="menu-title">
                      AirStoke App                </span>
                      <!--end::Title-->
                      <!--begin::Badge--> 
                      <span class="menu-badge">
                      <span class="badge badge-custom">
                      2                    </span>
                      </span>                      
                      <!--end::Badge-->                                      
                   </a>
                   <!--end::Menu link-->                
                </div>
                <!--end::Menu Item-->
                <!--begin::Menu Item-->
                <div class="menu-item">
                   <!--begin::Menu link-->
                   <a class="menu-link" href="/metronic8/demo36/apps/projects/budget.html">
                      <!--begin::Bullet--> 
                      <span class="menu-icon">
                      <span class="bullet bullet-dot h-10px w-10px bg-warning">
                      </span>
                      </span>                      
                      <!--end::Bullet--> 
                      <!--begin::Title-->
                      <span class="menu-title">
                      Internal Tasks                </span>
                      <!--end::Title-->
                      <!--begin::Badge--> 
                      <span class="menu-badge">
                      <span class="badge badge-custom">
                      37                    </span>
                      </span>                      
                      <!--end::Badge-->                                      
                   </a>
                   <!--end::Menu link-->                
                </div>
                <!--end::Menu Item-->
                <!--begin::Collapsible items-->
                <div class="menu-inner flex-column collapse show" id="kt_app_sidebar_menu_projects_collapse" style="">
                   <!--begin::Menu Item-->
                   <div class="menu-item">
                      <!--begin::Menu link-->
                      <a class="menu-link" href="/metronic8/demo36/apps/projects/users.html">
                         <!--begin::Bullet--> 
                         <span class="menu-icon">
                         <span class="bullet bullet-dot h-10px w-10px bg-danger">
                         </span>
                         </span>                      
                         <!--end::Bullet--> 
                         <!--begin::Title-->
                         <span class="menu-title">
                         Fitnes App                </span>
                         <!--end::Title-->
                         <!--begin::Badge--> 
                         <span class="menu-badge">
                         <span class="badge badge-custom">
                         3                    </span>
                         </span>                      
                         <!--end::Badge-->                                      
                      </a>
                      <!--end::Menu link-->                
                   </div>
                   <!--end::Menu Item-->
                   <!--begin::Menu Item-->
                   <div class="menu-item">
                      <!--begin::Menu link-->
                      <a class="menu-link" href="/metronic8/demo36/apps/projects/files.html">
                         <!--begin::Bullet--> 
                         <span class="menu-icon">
                         <span class="bullet bullet-dot h-10px w-10px bg-info">
                         </span>
                         </span>                      
                         <!--end::Bullet--> 
                         <!--begin::Title-->
                         <span class="menu-title">
                         Oppo CRM                </span>
                         <!--end::Title-->
                         <!--begin::Badge--> 
                         <span class="menu-badge">
                         <span class="badge badge-custom">
                         12                    </span>
                         </span>                      
                         <!--end::Badge-->                                      
                      </a>
                      <!--end::Menu link-->                
                   </div>
                   <!--end::Menu Item-->
                   <!--begin::Menu Item-->
                   <div class="menu-item">
                      <!--begin::Menu link-->
                      <a class="menu-link" href="/metronic8/demo36/apps/projects/activity.html">
                         <!--begin::Bullet--> 
                         <span class="menu-icon">
                         <span class="bullet bullet-dot h-10px w-10px bg-warning">
                         </span>
                         </span>                      
                         <!--end::Bullet--> 
                         <!--begin::Title-->
                         <span class="menu-title">
                         Finance Dispatch                </span>
                         <!--end::Title-->
                         <!--begin::Badge--> 
                         <span class="menu-badge">
                         <span class="badge badge-custom">
                         25                    </span>
                         </span>                      
                         <!--end::Badge-->                                      
                      </a>
                      <!--end::Menu link-->                
                   </div>
                   <!--end::Menu Item-->
                </div>
                <!--end::Collapsible items-->
             </div>
             <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                   <span class="menu-icon">
                      <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                      <span class="svg-icon svg-icon-2">
                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M21 9V11C21 11.6 20.6 12 20 12H14V8H20C20.6 8 21 8.4 21 9ZM10 8H4C3.4 8 3 8.4 3 9V11C3 11.6 3.4 12 4 12H10V8Z" fill="black" />
                            <path d="M15 2C13.3 2 12 3.3 12 5V8H15C16.7 8 18 6.7 18 5C18 3.3 16.7 2 15 2Z" fill="black" />
                            <path opacity="0.3" d="M9 2C10.7 2 12 3.3 12 5V8H9C7.3 8 6 6.7 6 5C6 3.3 7.3 2 9 2ZM4 12V21C4 21.6 4.4 22 5 22H10V12H4ZM20 12V21C20 21.6 19.6 22 19 22H14V12H20Z" fill="black" />
                         </svg>
                      </span>
                      <!--end::Svg Icon-->
                   </span>
                   <span class="menu-title">Pages</span>
                   <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg">
                   <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                      <span class="menu-link">
                      <span class="menu-bullet">
                      <span class="bullet bullet-dot"></span>
                      </span>
                      <span class="menu-title">Profile</span>
                      <span class="menu-arrow"></span>
                      </span>
                      <div class="menu-sub menu-sub-accordion menu-active-bg">
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/pages/profile/overview.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Overview</span>
                            </a>
                         </div>
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/pages/profile/projects.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Projects</span>
                            </a>
                         </div>
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/pages/profile/campaigns.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Campaigns</span>
                            </a>
                         </div>
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/pages/profile/documents.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Documents</span>
                            </a>
                         </div>
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/pages/profile/connections.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Connections</span>
                            </a>
                         </div>
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/pages/profile/activity.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Activity</span>
                            </a>
                         </div>
                      </div>
                   </div>
                   <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                      <span class="menu-link">
                      <span class="menu-bullet">
                      <span class="bullet bullet-dot"></span>
                      </span>
                      <span class="menu-title">Projects</span>
                      <span class="menu-arrow"></span>
                      </span>
                      <div class="menu-sub menu-sub-accordion menu-active-bg">
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/pages/projects/list.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">My Projects</span>
                            </a>
                         </div>
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/pages/projects/project.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">View Project</span>
                            </a>
                         </div>
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/pages/projects/targets.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Targets</span>
                            </a>
                         </div>
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/pages/projects/budget.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Budget</span>
                            </a>
                         </div>
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/pages/projects/users.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Users</span>
                            </a>
                         </div>
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/pages/projects/files.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Files</span>
                            </a>
                         </div>
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/pages/projects/activity.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Activity</span>
                            </a>
                         </div>
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/pages/projects/settings.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Settings</span>
                            </a>
                         </div>
                      </div>
                   </div>
                   <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                      <span class="menu-link">
                      <span class="menu-bullet">
                      <span class="bullet bullet-dot"></span>
                      </span>
                      <span class="menu-title">Wizards</span>
                      <span class="menu-arrow"></span>
                      </span>
                      <div class="menu-sub menu-sub-accordion menu-active-bg">
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/pages/wizards/horizontal.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Horizontal</span>
                            </a>
                         </div>
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/pages/wizards/vertical.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Vertical</span>
                            </a>
                         </div>
                      </div>
                   </div>
                   <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                      <span class="menu-link">
                      <span class="menu-bullet">
                      <span class="bullet bullet-dot"></span>
                      </span>
                      <span class="menu-title">Search</span>
                      <span class="menu-arrow"></span>
                      </span>
                      <div class="menu-sub menu-sub-accordion menu-active-bg">
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/pages/search/horizontal.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Horizontal</span>
                            </a>
                         </div>
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/pages/search/vertical.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Vertical</span>
                            </a>
                         </div>
                      </div>
                   </div>
                   <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                      <span class="menu-link">
                      <span class="menu-bullet">
                      <span class="bullet bullet-dot"></span>
                      </span>
                      <span class="menu-title">Blog</span>
                      <span class="menu-arrow"></span>
                      </span>
                      <div class="menu-sub menu-sub-accordion menu-active-bg">
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/pages/blog/home.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Blog Home</span>
                            </a>
                         </div>
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/pages/blog/post.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Blog Post</span>
                            </a>
                         </div>
                      </div>
                   </div>
                   <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                      <span class="menu-link">
                      <span class="menu-bullet">
                      <span class="bullet bullet-dot"></span>
                      </span>
                      <span class="menu-title">Company</span>
                      <span class="menu-arrow"></span>
                      </span>
                      <div class="menu-sub menu-sub-accordion menu-active-bg">
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/pages/company/about.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">About Us</span>
                            </a>
                         </div>
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/pages/company/pricing.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Pricing</span>
                            </a>
                         </div>
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/pages/company/contact.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Contact Us</span>
                            </a>
                         </div>
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/pages/company/team.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Our Team</span>
                            </a>
                         </div>
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/pages/company/licenses.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Licenses</span>
                            </a>
                         </div>
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/pages/company/sitemap.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Sitemap</span>
                            </a>
                         </div>
                      </div>
                   </div>
                   <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                      <span class="menu-link">
                      <span class="menu-bullet">
                      <span class="bullet bullet-dot"></span>
                      </span>
                      <span class="menu-title">Careers</span>
                      <span class="menu-arrow"></span>
                      </span>
                      <div class="menu-sub menu-sub-accordion menu-active-bg">
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/pages/careers/list.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Careers List</span>
                            </a>
                         </div>
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/pages/careers/apply.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Careers Apply</span>
                            </a>
                         </div>
                      </div>
                   </div>
                   <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                      <span class="menu-link">
                      <span class="menu-bullet">
                      <span class="bullet bullet-dot"></span>
                      </span>
                      <span class="menu-title">FAQ</span>
                      <span class="menu-arrow"></span>
                      </span>
                      <div class="menu-sub menu-sub-accordion menu-active-bg">
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/pages/faq/classic.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Classic</span>
                            </a>
                         </div>
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/pages/faq/extended.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Extended</span>
                            </a>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
             <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                   <span class="menu-icon">
                      <!--begin::Svg Icon | path: icons/duotune/communication/com013.svg-->
                      <span class="svg-icon svg-icon-2">
                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="black" />
                            <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="black" />
                         </svg>
                      </span>
                      <!--end::Svg Icon-->
                   </span>
                   <span class="menu-title">Account</span>
                   <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg">
                   <div class="menu-item">
                      <a class="menu-link" href="{{ asset('../../demo1/dist/account/overview.html') }}">
                      <span class="menu-bullet">
                      <span class="bullet bullet-dot"></span>
                      </span>
                      <span class="menu-title">Overview</span>
                      </a>
                   </div>
                   <div class="menu-item">
                      <a class="menu-link" href="{{ asset('../../demo1/dist/account/settings.html') }}">
                      <span class="menu-bullet">
                      <span class="bullet bullet-dot"></span>
                      </span>
                      <span class="menu-title">Settings</span>
                      </a>
                   </div>
                   <div class="menu-item">
                      <a class="menu-link" href="{{ asset('../../demo1/dist/account/security.html') }}">
                      <span class="menu-bullet">
                      <span class="bullet bullet-dot"></span>
                      </span>
                      <span class="menu-title">Security</span>
                      </a>
                   </div>
                   <div class="menu-item">
                      <a class="menu-link" href="{{ asset('../../demo1/dist/account/billing.html') }}">
                      <span class="menu-bullet">
                      <span class="bullet bullet-dot"></span>
                      </span>
                      <span class="menu-title">Billing</span>
                      </a>
                   </div>
                   <div class="menu-item">
                      <a class="menu-link" href="{{ asset('../../demo1/dist/account/statements.html') }}">
                      <span class="menu-bullet">
                      <span class="bullet bullet-dot"></span>
                      </span>
                      <span class="menu-title">Statements</span>
                      </a>
                   </div>
                   <div class="menu-item">
                      <a class="menu-link" href="{{ asset('../../demo1/dist/account/referrals.html') }}">
                      <span class="menu-bullet">
                      <span class="bullet bullet-dot"></span>
                      </span>
                      <span class="menu-title">Referrals</span>
                      </a>
                   </div>
                   <div class="menu-item">
                      <a class="menu-link" href="{{ asset('../../demo1/dist/account/api-keys.html') }}">
                      <span class="menu-bullet">
                      <span class="bullet bullet-dot"></span>
                      </span>
                      <span class="menu-title">API Keys</span>
                      </a>
                   </div>
                </div>
             </div>
             <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                   <span class="menu-icon">
                      <!--begin::Svg Icon | path: icons/duotune/technology/teh004.svg-->
                      <span class="svg-icon svg-icon-2">
                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M21 10.7192H3C2.4 10.7192 2 11.1192 2 11.7192C2 12.3192 2.4 12.7192 3 12.7192H6V14.7192C6 18.0192 8.7 20.7192 12 20.7192C15.3 20.7192 18 18.0192 18 14.7192V12.7192H21C21.6 12.7192 22 12.3192 22 11.7192C22 11.1192 21.6 10.7192 21 10.7192Z" fill="black" />
                            <path d="M11.6 21.9192C11.4 21.9192 11.2 21.8192 11 21.7192C10.6 21.4192 10.5 20.7191 10.8 20.3191C11.7 19.1191 12.3 17.8191 12.7 16.3191C12.8 15.8191 13.4 15.4192 13.9 15.6192C14.4 15.7192 14.8 16.3191 14.6 16.8191C14.2 18.5191 13.4 20.1192 12.4 21.5192C12.2 21.7192 11.9 21.9192 11.6 21.9192ZM8.7 19.7192C10.2 18.1192 11 15.9192 11 13.7192V8.71917C11 8.11917 11.4 7.71917 12 7.71917C12.6 7.71917 13 8.11917 13 8.71917V13.0192C13 13.6192 13.4 14.0192 14 14.0192C14.6 14.0192 15 13.6192 15 13.0192V8.71917C15 7.01917 13.7 5.71917 12 5.71917C10.3 5.71917 9 7.01917 9 8.71917V13.7192C9 15.4192 8.4 17.1191 7.2 18.3191C6.8 18.7191 6.9 19.3192 7.3 19.7192C7.5 19.9192 7.7 20.0192 8 20.0192C8.3 20.0192 8.5 19.9192 8.7 19.7192ZM6 16.7192C6.5 16.7192 7 16.2192 7 15.7192V8.71917C7 8.11917 7.1 7.51918 7.3 6.91918C7.5 6.41918 7.2 5.8192 6.7 5.6192C6.2 5.4192 5.59999 5.71917 5.39999 6.21917C5.09999 7.01917 5 7.81917 5 8.71917V15.7192V15.8191C5 16.3191 5.5 16.7192 6 16.7192ZM9 4.71917C9.5 4.31917 10.1 4.11918 10.7 3.91918C11.2 3.81918 11.5 3.21917 11.4 2.71917C11.3 2.21917 10.7 1.91916 10.2 2.01916C9.4 2.21916 8.59999 2.6192 7.89999 3.1192C7.49999 3.4192 7.4 4.11916 7.7 4.51916C7.9 4.81916 8.2 4.91918 8.5 4.91918C8.6 4.91918 8.8 4.81917 9 4.71917ZM18.2 18.9192C18.7 17.2192 19 15.5192 19 13.7192V8.71917C19 5.71917 17.1 3.1192 14.3 2.1192C13.8 1.9192 13.2 2.21917 13 2.71917C12.8 3.21917 13.1 3.81916 13.6 4.01916C15.6 4.71916 17 6.61917 17 8.71917V13.7192C17 15.3192 16.8 16.8191 16.3 18.3191C16.1 18.8191 16.4 19.4192 16.9 19.6192C17 19.6192 17.1 19.6192 17.2 19.6192C17.7 19.6192 18 19.3192 18.2 18.9192Z" fill="black" />
                         </svg>
                      </span>
                      <!--end::Svg Icon-->
                   </span>
                   <span class="menu-title">Authentication</span>
                   <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg">
                   <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                      <span class="menu-link">
                      <span class="menu-bullet">
                      <span class="bullet bullet-dot"></span>
                      </span>
                      <span class="menu-title">Basic Flow</span>
                      <span class="menu-arrow"></span>
                      </span>
                      <div class="menu-sub menu-sub-accordion menu-active-bg">
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/authentication/flows/basic/sign-in.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Sign-in</span>
                            </a>
                         </div>
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/authentication/flows/basic/sign-up.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Sign-up</span>
                            </a>
                         </div>
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/authentication/flows/basic/two-steps.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Two-steps</span>
                            </a>
                         </div>
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/authentication/flows/basic/password-reset.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Password Reset</span>
                            </a>
                         </div>
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/authentication/flows/basic/new-password.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">New Password</span>
                            </a>
                         </div>
                      </div>
                   </div>
                   <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                      <span class="menu-link">
                      <span class="menu-bullet">
                      <span class="bullet bullet-dot"></span>
                      </span>
                      <span class="menu-title">Aside Flow</span>
                      <span class="menu-arrow"></span>
                      </span>
                      <div class="menu-sub menu-sub-accordion menu-active-bg">
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/authentication/flows/aside/sign-in.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Sign-in</span>
                            </a>
                         </div>
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/authentication/flows/aside/sign-up.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Sign-up</span>
                            </a>
                         </div>
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/authentication/flows/aside/two-steps.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Two-steps</span>
                            </a>
                         </div>
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/authentication/flows/aside/password-reset.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Password Reset</span>
                            </a>
                         </div>
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/authentication/flows/aside/new-password.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">New Password</span>
                            </a>
                         </div>
                      </div>
                   </div>
                   <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                      <span class="menu-link">
                      <span class="menu-bullet">
                      <span class="bullet bullet-dot"></span>
                      </span>
                      <span class="menu-title">Dark Flow</span>
                      <span class="menu-arrow"></span>
                      </span>
                      <div class="menu-sub menu-sub-accordion menu-active-bg">
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/authentication/flows/dark/sign-in.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Sign-in</span>
                            </a>
                         </div>
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/authentication/flows/dark/sign-up.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Sign-up</span>
                            </a>
                         </div>
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/authentication/flows/dark/two-steps.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Two-steps</span>
                            </a>
                         </div>
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/authentication/flows/dark/password-reset.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Password Reset</span>
                            </a>
                         </div>
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/authentication/flows/dark/new-password.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">New Password</span>
                            </a>
                         </div>
                      </div>
                   </div>
                   <div class="menu-item">
                      <a class="menu-link" href="{{ asset('../../demo1/dist/authentication/extended/multi-steps-sign-up.html') }}">
                      <span class="menu-bullet">
                      <span class="bullet bullet-dot"></span>
                      </span>
                      <span class="menu-title">Multi-steps Sign-up</span>
                      </a>
                   </div>
                   <div class="menu-item">
                      <a class="menu-link" href="{{ asset('../../demo1/dist/authentication/extended/free-trial-sign-up.html') }}">
                      <span class="menu-bullet">
                      <span class="bullet bullet-dot"></span>
                      </span>
                      <span class="menu-title">Free Trial Sign-up</span>
                      </a>
                   </div>
                   <div class="menu-item">
                      <a class="menu-link" href="{{ asset('../../demo1/dist/authentication/extended/coming-soon.html') }}">
                      <span class="menu-bullet">
                      <span class="bullet bullet-dot"></span>
                      </span>
                      <span class="menu-title">Coming Soon</span>
                      </a>
                   </div>
                   <div class="menu-item">
                      <a class="menu-link" href="{{ asset('../../demo1/dist/authentication/general/welcome.html') }}">
                      <span class="menu-bullet">
                      <span class="bullet bullet-dot"></span>
                      </span>
                      <span class="menu-title">Welcome Message</span>
                      </a>
                   </div>
                   <div class="menu-item">
                      <a class="menu-link" href="{{ asset('../../demo1/dist/authentication/general/verify-email.html') }}">
                      <span class="menu-bullet">
                      <span class="bullet bullet-dot"></span>
                      </span>
                      <span class="menu-title">Verify Email</span>
                      </a>
                   </div>
                   <div class="menu-item">
                      <a class="menu-link" href="{{ asset('../../demo1/dist/authentication/general/password-confirmation.html') }}">
                      <span class="menu-bullet">
                      <span class="bullet bullet-dot"></span>
                      </span>
                      <span class="menu-title">Password Confirmation</span>
                      </a>
                   </div>
                   <div class="menu-item">
                      <a class="menu-link" href="{{ asset('../../demo1/dist/authentication/general/deactivation.html') }}">
                      <span class="menu-bullet">
                      <span class="bullet bullet-dot"></span>
                      </span>
                      <span class="menu-title">Account Deactivation</span>
                      </a>
                   </div>
                   <div class="menu-item">
                      <a class="menu-link" href="{{ asset('../../demo1/dist/authentication/general/error-404.html') }}">
                      <span class="menu-bullet">
                      <span class="bullet bullet-dot"></span>
                      </span>
                      <span class="menu-title">Error 404</span>
                      </a>
                   </div>
                   <div class="menu-item">
                      <a class="menu-link" href="{{ asset('../../demo1/dist/authentication/general/error-500.html') }}">
                      <span class="menu-bullet">
                      <span class="bullet bullet-dot"></span>
                      </span>
                      <span class="menu-title">Error 500</span>
                      </a>
                   </div>
                   <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                      <span class="menu-link">
                      <span class="menu-bullet">
                      <span class="bullet bullet-dot"></span>
                      </span>
                      <span class="menu-title">Email Templates</span>
                      <span class="menu-arrow"></span>
                      </span>
                      <div class="menu-sub menu-sub-accordion menu-active-bg">
                         <div class="menu-item">
                            <a class="menu-link" href="../../demo1/dist/authentication/email/verify-email.html" target="blank">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Verify Email</span>
                            </a>
                         </div>
                         <div class="menu-item">
                            <a class="menu-link" href="../../demo1/dist/authentication/email/invitation.html" target="blank">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Account Invitation</span>
                            </a>
                         </div>
                         <div class="menu-item">
                            <a class="menu-link" href="../../demo1/dist/authentication/email/password-reset.html" target="blank">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Password Reset</span>
                            </a>
                         </div>
                         <div class="menu-item">
                            <a class="menu-link" href="../../demo1/dist/authentication/email/password-change.html" target="blank">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Password Changed</span>
                            </a>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
             <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                   <span class="menu-icon">
                      <!--begin::Svg Icon | path: icons/duotune/art/art009.svg-->
                      <span class="svg-icon svg-icon-2">
                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M21 18.3V4H20H5C4.4 4 4 4.4 4 5V20C10.9 20 16.7 15.6 19 9.5V18.3C18.4 18.6 18 19.3 18 20C18 21.1 18.9 22 20 22C21.1 22 22 21.1 22 20C22 19.3 21.6 18.6 21 18.3Z" fill="black" />
                            <path d="M22 4C22 2.9 21.1 2 20 2C18.9 2 18 2.9 18 4C18 4.7 18.4 5.29995 18.9 5.69995C18.1 12.6 12.6 18.2 5.70001 18.9C5.30001 18.4 4.7 18 4 18C2.9 18 2 18.9 2 20C2 21.1 2.9 22 4 22C4.8 22 5.39999 21.6 5.79999 20.9C13.8 20.1 20.1 13.7 20.9 5.80005C21.6 5.40005 22 4.8 22 4Z" fill="black" />
                         </svg>
                      </span>
                      <!--end::Svg Icon-->
                   </span>
                   <span class="menu-title">Modals</span>
                   <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg">
                   <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                      <span class="menu-link">
                      <span class="menu-bullet">
                      <span class="bullet bullet-dot"></span>
                      </span>
                      <span class="menu-title">General</span>
                      <span class="menu-arrow"></span>
                      </span>
                      <div class="menu-sub menu-sub-accordion menu-active-bg">
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/modals/general/invite-friends.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Invite Friends</span>
                            </a>
                         </div>
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/modals/general/view-users.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">View Users</span>
                            </a>
                         </div>
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/modals/general/select-users.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Select Users</span>
                            </a>
                         </div>
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/modals/general/upgrade-plan.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Upgrade Plan</span>
                            </a>
                         </div>
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/modals/general/share-earn.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Share &amp; Earn</span>
                            </a>
                         </div>
                      </div>
                   </div>
                   <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                      <span class="menu-link">
                      <span class="menu-bullet">
                      <span class="bullet bullet-dot"></span>
                      </span>
                      <span class="menu-title">Forms</span>
                      <span class="menu-arrow"></span>
                      </span>
                      <div class="menu-sub menu-sub-accordion menu-active-bg">
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/modals/forms/new-target.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">New Target</span>
                            </a>
                         </div>
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/modals/forms/new-card.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">New Card</span>
                            </a>
                         </div>
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/modals/forms/new-address.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">New Address</span>
                            </a>
                         </div>
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/modals/forms/create-api-key.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Create API Key</span>
                            </a>
                         </div>
                      </div>
                   </div>
                   <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                      <span class="menu-link">
                      <span class="menu-bullet">
                      <span class="bullet bullet-dot"></span>
                      </span>
                      <span class="menu-title">Wizards</span>
                      <span class="menu-arrow"></span>
                      </span>
                      <div class="menu-sub menu-sub-accordion menu-active-bg">
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/modals/wizards/two-factor-authentication.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Two Factor Auth</span>
                            </a>
                         </div>
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/modals/wizards/create-app.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Create App</span>
                            </a>
                         </div>
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/modals/wizards/create-account.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Create Account</span>
                            </a>
                         </div>
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/modals/wizards/create-project.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Create Project</span>
                            </a>
                         </div>
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/modals/wizards/offer-a-deal.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Offer a Deal</span>
                            </a>
                         </div>
                      </div>
                   </div>
                   <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                      <span class="menu-link">
                      <span class="menu-bullet">
                      <span class="bullet bullet-dot"></span>
                      </span>
                      <span class="menu-title">Search</span>
                      <span class="menu-arrow"></span>
                      </span>
                      <div class="menu-sub menu-sub-accordion menu-active-bg">
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/modals/search/users.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Users</span>
                            </a>
                         </div>
                         <div class="menu-item">
                            <a class="menu-link" href="{{ asset('../../demo1/dist/modals/search/select-location.html') }}">
                            <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Select Location</span>
                            </a>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
             <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                   <span class="menu-icon">
                      <!--begin::Svg Icon | path: icons/duotune/general/gen022.svg-->
                      <span class="svg-icon svg-icon-2">
                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M11.2929 2.70711C11.6834 2.31658 12.3166 2.31658 12.7071 2.70711L15.2929 5.29289C15.6834 5.68342 15.6834 6.31658 15.2929 6.70711L12.7071 9.29289C12.3166 9.68342 11.6834 9.68342 11.2929 9.29289L8.70711 6.70711C8.31658 6.31658 8.31658 5.68342 8.70711 5.29289L11.2929 2.70711Z" fill="black" />
                            <path d="M11.2929 14.7071C11.6834 14.3166 12.3166 14.3166 12.7071 14.7071L15.2929 17.2929C15.6834 17.6834 15.6834 18.3166 15.2929 18.7071L12.7071 21.2929C12.3166 21.6834 11.6834 21.6834 11.2929 21.2929L8.70711 18.7071C8.31658 18.3166 8.31658 17.6834 8.70711 17.2929L11.2929 14.7071Z" fill="black" />
                            <path opacity="0.3" d="M5.29289 8.70711C5.68342 8.31658 6.31658 8.31658 6.70711 8.70711L9.29289 11.2929C9.68342 11.6834 9.68342 12.3166 9.29289 12.7071L6.70711 15.2929C6.31658 15.6834 5.68342 15.6834 5.29289 15.2929L2.70711 12.7071C2.31658 12.3166 2.31658 11.6834 2.70711 11.2929L5.29289 8.70711Z" fill="black" />
                            <path opacity="0.3" d="M17.2929 8.70711C17.6834 8.31658 18.3166 8.31658 18.7071 8.70711L21.2929 11.2929C21.6834 11.6834 21.6834 12.3166 21.2929 12.7071L18.7071 15.2929C18.3166 15.6834 17.6834 15.6834 17.2929 15.2929L14.7071 12.7071C14.3166 12.3166 14.3166 11.6834 14.7071 11.2929L17.2929 8.70711Z" fill="black" />
                         </svg>
                      </span>
                      <!--end::Svg Icon-->
                   </span>
                   <span class="menu-title">Widgets</span>
                   <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg">
                   <div class="menu-item">
                      <a class="menu-link" href="{{ asset('../../demo1/dist/widgets/lists.html') }}">
                      <span class="menu-bullet">
                      <span class="bullet bullet-dot"></span>
                      </span>
                      <span class="menu-title">Lists</span>
                      </a>
                   </div>
                   <div class="menu-item">
                      <a class="menu-link" href="{{ asset('../../demo1/dist/widgets/statistics.html') }}">
                      <span class="menu-bullet">
                      <span class="bullet bullet-dot"></span>
                      </span>
                      <span class="menu-title">Statistics</span>
                      </a>
                   </div>
                   <div class="menu-item">
                      <a class="menu-link" href="{{ asset('../../demo1/dist/widgets/charts.html') }}">
                      <span class="menu-bullet">
                      <span class="bullet bullet-dot"></span>
                      </span>
                      <span class="menu-title">Charts</span>
                      </a>
                   </div>
                   <div class="menu-item">
                      <a class="menu-link" href="{{ asset('../../demo1/dist/widgets/mixed.html') }}">
                      <span class="menu-bullet">
                      <span class="bullet bullet-dot"></span>
                      </span>
                      <span class="menu-title">Mixed</span>
                      </a>
                   </div>
                   <div class="menu-item">
                      <a class="menu-link" href="{{ asset('../../demo1/dist/widgets/tables.html') }}">
                      <span class="menu-bullet">
                      <span class="bullet bullet-dot"></span>
                      </span>
                      <span class="menu-title">Tables</span>
                      </a>
                   </div>
                   <div class="menu-item">
                      <a class="menu-link" href="{{ asset('../../demo1/dist/widgets/feeds.html') }}">
                      <span class="menu-bullet">
                      <span class="bullet bullet-dot"></span>
                      </span>
                      <span class="menu-title">Feeds</span>
                      </a>
                   </div>
                </div>
             </div>
          </div>
          <!--end::Menu-->
       </div>
       <!--end::Aside Menu-->
    </div>
    <!--end::Aside menu-->
    <!--begin::Footer-->
    <div class="aside-footer flex-column-auto pt-5 pb-7 px-5" id="kt_aside_footer">
       <a href="../../demo1/dist/documentation/getting-started.html" class="btn btn-custom btn-primary w-100" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss-="click" title="200+ in-house components and 3rd-party plugins">
          <span class="btn-label">Instagram</span>
          <!--begin::Svg Icon | path: icons/duotune/general/gen005.svg-->
          <span class="svg-icon btn-icon svg-icon-2">
             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM15 17C15 16.4 14.6 16 14 16H8C7.4 16 7 16.4 7 17C7 17.6 7.4 18 8 18H14C14.6 18 15 17.6 15 17ZM17 12C17 11.4 16.6 11 16 11H8C7.4 11 7 11.4 7 12C7 12.6 7.4 13 8 13H16C16.6 13 17 12.6 17 12ZM17 7C17 6.4 16.6 6 16 6H8C7.4 6 7 6.4 7 7C7 7.6 7.4 8 8 8H16C16.6 8 17 7.6 17 7Z" fill="black" />
                <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="black" />
             </svg>
          </span>
          <!--end::Svg Icon-->
       </a>
    </div>
    <!--end::Footer-->
 </div>