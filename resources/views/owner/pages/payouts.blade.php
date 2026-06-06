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
                    <li class="menu-item">
                        <a href="{{ route('dashboard') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-smile"></i>
                            <div class="text-truncate" data-i18n="Basic">{{ __('messages.dashboard') }}</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-package"></i>
                            <div class="text-truncate" data-i18n="Dashboards">{{ __('messages.products') }}</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="{{ route('products.add-view') }}" class="menu-link">
                                    <div class="text-truncate" data-i18n="Analytics">{{ __('messages.add_product') }}</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('products.view') }}" class="menu-link">
                                    <div class="text-truncate" data-i18n="Analytics">{{ __('messages.view_product') }}</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu-item">
                        <a href="{{ route('category.view') }}" class="menu-link">
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

                    <li class="menu-item active">
                        <a href="#" class="menu-link">
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
                        @include('popup')

                        <div class="row g-4">
                            <!-- Available Balance & Form -->
                            <div class="col-md-5">
                                <div class="card bg-label-warning shadow-sm border border-2 border-warning mb-4 text-center py-4">
                                    <div class="card-body">
                                        <i class="bx bx-credit-card-front fs-1 mb-2 text-warning"></i>
                                        <h5 class="card-title fw-bold text-dark mb-1">{{ __('messages.available_balance') }}</h5>
                                        <h1 class="display-6 fw-bold text-warning mb-0">{{ number_format($dueCommission, 2) }} DA</h1>
                                    </div>
                                </div>

                                <div class="card shadow-sm border border-2 border-warning-subtle">
                                    <div class="card-header bg-warning-subtle py-3 text-warning d-flex align-items-center">
                                        <i class="bx bx-plus-circle me-2 fs-4"></i>
                                        <h5 class="mb-0 fw-semibold">{{ __('messages.request_withdrawal') }}</h5>
                                    </div>
                                    <div class="card-body pt-4">
                                        <form method="POST" action="{{ route('owner-payouts.store') }}">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="amount" class="form-label fw-bold">{{ __('messages.withdraw_amount') }} (DA)</label>
                                                <input type="number" 
                                                       name="amount" 
                                                       id="amount" 
                                                       class="form-control" 
                                                       placeholder="Minimum: 1 DA" 
                                                       min="1" 
                                                       max="{{ $dueCommission }}" 
                                                       step="0.01" 
                                                       required>
                                            </div>
                                            <div class="mb-4">
                                                <label for="bank_details" class="form-label fw-bold">{{ __('messages.bank_details') }}</label>
                                                <textarea name="bank_details" 
                                                          id="bank_details" 
                                                          rows="3" 
                                                          class="form-control" 
                                                          placeholder="Provide proof/receipt details:&#10;E.g., Sent 500 DA via BaridiMob.&#10;Transaction reference: 998234710&#10;Sender name: John Doe" 
                                                          required></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-warning text-dark w-100" {{ $dueCommission < 1 ? 'disabled' : '' }}>
                                                <i class="bx bx-send me-1"></i> {{ __('messages.send') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Payout History -->
                            <div class="col-md-7">
                                <div class="card shadow-sm border border-2 border-primary-subtle h-100">
                                    <div class="card-header bg-primary-subtle py-3 text-primary d-flex align-items-center">
                                        <i class="bx bx-history me-2 fs-4"></i>
                                        <h5 class="mb-0 fw-semibold">{{ __('messages.payout_requests') }}</h5>
                                    </div>
                                    <div class="card-body pt-4">
                                        <div class="table-responsive text-nowrap">
                                            <table class="table table-striped align-middle">
                                                <thead>
                                                    <tr>
                                                        <th>{{ __('messages.date') }}</th>
                                                        <th>{{ __('messages.amount') }}</th>
                                                        <th>{{ __('messages.status') }}</th>
                                                        <th>{{ __('messages.transaction_id') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($payoutRequests as $payout)
                                                        <tr>
                                                            <td>{{ $payout->created_at->format('Y-m-d H:i') }}</td>
                                                            <td class="fw-bold">{{ number_format($payout->amount, 2) }} DA</td>
                                                            <td>
                                                                @if($payout->status == 'approved')
                                                                    <span class="badge bg-success">{{ __('messages.approved') }}</span>
                                                                @elseif($payout->status == 'rejected')
                                                                    <span class="badge bg-danger">{{ __('messages.rejected') }}</span>
                                                                @else
                                                                    <span class="badge bg-warning text-dark">{{ __('messages.pending') }}</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <span class="text-wrap text-muted" style="max-width: 150px; font-size: 0.85rem;">
                                                                    {{ $payout->admin_notes ?? '-' }}
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="4" class="text-center py-4 text-muted">
                                                                <i class="bx bx-info-circle fs-3 mb-2 d-block"></i> No payouts requested yet.
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
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
