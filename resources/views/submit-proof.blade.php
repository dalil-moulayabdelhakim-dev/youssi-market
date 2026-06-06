<!DOCTYPE html>
<html lang="zxx">
@include('layout.head')

<body>

    <link rel="stylesheet" href="{{ asset('css/register/myCstm.css') }}" />
    @include('popup')
    @include('layout.header')

    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>{{ __('messages.subscribe') }}</h2>
                        <br>
                        <p class="font-weight-bold">{{__('messages.' . $subscription_method->name . '_title')}}</p>
                    </div>

                </div>
            </div>
            <div class="row featured__filter">
                <!-- دليل الدفع -->
                <div class="col-md-6 mb-4">
                    <div class="card border-info shadow p-4 rounded-lg h-100">
                        <div class="card-body" style="direction: {{ config('app.locale') === 'ar' ? 'rtl' : 'ltr' }}">
                            <h4 class="text-info mb-4 text-center">
                                {{ __('messages.payment_guide') }}
                            </h4>

                            <div class="mb-3">
                                <h5 class="text-dark">📬 {{ __('messages.ccp_payment') }}</h5>
                                <p class="mb-1">
                                    <strong>{{ __('messages.ccp_number') }}:</strong> <span id="ccp-number"
                                        class="text-primary" style="direction: ltr">
                                            {{$admin_info->ccp}}
                                    </span>
                                    <button onclick="copyToClipboard('ccp-number')"
                                        class="btn btn-sm btn-outline-secondary ms-2">
                                        📋 {{ __('messages.copy') }}
                                    </button>
                                </p>
                            </div>

                            <div class="mb-3">
                                <h5 class="text-dark">📱 {{ __('messages.baridimob_payment') }}</h5>
                                <p class="mb-1">
                                    <strong>{{ __('messages.baridimob_number') }}:</strong> <span id="baridimob-number"
                                        class="text-success">
                                            {{$admin_info->baridimob}}
                                        </span>
                                    <button onclick="copyToClipboard('baridimob-number')"
                                        class="btn btn-sm btn-outline-secondary ms-2">
                                        📋 {{ __('messages.copy') }}
                                    </button>
                                </p>
                            </div>

                            <div class="alert alert-warning mt-4">
                                ⚠️ {{ __('messages.payment_note') }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- بطاقة التوضيح + الفورم -->
                <div class="col-md-6 mb-4">
                    <div class="card border-warning shadow p-4 rounded-lg h-100 bg-light">
                        <div class="card-body text-center d-flex flex-column justify-content-between" style="direction: {{ config('app.locale') === 'ar' ? 'rtl' : 'ltr' }}">

                            <h5 class="text-warning mb-3">{{ __('messages.payment_instruction_title') }}</h5>

                            <p class="mb-3">{{ __('messages.baridimob_instruction') }}</p>
                            <div class="mb-3">
                                📧 <strong id="email-to-copy">{{$admin_info->email}}</strong>
                                <button onclick="copyToClipboard('email-to-copy')"
                                    class="btn btn-sm btn-outline-secondary ms-2">
                                    📋 {{ __('messages.copy_email') }}
                                </button>
                            </div>


                            <!-- فورم رفع الدليل -->
                            <form action="{{route('payment-proof')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="payment_proof" class="form-label">{{ __('messages.upload_proof') }}</label>
                                    <input type="file" name="payment_proof" id="payment_proof" class="form-control"
                                        accept="image/*,application/pdf" required>
                                        <input type="hidden" name="subscription_method" value="{{$subscription_method->id}}">
                                </div>
                                <button type="submit" class="btn btn-success">
                                    {{ __('messages.submit_proof') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- Featured Section End -->


    @include('layout.footer')

    @include('layout.scripts')

    <script>
        function copyToClipboard(elementId) {
            const el = document.getElementById(elementId);
            const text = el.innerText;
            navigator.clipboard.writeText(text).then(() => {
                alert('تمالنسخ الى الحافظ');
            });
        }
    </script>
</body>

</html>
