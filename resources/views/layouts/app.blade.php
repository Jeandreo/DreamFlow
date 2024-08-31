<!DOCTYPE html>
<html lang="pt-BR"  data-bs-theme-mode="light" >
    <!--begin::Head-->
    <head>
        @include('layouts.head')
    </head>
    <!--end::Head-->
    <!--begin::Body-->
    <body  id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true"  class="app-default" data-kt-app-sidebar-minimize="@if(Auth::user()->sidebar){{ 'off' }}@else{{ 'on' }}@endif">
        <!--begin::Theme mode setup on page load-->
        @include('layouts.config')
        <!--end::Theme mode setup on page load-->
        <!--begin::App-->
        <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
            <!--begin::Page-->
            <div class="app-page  flex-column flex-column-fluid " id="kt_app_page">
                <!--begin::Header-->
                {{-- @include('layouts.header') --}}
                <!--end::Header-->   
                <!--begin::Wrapper-->
                <div class="app-wrapper flex-column flex-row-fluid position-relative mt-0" id="kt_app_wrapper">
                    <!--begin::Sidebar-->
                    @include('layouts.sidebar')
                    <!--end::Sidebar-->
                    <!--begin::Main-->
                    <div class="app-main flex-column flex-row-fluid">
                        <div class="@if(!isset($pageClean)) app-container container-fluid py-6 @else px-0 @endif">
                            @yield('content')
                        </div>
                    </div>
                    <!--end:::Main-->
                    <!--begin::Toast-->
                    @if(session('message'))
                    <div class="toast show position-absolute" role="alert" aria-live="assertive" aria-atomic="true" style="right: 30px;top: 30px;">
                        <div class="toast-header">
                            <i class="ki-duotone ki-abstract-39 fs-2 text-primary me-3"><span class="path1"></span><span class="path2"></span></i>
                            <strong class="me-auto">ATENÇÃO</strong>
                            <small>A alguns segundos</small>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                            {{ session('message') }}
                        </div>
                    </div>
                    @endif
                    <!--end:::Toast-->
                    <!--begin::Footer-->
                    {{-- @include('layouts.footer') --}}
                    <!--end::Footer-->     
                    <button id="open_sidebar" class="btn btn-icon btn-dark app-layout-builder-toggle py-4 d-flex d-md-none">
                        <i class="ki-duotone ki-setting-4 fs-1"></i>
                    </button>    
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Page-->
        </div>
        <!--end::App-->
        <!--begin::Scrolltop-->
        <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
            <i class="ki-duotone ki-arrow-up"><span class="path1"></span><span class="path2"></span></i>
        </div>
        <!--end::Scrolltop-->
        <!--begin::Modals-->
		@include('layouts.modals')
        @yield('modals')
		<!--end::Modals-->
        <!--begin::Javascript-->
        <script>
            var hostUrl = "assets/";
			var globalUrl = "{{ route('dashboard.index') }}";
			var csrf = "{{ csrf_token() }}";
        </script>
        <!--begin::Global Javascript Bundle(mandatory for all pages)-->
        <script src="{{ asset('/assets/plugins/global/plugins.bundle.js') }}"></script>
        <script src="{{ asset('/assets/js/scripts.bundle.js') }}"></script>
		<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/l10n/pt.min.js"></script>
        <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
        <script src="{{ asset('assets/plugins/custom/cropper/cropper.bundle.js') }}"></script>
        <script src="{{ asset('/assets/js/custom.bundle.js?v=2') }}"></script>
        <!--end::Global Javascript Bundle-->
        <script>
            // SAVE STATE SIDEBAR
            $(document).on('click', '.toggle-sidebar', function(){
                $.ajax({
                    type:'PUT',
                    url: "{{ route('users.sidebar') }}",
                    data: {_token: @json(csrf_token())},
                });
            });
        </script>
        @yield('custom-footer')
        <!--end::Javascript-->
    </body>
    <!--end::Body-->
</html>