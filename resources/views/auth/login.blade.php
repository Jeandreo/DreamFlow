<!DOCTYPE html>
<html lang="pt-BR" data-bs-theme="light">
    <!--begin::Head-->
    <head>
        @include('layouts.head')
    </head>
    <!--end::Head-->
    <!--begin::Body-->
    <body id="kt_body" class="app-blank" cz-shortcut-listen="true">
        <!--begin::Root-->
        <div class="d-flex flex-column flex-root" id="kt_app_root">
            <!--begin::Authentication - Sign-in -->
            <div class="d-flex flex-column flex-lg-row flex-column-fluid">
                <!--begin::Body-->
                <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1 bg-white">
                    <!--begin::Form-->
                    <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                        <!--begin::Wrapper-->
                        <div class="w-lg-500px p-10">
                            <!--begin::Form-->
                            <form action="{{ route('login') }}" class="form" method="POST">
                                @csrf
                                <div class="text-center mb-10">
                                    <!-- Session Status -->
                                    <x-auth-session-status class="mb-4" :status="session('status')" />
                                </div>
                                <!--begin::Heading-->
                                <div class="text-center mb-11">
                                    <!--begin::Title-->
                                    <h1 class="text-gray-700 fw-bolder mb-3">
                                        ACESSAR DREAMFLOW
                                    </h1>
                                    <!--end::Title-->
                                    <!--begin::Subtitle-->
                                    <div class="text-gray-500 fw-semibold fs-6">
                                        A ferramenta ideal para disparar sua performance!
                                    </div>
                                    <!--end::Subtitle--->
                                </div>
                                <!--begin::Heading-->
                                <!--begin::Login options-->
                                <div class="row g-3 mb-9">
                                    <!--begin::Col-->
                                    <div class="col-md-6">
                                        <!--begin::Google link--->
                                        <a href="#" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                                            <img alt="Logo" src="{{ asset('assets/media/svg/brand-logos/google-icon.svg') }}" class="h-15px me-3">   
                                            Acessar com o Google
                                        </a>
                                        <!--end::Google link--->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6">
                                        <!--begin::Google link--->
                                        <a href="#" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                                        <img alt="Logo" src="{{ asset('assets/media/svg/brand-logos/apple-black.svg') }}" class="theme-light-show h-15px me-3">
                                        Acessar com a Apple
                                        </a>
                                        <!--end::Google link--->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Login options-->
                                <!--begin::Separator-->
                                <div class="separator separator-content my-14">
                                    <span class="w-125px text-gray-500 fw-semibold fs-7">Ou com email</span>
                                </div>
                                <!--end::Separator-->
                                <!--begin::Input group--->
                                <div class="fv-row mb-8 fv-plugins-icon-container">
                                    <!--begin::Email-->
                                    <input type="email" placeholder="E-mail" name="email" autocomplete="off" class="form-control form-control-solid" value="{{ old('email') }}" required> 
                                    <!--end::Email-->
                                </div>
                                <!--end::Input group--->
                                <div class="fv-row mb-3 fv-plugins-icon-container">
                                    <!--begin::Password-->
                                    <div class="position-relative mb-3">
                                        <input class="form-control form-control-lg form-control-solid" type="password" name="password" placeholder="Senha" required />
                                        <!--begin::Visibility toggle-->
                                        <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2 eye-password"
                                            data-kt-password-meter-control="visibility">
                                                <i class="ki-duotone ki-eye-slash fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                                                <i class="ki-duotone ki-eye d-none fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                        </span>
                                        <!--end::Visibility toggle-->
                                    </div>
                                    <!--end::Password-->
                                </div>
                                <!--end::Input group--->
                                <!--end::Input group-->
                                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                                <!--end::Input-->
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                                    <div></div>
                                    <!--begin::Link-->
                                    <a href="#" class="link-primary">
                                    Esqueceu a senha?
                                    </a>
                                    <!--end::Link-->
                                </div>
                                <!--end::Wrapper-->    
                                <!--begin::Submit button-->
                                <div class="d-grid mb-10">
                                    <button type="submit" class="btn btn-primary">
                                        Acessar
                                    </button>
                                </div>
                                <!--end::Submit button-->
                                <!--begin::Sign up-->
                                <div class="text-gray-500 text-center fw-semibold fs-6">
                                    Não é membro ainda?
                                    <a href="authentication/layouts/corporate/sign-up.html" class="link-primary">
                                    Inscreva-se
                                    </a>
                                </div>
                                <!--end::Sign up-->
                            </form>
                            <!--end::Form--> 
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Form-->       
                    <!--begin::Footer-->  
                    <div class="w-lg-500px d-flex flex-stack px-10 mx-auto">
                        <!--begin::Languages-->
                        <div class="me-10">
                            <!--begin::Toggle-->
                            <button class="btn btn-flex btn-link btn-color-gray-700 btn-active-color-primary rotate fs-base" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" data-kt-menu-offset="0px, 0px">
                            <img data-kt-element="current-lang-flag" class="w-20px h-20px rounded me-3" src="{{ asset('assets/media/flags/brazil.svg') }}" alt="">
                            <span data-kt-element="current-lang-name" class="me-1">Português</span>
                            <span class="d-flex flex-center rotate-180">
                            <i class="ki-duotone ki-down fs-5 text-muted m-0"></i>                    </span>
                            </button>
                            <!--end::Toggle-->
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-4 fs-7" data-kt-menu="true" id="kt_auth_lang_menu">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link d-flex px-5" data-kt-lang="English">
                                    <span class="symbol symbol-20px me-4">
                                    <img data-kt-element="lang-flag" class="rounded-1" src="{{ asset('assets/media/flags/brazil.svg') }}" alt="">
                                    </span>
                                    <span data-kt-element="lang-name">Português</span>
                                    </a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link d-flex px-5" data-kt-lang="English">
                                    <span class="symbol symbol-20px me-4">
                                    <img data-kt-element="lang-flag" class="rounded-1" src="{{ asset('assets/media/flags/united-states.svg') }}" alt="">
                                    </span>
                                    <span data-kt-element="lang-name">Inglês</span>
                                    </a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link d-flex px-5" data-kt-lang="Spanish">
                                    <span class="symbol symbol-20px me-4">
                                    <img data-kt-element="lang-flag" class="rounded-1" src="{{ asset('assets/media/flags/spain.svg') }}" alt="">
                                    </span>
                                    <span data-kt-element="lang-name">Espanhol</span>
                                    </a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link d-flex px-5" data-kt-lang="German">
                                    <span class="symbol symbol-20px me-4">
                                    <img data-kt-element="lang-flag" class="rounded-1" src="{{ asset('assets/media/flags/germany.svg') }}" alt="">
                                    </span>
                                    <span data-kt-element="lang-name">Alemão</span>
                                    </a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link d-flex px-5" data-kt-lang="Japanese">
                                    <span class="symbol symbol-20px me-4">
                                    <img data-kt-element="lang-flag" class="rounded-1" src="{{ asset('assets/media/flags/japan.svg') }}" alt="">
                                    </span>
                                    <span data-kt-element="lang-name">Japones</span>
                                    </a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link d-flex px-5" data-kt-lang="French">
                                    <span class="symbol symbol-20px me-4">
                                    <img data-kt-element="lang-flag" class="rounded-1" src="{{ asset('assets/media/flags/france.svg') }}" alt="">
                                    </span>
                                    <span data-kt-element="lang-name">Françes</span>
                                    </a>
                                </div>
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->           
                        </div>
                        <!--end::Languages--> 
                        <!--begin::Links-->
                        <div class="d-flex fw-semibold text-primary fs-base gap-5">
                            <a href="pages/team.html" target="_blank">Termos</a>
                            <a href="pages/pricing/column.html" target="_blank">Planos</a>
                            <a href="pages/contact.html" target="_blank">Fale Conosco</a>
                        </div>
                        <!--end::Links-->
                    </div>
                    <!--end::Footer-->
                </div>
                <!--end::Body-->
                <!--begin::Aside-->
                <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2" style="background-image: url({{ asset('assets/media/images/bg_colors.jpg') }})">
                    <!--begin::Content-->
                    <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">
                        <!--begin::Logo-->
                        <img alt="Logo" src="{{ asset('assets/media/logos/dreamflow-pb.webp') }}" class="h-35px h-lg-50px">
                        <!--end::Logo-->
                        <!--begin::Image-->                
                        <img class="mx-auto w-275px w-md-50 w-xl-700px mb-10 mb-lg-20 mt-10" src="{{ asset('assets/media/images/imagens-login.png') }}" alt="">                 
                        <!--end::Image-->
                        <!--begin::Title-->
                        <h1 class="text-white fs-2qx fw-bolder text-center mb-7"> 
                            Rápido, Fácil e Eficiente
                        </h1>
                        <!--end::Title-->
                        <!--begin::Text-->
                        <div class="text-white fs-base text-center">
                            Esta ferramenta foi desenvolvida por uma pessoa que estava em busca de sua <span class="text-warning fw-bold">melhor versão</span>, utilize-a da maneira que desejar,<br> o objetivo dela é lhe ajudar a chegar mais longe, organizando seus objetivos, metas e avalizando sua performance.
                        </div>
                        <!--end::Text-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Aside-->
            </div>
            <!--end::Authentication - Sign-in-->
        </div>
        <!--end::Root-->
        <!--begin::Javascript-->
        <script>
            var hostUrl = "assets/";        
        </script>
        <!--begin::Global Javascript Bundle(mandatory for all pages)-->
        <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
        <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
        <!--end::Global Javascript Bundle-->
        <!--begin::Custom Javascript(used for this page only)-->
        <script src="{{ asset('assets/js/custom/authentication/sign-in/general.js') }}"></script>
        <script>
           $('.eye-password').click(function(){
                let passwordField = $('[name="password"]');
                let fieldType = passwordField.attr('type') === 'password' ? 'text' : 'password';
                passwordField.attr('type', fieldType);
            });

        </script>
        <!--end::Custom Javascript-->
        <!--end::Javascript-->
        <svg id="SvgjsSvg1001" width="2" height="0" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" style="overflow: hidden; top: -100%; left: -100%; position: absolute; opacity: 0;">
            <defs id="SvgjsDefs1002"></defs>
            <polyline id="SvgjsPolyline1003" points="0,0"></polyline>
            <path id="SvgjsPath1004" d="M0 0 "></path>
        </svg>
    </body>
    <!--end::Body-->
</html>