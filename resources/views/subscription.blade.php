<!-- Featured Section Begin -->
<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>{{ __('messages.subscribe') }}</h2>
                </div>

            </div>
        </div>
        <div class="row featured__filter" style="direction: {{ config('app.locale') === 'ar' ? 'rtl' : 'ltr' }}">
            <!-- بطاقة الاشتراك الشهري -->
            <div class="col-md-6 mb-4">
                <div class="card border-primary h-100 shadow p-3 rounded-lg">

                    <div class="card-body text-center">
                        <h5 class="card-title text-primary">
                            @if(config('app.locale') === 'ar' && isset($monthly) && $monthly->display_name_ar)
                                {{ $monthly->display_name_ar }}
                            @elseif(isset($monthly) && $monthly->display_name_en)
                                {{ $monthly->display_name_en }}
                            @else
                                {{ __('messages.monthly_title') }}
                            @endif
                        </h5>
                        <h2 style="direction: {{ config('app.locale') === 'ar' ? 'rtl' : 'ltr' }}"
                            class="card-price text-dark">
                            @isset($monthly)
                                {{$monthly->price}}
                            @endisset
                            {{ __('messages.da') }} / {{ __('messages.month') }}</h2>
                        <ul class="list-unstyled mt-3 mb-4">
                            @if(config('app.locale') === 'ar' && isset($monthly) && $monthly->features_ar)
                                @foreach(explode("\n", str_replace("\r", "", $monthly->features_ar)) as $feature)
                                    @if(trim($feature))
                                        <li>✅ {{ trim($feature) }}</li>
                                    @endif
                                @endforeach
                            @elseif(isset($monthly) && $monthly->features_en)
                                @foreach(explode("\n", str_replace("\r", "", $monthly->features_en)) as $feature)
                                    @if(trim($feature))
                                        <li>✅ {{ trim($feature) }}</li>
                                    @endif
                                @endforeach
                            @else
                                <li>✅ {{ __('messages.monthly_feature_1') }}</li>
                                <li>✅ {{ __('messages.monthly_feature_2') }}</li>
                                <li>✅ {{ __('messages.monthly_feature_3') }}</li>
                            @endif
                        </ul>
                        <a href="{{route('subscribe-form-view', $monthly->id)}}" class="btn btn-primary">{{ __('messages.subscribe_now') }}</a>
                    </div>
                </div>
            </div>

            <!-- بطاقة الاشتراك السنوي -->
            <div class="col-md-6 mb-4">
                <div class="card border-success h-100 shadow p-3 rounded-lg">
                    <!-- وسم الأكثر شيوعًا -->
                    <div class="position-absolute top-0 start-50 translate-middle-x mt-1"
                        style="z-index: 1; margin-top: -15px; color: white">
                        <span class="badge bg-danger px-3 py-2 shadow-sm rounded-pill animate__animated animate__pulse animate__infinite">
                            {{ __('messages.most_popular') }}
                        </span>
                    </div>

                    <div class="card-body text-center ">
                        <h5 class="card-title text-success">
                            @if(config('app.locale') === 'ar' && isset($yearly) && $yearly->display_name_ar)
                                {{ $yearly->display_name_ar }}
                            @elseif(isset($yearly) && $yearly->display_name_en)
                                {{ $yearly->display_name_en }}
                            @else
                                {{ __('messages.yearly_title') }}
                            @endif
                        </h5>
                        <h2 style="direction: {{ config('app.locale') === 'ar' ? 'rtl' : 'ltr' }}"
                            class="card-price text-dark">
                            @isset($yearly)
                                {{$yearly->price}}
                            @endisset
                             {{ __('messages.da') }} / {{ __('messages.year') }}</h2>
                        <ul class="list-unstyled mt-3 mb-4">
                            @if(config('app.locale') === 'ar' && isset($yearly) && $yearly->features_ar)
                                @foreach(explode("\n", str_replace("\r", "", $yearly->features_ar)) as $feature)
                                    @if(trim($feature))
                                        <li>✅ {{ trim($feature) }}</li>
                                    @endif
                                @endforeach
                            @elseif(isset($yearly) && $yearly->features_en)
                                @foreach(explode("\n", str_replace("\r", "", $yearly->features_en)) as $feature)
                                    @if(trim($feature))
                                        <li>✅ {{ trim($feature) }}</li>
                                    @endif
                                @endforeach
                            @else
                                <li>✅ {{ __('messages.yearly_feature_1') }}</li>
                                <li>✅ {{ __('messages.yearly_feature_2') }}</li>
                                <li>✅ {{ __('messages.yearly_feature_3') }}</li>
                            @endif
                        </ul>
                        <a href="{{route('subscribe-form-view', $yearly->id)}}" class="btn btn-success">{{ __('messages.subscribe_now') }}</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- Featured Section End -->
