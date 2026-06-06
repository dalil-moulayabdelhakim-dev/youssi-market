<!doctype html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo.jpg') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/register/myCstm.css') }}" />
    <style>
        :root{
            --primary-color: #03c8e2
        }
        body {
            background: #f5f4f4;
        }

        .list-group-item.active {
            background: var(--primary-color);
            border-color: var(--primary-color);
        }

        .profile-cover {
            background: url('https://picsum.photos/1200/300?blur=2') center/cover no-repeat;
            height: 180px;
            border-top-left-radius: .375rem;
            border-top-right-radius: .375rem;
            position: relative;
        }

        .avatar-circle {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: var(--primary-color);;
            color: #fff;
            font-size: 32px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            bottom: -50px;
            left: 20px;
            border: 4px solid #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .card-body {
            margin-top: 60px;
        }
        .logo{
            width: 100%;
            height: auto;
        }
    </style>
</head>

<body>

    @include('popup')
    <div class="container py-4">
        <div class="row">
            <!-- Sidebar -->
            <div class=" col-md-3 mb-3 ">
                <div class="list-group shadow-sm rounded-4 overflow-hidden sticky-top">

                    <a href="#"><img class="logo"  src="{{ asset('img/logo.jpg') }}" alt=""></a>
                    <a href="#" class="list-group-item list-group-item-action active" id="btn-profile">
                        <i class="bi bi-person"></i> {{ __('messages.profile') }}
                    </a>
                    <a href="#" class="list-group-item list-group-item-action" id="btn-settings">
                        <i class="bi bi-gear"></i> {{ __('messages.settings') }}
                    </a>
                    <a href="{{ route('/') }}" class="list-group-item list-group-item-action">
                        <i class="bi bi-house"></i> {{ __('messages.home') }}
                    </a>
                    <a href="{{ route('logout') }}" class="list-group-item list-group-item-action text-danger"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right"></i> {{ __('messages.logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>

            <!-- Main -->
            <div class="col-md-9">
                <!-- Profile Card -->
                <div class="card shadow-sm mb-3" id="card-profile">
                    <div class="profile-cover">
                        <div class="avatar-circle">
                            {{ collect(explode(' ', $user->name))->map(fn($w) => strtoupper(substr($w, 0, 1)))->take(2)->implode('') }}
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $user->name }}</h5>
                        <p><strong>{{ __('messages.email') }}:</strong> {{ $user->email }}</p>
                        <p><strong>{{ __('messages.wilaya') }}:</strong>
                            @if($user->wilaya)
                                {{ app()->getLocale() === 'ar' ? ($user->wilaya->ar_name ?? $user->wilaya->name) : ($user->wilaya->name ?? $user->wilaya->ar_name) }}
                            @else
                                —
                            @endif
                        </p>
                        <p><strong>{{ __('messages.commune') }}:</strong>
                            @if($user->commune)
                                {{ app()->getLocale() === 'ar' ? ($user->commune->ar_name ?? $user->commune->name) : ($user->commune->name ?? $user->commune->ar_name) }}
                            @else
                                —
                            @endif
                        </p>
                        <p><strong>{{ __('messages.address') }}:</strong>
                            {{ $user->address ?? __('messages.not_available') }}</p>
                        <p><strong>{{ __('messages.joined') }}:</strong> {{ $user->created_at?->format('d M Y') }}</p>

                        @if ($user->store)
                            <hr>
                            <h5 class="text-primary"><i class="bi bi-shop"></i> {{ __('messages.store_info') }}</h5>
                            <p><strong>{{ __('messages.store_name') }}:</strong> {{ $user->store->name }}</p>
                            <p><strong>{{ __('messages.address') }}:</strong> {{ $user->store->adress }}</p>
                            <p><strong>{{ __('messages.category') }}:</strong> {{ $user->store->category }}</p>
                            <p><strong>{{ __('messages.contact') }}:</strong> {{ $user->store->contact }}</p>
                            <p><strong>{{ __('messages.subscription_status') }}:</strong>
                                {{ __('messages.') . $user->store->subscription_status }}</p>
                            @switch($user->store->subscription_status)
                                @case('trial')
                                    <p>
                                        <strong>{{ __('messages.ش') }}:</strong>
                                        {{ $user->store->trial_ends_at }}
                                    </p>
                                @break

                                @case('active')
                                    <p>
                                        <strong>{{ __('messages.expired_at') }}:</strong>
                                        {{ $user->store->subscription_ends_at }}
                                    </p>
                                @break

                                @case('expired')
                                    {{-- لا نظهر تاريخ --}}
                                @break
                            @endswitch

                            <p><strong>{{ __('messages.commission_rate') }}:</strong>
                                {{ (int) $user->store->commission_rate }}%</p>
                        @endif
                    </div>
                </div>

                <!-- Settings Card -->
                <div class="card shadow-sm mb-3 d-none" id="card-settings">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0"><i class="bi bi-gear"></i> {{ __('messages.settings') }}</h5>
                    </div>
                    <div class="card-body">
                        {{-- قسم المعلومات الشخصية --}}
                        <form action="{{ route('profile.updatePersonal') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <h5 class="text-primary">{{ __('messages.personal_info') }}</h5>
                            <div class="mb-3">
                                <label class="form-label">{{ __('messages.name') }}</label>
                                <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{ __('messages.email') }}</label>
                                <input type="text" name="email" class="form-control" value="{{ $user->email }}">
                            </div>

                            <div class="input-box m-1">
                                <label for="wilaya" class="form-label">{{ __('messages.wilaya') }}</label>
                                <select class="form-control" id="wilaya" name="wilaya_id">
                                    <option value="">{{ __('messages.select_wilaya') }}</option>
                                    @foreach ($wilayas as $wilaya)
                                        @switch(config('app.locale'))
                                            @case('ar')
                                                <option value="{{ $wilaya->id }}">
                                                    {{ $wilaya->ar_name }}</option>
                                            @break

                                            @case('en')
                                                <option value="{{ $wilaya->id }}">
                                                    {{ $wilaya->name }}</option>
                                            @break

                                            @default
                                        @endswitch
                                    @endforeach
                                </select>
                            </div>

                            <div class="input-box m-1">
                                <label for="commune" class="form-label">{{ __('messages.commune') }}</label>
                                <select class="form-control" id="commune" name="commune_id"
                                    data-loading="{{ __('messages.loading') }}"
                                    data-select="{{ __('messages.select_commune') }}">
                                    <option value="">{{ __('messages.select_commune') }}</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{ __('messages.address') }}</label>
                                <input type="text" name="address" class="form-control" value="{{ $user->address }}">
                            </div>

                            <button type="submit" class="btn btn-primary">{{ __('messages.save_changes') }}</button>
                        </form>

                        <hr>

                        {{-- قسم كلمة المرور --}}
                        <form action="{{ route('profile.updatePassword') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <h5 class="text-primary">{{ __('messages.change_password') }}</h5>
                            <!-- كلمة المرور الحالية -->
                            <div class="mb-3">
                                <label class="form-label">{{ __('messages.current_password') }}</label>
                                <input type="password" name="current_password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('messages.password') }} </label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('messages.confirm_password') }}</label>
                                <input type="password" name="password_confirmation" class="form-control">
                            </div>

                            <button type="submit"
                                class="btn btn-primary">{{ __('messages.change_password') }}</button>
                        </form>

                        <hr>

                        {{-- قسم المتجر --}}
                        @if ($user->store)
                            <form action="{{ route('profile.updateStore') }}" method="POST">
                                @csrf
                                @method('PUT')

                                <h5 class="text-primary">{{ __('messages.store_settings') }}</h5>
                                <div class="mb-3">
                                    <label class="form-label">{{ __('messages.store_name') }}</label>
                                    <input type="text" name="store_name" class="form-control"
                                        value="{{ $user->store->name }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">{{ __('messages.contact') }}</label>
                                    <input type="text" name="store_contact" class="form-control"
                                        value="{{ $user->store->contact }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">{{ __('messages.category') }}</label>
                                    <input type="text" name="store_category" class="form-control"
                                        value="{{ $user->store->category }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">{{ __('messages.address') }}</label>
                                    <input type="text" name="store_address" class="form-control"
                                        value="{{ $user->store->address }}">
                                </div>

                                <button type="submit"
                                    class="btn btn-primary">{{ __('messages.save_changes') }}</button>
                            </form>
                        @endif

                        <hr>

                        {{-- قسم اللغة --}}
                        <h5 class="text-primary"><i class="bi bi-translate"></i> {{ __('messages.language') }}</h5>
                        @switch(config('app.locale'))
                            @case('ar')
                                <b><a href="{{ route('lang.switch', 'en') }}">English</a></b>
                            @break

                            @case('en')
                                <b><a href="{{ route('lang.switch', 'ar') }}">العربية</a></b>
                            @break

                            @default
                        @endswitch


                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const btnProfile = document.getElementById('btn-profile');
        const btnSettings = document.getElementById('btn-settings');
        const cardProfile = document.getElementById('card-profile');
        const cardSettings = document.getElementById('card-settings');

        btnProfile.addEventListener('click', (e) => {
            e.preventDefault();
            cardProfile.classList.remove('d-none');
            cardSettings.classList.add('d-none');
            btnProfile.classList.add('active');
            btnSettings.classList.remove('active');
        });

        btnSettings.addEventListener('click', (e) => {
            e.preventDefault();
            cardSettings.classList.remove('d-none');
            cardProfile.classList.add('d-none');
            btnSettings.classList.add('active');
            btnProfile.classList.remove('active');
        });

        document.getElementById("wilaya").addEventListener("change", function() {
            let wilayaId = this.value;
            let communeSelect = document.getElementById("commune");

            // نجيب النصوص من data attributes
            let loadingText = communeSelect.dataset.loading;
            let selectText = communeSelect.dataset.select;

            communeSelect.innerHTML = `<option value="">${loadingText}</option>`;

            let locale = document.documentElement.lang; // أو نمرروها من Blade

            if (wilayaId) {
                fetch("/api/communes/" + wilayaId)
                    .then((response) => response.json())
                    .then((data) => {
                        communeSelect.innerHTML = `<option value="">${selectText}</option>`;
                        data.forEach((commune) => {
                            let name =
                                locale === "ar" ? commune.ar_name : commune.name;
                            communeSelect.innerHTML += `<option value="${commune.id}">${name}</option>`;
                        });
                    });
            } else {
                communeSelect.innerHTML = `<option value="">${selectText}</option>`;
            }
        });
    </script>
</body>

</html>
