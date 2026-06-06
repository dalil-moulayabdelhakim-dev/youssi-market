<footer class="content-footer sticky-bottom footer bg-footer-theme">
    <div class="container-xxl">
        <div class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
            <div class="mb-2 mb-md-0">
                &copy;
                <script>
                    document.write(new Date().getFullYear());
                </script>
                {{ __('messages.all_rights_reserved') }}
                <a href="{{ route('/') }}" target="_blank" class="footer-link">
                    {{ config('app.name') }}
                </a>
            </div>
            <div class="language-switcher mt-3">
                <a href="{{ route('lang.switch', 'en') }}"
                    class="{{ app()->getLocale() == 'en' ? 'fw-bold' : '' }}">English</a> |
                <a href="{{ route('lang.switch', 'ar') }}"
                    class="{{ app()->getLocale() == 'ar' ? 'fw-bold' : '' }}">العربية</a>
            </div>
        </div>
    </div>
</footer>
