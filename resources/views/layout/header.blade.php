<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>

<!-- Humberger Begin -->
<div class="humberger__menu__overlay"></div>
<div class="humberger__menu__wrapper">
    <div class="humberger__menu__logo">
        <a href="#"><img src="{{ asset('img/logo.jpg') }}" alt=""></a>
    </div>
    <div class="humberger__menu__cart">
        <ul>
            <li><a href="{{ route('cart-view') }}"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
        </ul>
    </div>
    <div class="humberger__menu__widget">
        <div class="header__top__right__language">
            @if (app()->getLocale() == 'en')
                <img style="width: 27px" src="{{ asset('img/lang/en.png') }}" alt="">
            @elseif (app()->getLocale() == 'ar')
                <img style="width: 27px" src="{{ asset('img/lang/ar.png') }}" alt="">
            @endif

            <div>{{ app()->getLocale() == 'ar' ? 'العربية' : 'English' }}</div>
            <span class="arrow_carrot-down"></span>
            <ul>
                <li><a href="{{ route('lang.switch', 'ar') }}">العربية</a></li>
                <li><a href="{{ route('lang.switch', 'en') }}">English</a></li>
            </ul>
        </div>
        @if (Route::has('login'))
            @auth
                <div class="header__top__right__auth">
                    <a href="{{ route('profile') }}"> <i class="fa fa-user"></i> {{ __('messages.profile') }}</a>
                </div>
                @isset($user_type)
                    @if ($user_type != 3)
                        <div class="header__top__right__auth" style="margin-left: 10px">
                            <a href="{{ route('dashboard') }}"> <i class="fa fa-user"></i>
                                {{ __('messages.dashboard') }}</a>
                        </div>
                    @endif
                @endisset

                <div class="header__top__right__auth" style="margin-left: 10px">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" style="background: none; border: none; color: inherit;">
                            <i class="fa fa-sign-out"></i> {{ __('messages.logout') }}
                        </button>
                    </form>
                </div>
            @else
                <div class="header__top__right__auth">
                    <a href="{{ route('login') }}"><i class="fa fa-lock"></i> {{ __('messages.login') }}</a>
                </div>
                @if (Route::has('register'))
                    <div class="header__top__right__auth" style="margin-left: 10px">
                        <a href="{{ route('register') }}"> <i class="fa fa-user"></i> {{ __('messages.register') }}</a>
                    </div>
                @endif
            @endauth
        @endif
    </div>
    <nav class="humberger__menu__nav mobile-menu">
        <ul>
            <li class="active"><a href="{{ route('/') }}">{{ __('messages.home') }}</a></li>
            <li><a href="#">{{ __('messages.shop') }}</a></li>
            <li><a href="{{ route('cart-view') }}">{{ __('messages.cart') }}</a></li>
            <li><a href="{{route('contact.view')}}">{{ __('messages.contact') }}</a></li>

        </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>
    <div class="header__top__right__social">
        <a href="https://www.facebook.com/profile.php?id=61570952016140" target="_blank" rel="noopener noreferrer"><i
                class="fa fa-facebook"></i></a>
        <a href="https://www.instagram.com/youssi_market/" target="_blank" rel="noopener noreferrer"><i
                class="fa fa-instagram"></i></a>
    </div>
    <div class="humberger__menu__contact">
        <ul>
            <li><i class="fa fa-envelope"></i>
                @isset($admin_info)
                    {{ $admin_info->email }}
                @endisset
            </li>
            <li style="direction: {{ config('app.locale') === 'ar' ? 'rtl' : 'ltr' }}">
                @isset($user_type)
                    @if ($user_type == 2)
                        @isset($subscription)
                            @if ($subscription == 3)
                                <a class="subscreption" href="{{ route('subscribe-view') }}"> <i class="fa fa-money"></i>
                                    {{ __('messages.subscribe') }}</a>
                            @endif
                        @endisset
                        @isset($subscription_status)
                            <a class="subscreption_status" href="#">
                                {{ __('messages.' . $subscription_status) }}</a>
                        @endisset
                    @endif
                @endisset
            </li>
        </ul>
    </div>
