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
            @include('owner.layout.sidebar')
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->


                @include('owner.layout.nav-bar')

                <!-- / Navbar -->

                <!-- Content wrapper -->

                <form action="{{ route('wilaya.stores.updateDelivery', $store->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">
                            <div class="row sticky-top card w-100 m-3 p-3 mb-4">
                                <div class="content-wrapper">
                                    <div class="col-sm-4 d-flex align-items-center gap-3">
                                        <span class="w-px-22 h-px-22"><i
                                                class="icon-base bx bx-search icon-md"></i></span>
                                        <select class="form-select border-0" id="wilayaSelect" required>
                                            <option selected="">{{ __('messages.select_wilaya') }}</option>
                                            @isset($wilayas)
                                                @foreach ($wilayas as $wilaya)
                                                    <option value="{{ $wilaya->id }}">
                                                        {{ $wilaya->id }} - {{ app()->getLocale() === 'ar' ? ($wilaya->ar_name ?? $wilaya->name) : ($wilaya->name ?? $wilaya->ar_name) }}
                                                    </option>
                                                @endforeach
                                            @endisset
                                        </select>
                                    </div>
                                </div>
                            </div>

                            @isset($wilayas)
                                @foreach ($wilayas as $wilaya)
                                    @php
                                        $pivot = $store->wilayas->firstWhere('id', $wilaya->id)?->pivot;
                                    @endphp

                                    <div class="col-12 col-md-6 col-lg-4 mb-4" id="wilaya-card-{{ $wilaya->id }}">
                                        <div class="card h-100">
                                            <div class="card-header">
                                                <h5 class="mb-0">{{ $wilaya->id }} - {{ app()->getLocale() === 'ar' ? ($wilaya->ar_name ?? $wilaya->name) : ($wilaya->name ?? $wilaya->ar_name) }}</h5>
                                            </div>
                                            <div class="card-body">

                                                <!-- Home Delivery -->
                                                <div class="mb-3">
                                                    <label for="H_cost_{{ $wilaya->id }}" class="form-label">
                                                        {{ __('messages.home_delevery') }}
                                                    </label>
                                                    <div class="input-group">
                                                        <input type="text" name="wilayas[{{ $wilaya->id }}][H_cost]"
                                                            id="H_cost_{{ $wilaya->id }}" class="form-control"
                                                            value="{{ $pivot->price_to_home ?? '' }}" />
                                                        <span class="input-group-text">{{ __('messages.da') }}</span>
                                                    </div>
                                                </div>

                                                <!-- Stopdesk Delivery -->
                                                <div class="mb-3">
                                                    <label for="SD_cost_{{ $wilaya->id }}" class="form-label">
                                                        {{ __('messages.stopdesk_delevery') }}
                                                    </label>
                                                    <div class="input-group">
                                                        <input type="text" name="wilayas[{{ $wilaya->id }}][SD_cost]"
                                                            id="SD_cost_{{ $wilaya->id }}" class="form-control"
                                                            value="{{ $pivot->price_to_office ?? '' }}" />
                                                        <span class="input-group-text">{{ __('messages.da') }}</span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endisset
                        </div>
                    </div>

                    <div class="sticky-bottom mb-2 py-3 text-center" style="z-index: 10000;">
                        <button type="submit" class="btn btn-primary">
                            {{ __('messages.save_changes') }}
                        </button>
                    </div>
                </form>


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
        document.getElementById('wilayaSelect').addEventListener('change', function() {
            const wilayaId = this.value;
            if (wilayaId) {
                const targetCard = document.getElementById('wilaya-card-' + wilayaId);
                if (targetCard) {
                    targetCard.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                    targetCard.classList.add('highlight-card');

                    setTimeout(() => {
                        targetCard.classList.remove('highlight-card');
                    }, 2000);
                }
            }
        });
    </script>

    <body>

</html>
