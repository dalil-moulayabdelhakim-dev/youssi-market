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
                                                                    class="badge bg-primary">{{ __('messages.in_progress') }}</span>
                                                            @elseif($ticket->status == 'closed')
                                                                <span
                                                                    class="badge bg-success">{{ __('messages.closed') }}</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $ticket->user->name ?? 'User' }}</td>
                                                        <td>{{ $ticket->updated_at->diffForHumans() }}</td>
                                                        <td>
                                                            <!-- زر عرض التذكرة -->
                                                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                                data-bs-target="#ticketModal{{ $ticket->id }}">
                                                                <i class="bx bx-show"></i>
                                                            </button>

                                                            <!-- Modal عرض التذكرة والرد -->
                                                            <div class="modal fade" id="ticketModal{{ $ticket->id }}"
                                                                tabindex="-1">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">{{ $ticket->subject }}
                                                                            </h5>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p><strong>{{ __('messages.from') }}:</strong>
                                                                                {{ $ticket->user->name }}
                                                                                ({{ $ticket->user->email }})</p>
                                                                            <p><strong>{{ __('messages.priority') }}:</strong>
                                                                                {{ $ticket->priority }}</p>
                                                                            <hr>
                                                                            <h6>{{ __('messages.messages') }}</h6>
                                                                            <div
                                                                                style="max-height: 300px; overflow-y: auto; padding: 10px; background: #f9f9f9; border-radius: 5px;">
                                                                                @foreach ($ticket->messages as $msg)
                                                                                    <div
                                                                                        class="mb-3 {{ $msg->user_id == Auth::id() ? 'text-end' : '' }}">
                                                                                        <span
                                                                                            class="badge {{ $msg->user_id == Auth::id() ? 'bg-primary' : 'bg-secondary' }}">
                                                                                            {{ $msg->user->name }}
                                                                                        </span>
                                                                                        <p
                                                                                            class="mb-0 p-2 border rounded">
                                                                                            {{ $msg->message }}</p>
                                                                                        <small
                                                                                            class="text-muted">{{ $msg->created_at->diffForHumans() }}</small>
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>

                                                                            <hr>
                                                                            <!-- نموذج الرد وتغيير الحالة -->
                                                                            <form
                                                                                action="{{ route('admin-tickets.reply', $ticket->id) }}"
                                                                                method="POST">
                                                                                @csrf
                                                                                <div class="mb-3">
                                                                                    <label
                                                                                        class="form-label">{{ __('messages.reply') }}</label>
                                                                                    <textarea name="message" class="form-control" rows="3" required></textarea>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-md-6 mb-3">
                                                                                        <label
                                                                                            class="form-label">{{ __('messages.change_status') }}</label>
                                                                                        <select name="status"
                                                                                            class="form-select">
                                                                                            <option value="open"
                                                                                                {{ $ticket->status == 'open' ? 'selected' : '' }}>
                                                                                                {{ __('messages.open') }}
                                                                                            </option>
                                                                                            <option value="in_progress"
                                                                                                {{ $ticket->status == 'in_progress' ? 'selected' : '' }}>
                                                                                                {{ __('messages.in_progress') }}
                                                                                            </option>
                                                                                            <option value="closed"
                                                                                                {{ $ticket->status == 'closed' ? 'selected' : '' }}>
                                                                                                {{ __('messages.closed') }}
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="col-md-6 mb-3">
                                                                                        <label
                                                                                            class="form-label">{{ __('messages.agent_notes') }}</label>
                                                                                        <textarea name="agent_notes" class="form-control" rows="1">{{ $ticket->agent_notes }}</textarea>
                                                                                    </div>
                                                                                </div>
                                                                                <button type="submit"
                                                                                    class="btn btn-success">{{ __('messages.send_reply') }}</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
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
                let text = row.innerText.toLowerCase();
                row.style.display = text.includes(value) ? '' : 'none';
            });
        });
    </script>
</body>

</html>