</div>
<!-- Humberger End -->


<!-- Header Section Begin -->
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__left">
                        <ul>
                            <li><i class="fa fa-envelope"></i>
                                @isset($admin_info)
                                    {{ $admin_info->email }}
                                @endisset
                            </li>
                            <li style="direction: {{ config('app.locale') === 'ar' ? 'rtl' : 'ltr' }}">
                                @isset($user_type)
                                    @if ($user_type == 2)
                                        @isset($subscription)
                                            @if ($subscription == 3)
                                                <a class="subscreption" href="{{ route('subscribe-view') }}"> <i
                                                        class="fa fa-money"></i>
                                                    {{ __('messages.subscribe') }}</a>
                                            @endif
                                        @endisset
                                        @isset($subscription_status)
                                            <a class="subscreption_status" href="#">
                                                {{ __('messages.' . $subscription_status) }}</a>
                                        @endisset
                                    @endif
                                @endisset
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__right">
                        <div class="header__top__right__social">
                            <a href="https://www.facebook.com/profile.php?id=61570952016140" target="_blank"
                                rel="noopener noreferrer"><i class="fa fa-facebook"></i></a>
                            <a href="https://www.instagram.com/youssi_market/" target="_blank"
                                rel="noopener noreferrer"><i class="fa fa-instagram"></i></a>
                        </div>
                        <div class="header__top__right__language">
                            @if (app()->getLocale() == 'en')
                                <img style="width: 27px" src="{{ asset('img/lang/en.png') }}" alt="">
                            @elseif (app()->getLocale() == 'ar')
                                <img style="width: 27px" src="{{ asset('img/lang/ar.png') }}" alt="">
                            @endif
                            <div>{{ app()->getLocale() == 'ar' ? 'العربية' : 'English' }}</div>
                            <span class="arrow_carrot-down"></span>
                            <ul>
                                <li><a href="{{ route('lang.switch', 'ar') }}">العربية</a></li>
                                <li><a href="{{ route('lang.switch', 'en') }}">English</a></li>
                            </ul>
                        </div>
                        @if (Route::has('login'))
                            @auth
                                <div class="header__top__right__auth">
                                    <a href="{{ route('profile') }}"> <i class="fa fa-user"></i>
                                        {{ __('messages.profile') }}</a>
                                </div>
                                @isset($user_type)
                                    @if ($user_type != 3)
                                        <div class="header__top__right__auth" style="margin-left: 10px">
                                            <a href="{{ route('dashboard') }}"> <i class="fa fa-user"></i>
                                                {{ __('messages.dashboard') }}</a>
                                        </div>
                                    @endif
                                @endisset

                                <div class="header__top__right__auth" style="margin-left: 10px">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" style="background: none; border: none; color: inherit;">
                                            <i class="fa fa-sign-out"></i> {{ __('messages.logout') }}
                                        </button>
                                    </form>
                                </div>
                            @else
                                <div class="header__top__right__auth">
                                    <a href="{{ route('login') }}"><i class="fa fa-lock"></i>
                                        {{ __('messages.login') }}</a>
                                </div>
                                @if (Route::has('register'))
                                    <div class="header__top__right__auth" style="margin-left: 10px">
                                        <a href="{{ route('register') }}"> <i class="fa fa-user"></i>
                                            {{ __('messages.register') }}</a>
                                    </div>
                                @endif
                            @endauth
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">

                <div class="header__logo">
                    <a href="{{ route('/') }}"><img src="{{ asset('img/logo.jpg') }}" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="header__menu">
                    <ul>
                        <li class="active"><a href="{{ route('/') }}">{{ __('messages.home') }}</a></li>
                        <li><a href="#">{{ __('messages.shop') }}</a></li>
                        <li><a href="{{ route('cart-view') }}">{{ __('messages.cart') }}</a></li>
                        <li><a href="{{route('contact.view')}}">{{ __('messages.contact') }}</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__cart">
                    <ul>
                        <li><a href="{{ route('cart-view') }}"><i
                                    class="fa fa-shopping-bag"></i><span>{{ $cartCount }}</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
<!-- Header Section End -->
