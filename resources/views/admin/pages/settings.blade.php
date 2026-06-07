<!doctype html>
<html lang="{{ config('app.locale') }}" dir="{{ config('app.locale') === 'ar' ? 'rtl' : 'ltr' }}"
    class="layout-menu-fixed layout-compact">

@include('owner.layout.head')

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @include('admin.layout.sidebar')
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
                        @include('popup')

                        <div class="row g-4">
                            <!-- Global settings / commission rate -->
                            <div class="col-md-4">
                                <div class="card shadow-sm h-100">
                                    <div class="card-header bg-label-primary d-flex align-items-center py-3">
                                        <i class="bx bx-slider me-2 fs-4 text-primary"></i>
                                        <h5 class="mb-0 fw-semibold">{{ __('messages.global_settings') }}</h5>
                                    </div>
                                    <div class="card-body pt-4">
                                        <form method="POST" action="{{ route('admin-settings.update-commission') }}">
                                            @csrf
                                            <div class="mb-4">
                                                <label class="form-label fw-bold" for="default_commission_rate">
                                                    {{ __('messages.default_commission_rate') }}
                                                </label>
                                                <div class="input-group input-group-merge">
                                                    <input type="number" 
                                                           name="default_commission_rate" 
                                                           id="default_commission_rate" 
                                                           class="form-control form-control-lg" 
                                                           value="{{ $admin_info->default_commission_rate ?? 3.00 }}" 
                                                           min="0" 
                                                           max="100" 
                                                           step="0.01" 
                                                           required>
                                                    <span class="input-group-text fw-bold">%</span>
                                                </div>
                                                <small class="text-muted mt-1 d-block text-start">
                                                    Automatically applies as the default commission rate for all new store registrations.
                                                </small>
                                            </div>
                                            <button type="submit" class="btn btn-primary w-100">
                                                <i class="bx bx-save me-1"></i> {{ __('messages.save') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Plan Manager -->
                            <div class="col-md-8">
                                <div class="card shadow-sm">
                                    <div class="card-header bg-label-success d-flex align-items-center py-3">
                                        <i class="bx bx-credit-card me-2 fs-4 text-success"></i>
                                        <h5 class="mb-0 fw-semibold">{{ __('messages.plan_manager') }}</h5>
                                    </div>
                                    <div class="card-body pt-4">
                                        <form method="POST" action="{{ route('admin-settings.update-plans') }}">
                                            @csrf

                                            <div class="nav-align-top mb-4">
                                                <ul class="nav nav-pills mb-3" role="tablist">
                                                    @foreach($plans as $index => $plan)
                                                        <li class="nav-item">
                                                            <button type="button" 
                                                                    class="nav-link {{ $index === 0 ? 'active' : '' }}" 
                                                                    role="tab" 
                                                                    data-bs-toggle="tab" 
                                                                    data-bs-target="#navs-pills-{{ $plan->name }}" 
                                                                    aria-controls="navs-pills-{{ $plan->name }}" 
                                                                    aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                                                                {{ config('app.locale') === 'ar' && $plan->display_name_ar ? $plan->display_name_ar : ($plan->display_name_en ?? ucfirst($plan->name)) }}
                                                            </button>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                                <div class="tab-content border-0 p-0 shadow-none">
                                                    @foreach($plans as $index => $plan)
                                                        <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}" 
                                                             id="navs-pills-{{ $plan->name }}" 
                                                             role="tabpanel">
                                                            
                                                            <input type="hidden" name="plans[{{ $index }}][id]" value="{{ $plan->id }}">
                                                            
                                                            <div class="row g-3">
                                                                <div class="col-md-6">
                                                                    <label class="form-label fw-bold">Display Name (English)</label>
                                                                    <input type="text" 
                                                                           name="plans[{{ $index }}][display_name_en]" 
                                                                           class="form-control" 
                                                                           value="{{ $plan->display_name_en ?? ucfirst($plan->name) . ' Subscription' }}" 
                                                                           required>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label fw-bold">الاسم المعروض (عربي)</label>
                                                                    <input type="text" 
                                                                           name="plans[{{ $index }}][display_name_ar]" 
                                                                           class="form-control text-end" 
                                                                           value="{{ $plan->display_name_ar ?? 'اشتراك ' . $plan->name }}" 
                                                                           required>
                                                                </div>
                                                                <div class="col-12">
                                                                    <label class="form-label fw-bold">Price (DA)</label>
                                                                    <div class="input-group">
                                                                        <input type="number" 
                                                                               name="plans[{{ $index }}][price]" 
                                                                               class="form-control" 
                                                                               value="{{ $plan->price }}" 
                                                                               min="0" 
                                                                               required>
                                                                        <span class="input-group-text">DA</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label fw-bold">{{ __('messages.plan_features') }} (EN)</label>
                                                                    <textarea name="plans[{{ $index }}][features_en]" 
                                                                              class="form-control" 
                                                                              rows="5" 
                                                                              placeholder="Feature 1&#10;Feature 2&#10;Feature 3">{{ $plan->features_en }}</textarea>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label fw-bold">{{ __('messages.plan_features') }} (AR)</label>
                                                                    <textarea name="plans[{{ $index }}][features_ar]" 
                                                                              class="form-control text-end" 
                                                                              rows="5" 
                                                                              placeholder="ميزة 1&#10;ميزة 2&#10;ميزة 3">{{ $plan->features_ar }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <div class="text-end">
                                                <button type="submit" class="btn btn-success">
                                                    <i class="bx bx-save me-1"></i> {{ __('messages.save') }}
                                                </button>
                                            </div>
                                        </form>
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
