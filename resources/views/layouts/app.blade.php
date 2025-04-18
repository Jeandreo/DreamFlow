<!DOCTYPE html>
<html lang="pt-BR"  data-bs-theme-mode="light" >
    <head>
        @include('layouts.head')
    </head>
    <body  id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true"  class="app-default" data-kt-app-sidebar-minimize="@if(Auth::user()->sidebar){{ 'off' }}@else{{ 'on' }}@endif">
        @include('layouts.config')
        <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
            <div class="app-page  flex-column flex-column-fluid " id="kt_app_page">
                {{-- @include('layouts.header') --}}
                <div class="app-wrapper flex-column flex-row-fluid position-relative mt-0" id="kt_app_wrapper">
                    @include('layouts.sidebar')
                    <div class="app-main flex-column flex-row-fluid">
                        <div class="app-container container-fluid" style="padding: 0px !important;">
                            <div class="row m-0 background-dashboard" style="background-image: url('{{ asset('assets/media/logos/background-pattern.webp') }}'); background-size: cover; margin-bottom: -50px !important;">
                                <div style="background: linear-gradient(0deg, #090c11, #18202bf0);">
                                    <div class="col-12">
                                        <div class="toolbar py-20" id="kt_toolbar">
                                            <div id="kt_toolbar_container" class="container-xxl d-flex justify-content-center">
                                                @include('includes.nav-admin')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container-fluid py-6">
                                @yield('content')
                            </div>
                        </div>
                    </div>
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
                    {{-- @include('layouts.footer') --}}
                    <button id="open_sidebar" class="btn btn-icon btn-danger app-layout-builder-toggle py-4 d-flex d-md-none shadow" style="top: 20px;">
                        <i class="ki-duotone ki-setting-4 fs-1"></i>
                    </button>
                </div>
            </div>
        </div>
        <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
            <i class="ki-duotone ki-arrow-up"><span class="path1"></span><span class="path2"></span></i>
        </div>
		@include('layouts.modals')
        @yield('modals')
        <script>
            var hostUrl = "assets/";
			var globalUrl = "{{ route('dashboard.index') }}";
			var csrf = "{{ csrf_token() }}";
        </script>
        <script src="{{ asset('/assets/plugins/global/plugins.bundle.js') }}"></script>
        <script src="{{ asset('/assets/js/scripts.bundle.js') }}"></script>
		<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/l10n/pt.min.js"></script>
        <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
        <script src="{{ asset('assets/plugins/custom/cropper/cropper.bundle.js') }}"></script>
        <script src="{{ asset('/assets/js/custom.bundle.js?v=2') }}"></script>
        <script src="{{ asset('assets/plugins/custom/ckeditor5/ckeditor-classic.bundle.js') }}"></script>
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
    </body>
</html>
