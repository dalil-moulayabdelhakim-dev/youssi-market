<!doctype html>
<html lang="{{ config('app.locale') }}" dir="{{ config('app.locale') === 'ar' ? 'rtl' : 'ltr' }}"
    class="layout-menu-fixed layout-compact">

@include('owner.layout.head')

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @include('owner.layout.sidebar')
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                @include('owner.layout.nav-bar')
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="py-3 mb-4">
                            <span class="text-muted fw-light">{{ __('messages.dashboard') }} /</span> {{ __('messages.parameters') }}
                        </h4>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-4">
                                    <h5 class="card-header">{{ __('messages.language_settings') }}</h5>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label">{{ __('messages.select_language') }}</label>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('lang.switch', 'en') }}" class="btn {{ app()->getLocale() == 'en' ? 'btn-primary' : 'btn-outline-primary' }} d-flex align-items-center gap-2">
                                                        <span class="fi fi-us"></span> English
                                                    </a>
                                                    <a href="{{ route('lang.switch', 'ar') }}" class="btn {{ app()->getLocale() == 'ar' ? 'btn-primary' : 'btn-outline-primary' }} d-flex align-items-center gap-2">
                                                        <span class="fi fi-dz"></span> العربية
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card mb-4">
                                    <h5 class="card-header">{{ __('messages.other_parameters') }}</h5>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="notificationsSwitch" checked>
                                                    <label class="form-check-label" for="notificationsSwitch">{{ __('messages.enable_notifications') }}</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="autoAcceptSwitch">
                                                    <label class="form-check-label" for="autoAcceptSwitch">{{ __('messages.auto_accept_orders') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary mt-3">{{ __('messages.save_parameters') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    @include('owner.layout.footer')
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    @include('owner.layout.scripts')
</body>

</html>
