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
        <li class="menu-item {{ Route::is('admin-users.view') ? 'active' : '' }}">
            <a href="{{ route('admin-users.view') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div class="text-truncate" data-i18n="Basic">{{ __('messages.users') }}
                </div>
            </a>
        </li>
        <li class="menu-item {{ Route::is('admin-subscription-request') ? 'active' : '' }}">
            <a href="{{ route('admin-subscription-request') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-credit-card"></i>
                <div class="text-truncate" data-i18n="Basic">{{ __('messages.subscription_requests') }}
                </div>
            </a>
        </li>
        <li class="menu-item {{ Route::is('admin-admin.profits') ? 'active' : '' }}">
            <a href="{{ route('admin-admin.profits') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-dollar-circle"></i>
                <div class="text-truncate" data-i18n="Basic">{{ __('messages.profits') }}
                </div>
            </a>
        </li>
        <li class="menu-item {{ Route::is('admin-tickets.view') ? 'active' : '' }}">
            <a href="{{ route('admin-tickets.view') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-purchase-tag-alt"></i>
                <div class="text-truncate" data-i18n="Basic">{{ __('messages.tickets') }}</div>
                @if(isset($unresolved_tickets_count) && $unresolved_tickets_count > 0)
                    <span class="badge rounded-pill bg-danger ms-auto">{{ $unresolved_tickets_count }}</span>
                @endif
            </a>
        </li>
        <li class="menu-item {{ Route::is('admin-settings.view') ? 'active' : '' }}">
            <a href="{{ route('admin-settings.view') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div class="text-truncate" data-i18n="Basic">{{ __('messages.settings') }}</div>
            </a>
        </li>
        <li class="menu-item {{ Route::is('admin-payouts.view') ? 'active' : '' }}">
            <a href="{{ route('admin-payouts.view') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-wallet"></i>
                <div class="text-truncate" data-i18n="Basic">{{ __('messages.payout_requests') }}</div>
            </a>
        </li>

        <li class="menu-item {{ Route::is('profile') ? 'active' : '' }}">
            <a href="{{ route('profile') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-circle"></i>
                <div class="text-truncate" data-i18n="Basic">{{ __('messages.profile') }}</div>
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
