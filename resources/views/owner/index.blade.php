<!doctype html>
<html lang="{{ config('app.locale') }}" dir="{{ config('app.locale') === 'ar' ? 'rtl' : 'ltr' }}"
    class="layout-menu-fixed layout-compact">


@include('owner.layout.head')

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="index.html" class="app-brand-link">
                        <span class="app-brand-logo demo">
                            <span class="text-primary">
                                <img style="width: 80%" src="{{ asset('img/logo.jpg') }}">
                            </span>
                        </span>
                    </a>
                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                        <i class="bx bx-chevron-left d-block d-xl-none align-middle"></i>
                    </a>
                </div>

                <div class="menu-divider mt-0"></div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <!-- Dashboards -->
                    <li class="menu-item active">
                        <a href="#" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-smile"></i>
                            <div class="text-truncate" data-i18n="Basic">{{ __('messages.dashboard') }}</div>
                        </a>
                    </li>

                    <li class="menu-item ">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-package"></i>
                            <div class="text-truncate" data-i18n="Dashboards">{{ __('messages.products') }}</div>
                            {{-- <span class="badge rounded-pill bg-danger ms-auto">5</span> --}}
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="{{ route('products.add-view') }}" class="menu-link">
                                    <div class="text-truncate" data-i18n="Analytics">{{ __('messages.add_product') }}
                                    </div>
                                </a>
                            </li>

                            <li class="menu-item">
                                <a href="{{ route('products.view') }}" class="menu-link">
                                    <div class="text-truncate" data-i18n="Analytics">{{ __('messages.view_product') }}
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu-item">
                        <a href="{{route('category.view')}}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-category"></i>
                            <div class="text-truncate" data-i18n="Basic">{{ __('messages.categories') }}</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="{{ route('order.view') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-box"></i>
                            <div class="text-truncate" data-i18n="Basic">{{ __('messages.orders') }}</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="{{ route('wilaya.add-view') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-mail-send"></i>
                            <div class="text-truncate" data-i18n="Basic">{{ __('messages.delivery') }}</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('owner-payouts.view') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-wallet"></i>
                            <div class="text-truncate" data-i18n="Basic">{{ __('messages.payout_requests') }}</div>
                        </a>
                    </li>


                </ul>
                <div class="mt-auto p-3">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger w-100 d-flex align-items-center">
                            <i class="bx bx-log-out me-2"></i>
                            <span>{{ __('messages.logout') }}</span>
                        </button>
                    </form>
                </div>
            </aside>
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
                        <div class="row">

                            <div class="col-xxl-12 col-lg-12 col-md-12 order-1">
                                <div class="row">
                                    <!-- Orders -->
                                    <div class="col-lg-3 col-md-6 col-12 mb-4">
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <a href="{{ route('order.view') }}">
                                                    <div
                                                        class="card-title d-flex align-items-start justify-content-between mb-3">
                                                        <div class="avatar flex-shrink-0">
                                                            <img src="{{ asset('owner/assets/img/icons/unicons/chart-success.png') }}"
                                                                alt="Orders" class="rounded" />
                                                        </div>
                                                    </div>
                                                    <p class="mb-1">{{ __('messages.orders') }}</p>
                                                    <h4 class="card-title mb-2">{{ $orders_number }}</h4>
                                                </a>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- Products -->
                                    <div class="col-lg-3 col-md-6 col-12 mb-4">
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <a href="{{ route('products.view') }}">
                                                    <div
                                                        class="card-title d-flex align-items-start justify-content-between mb-3">
                                                        <div class="avatar flex-shrink-0">
                                                            <img src="{{ asset('owner/assets/img/icons/unicons/product.png') }}"
                                                                alt="Products" class="rounded" />
                                                        </div>
                                                    </div>
                                                    <p class="mb-1">{{ __('messages.products') }}</p>
                                                    <h4 class="card-title mb-2">{{ $products_number }}</h4>
                                                </a>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- Customers -->
                                    <div class="col-lg-3 col-md-6 col-12 mb-4">
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <a href="#">
                                                    <div
                                                        class="card-title d-flex align-items-start justify-content-between mb-3">
                                                        <div class="avatar flex-shrink-0">
                                                            <img src="{{ asset('owner/assets/img/icons/unicons/user.png') }}"
                                                                alt="Customers" class="rounded" />
                                                        </div>
                                                    </div>
                                                    <p class="mb-1">{{ __('messages.customers') }}</p>
                                                    <h4 class="card-title mb-2">{{ $customers_number }}</h4>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Revenue -->
                                    <div class="col-lg-3 col-md-6 col-12 mb-4">
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <a href="#">
                                                    <div
                                                        class="card-title d-flex align-items-start justify-content-between mb-3">
                                                        <div class="avatar flex-shrink-0">
                                                            <img src="{{ asset('owner/assets/img/icons/unicons/wallet-info.png') }}"
                                                                alt="Revenue" class="rounded" />
                                                        </div>
                                                    </div>
                                                    <p class="mb-1">{{ __('messages.revenue') }}</p>
                                                    <h4 class="card-title mb-2 " style="direction: ltr">
                                                        {{ number_format($revenue, 2, ',', ' ') }}
                                                        {{ __('messages.da') }}</h4>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-lg-6 col-md-12 col-6 mb-6">
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <div
                                                    class="card-title d-flex align-items-start justify-content-between mb-4">
                                                    <div class="avatar flex-shrink-0">
                                                        <img src="{{ asset('owner/assets/img/icons/unicons/wallet-info.png') }}"
                                                            alt="wallet info" class="rounded" />
                                                    </div>
                                                    <div class="dropdown">
                                                        <button class="btn p-0" type="button" id="cardOpt6"
                                                            data-bs-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <i
                                                                class="icon-base bx bx-dots-vertical-rounded text-body-secondary"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end"
                                                            aria-labelledby="cardOpt6">
                                                            <a class="dropdown-item" href="javascript:void(0);">View
                                                                More</a>
                                                            <a class="dropdown-item"
                                                                href="javascript:void(0);">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="mb-1">Sales</p>
                                                <h4 class="card-title mb-3">$4,679</h4>
                                                <small class="text-success fw-medium"><i
                                                        class="icon-base bx bx-up-arrow-alt"></i> +28.42%</small>
                                            </div>
                                        </div>
                                    </div> --}}
                            </div>
                        </div>

                        {{-- <div class="col-12 col-md-8 col-lg-12 col-xxl-4 order-3 order-md-2 profile-report">
                                <div class="row">
                                    <div class="col-6 mb-6 payments">
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <div
                                                    class="card-title d-flex align-items-start justify-content-between mb-4">
                                                    <div class="avatar flex-shrink-0">
                                                        <img src="{{ asset('owner/assets/img/icons/unicons/paypal.png') }}"
                                                            alt="paypal" class="rounded" />
                                                    </div>
                                                    <div class="dropdown">
                                                        <button class="btn p-0" type="button" id="cardOpt4"
                                                            data-bs-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <i
                                                                class="icon-base bx bx-dots-vertical-rounded text-body-secondary"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end"
                                                            aria-labelledby="cardOpt4">
                                                            <a class="dropdown-item" href="javascript:void(0);">View
                                                                More</a>
                                                            <a class="dropdown-item"
                                                                href="javascript:void(0);">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="mb-1">Payments</p>
                                                <h4 class="card-title mb-3">$2,456</h4>
                                                <small class="text-danger fw-medium"><i
                                                        class="icon-base bx bx-down-arrow-alt"></i> -14.82%</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-6 transactions">
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <div
                                                    class="card-title d-flex align-items-start justify-content-between mb-4">
                                                    <div class="avatar flex-shrink-0">
                                                        <img src="{{ asset('owner/assets/img/icons/unicons/cc-primary.png') }}"
                                                            alt="Credit Card" class="rounded" />
                                                    </div>
                                                    <div class="dropdown">
                                                        <button class="btn p-0" type="button" id="cardOpt1"
                                                            data-bs-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <i
                                                                class="icon-base bx bx-dots-vertical-rounded text-body-secondary"></i>
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                                            <a class="dropdown-item" href="javascript:void(0);">View
                                                                More</a>
                                                            <a class="dropdown-item"
                                                                href="javascript:void(0);">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="mb-1">Transactions</p>
                                                <h4 class="card-title mb-3">$14,857</h4>
                                                <small class="text-success fw-medium"><i
                                                        class="icon-base bx bx-up-arrow-alt"></i> +28.14%</small>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div> --}}
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

    <!-- Core JS -->

    @include('owner.layout.scripts')
</body>

</html>
