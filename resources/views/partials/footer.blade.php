@php
    $locale = app()->getLocale();
@endphp

<footer class="footer">
    <div class="container">
        <div class="footer__grid">
            <div>
                <div class="footer__title">{{ __('footer.contact_title') }}</div>

                <div class="footer__contact">
                    <div>
                        {{ __('footer.email_label') }} <a href="mailto:info@treehouseitalia.it">info@treehouseitalia.it</a>
                    </div>
                    <div>
                        {{ __('footer.phone_label') }} <a href="tel:+390198387211">+39 019 8387211</a>
                    </div>
                    <div>
                        {{ __('footer.vat_label') }} IT01581160098
                    </div>
                    <div>
                        {{ __('footer.address_label') }} Via Agostino Chiodo 6, Savona, 17100
                    </div>
                </div>
            </div>

            <div>
                <div class="footer__title">{{ __('footer.useful_links') }}</div>
                <ul class="footer__links">
                    <li><a href="{{ route('legal.privacy', ['locale' => $locale]) }}">{{ __('legal.privacy.title') }}</a></li>
                    <li><a href="{{ route('legal.cookies', ['locale' => $locale]) }}">{{ __('legal.cookies.title') }}</a></li>
                    <li><a href="{{ route('legal.terms', ['locale' => $locale]) }}">{{ __('legal.terms.title') }}</a></li>
                    <li><a href="{{ route('legal.notice', ['locale' => $locale]) }}">{{ __('legal.notice.title') }}</a></li>
                    <li><a href="{{ route('legal.accessibility', ['locale' => $locale]) }}">{{ __('legal.accessibility.title') }}</a></li>
                    <li><a href="{{ route('legal.cookie_preferences', ['locale' => $locale]) }}">{{ __('legal.cookie_preferences.title') }}</a></li>
                </ul>
            </div>
        </div>

        <div class="footer__bottom">
            <small>© {{ date('Y') }} {{ config('app.name', 'TreeHouse Italia') }}</small>
            <small>
                <a href="{{ route('legal.privacy', ['locale' => $locale]) }}">{{ __('legal.privacy.title') }}</a>
                <span aria-hidden="true"> • </span>
                <a href="{{ route('legal.cookies', ['locale' => $locale]) }}">{{ __('legal.cookies.title') }}</a>
            </small>
        </div>
    </div>
</footer>
