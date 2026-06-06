<!-- Footer Section Begin -->
<footer class="footer spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer__about">
                    <div class="footer__about__logo">
                        <a href="./index.html"><img src="{{ asset('img/logo.jpg') }}" alt=""></a>
                    </div>
                    @isset($admin_info)
                        <ul>
                            <li>{{ __('messages.address') }}: Bechar</li>
                            <li>{{ __('messages.phone') }}:  {{ $admin_info->phone }}</li>
                            <li>{{ __('messages.email') }}:  {{ $admin_info->email }}</li>
                        </ul>
                    @endisset

                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                <div class="footer__widget">
                    <h6>{{ __('messages.useful_links') }}</h6>
                    <ul>
                        <li><a href="{{ route('/') }}">{{ __('messages.about_us') }}</a></li>
                        <li><a href="{{ route('/') }}">{{ __('messages.about_our_shop') }}</a></li>
                        <li><a href="#">{{ __('messages.secure_shopping') }}</a></li>
                        <li><a href="#">{{ __('messages.delivery_information') }}</a></li>
                        <li><a href="#">{{ __('messages.privacy_policy') }}</a></li>
                        <li><a href="#">{{ __('messages.our_sitemap') }}</a></li>
                    </ul>
                    <ul>
                        <li><a href="#">{{ __('messages.who_we_are') }}</a></li>
                        <li><a href="#">{{ __('messages.our_services') }}</a></li>
                        <li><a href="#">{{ __('messages.projects') }}</a></li>
                        <li><a href="{{ route('contact.view') }}">{{ __('messages.contact') }}</a></li>
                        <li><a href="#">{{ __('messages.innovation') }}</a></li>
                        <li><a href="#">{{ __('messages.testimonials') }}</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="footer__widget">
                    <h6>{{ __('messages.join_newsletter') }}</h6>
                    <p>{{ __('messages.get_email_updates') }}</p>
                    <form action="#">
                        <input type="text" placeholder="{{ __('messages.enter_your_mail') }}">
                        <button type="submit" class="site-btn">{{ __('messages.subscribe') }}</button>
                    </form>
                    <div class="footer__widget__social">
                        <a href="https://www.facebook.com/profile.php?id=61570952016140" target="_blank"
                            rel="noopener noreferrer"><i class="fa fa-facebook"></i></a>
                        <a href="https://www.instagram.com/youssi_market/" target="_blank" rel="noopener noreferrer"><i
                                class="fa fa-instagram"></i></a>
                    </div>
                    <div class="language-switcher mt-3">
                        <a href="{{ route('lang.switch', 'en') }}"
                            class="{{ app()->getLocale() == 'en' ? 'font-weight-bold' : '' }}">English</a> |
                        <a href="{{ route('lang.switch', 'ar') }}"
                            class="{{ app()->getLocale() == 'ar' ? 'font-weight-bold' : '' }}">العربية</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="footer__copyright">
                    <div class="footer__copyright__text">
                        <p>
                            &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script> {{ __('messages.all_rights_reserved') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->
