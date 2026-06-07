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

                        <div class="card sticky-top mb-3 shadow-sm">
                            <div class="d-flex align-items-center p-3 ">
                                <span class="w-px-22 h-px-22"><i class="icon-base bx bx-search icon-md"></i></span>
                                <input type="text" id="payoutSearch" class="form-control border-0"
                                    placeholder="{{ __('messages.search') }}">
                            </div>
                        </div>

                        <div class="card" id="card-payouts-manager">
                            <div class="card-header d-flex justify-content-between align-items-center no-print">
                                <h5 class="mb-0 fw-semibold">{{ __('messages.payout_manager') }}</h5>
                                <div class="d-flex gap-2">
                                    <button onclick="exportTableToCSV('payouts-table', 'payout_requests_report.csv')" class="btn btn-outline-primary btn-sm">
                                        <i class="bx bx-export me-1"></i> {{ __('messages.export_csv') }}
                                    </button>
                                    <button onclick="printCard('card-payouts-manager')" class="btn btn-outline-danger btn-sm">
                                        <i class="bx bx-printer me-1"></i> {{ __('messages.export_pdf') }}
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive text-nowrap">
                                    <table id="payouts-table" class="table table-striped align-middle">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{ __('messages.store_name') }}</th>
                                                <th>{{ __('messages.amount') }}</th>
                                                <th>{{ __('messages.bank_details') }}</th>
                                                <th>{{ __('messages.date') }}</th>
                                                <th>{{ __('messages.status') }}</th>
                                                <th>{{ __('messages.transaction_id') }}</th>
                                                <th class="no-print">{{ __('messages.actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($payoutRequests as $payout)
                                                <tr>
                                                    <td><b>#{{ $payout->id }}</b></td>
                                                    <td class="fw-bold">{{ optional($payout->store)->name ?? 'N/A' }}</td>
                                                    <td class="text-primary fw-semibold">{{ number_format($payout->amount, 2) }} {{ __('messages.da') }}</td>
                                                    <td>
                                                        <span class="text-wrap d-block" style="max-width: 250px; white-space: normal;">
                                                            {{ $payout->bank_details }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $payout->created_at->format('Y-m-d H:i') }}</td>
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
                                                    <td class="no-print">
                                                        @if($payout->status == 'pending')
                                                            <button class="btn btn-xs btn-success me-1" data-bs-toggle="modal" data-bs-target="#approveModal{{ $payout->id }}">
                                                                <i class="bx bx-check me-1"></i> {{ __('messages.approved') }}
                                                            </button>
                                                            <button class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $payout->id }}">
                                                                <i class="bx bx-x me-1"></i> {{ __('messages.rejected') }}
                                                            </button>
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </td>
                                                </tr>

                                                @if($payout->status == 'pending')
                                                    <!-- Approve Modal -->
                                                    <div class="modal fade" id="approveModal{{ $payout->id }}" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Approve Payout Request #{{ $payout->id }}</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <form method="POST" action="{{ route('admin-payouts.action', $payout->id) }}">
                                                                    @csrf
                                                                    <input type="hidden" name="action" value="approve">
                                                                    <div class="modal-body">
                                                                        <p>You are approving a payout of <b>{{ number_format($payout->amount, 2) }} DA</b> for store <b>{{ optional($payout->store)->name }}</b>.</p>
                                                                        <div class="mb-3">
                                                                            <label for="admin_notes_approve" class="form-label fw-bold">{{ __('messages.transaction_id') }}</label>
                                                                            <input type="text" name="admin_notes" id="admin_notes_approve" class="form-control" placeholder="Enter transaction number, receipt ID, or payment notes...">
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">{{ __('messages.close') }}</button>
                                                                        <button type="submit" class="btn btn-success">Approve &amp; Mark as Paid</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Reject Modal -->
                                                    <div class="modal fade" id="rejectModal{{ $payout->id }}" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Reject Payout Request #{{ $payout->id }}</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <form method="POST" action="{{ route('admin-payouts.action', $payout->id) }}">
                                                                    @csrf
                                                                    <input type="hidden" name="action" value="reject">
                                                                    <div class="modal-body">
                                                                        <p>You are rejecting a payout of <b>{{ number_format($payout->amount, 2) }} DA</b> for store <b>{{ optional($payout->store)->name }}</b>.</p>
                                                                        <div class="mb-3">
                                                                            <label for="admin_notes_reject" class="form-label fw-bold">Reason for Rejection</label>
                                                                            <textarea name="admin_notes" id="admin_notes_reject" rows="3" class="form-control" placeholder="Enter the reason why this withdrawal request was rejected..." required></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">{{ __('messages.close') }}</button>
                                                                        <button type="submit" class="btn btn-danger">Reject Payout Request</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
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

    @include('owner.layout.scripts')

    <script>
        // Real-time search
        document.getElementById('payoutSearch').addEventListener('keyup', function() {
            let value = this.value.toLowerCase();
            let rows = document.querySelectorAll('#payouts-table tbody tr');

            rows.forEach(row => {
                let id = row.cells[0].textContent.toLowerCase();
                let store = row.cells[1].textContent.toLowerCase();
                let details = row.cells[3].textContent.toLowerCase();
                let status = row.cells[5].textContent.toLowerCase();

                // Skip checking modal structures since they are outside tbody rows
                if (id.includes(value) || store.includes(value) || details.includes(value) || status.includes(value)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        });

        // Client-side CSV export
        function exportTableToCSV(tableId, filename) {
            let csv = [];
            let rows = document.querySelectorAll('#' + tableId + ' tr');
            for (let i = 0; i < rows.length; i++) {
                if (rows[i].style.display === 'none') continue;
                let row = [], cols = rows[i].querySelectorAll('td, th');
                for (let j = 0; j < cols.length - 1; j++) { // Skip actions column
                    let data = cols[j].innerText.trim().replace(/(\r\n|\n|\r)/gm, " ");
                    data = data.replace(/"/g, '""');
                    row.push('"' + data + '"');
                }
                csv.push(row.join(','));
            }
            let csvContent = "\ufeff" + csv.join("\n"); // UTF-8 BOM
            let blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
            let link = document.createElement("a");
            if (link.download !== undefined) {
                let url = URL.createObjectURL(blob);
                link.setAttribute("href", url);
                link.setAttribute("download", filename);
                link.style.visibility = 'hidden';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
        }

        // Print card to PDF
        function printCard(cardId) {
            let card = document.getElementById(cardId);
            card.classList.add('print-target-section');
            document.body.classList.add('printing-active');
            
            let printStyle = document.createElement('style');
            printStyle.id = 'print-helper-style';
            printStyle.innerHTML = `
                @media print {
                    body.printing-active * {
                        visibility: hidden;
                    }
                    body.printing-active .print-target-section,
                    body.printing-active .print-target-section * {
                        visibility: visible;
                    }
                    body.printing-active .print-target-section {
                        position: absolute;
                        left: 0;
                        top: 0;
                        width: 100%;
                        box-shadow: none !important;
                        border: none !important;
                    }
                    body.printing-active .no-print {
                        display: none !important;
                    }
                }
            `;
            document.head.appendChild(printStyle);
            window.print();
            
            // Clean up
            card.classList.remove('print-target-section');
            document.body.classList.remove('printing-active');
            document.getElementById('print-helper-style').remove();
        }
    </script>
</body>

</html>
