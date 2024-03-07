<!DOCTYPE html>
<html lang="pt-BR">
<!--begin::Head-->

<head>
    <title>DreamFlow</title>
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.png') }}" />
    <!--begin::Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@500&family=Marhey&display=swap" rel="stylesheet">
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
</head>

<body class="bg-gray-300">
    <div class="container">
        <div class="row min-vh-100">
            <div class="col-md-5 d-flex align-items-center">
                <!--begin::Form-->
                <form class="form w-100 fv-plugins-bootstrap5 fv-plugins-framework" method="POST" novalidate="novalidate" action="{{ route('login') }}">
                    @csrf
                    <!--begin::Heading-->
                    <div class="text-center mb-11">
                        <img alt="Logo Sulink" title="Logo Sulink" src="{{ asset('assets/media/logos/logo-sulink.svg') }}" class="w-100 h-90px" />
                        <p class="text-gray-800 fw-bold mt-2 fs-5">
                            DREAMFLOW
                        </p>
                    </div>
                    <!--begin::Heading-->
                    <!--begin::Input group--->
                    <div class="fv-row mb-5 mx-5 mx-md-15">
                        <!--begin::Input group-->
                        <div class="fv-row mb-3">
                            <!--begin::Input E-mail-->
                            <div class="form-floating mb-3">
                                <input type="email" maxlength="40" class="form-control menu-bg-se email-field border-gray-600 shadow" id="floatingInput" name="email" placeholder="E-mail" autocomplete="off" style="border: solid 2px;" required />
                                <label for="floatingInput" class="text-gray-700">E-mail</label>
                            </div>
                            <!--end::Input E-mail-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-3">
                            <!--begin::Input-->
                            <!--begin::Input group-->
                            <div class="form-floating position-relative mb-3" data-kt-password-meter="true">
                                <input type="password" maxlength="40" class="form-control menu-bg-se border-gray-600 shadow" id="floatingPassword" name="password" autocomplete="off" placeholder="Senha" style="border: solid 2px;" required/>
                                <label for="floatingPassword" class="text-gray-700">Senha</label>
                                <span
                                    class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                    data-kt-password-meter-control="visibility">
                                    <i class="bi bi-eye-slash fs-2"></i>
                                    <i class="bi bi-eye fs-2 d-none"></i>
                                </span>
                            </div>
                        </div>
                        <!--begin::Actions-->
                        <div class="text-center">
                            <!--begin::Submit button-->
                            <button type="submit" class="btn btn-lg btn-primary fs-3 w-100 my-5 shadow" style="border: solid 2px #1e8fe7;">
                                <span class="indicator-label fw-bolder text-white">{{ __('FAZER LOGIN') }}<i
                                        class="fa-solid fa-user-lock fs-3 ms-3 mirror-icon"></i></span>
                            </button>
                            <!--end::Submit button-->
                        </div>
                        <!--end::Actions-->
                    </div>
                    <!--end::Submit button-->
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
    </div>
    <!--end::Root-->
    <script>
        var hostUrl = "assets/";
    </script>
    <!--begin::Javascript-->
    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src={{ asset('assets/plugins/global/plugins.bundle.js') }}></script>
    <script src={{ asset('assets/js/scripts.bundle.js') }}></script>
    <!--end::Global Javascript Bundle-->
</body>
</html>
