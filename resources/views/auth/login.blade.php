<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" dir="{{ config('app.locale') === 'ar' ? 'rtl' : 'ltr' }}">


@include('auth.layouts.head')

<body>

@include('popup')

    <div class="homed">
        <a href="{{ route('/') }}" class="btn btn-outline-primary"><i class="bi bi-arrow-left"></i> {{__('messages.home')}}</a>
    </div>
    <div class="login-container">
        <img style="width: 100%" src="{{asset('img/logo.jpg')}}" alt="">
        <div class="title">{{ __('messages.login') }}</div>
        <div class="content">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="login-form">

                    <div class="input-box">
                        <span class="details">{{ __('messages.email') }}</span>
                        <input id="email" type="email"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    </div>

                    <div class="input-box">
                        <span class="details">{{ __('messages.password') }}</span>
                        <input id="password" type="password"
                            name="password" required autocomplete="current-password">

                    </div>

                </div>
                <div>
                    <a href="{{route('password.request')}}" class="link">
                        {{__('messages.forgot_your_password')}}
                    </a>
                </div>
                <div class="button">
                    <input type="submit" value="{{ __('messages.login') }}">
                </div>
            </form>
            <div class="txt-cnt"">
                <p>{{__('messages.you_dont_have_an_account')}} <a href="{{ route('register') }}" class="link">{{__('messages.register')}}</a></p>
            </div>
        </div>
    </div>

</body>

</html>






{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}" />
    <title>MedPital</title>
</head>

<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form action="{{ route('login') }}" method="POST" class="sign-in-form">
                    @csrf
                    <h2 class="title">Sign in</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" placeholder="Enter your email" required>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input id="password" type="password" class="@error('password') is-invalid @enderror"
                            name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <input type="submit" value="Login" class="btn solid" />

                </form>
                <form action="{{ route('register') }}" method="POST" class="sign-up-form">
                    @csrf
                    <div class="column">

                        <h2 class="title">Sign up</h2>
                        <div class="input-field">
                            <i class="fas fa-user"></i>
                            <input id="name" type="text" class=" @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" required autocomplete="name"
                                placeholder="Enter your name">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="input-field">
                            <i class="fas fa-id-card"></i>
                            <input id="id_card_number" type="text" pattern="[0-9]+"
                                class=" @error('id_card_number') is-invalid @enderror" name="id_card_number"
                                value="{{ old('id_card_number') }}" required autocomplete="id_card_number"
                                placeholder="ID card number">
                            @error('id_cart_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="input-field">
                            <i class="fas fa-calendar"></i>
                            <input id="date_of_birth" type="date"
                                class=" @error('date_of_birth') is-invalid @enderror" name="date_of_birth"
                                value="{{ old('date_of_birth') }}" required autocomplete="date_of_birth"
                                placeholder="Date of birth">
                            @error('date_of_birth')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="input-field">
                            <i class="fas fa-envelope"></i>
                            <input id="email" type="email" class=" @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email"
                                placeholder="Email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="column">
                        <div class="input-field">
                            <i class="fas fa-phone"></i>
                            <input id="phone" type="tel" pattern="[0-9]{10}" class=" @error('phone') is-invalid @enderror"
                                name="phone" value="{{ old('phone') }}" required autocomplete="phone"
                                placeholder="Phone">
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="input-field ">
                            <i class="fas fa-calendar"></i>
                            <select required>
                                <option disabled selected>Gender</option>
                                <option value="1">Male</option>
                                <option value="2">Memale</option>
                            </select>

                        </div>

                        <div class="input-field">
                            <i class="fas fa-lock"></i>
                            <input id="password" type="password" class=" @error('password') is-invalid @enderror"
                                name="password" value="{{ old('password') }}" required autocomplete="password"
                                placeholder="Enter your password">
                        </div>

                        <div class="input-field">
                            <i class="fas fa-lock"></i>
                            <input id="password_confirmation" type="password" name="password_confirmation"
                                placeholder="Confirm password" required autocomplete="new-password">
                        </div>

                        <div class="input-field">
                            <i class="fas fa-file"></i>
                            <input type="file" name="id_card_file" accept=".pdf, .doc, .docx, image/*" required />
                        </div>
                    </div>

                    <input type="submit" class="btn" value="Sign up" />

                </form>

            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>New here ?</h3>
                    <p>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis,
                        ex ratione. Aliquid!
                    </p>
                    <button class="btn transparent" id="sign-up-btn">
                        Sign up
                    </button>
                </div>
                <img src="img/auth/log.svg" class="image" alt="" />
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>One of us ?</h3>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum
                        laboriosam ad deleniti.
                    </p>
                    <button class="btn transparent" id="sign-in-btn">
                        Sign in
                    </button>
                </div>
                <img src="img/auth/register.svg" class="image" alt="" />
            </div>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html> --}}






{{--
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class=" @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

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
                                <input id="password" type="password" class=" @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
