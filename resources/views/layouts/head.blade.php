<base href="">
<title>@yield('title-page', 'DreamFlow') - Gerenciamento de Tarefas</title>
<meta name="description" content="DreamFlow é a solução definitiva para o gerenciamento eficiente de suas tarefas. Organize, acompanhe e conclua seus projetos com facilidade." />
<meta name="keywords" content="gerenciamento de tarefas, produtividade, organização, software, colaboração, equipe, projetos" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta charset="utf-8" />
<meta property="og:locale" content="pt_BR" />
<meta property="og:type" content="website" />
<meta property="og:title" content="DreamFlow - Gerenciamento de Tarefas Simplificado" />
<meta property="og:url" content="https://dreamake.com.br/" />
<meta property="og:site_name" content="Keenthemes | Metronic" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
<link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />
<!--begin::Fonts-->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
<!--end::Fonts-->
<!--begin::Global Stylesheets Bundle(used by all pages)-->
<link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/custom.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/plugins/custom/cropper/cropper.bundle.css') }}" rel="stylesheet" type="text/css" />
<!--end::Global Stylesheets Bundle-->
<!--begin::Custom Head-->
@yield('custom-head')
<!--end::Custom Head-->