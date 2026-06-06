<!DOCTYPE html>
<html lang="zxx">

@include('layout.head')

<body>


    <link rel="stylesheet" href="{{ asset('css/register/myCstm.css') }}" />
    @include('popup')

    @include('layout.header')
    <!-- Hero Section Begin -->
    <section class="hero hero-normal">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <!-- زر فتح تذكرة جديدة -->
                    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#newTicketModal">
                        {{ __('messages.new_ticket') }}
                    </button>

                    <!-- جدول التذاكر -->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>{{ __('messages.ticket_id') }}</th>
                                <th>{{ __('messages.subject') }}</th>
                                <th>{{ __('messages.status') }}</th>
                                <th>{{ __('messages.last_update') }}</th>
                                <th>{{ __('messages.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tickets as $ticket)
                                <tr>
                                    <td>#{{ $ticket->id }}</td>
                                    <td>{{ $ticket->subject }}</td>
                                    <td>
                                        @if ($ticket->status == 'open')
                                            <span class="badge bg-success">{{ __('messages.open') }}</span>
                                        @elseif($ticket->status == 'in_progress')
                                            <span class="badge bg-warning">{{ __('messages.in_progress') }}</span>
                                        @else
                                            <span class="badge bg-secondary">{{ __('messages.closed') }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $ticket->updated_at->format('Y-m-d H:i') }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                                            data-bs-target="#ticketModal{{ $ticket->id }}">
                                            {{ __('messages.view') }}
                                        </button>
                                    </td>
                                </tr>

                                <!-- Modal عرض المحادثة -->
                                <div class="modal fade" id="ticketModal{{ $ticket->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">{{ __('messages.ticket') }}:
                                                    {{ $ticket->subject }}</h5>
                                                <button type="button" class="btn-close"
                                                    data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body" style="max-height:400px; overflow-y:auto;">
                                                @foreach ($ticket->messages as $msg)
                                                    <div
                                                        class="mb-2 p-2 border rounded {{ $msg->user->user_type_id == '1' ? 'bg-light' : 'bg-white' }}">
                                                        <strong>{{ $msg->user->user_type_id != '1' ? $msg->user->name : __('messages.system') }}:</strong>
                                                        <p
                                                            class="m-1 p-1 border rounded {{ $msg->user->user_type_id == '1' ? 'bg-white' : 'bg-light' }}">
                                                            {!! $msg->message !!}</p>
                                                        <small
                                                            class="text-muted">{{ $msg->created_at->format('Y-m-d H:i') }}</small>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="modal-footer">
                                                @if ($ticket->status != 'closed')
                                                    @if ($ticket->status != 'open')
                                                        <form
                                                            action="{{ route('contact.tickets.reply', $ticket->id) }}"
                                                            method="POST" class="d-flex w-100">
                                                            @csrf
                                                            <textarea name="message" class="form-control me-2" rows="1" placeholder="{{ __('messages.enter_message') }}"
                                                                required></textarea>
                                                            <input type="hidden" name="type" value="0">
                                                            <button type="submit"
                                                                class="btn btn-primary">{{ __('messages.send') }}</button>
                                                        </form>
                                                    @endif
                                                @else
                                                    <span class="text-muted">{{ __('messages.ticket_closed') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">{{ __('messages.no_tickets') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Modal إنشاء تذكرة جديدة -->
    <div class="modal fade" id="newTicketModal" tabindex="-1">
        <div class="modal-dialog">
            <form action="{{ route('contact.tickets.store') }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('messages.new_ticket') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>{{ __('messages.subject') }}</label>
                        <input type="text" name="subject" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>{{ __('messages.message') }}</label>
                        <textarea name="message" class="form-control" rows="4" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">{{ __('messages.send') }}</button>
                </div>
            </form>
        </div>
    </div>



    @include('layout.footer')

    @include('layout.scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>



</body>

</html>
