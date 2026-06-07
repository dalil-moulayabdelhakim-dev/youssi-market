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
                        <div class="row sticky-top card w-100 m-3 p-3 mb-4">
                            <div class="d-flex justify-content-center align-items-center col-md-6">
                                <span class="w-px-22 h-px-22"><i class="icon-base bx bx-search icon-md"></i></span>
                                <input type="text" id="orderSearch" class="form-control border-0 shadow-none"
                                    placeholder="{{ __('messages.search_by_id_or_name') }}">
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mb-4">
                            {{ $orders->links() }}
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-8 col-lg-12 col-xxl-4 order-3 order-md-2 profile-report">
                                @foreach ($orders as $order)
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card mb-5 shadow-sm order-card">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center mb-3">
                                                        <h5 class="card-title mb-0 order-id">#{{ $order->id }}</h5>
                                                    </div>
                                                    <div class="d-flex gap-6">
                                                        <h5 class="card-text">
                                                            <strong>{{ __('messages.customer_name') }}:</strong>
                                                            <span class="customer-name">{{ $order->user->name }}</span>
                                                        </h5>
                                                        <h5 class="card-text">
                                                            <strong>{{ __('messages.total') }}:</strong>
                                                            <span>{{ $order->total_price }}
                                                                {{ __('messages.da') }}</span>
                                                        </h5>
                                                        <h5 class="card-text">
                                                            <strong>{{ __('messages.date') }}:</strong>
                                                            <span>{{ $order->created_at }}</span>
                                                        </h5>
                                                        <h5 class="d-flex gap-1 card-text">
                                                            <strong>{{ __('messages.status') }}:</strong>
                                                            <form
                                                                action="{{ route('order.updateStatus', $order->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <select name="status"
                                                                    class="form-select form-select-sm status-select"
                                                                    onchange="this.form.submit()">
                                                                    <option value="pending"
                                                                        {{ optional($order->orderItems->first())->status == 'pending' ? 'selected' : '' }}>
                                                                        {{ __('messages.pending') }}
                                                                    </option>
                                                                    <option value="accepted"
                                                                        {{ optional($order->orderItems->first())->status == 'accepted' ? 'selected' : '' }}>
                                                                        {{ __('messages.accepted') }}
                                                                    </option>
                                                                    <option value="shipped"
                                                                        {{ optional($order->orderItems->first())->status == 'shipped' ? 'selected' : '' }}>
                                                                        {{ __('messages.shipped') }}
                                                                    </option>
                                                                    <option value="delivered"
                                                                        {{ optional($order->orderItems->first())->status == 'delivered' ? 'selected' : '' }}>
                                                                        {{ __('messages.delivered') }}
                                                                    </option>
                                                                    <option value="received"
                                                                        {{ optional($order->orderItems->first())->status == 'received' ? 'selected' : '' }}>
                                                                        {{ __('messages.received') }}
                                                                    </option>
                                                                    <option value="rejected"
                                                                        {{ optional($order->orderItems->first())->status == 'rejected' ? 'selected' : '' }}>
                                                                        {{ __('messages.rejected') }}
                                                                    </option>
                                                                </select>
                                                            </form>
                                                        </h5>

                                                    </div>

                                                    <div class="d-flex gap-6">

                                                        <h5 class="card-text">
                                                            <strong>{{ __('messages.wilaya') }}:</strong>
                                                            <span>
                                                                @if($order->user && $order->user->wilaya)
                                                                    {{ app()->getLocale() === 'ar' ? ($order->user->wilaya->ar_name ?? $order->user->wilaya->name) : ($order->user->wilaya->name ?? $order->user->wilaya->ar_name) }}
                                                                @else
                                                                    —
                                                                @endif
                                                            </span>
                                                        </h5>

                                                        <h5 class="card-text">
                                                            <strong>{{ __('messages.commune') }}:</strong>
                                                            <span>
                                                                @if($order->user && $order->user->commune)
                                                                    {{ app()->getLocale() === 'ar' ? ($order->user->commune->ar_name ?? $order->user->commune->name) : ($order->user->commune->name ?? $order->user->commune->ar_name) }}
                                                                @else
                                                                    —
                                                                @endif
                                                            </span>
                                                        </h5>

                                                        <h5 class="card-text">
                                                            <strong>{{ __('messages.delivery_place') }}:</strong>
                                                            <span>
                                                                {{ $order->delivery_place == 1 ? __('messages.delivery_places.home') : __('messages.delivery_places.office') }}
                                                            </span>
                                                        </h5>
                                                    </div>

                                                    <table class="table table-striped">
                                                        <thead>
                                                            <th>{{ __('messages.image') }}</th>
                                                            <th>{{ __('messages.title') }}</th>
                                                            <th>{{ __('messages.type') }}</th>
                                                            <th>{{ __('messages.quantity') }}</th>
                                                            <th>{{ __('messages.price') }}</th>
                                                            <th>{{ __('messages.status') }}</th>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($order->orderItems as $item)
                                                                <tr>
                                                                    <td>
                                                                        <img src="{{ config('app.url') . '/' . $item->product->image }}"
                                                                            alt="Image" class="rounded me-3"
                                                                            width="50" height="50"
                                                                            loading="lazy">
                                                                    </td>
                                                                    <td>
                                                                        <p class="card-text">
                                                                            {{ $item->product->title }}
                                                                        </p>
                                                                    </td>

                                                                   <td>
                                                                        <p class="card-text">
                                                                            {{ __('messages.' . $item->product->type) }}
                                                                        </p>
                                                                    </td>
                                                                    <td>
                                                                        <p class="card-text">
                                                                            {{ $item->quantity }}
                                                                        </p>
                                                                    </td>
                                                                    <td>
                                                                        <p class="card-text">

                                                                            {{ $item->price }}
                                                                        </p>
                                                                    </td>
                                                                    <td>
                                                                        <p class="card-text">

                                                                            {{ __('messages.' . $item->status) }}
                                                                        </p>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            {{ $orders->links() }}
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
        function updateStatusColor(select) {
            const colors = {
                pending: "bg-warning",
                accepted: "bg-Secondary",
                rejected: "bg-danger",
                shipped: "bg-info",
                delivered: "bg-primary",
                received: "bg-sucess"
            };

            // نحذف جميع الكلاسات السابقة
            select.className = "form-select form-select-sm";

            // نضيف اللون المناسب حسب القيمة
            if (colors[select.value]) {
                select.classList.add(...colors[select.value].split(" "));
            }
        }

        // تشغيل عند تحميل الصفحة
        document.querySelectorAll(".status-select").forEach(updateStatusColor);

        document.getElementById("orderSearch").addEventListener("keyup", function() {
            let value = this.value.toLowerCase();
            let cards = document.querySelectorAll(".order-card");

            cards.forEach(function(card) {
                let orderId = card.querySelector(".order-id").textContent.toLowerCase();
                let customerName = card.querySelector(".customer-name").textContent.toLowerCase();

                if (orderId.includes(value) || customerName.includes(value)) {
                    card.style.display = "";
                } else {
                    card.style.display = "none";
                }
            });
        });
    </script>
</body>

</html>
