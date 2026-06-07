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
            @foreach($plans as $plan)
            <div class="col-md-6 mb-4">
                <div class="card {{ $plan->name === 'yearly' ? 'border-success' : ($plan->price == 0 ? 'border-info' : 'border-primary') }} h-100 shadow p-3 rounded-lg">
                    @if($plan->name === 'yearly')
                    <!-- وسم الأكثر شيوعًا -->
                    <div class="position-absolute top-0 start-50 translate-middle-x mt-1"
                        style="z-index: 1; margin-top: -15px; color: white">
                        <span class="badge bg-danger px-3 py-2 shadow-sm rounded-pill animate__animated animate__pulse animate__infinite">
                            {{ __('messages.most_popular') }}
                        </span>
                    </div>
                    @elseif($plan->price == 0)
                    <!-- وسم عرض خاص -->
                    <div class="position-absolute top-0 start-50 translate-middle-x mt-1"
                        style="z-index: 1; margin-top: -15px; color: white">
                        <span class="badge bg-info px-3 py-2 shadow-sm rounded-pill animate__animated animate__pulse animate__infinite">
                            {{ __('messages.special_offer') }}
                        </span>
                    </div>
                    @endif

                    <div class="card-body text-center">
                        <h5 class="card-title {{ $plan->name === 'yearly' ? 'text-success' : ($plan->price == 0 ? 'text-info' : 'text-primary') }}">
                            @if(config('app.locale') === 'ar' && $plan->display_name_ar)
                                {{ $plan->display_name_ar }}
                            @elseif($plan->display_name_en)
                                {{ $plan->display_name_en }}
                            @else
                                {{ ucfirst($plan->name) }}
                            @endif
                        </h5>
                        <h2 style="direction: {{ config('app.locale') === 'ar' ? 'rtl' : 'ltr' }}"
                            class="card-price text-dark">
                            {{$plan->price}}
                            {{ __('messages.da') }} / {{ $plan->duration_days }} {{ __('messages.days') }}</h2>
                        <ul class="list-unstyled mt-3 mb-4">
                            @if(config('app.locale') === 'ar' && $plan->features_ar)
                                @foreach(explode("\n", str_replace("\r", "", $plan->features_ar)) as $feature)
                                    @if(trim($feature))
                                        <li>✅ {{ trim($feature) }}</li>
                                    @endif
                                @endforeach
                            @elseif($plan->features_en)
                                @foreach(explode("\n", str_replace("\r", "", $plan->features_en)) as $feature)
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
                        <a href="{{route('subscribe-form-view', $plan->id)}}" class="btn {{ $plan->name === 'yearly' ? 'btn-success' : 'btn-primary' }}">{{ __('messages.subscribe_now') }}</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>
<!-- Featured Section End -->
