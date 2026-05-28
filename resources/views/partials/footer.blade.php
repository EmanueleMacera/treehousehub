@php
    $locale = app()->getLocale();
    $adminUrl = auth()->check() ? route('admin.dashboard') : route('admin.login');
@endphp

<footer class="footer">
    <div class="container">
        <div class="footer__topline"></div>

        <div class="footer__grid">
            <section class="footer__brand-block" aria-labelledby="footer-brand-title">
                <a class="footer__brand" id="footer-brand-title" href="{{ route('home', ['locale' => $locale]) }}">
                    @if (file_exists(public_path('images/logo-treehouse.png')))
                        <img src="{{ asset('images/logo-treehouse.png') }}" alt="{{ __('footer.brand_title') }}">
                    @else
                        <span>{{ __('footer.brand_title') }}</span>
                    @endif
                </a>
                <p class="footer__claim">{{ __('footer.claim') }}</p>
            </section>

            <section aria-labelledby="footer-nav-title">
                <div class="footer__title" id="footer-nav-title">{{ __('footer.navigation_title') }}</div>
                <ul class="footer__links">
                    <li><a href="{{ route('home', ['locale' => $locale]) }}">{{ __('footer.links.home') }}</a></li>
                    <li><a href="{{ route('rentals.index', ['locale' => $locale]) }}">{{ __('nav.rentals') }}</a></li>
                    <li><a href="{{ route('sales.index', ['locale' => $locale]) }}">{{ __('nav.sales') }}</a></li>
                    <li><a href="{{ route('owners', ['locale' => $locale]) }}">{{ __('nav.owners') }}</a></li>
                    <li><a href="{{ route('about', ['locale' => $locale]) }}">{{ __('nav.about') }}</a></li>
                    <li><a href="{{ route('contact', ['locale' => $locale]) }}">{{ __('nav.contact') }}</a></li>
                </ul>
            </section>

            <section aria-labelledby="footer-contact-title">
                <div class="footer__title" id="footer-contact-title">{{ __('footer.contact_title') }}</div>
                <address class="footer__contact">
                    <span>{{ __('footer.address_label') }} Via Agostino Chiodo 6, 17100 Savona</span>
                    <span>{{ __('footer.email_label') }} <a href="mailto:info@treehouseitalia.it">info@treehouseitalia.it</a></span>
                    <span>{{ __('footer.phone_label') }} <a href="tel:+390198387211">+39 019 8387211</a></span>
                    <span>{{ __('footer.vat_label') }} IT01581160098</span>
                </address>
            </section>

            <section aria-labelledby="footer-legal-title">
                <div class="footer__title" id="footer-legal-title">{{ __('footer.useful_links') }}</div>
                <ul class="footer__links">
                    <li><a href="{{ route('legal.privacy', ['locale' => $locale]) }}">{{ __('legal.privacy.title') }}</a></li>
                    <li><a href="{{ route('legal.cookies', ['locale' => $locale]) }}">{{ __('legal.cookies.title') }}</a></li>
                    <li><a href="{{ route('legal.terms', ['locale' => $locale]) }}">{{ __('legal.terms.title') }}</a></li>
                    <li><a href="{{ route('legal.notice', ['locale' => $locale]) }}">{{ __('legal.notice.title') }}</a></li>
                    <li><a href="{{ route('legal.accessibility', ['locale' => $locale]) }}">{{ __('legal.accessibility.title') }}</a></li>
                    <li><a href="{{ route('legal.cookie_preferences', ['locale' => $locale]) }}">{{ __('legal.cookie_preferences.title') }}</a></li>
                </ul>
            </section>
        </div>

        <div class="footer__bottom">
            <small>{{ __('footer.copyright', ['year' => date('Y')]) }}</small>
            <div class="footer__bottom-links">
                <a href="{{ route('legal.privacy', ['locale' => $locale]) }}">{{ __('legal.privacy.title') }}</a>
                <a href="{{ route('legal.cookies', ['locale' => $locale]) }}">{{ __('legal.cookies.title') }}</a>
                <a href="{{ $adminUrl }}">{{ __('footer.admin_login') }}</a>
            </div>
        </div>
    </div>
</footer>
