<!doctype html>
<html lang="{{ config('app.locale') }}" dir="{{ config('app.locale') === 'ar' ? 'rtl' : 'ltr' }}"
    class="layout-menu-fixed layout-compact">

@include('owner.layout.head')
<link rel="stylesheet" href="{{ asset('css/register/myCstm.css') }}" />
@include('popup')

<style>
    .preview-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 10px;
    }

    .image-box {
        position: relative;
        width: 100px;
        height: 100px;
    }

    .image-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .remove-btn {
        position: absolute;
        top: -8px;
        right: -8px;
        background-color: red;
        color: white;
        border: none;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        font-size: 14px;
        line-height: 20px;
        text-align: center;
        cursor: pointer;
        z-index: 1;
    }
</style>

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
                        <a href="{{ route('admin-users.view') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-user"></i>
                            <div class="text-truncate" data-i18n="Basic">{{ __('messages.users') }}
                            </div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('admin-subscription-request') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-credit-card"></i>
                            <div class="text-truncate" data-i18n="Basic">{{ __('messages.subscription_requests') }}
                            </div>
                        </a>
                    </li>
                    <li class="menu-item active">
                        <a href="{{ route('admin-admin.profits') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-dollar-circle"></i>
                            <div class="text-truncate" data-i18n="Basic">{{ __('messages.profits') }}</div>
                        </a>
                    </li>
                    <li class="menu-item ">
                        <a href="{{ route('admin-tickets.view') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-purchase-tag-alt"></i>
                            <div class="text-truncate" data-i18n="Basic">{{ __('messages.tickets') }}</div>
                            @if($unresolved_tickets_count > 0)
                                <span class="badge rounded-pill bg-danger ms-auto">{{ $unresolved_tickets_count }}</span>
                            @endif
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('admin-settings.view') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-cog"></i>
                            <div class="text-truncate" data-i18n="Basic">{{ __('messages.settings') }}</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('admin-payouts.view') }}" class="menu-link">
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

                            <div class="col-12 ">

                                <div class="card sticky-top mb-3 shadow-sm">
                                    <div class="d-flex align-items-center p-3 ">
                                        <span class="w-px-22 h-px-22"><i
                                                class="icon-base bx bx-search icon-md"></i></span>
                                        <input type="text" id="storeSearch" class="form-control border-0"
                                            placeholder="{{ __('messages.search') }}">
                                    </div>
                                </div>

                                <div class="nav-align-top mb-4">
                                    <ul class="nav nav-pills mb-3" role="tablist">
                                        <li class="nav-item">
                                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-profits" aria-controls="navs-pills-profits" aria-selected="true">
                                                <i class="bx bx-bar-chart-alt-2 me-1"></i> {{ __('messages.profits') }}
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-subscriptions" aria-controls="navs-pills-subscriptions" aria-selected="false">
                                                <i class="bx bx-history me-1"></i> {{ __('messages.subscription_history') }}
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-commissions" aria-controls="navs-pills-commissions" aria-selected="false">
                                                <i class="bx bx-list-ul me-1"></i> {{ __('messages.commission_logs') }}
                                            </button>
                                        </li>
                                    </ul>
                                    <div class="tab-content border-0 p-0 shadow-none bg-transparent">
                                        <!-- Profits Tab -->
                                        <div class="tab-pane fade show active" id="navs-pills-profits" role="tabpanel">
                                            <div class="card shadow-sm" id="card-profits">
                                                <div class="card-header d-flex justify-content-between align-items-center no-print">
                                                    <h5 class="mb-0 fw-semibold">{{ __('messages.profits') }}</h5>
                                                    <div class="d-flex gap-2">
                                                        <button onclick="exportTableToCSV('stores-table', 'profits_report.csv')" class="btn btn-outline-primary btn-sm">
                                                            <i class="bx bx-export me-1"></i> {{ __('messages.export_csv') }}
                                                        </button>
                                                        <button onclick="printCard('card-profits')" class="btn btn-outline-danger btn-sm">
                                                            <i class="bx bx-printer me-1"></i> {{ __('messages.export_pdf') }}
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive text-nowrap">
                                                        <table id="stores-table" class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>{{ __('messages.store_name') }}</th>
                                                                    <th>{{ __('messages.received_items') }}</th>
                                                                    <th>{{ __('messages.commission_rate') }}</th>
                                                                    <th>{{ __('messages.total_commissions') }}</th>
                                                                    <th>{{ __('messages.withdraw_amount') }}</th>
                                                                    <th>{{ __('messages.available_balance') }}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($storesData as $data)
                                                                    <tr>
                                                                        <td><b>#{{ $data['store']->id }}</b></td>
                                                                        <td>{{ $data['store']->name }}</td>
                                                                        <td>{{ $data['received_items_count'] }}</td>
                                                                        <td>{{ (int) $data['store']->commission_rate }}%</td>
                                                                        <td>{{ number_format($data['total_commission'], 2) }} {{ __('messages.da') }}</td>
                                                                        <td class="text-success fw-semibold">{{ number_format($data['paid_commission'], 2) }} {{ __('messages.da') }}</td>
                                                                        <td class="text-danger fw-bold">{{ number_format($data['due_commission'], 2) }} {{ __('messages.da') }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Subscriptions Tab -->
                                        <div class="tab-pane fade" id="navs-pills-subscriptions" role="tabpanel">
                                            <div class="card shadow-sm" id="card-subscriptions">
                                                <div class="card-header d-flex justify-content-between align-items-center no-print">
                                                    <h5 class="mb-0 fw-semibold">{{ __('messages.subscription_history') }}</h5>
                                                    <div class="d-flex gap-2">
                                                        <button onclick="exportTableToCSV('subscription-history-table', 'subscriptions_report.csv')" class="btn btn-outline-primary btn-sm">
                                                            <i class="bx bx-export me-1"></i> {{ __('messages.export_csv') }}
                                                        </button>
                                                        <button onclick="printCard('card-subscriptions')" class="btn btn-outline-danger btn-sm">
                                                            <i class="bx bx-printer me-1"></i> {{ __('messages.export_pdf') }}
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive text-nowrap">
                                                        <table id="subscription-history-table" class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>{{ __('messages.store_name') }}</th>
                                                                    <th>{{ __('messages.type') }}</th>
                                                                    <th>{{ __('messages.price') }}</th>
                                                                    <th>{{ __('messages.date') }}</th>
                                                                    <th>{{ __('messages.status') }}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($subscriptionPayments as $payment)
                                                                    <tr>
                                                                        <td><b>#{{ $payment->id }}</b></td>
                                                                        <td>{{ optional($payment->store)->name ?? 'N/A' }}</td>
                                                                        <td>
                                                                            @if(config('app.locale') === 'ar' && optional($payment->subscription_method)->display_name_ar)
                                                                                {{ $payment->subscription_method->display_name_ar }}
                                                                            @else
                                                                                {{ optional($payment->subscription_method)->display_name_en ?? optional($payment->subscription_method)->name }}
                                                                            @endif
                                                                        </td>
                                                                        <td>{{ number_format(optional($payment->subscription_method)->price ?? 0, 2) }} {{ __('messages.da') }}</td>
                                                                        <td>{{ $payment->created_at->format('Y-m-d H:i') }}</td>
                                                                        <td>
                                                                            @if($payment->status == 'approved')
                                                                                <span class="badge bg-success">{{ __('messages.approved') }}</span>
                                                                            @elseif($payment->status == 'rejected')
                                                                                <span class="badge bg-danger">{{ __('messages.rejected') }}</span>
                                                                            @else
                                                                                <span class="badge bg-warning text-dark">{{ __('messages.pending') }}</span>
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Commissions Tab -->
                                        <div class="tab-pane fade" id="navs-pills-commissions" role="tabpanel">
                                            <div class="card shadow-sm" id="card-commissions">
                                                <div class="card-header d-flex justify-content-between align-items-center no-print">
                                                    <h5 class="mb-0 fw-semibold">{{ __('messages.commission_logs') }}</h5>
                                                    <div class="d-flex gap-2">
                                                        <button onclick="exportTableToCSV('commissions-table', 'commissions_report.csv')" class="btn btn-outline-primary btn-sm">
                                                            <i class="bx bx-export me-1"></i> {{ __('messages.export_csv') }}
                                                        </button>
                                                        <button onclick="printCard('card-commissions')" class="btn btn-outline-danger btn-sm">
                                                            <i class="bx bx-printer me-1"></i> {{ __('messages.export_pdf') }}
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive text-nowrap">
                                                        <table id="commissions-table" class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>{{ __('messages.store_name') }}</th>
                                                                    <th>{{ __('messages.order') }} #</th>
                                                                    <th>{{ __('messages.amount') }}</th>
                                                                    <th>{{ __('messages.date') }}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($commissionLogs as $log)
                                                                    <tr>
                                                                        <td><b>#{{ $log->id }}</b></td>
                                                                        <td>{{ optional($log->store)->name ?? 'N/A' }}</td>
                                                                        <td><b>#{{ $log->order_id }}</b></td>
                                                                        <td>{{ number_format($log->amount, 2) }} {{ __('messages.da') }}</td>
                                                                        <td>{{ $log->created_at->format('Y-m-d H:i') }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

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

    <script>
        // Real-time search for all tables
        document.getElementById('storeSearch').addEventListener('keyup', function() {
            let value = this.value.toLowerCase();
            
            // Filter stores table
            document.querySelectorAll('#stores-table tbody tr').forEach(row => {
                let id = row.cells[0].textContent.toLowerCase();
                let name = row.cells[1].textContent.toLowerCase();
                row.style.display = (id.includes(value) || name.includes(value)) ? "" : "none";
            });

            // Filter subscriptions table
            document.querySelectorAll('#subscription-history-table tbody tr').forEach(row => {
                let id = row.cells[0].textContent.toLowerCase();
                let name = row.cells[1].textContent.toLowerCase();
                let status = row.cells[5].textContent.toLowerCase();
                row.style.display = (id.includes(value) || name.includes(value) || status.includes(value)) ? "" : "none";
            });

            // Filter commissions table
            document.querySelectorAll('#commissions-table tbody tr').forEach(row => {
                let id = row.cells[0].textContent.toLowerCase();
                let store = row.cells[1].textContent.toLowerCase();
                let order = row.cells[2].textContent.toLowerCase();
                row.style.display = (id.includes(value) || store.includes(value) || order.includes(value)) ? "" : "none";
            });
        });

        // Client-side CSV export
        function exportTableToCSV(tableId, filename) {
            let csv = [];
            let rows = document.querySelectorAll('#' + tableId + ' tr');
            for (let i = 0; i < rows.length; i++) {
                if (rows[i].style.display === 'none') continue;
                let row = [], cols = rows[i].querySelectorAll('td, th');
                for (let j = 0; j < cols.length; j++) {
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

</html>
