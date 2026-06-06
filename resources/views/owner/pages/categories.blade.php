<!doctype html>
<html lang="{{ config('app.locale') }}" dir="{{ config('app.locale') === 'ar' ? 'rtl' : 'ltr' }}"
    class="layout-menu-fixed layout-compact">

@include('owner.layout.head')

<link rel="stylesheet" href="{{ asset('css/register/myCstm.css') }}" />
@include('popup')

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="{{route('/')}}" class="app-brand-link">
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
                    <li class="menu-item ">
                        <a href="{{ route('dashboard') }}" class="menu-link">
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

                    <li class="menu-item active">
                        <a href="#" class="menu-link ">
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
                            <!-- Form إضافة category -->
                            <div class="card mb-4 shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title">{{ __('messages.add_category') }}</h5>
                                    <form action="{{ route('category.add') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row g-3">
                                            <div class="col-md-5">
                                                <input type="text" name="name" class="form-control"
                                                    placeholder="{{ __('messages.name') }}" required>
                                            </div>
                                            <div class="col-md-5">
                                                <input type="file" name="image" class="form-control"
                                                    accept="image/*" required>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="submit"
                                                    class="btn btn-primary w-100">{{ __('messages.save') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- جدول عرض categories -->
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title">{{ __('messages.categories_list') }}</h5>
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{ __('messages.name') }}</th>
                                                <th>{{ __('messages.image') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($categories as $category)
                                                <tr>
                                                    <td>{{ $category->id }}</td>
                                                    <td>{{ __('messages.' . $category->name) == 'messages.' . $category->name ? str_replace('_', ' ', $category->name) : __('messages.' . $category->name) }}</td>
                                                    <td>
                                                        <img src="{{ asset($category->path) }}" alt="Image"
                                                            width="60" height="60" class="rounded" loading="lazy">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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

    <!-- Core JS -->

    @include('owner.layout.scripts')
</body>

</html>
