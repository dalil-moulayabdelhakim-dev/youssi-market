<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('/') }}" class="app-brand-link">
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
        <li class="menu-item {{ Route::is('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-smile"></i>
                <div class="text-truncate" data-i18n="Basic">{{ __('messages.dashboard') }}</div>
            </a>
        </li>

        <li class="menu-item {{ Request::is('p/*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-package"></i>
                <div class="text-truncate" data-i18n="Dashboards">{{ __('messages.products') }}</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ Route::is('products.add-view') ? 'active' : '' }}">
                    <a href="{{ route('products.add-view') }}" class="menu-link">
                        <div class="text-truncate" data-i18n="Analytics">{{ __('messages.add_product') }}
                        </div>
                    </a>
                </li>

                <li class="menu-item {{ Route::is('products.view') ? 'active' : '' }}">
                    <a href="{{ route('products.view') }}" class="menu-link">
                        <div class="text-truncate" data-i18n="Analytics">{{ __('messages.view_product') }}
                        </div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item {{ Route::is('category.view') ? 'active' : '' }}">
            <a href="{{ route('category.view') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-category"></i>
                <div class="text-truncate" data-i18n="Basic">{{ __('messages.categories') }}</div>
            </a>
        </li>

        <li class="menu-item {{ Route::is('order.view') ? 'active' : '' }}">
            <a href="{{ route('order.view') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-box"></i>
                <div class="text-truncate" data-i18n="Basic">{{ __('messages.orders') }}</div>
            </a>
        </li>

        <li class="menu-item {{ Route::is('wilaya.add-view') ? 'active' : '' }}">
            <a href="{{ route('wilaya.add-view') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-mail-send"></i>
                <div class="text-truncate" data-i18n="Basic">{{ __('messages.delivery') }}</div>
            </a>
        </li>

        <li class="menu-item {{ Route::is('owner-payouts.view') ? 'active' : '' }}">
            <a href="{{ route('owner-payouts.view') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-wallet"></i>
                <div class="text-truncate" data-i18n="Basic">{{ __('messages.payout_requests') }}</div>
            </a>
        </li>

        @if(Auth::user()->user_type_id == 2)
        <li class="menu-item {{ Route::is('subscribe-view') ? 'active' : '' }}">
            <a href="{{ route('subscribe-view') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-credit-card"></i>
                <div class="text-truncate" data-i18n="Basic">{{ __('messages.subscription_plan') }}</div>
            </a>
        </li>
        @endif

        <li class="menu-item {{ Route::is('profile') ? 'active' : '' }}">
            <a href="{{ route('profile') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div class="text-truncate" data-i18n="Basic">{{ __('messages.profile') }}</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">{{ __('messages.parameters') }}</span>
        </li>

        <li class="menu-item {{ Route::is('parameters.view') ? 'active' : '' }}">
            <a href="{{ route('parameters.view') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div class="text-truncate" data-i18n="Basic">{{ __('messages.parameters') }}</div>
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
