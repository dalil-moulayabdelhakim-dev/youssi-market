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
                    <li class="menu-item ">
                        <a href="{{ route('admin-users.view') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-user"></i>
                            <div class="text-truncate" data-i18n="Basic">{{ __('messages.users') }}
                            </div>
                        </a>
                    </li>
                    <li class="menu-item ">
                        <a href="{{ route('admin-subscription-request') }}" class="menu-link">
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
                    <li class="menu-item active">
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

                                <div class="card mb-3 shadow-sm">
                                    <div class="sticky-top d-flex align-items-center p-3">
                                        <span class="w-px-22 h-px-22"><i
                                                class="icon-base bx bx-search icon-md"></i></span>
                                        <input id="ticketSearch" type="text" class="form-control border-0"
                                            placeholder="{{ __('messages.search') }}">
                                    </div>
                                </div>
                                <div class="card">
                                    <h5 class="card-header">{{ __('messages.ticket_management') }}</h5>
                                    <div class="card-body">
                                        <table id="ticket-table" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>{{ __('messages.subject') }}</th>
                                                    <th>{{ __('messages.priority') }}</th>
                                                    <th>{{ __('messages.status') }}</th>
                                                    <th>{{ __('messages.from') }}</th>
                                                    <th>{{ __('messages.last_update') }}</th>
                                                    <th>{{ __('messages.actions') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($tickets as $ticket)
                                                    <tr>
                                                        <td>{{ $ticket->id }}</td>
                                                        <td>{{ $ticket->subject }}</td>
                                                        <td>
                                                            @if (($ticket->priority ?? 'low') == 'high')
                                                                <span class="badge bg-danger">{{ __('messages.high') }}</span>
                                                            @elseif(($ticket->priority ?? 'low') == 'medium')
                                                                <span class="badge bg-warning text-dark">{{ __('messages.medium') }}</span>
                                                            @else
                                                                <span class="badge bg-secondary">{{ __('messages.low') }}</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($ticket->status == 'open')
                                                                <span
                                                                    class="badge bg-info">{{ __('messages.new') }}</span>
                                                            @elseif($ticket->status == 'in_progress')
                                                                <span
                                                                    class="badge bg-warning">{{ __('messages.in_progress') }}</span>
                                                            @else
                                                                <span
                                                                    class="badge bg-dark">{{ __('messages.closed') }}</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $ticket->user->name }}</td>
                                                        <td>{{ $ticket->updated_at->diffForHumans() }}</td>
                                                        <td>
                                                            <button type="button" class="btn btn-sm btn-primary"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#ticketModal{{ $ticket->id }}">
                                                                {{ __('messages.view_reply') }}
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="ticketModal{{ $ticket->id }}"
                                                        tabindex="-1">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">

                                                                <div class="modal-header">
                                                                    <h5 class="modal-title d-flex align-items-center">
                                                                        <span>{{ __('messages.ticket') }}: {{ $ticket->subject }}</span>
                                                                        @if (($ticket->priority ?? 'low') == 'high')
                                                                            <span class="badge bg-danger ms-2">{{ __('messages.high') }}</span>
                                                                        @elseif(($ticket->priority ?? 'low') == 'medium')
                                                                            <span class="badge bg-warning text-dark ms-2">{{ __('messages.medium') }}</span>
                                                                        @else
                                                                            <span class="badge bg-secondary ms-2">{{ __('messages.low') }}</span>
                                                                        @endif
                                                                    </h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"></button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    <!-- الرسائل القديمة -->
                                                                    <div class="mb-3"
                                                                        style="max-height: 300px; overflow-y:auto;">
                                                                        @foreach ($ticket->messages as $msg)
                                                                            <div
                                                                                class="p-2 mb-2 border rounded {{ $msg->user->user_type_id == '1' ? 'bg-light text-end' : 'bg-white' }}">
                                                                                <strong>{{ $msg->user->user_type_id == '1' ? __('messages.admin') : $ticket->user->name }}:</strong>
                                                                                <p
                                                                                    class="m-1 p-1 border rounded {{ $msg->user->user_type_id == '1' ? 'bg-white' : 'bg-light' }}">
                                                                                    {!! $msg->message !!}
                                                                                </p>
                                                                                <small
                                                                                    class="text-muted">{{ $msg->created_at->diffForHumans() }}</small>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>

                                                                    <!-- الفورم ديال الرد -->
                                                                    <form method="POST"
                                                                        action="{{ route('contact.tickets.reply', $ticket->id) }}">
                                                                        @csrf
                                                                        <div class="mb-3">
                                                                            <textarea name="message" class="form-control" rows="3" required
                                                                                placeholder="{{ __('messages.write_reply') }}"></textarea>
                                                                        </div>
                                                                        <input type="hidden" name="type"
                                                                            value="1">
                                                                        <button type="submit"
                                                                            class="btn btn-success">{{ __('messages.send_reply') }}</button>
                                                                    </form>

                                                                    <!-- Internal Notes & Settings -->
                                                                    <div class="card mt-4 border border-2 border-primary-subtle shadow-none">
                                                                        <div class="card-header bg-primary-subtle text-primary py-2 d-flex justify-content-between align-items-center">
                                                                            <h6 class="mb-0 fw-semibold">
                                                                                <i class="bx bx-cog me-1"></i> {{ __('messages.internal_notes') }}
                                                                            </h6>
                                                                            <span class="badge bg-primary text-white">{{ __('messages.admin_only') }}</span>
                                                                        </div>
                                                                        <div class="card-body pt-3 pb-2">
                                                                            <form method="POST" action="{{ route('admin-tickets.status', $ticket->id) }}">
                                                                                @csrf
                                                                                <div class="row g-3">
                                                                                    <div class="col-md-6">
                                                                                        <label class="form-label fw-bold">{{ __('messages.status') }}</label>
                                                                                        <select name="status" class="form-select">
                                                                                            <option value="open" {{ $ticket->status == 'open' ? 'selected' : '' }}>{{ __('messages.new') }}</option>
                                                                                            <option value="in_progress" {{ $ticket->status == 'in_progress' ? 'selected' : '' }}>{{ __('messages.in_progress') }}</option>
                                                                                            <option value="closed" {{ $ticket->status == 'closed' ? 'selected' : '' }}>{{ __('messages.closed') }}</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <label class="form-label fw-bold">{{ __('messages.priority') }}</label>
                                                                                        <select name="priority" class="form-select">
                                                                                            <option value="low" {{ ($ticket->priority ?? 'low') == 'low' ? 'selected' : '' }}>{{ __('messages.low') }}</option>
                                                                                            <option value="medium" {{ ($ticket->priority ?? 'low') == 'medium' ? 'selected' : '' }}>{{ __('messages.medium') }}</option>
                                                                                            <option value="high" {{ ($ticket->priority ?? 'low') == 'high' ? 'selected' : '' }}>{{ __('messages.high') }}</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="col-12 mt-2">
                                                                                        <label class="form-label fw-bold">{{ __('messages.agent_notes') }}</label>
                                                                                        <textarea name="agent_notes" class="form-control" rows="3" placeholder="{{ __('messages.agent_notes_placeholder') }}">{{ $ticket->agent_notes }}</textarea>
                                                                                    </div>
                                                                                    <div class="col-12 mt-3 text-end">
                                                                                        <button type="submit" class="btn btn-primary btn-sm">
                                                                                            <i class="bx bx-save me-1"></i> {{ __('messages.update') }}
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                                        {{ __('messages.close') }}
                                                                    </button>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </tbody>
                                        </table>
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

    <!-- Core JS -->

    @include('owner.layout.scripts')
    <script>
        document.getElementById('ticketSearch').addEventListener('keyup', function() {
            let value = this.value.toLowerCase();
            let rows = document.querySelectorAll('#ticket-table tbody tr');

            rows.forEach(row => {
                let id = row.cells[0].textContent.toLowerCase();
                let subject = row.cells[1].textContent.toLowerCase();
                let priority = row.cells[2].textContent.toLowerCase();
                let status = row.cells[3].textContent.toLowerCase();
                let from = row.cells[4].textContent.toLowerCase();

                if (id.includes(value) ||
                    subject.includes(value) ||
                    priority.includes(value) ||
                    status.includes(value) ||
                    from.includes(value)
                ) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });

        })
    </script>
</body>

</html>
