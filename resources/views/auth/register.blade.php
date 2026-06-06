<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" dir="{{ config('app.locale') === 'ar' ? 'rtl' : 'ltr' }}">


@include('auth.layouts.head')

<body>

    @include('popup')
    <div class="homed">
        <a href="{{ route('/') }}" class="btn btn-outline-primary"><i class="bi bi-arrow-left"></i>
            {{ __('messages.home') }}</a>
    </div>
    <div class="register-container">
        <div class="title">{{ __('messages.registration') }}</div>

        <div class="content">
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf
                <div class="container user-details">
                    <!-- العنوان الشخصي -->
                    <div class="row">
                        <h3 id="titre">{{ __('messages.personal_details') }}</h3>
                    </div>
                    <div class="row">
                        <div class="input-box m-1">
                            <label for="role" class="details">{{ __('messages.reason_for_joining') }}</label>
                            <select id="role" name="user_type" onchange="toggleFields()">
                                <option value="3">{{ __('messages.customer') }}</option>
                                <option value="2">{{ __('messages.seller') }}</option>
                            </select>
                        </div>

                        <div class="input-box m-1">
                            <label for="name" class="details">{{ __('messages.full_name') }}</label>
                            <input id="name" type="text" name="name" required autocomplete="name"
                                placeholder="{{ __('messages.enter_your_name') }}">
                        </div>
                    </div>



                    <div class="row gap-3">
                        <div class="input-box m-1">
                            <label for="phone" class="details">{{ __('messages.phone_number') }}</label>
                            <input id="phone" type="tel" pattern="[0-9]{10}" name="phone" required
                                autocomplete="phone" placeholder="{{ __('messages.enter_your_phone_number') }}">
                        </div>

                        <div class="input-box m-1">
                            <label for="email" class="details">{{ __('messages.email') }}</label>
                            <input id="email" type="email" placeholder="{{ __('messages.enter_your_email') }}"
                                name="email" value="{{ old('email') }}" required autocomplete="email">
                        </div>
                    </div>

                    <!-- العنوان -->
                    <div class="row mt-3">
                        <h3 id="titre">{{ __('messages.address') }}</h3>
                    </div>

                    <div class="row">
                        <div class="input-box m-1">
                            <label for="wilaya" class="details">{{ __('messages.wilaya') }}</label>
                            <select id="wilaya" name="wilaya_id" required>
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
                            <label for="commune" class="details">{{ __('messages.commune') }}</label>
                            <select id="commune" name="commune_id" required
                                data-loading="{{ __('messages.loading') }}"
                                data-select="{{ __('messages.select_commune') }}">
                                <option value="">{{ __('messages.select_commune') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="row gap-3">
                        <div class="input-box m-1">
                            <label for="address" class="details">{{ __('messages.address') }}</label>
                            <input id="address" type="text" name="address"
                                placeholder="{{ __('messages.enter_your_address') }}">
                        </div>
                    </div>

                    <!-- الأمان -->
                    <div class="row mt-3">
                        <h3 id="titre">{{ __('messages.password') }}</h3>
                    </div>

                    <div class="row gap-3">
                        <div class="input-box m-1">
                            <label for="password" class="details">{{ __('messages.password') }}</label>
                            <input id="password" type="password" name="password" required autocomplete="password"
                                placeholder="{{ __('messages.enter_your_password') }}">
                            <div class="tooltip2 d-none" id="passwordTooltip">
                                {{ __('messages.password_uppercase') }}<br>
                                {{ __('messages.password_lowercase') }}<br>
                                {{ __('messages.password_digit') }}<br>
                                {{ __('messages.password_special') }}<br>
                                {{ __('messages.password_min_length') }}
                            </div>
                        </div>

                        <div class="input-box m-1">
                            <label for="password_confirmation"
                                class="details">{{ __('messages.confirm_password') }}</label>
                            <input id="password_confirmation" type="password" name="password_confirmation"
                                placeholder="{{ __('messages.confirm_your_password') }}" required
                                autocomplete="new-password">
                        </div>
                    </div>

                    <!-- بيانات المتجر -->
                    <div id="storeSection">
                        <div class="row mt-3">
                            <h3>{{ __('messages.store_details') }}</h3>
                        </div>

                        <div class="row gap-3">
                            <div class="input-box m-1" id="st_name">
                                <label for="store_name" class="details">{{ __('messages.store_name') }}</label>
                                <input id="store_name" type="text" name="store_name" autocomplete="name"
                                    placeholder="{{ __('messages.enter_your_store_name') }}">
                            </div>

                            <div class="input-box m-1" id="st_category">
                                <label for="store_category"
                                    class="details">{{ __('messages.store_category') }}</label>
                                <input id="store_category" type="text" name="store_category"
                                    autocomplete="store_category"
                                    placeholder="{{ __('messages.enter_your_store_category') }}">
                            </div>
                        </div>



                        <div class="row gap-3">
                            <div class="input-box m-1" id="st_address">
                                <label for="store_address" class="details">{{ __('messages.store_address') }}</label>
                                <input id="store_address" type="text" name="store_address"
                                    autocomplete="store_address"
                                    placeholder="{{ __('messages.enter_your_store_address') }}">
                            </div>

                            <div class="input-box m-1" id="st_contact">
                                <label for="store_contact" class="details">{{ __('messages.store_contact') }}</label>
                                <input id="store_contact" type="text" name="store_contact"
                                    autocomplete="store_contact"
                                    placeholder="{{ __('messages.enter_your_store_contact') }}">
                            </div>
                        </div>




                        <div class="row gap-3">
                            <div class="input-box m-1" id="st_proof">
                                <label for="store_proof" class="details">{{ __('messages.proof') }}</label>
                                <input id="store_proof" type="file" accept=".pdf, image/*, .doc, .docx"
                                    name="store_proof" autocomplete="store_proof"
                                    placeholder="{{ __('messages.proof_of_ownership_or_commercial_activity') }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="button">
                    <input type="submit" value="{{ __('messages.register') }}">
                </div>
            </form>

            <div class="txt-cnt">
                <p>{{ __('messages.you_already_have_an_account?') }} <a href="{{ route('login') }}"
                        class="link">{{ __('messages.login') }}</a></p>
            </div>

        </div>
    </div>

    <script src="{{ asset('js/auth/valider.js') }}"></script>

</body>

</html>




{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row gap-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
