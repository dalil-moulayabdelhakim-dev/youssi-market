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
