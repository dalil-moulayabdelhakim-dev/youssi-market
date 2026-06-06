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
                    <li class="menu-item active">
                        <a href="#" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-credit-card"></i>
                            <div class="text-truncate" data-i18n="Basic">{{ __('messages.subscription_requests') }}
                            </div>
                        </a>
                    </li>
                    <li class="menu-item ">
                        <a href="{{ route('admin-admin.profits') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-dollar-circle"></i>
                            <div class="text-truncate" data-i18n="Basic">{{ __('messages.profits') }}
                            </div>
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

                            <div class="col-12">

                                <div class="card sticky-top mb-3 shadow-sm">
                                    <div class="d-flex align-items-center p-3 ">
                                        <span class="w-px-22 h-px-22"><i
                                                class="icon-base bx bx-search icon-md"></i></span>
                                        <input type="text" id="subSearch" class="form-control border-0"
                                            placeholder="{{ __('messages.search_by_id_store_or_date') }}">
                                    </div>
                                </div>
                                <!-- Striped Rows -->
                                <div class="card">
                                    <h5 class="card-header">{{ __('messages.subscription_requests') }}</h5>
                                    <div class="table-responsive text-nowrap">
                                        <table id="subscription-table" class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>{{ __('messages.store_name') }}</th>
                                                    <th>{{ __('messages.proof') }}</th>
                                                    <th>{{ __('messages.date') }}</th>
                                                    <th>{{ __('messages.status') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">
                                                @isset($requests)
                                                    @if (count($requests) > 0)
                                                        @foreach ($requests as $request)
                                                            <tr>

                                                                <td>{{ $request->id }}</td>
                                                                <td>{{ $request->store->name }}</td>
                                                                <td>
                                                                    <img class="icon-xxl me-4"
                                                                        src="{{ asset($request->proof_path) }}"
                                                                        alt="proof{{ $request->id }}">
                                                                </td>

                                                                <td>
                                                                    {{ $request->created_at }}
                                                                </td>
                                                                <td>
                                                                    @switch($request->status)
                                                                        @case('approved')
                                                                            <span
                                                                                class="badge bg-success">{{ __('messages.approved') }}</span>
                                                                        @break

                                                                        @case('rejected')
                                                                            <span
                                                                                class="badge bg-danger">{{ __('messages.rejected') }}</span>
                                                                        @break

                                                                        @case('pending')
                                                                            <span
                                                                                class="badge bg-warning text-dark">{{ __('messages.pending') }}</span>
                                                                        @break

                                                                        @default
                                                                            <span
                                                                                class="badge bg-secondary">{{ __('messages.unknown') }}</span>
                                                                    @endswitch
                                                                </td>
                                                                <td>
                                                                    <div class="dropdown">
                                                                        <button type="button"
                                                                            class="btn p-0 dropdown-toggle hide-arrow"
                                                                            data-bs-toggle="dropdown">
                                                                            <i
                                                                                class="icon-base bx bx-dots-vertical-rounded"></i>
                                                                        </button>
                                                                        <div class="dropdown-menu">

                                                                            <button type="button"
                                                                                class="dropdown-item view-details"
                                                                                data-id="{{ $request->id }}">
                                                                                <i
                                                                                    class="icon-base bx bx-show-alt me-1"></i>
                                                                                {{ __('messages.preview') }}
                                                                            </button>

                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td>{{ __('messages.empty') }}</td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    @endif
                                                    <div class="m1-3">
                                                        {{ $requests->links('pagination::bootstrap-5') }}
                                                    </div>
                                                @endisset
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!--/ Striped Rows -->
                            </div>
                        </div>
                    </div>
                    <!-- / Content -->
                    <div class="modal fade" id="detailsModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">{{ __('messages.preview') }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="{{ __('messages.close') }}"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>{{ __('messages.status') }}:</strong> <span id="status"></span></p>
                                    <p><strong>{{ __('messages.subscription_plan') }}:</strong> <span
                                            id="subscription"></span></p>
                                    <p><strong>{{ __('messages.price') }}:</strong> <span id="price"></span></p>
                                    <p><strong>{{ __('messages.payment_proof') }}:</strong>
                                        <a class="btn btn-outline-primary ms-2" id="proof_path" href="#"
                                            target="_blank">{{ __('messages.view') }}</a>
                                    </p>
                                    <hr>
                                    <h6>{{ __('messages.store_info') }}</h6>
                                    <p><strong>{{ __('messages.name') }}:</strong> <span id="store_name"></span></p>
                                    <p><strong>{{ __('messages.category') }}:</strong> <span
                                            id="store_category"></span></p>
                                    <p><strong>{{ __('messages.address') }}:</strong> <span id="store_address"></span>
                                    </p>
                                    <p><strong>{{ __('messages.contact') }}:</strong> <span id="store_contact"></span>
                                    </p>
                                    <p><strong>{{ __('messages.subscription_status') }}:</strong> <span
                                            id="store_subscription_status"></span></p>
                                </div>
                                <div class="modal-footer" id="buttons">

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
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.view-details').forEach(button => {
                button.addEventListener('click', function() {
                    let id = this.dataset.id;

                    fetch(`/a/payment-requests/${id}`) // لازم تكون عندك route يرجع JSON
                        .then(res => res.json())
                        .then(data => {
                            document.getElementById('status').textContent = data.status;
                            if (data.status != 'approved') {
                                document.getElementById('buttons').innerHTML = `
        <form id="approveForm" method="POST" action="{{ route('admin-payment_requests.approve') }}">
            @csrf
            <input type="hidden" name="request_id" id="approve_request_id" value="${data.id}">
            <button type="submit" class="btn btn-success">{{ __('messages.approve') }}</button>
        </form>
        <form id="rejectForm" method="POST" action="{{ route('admin-payment_requests.reject') }}">
            @csrf
            <input type="hidden" name="request_id" id="reject_request_id" value="${data.id}">
            <button type="submit" class="btn btn-danger">{{ __('messages.reject') }}</button>
        </form>
    `;
                            }


                            document.getElementById('subscription').textContent = data.name;
                            document.getElementById('price').textContent = data.price +
                                "{{ __('messages.da') }}";
                            document.getElementById('proof_path').href = data.proof_path;
                            document.getElementById('store_name').textContent = data.store.name;
                            document.getElementById('store_category').textContent = data.store
                                .category;
                            document.getElementById('store_address').textContent = data.store
                                .address;
                            document.getElementById('store_contact').textContent = data.store
                                .contact;
                            document.getElementById('store_subscription_status').textContent =
                                data.store.subscription_status;

                            let modal = new bootstrap.Modal(document.getElementById(
                                'detailsModal'));
                            modal.show();
                        });
                });
            });

            document.getElementById('subSearch').addEventListener('keyup', function() {
                let value = this.value.toLowerCase();
                let rows = document.querySelectorAll('#subscription-table tbody tr');

                rows.forEach(row => {
                    let id = row.cells[0].textContent.toLowerCase();
                    let storeName = row.cells[1].textContent.toLowerCase();
                    let date = row.cells[3].textContent.toLowerCase();
                    if (id.includes(value) || storeName.includes(value) || date.includes(value)) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                })
            })
        });
    </script>
</body>

</html>
