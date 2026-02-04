@php
    $locale = app()->getLocale();
@endphp

<footer class="border-top mt-5 py-4 bg-body-tertiary">
    <div class="container">
        <div class="row g-4">
            <div class="col-12 col-md-6">
                <h5 class="mb-3">{{ __('footer.contact_title') }}</h5>

                <div class="small text-body-secondary">
                    <div class="mb-1">
                        {{ __('footer.email_label') }}
                        <a href="mailto:info@treehouseitalia.it">info@treehouseitalia.it</a>
                    </div>
                    <div class="mb-1">
                        {{ __('footer.phone_label') }}
                        <a href="tel:+390198387211">+39 019 8387211</a>
                    </div>
                    <div class="mb-1">
                        {{ __('footer.vat_label') }} IT01581160098
                    </div>
                    <div>
                        {{ __('footer.address_label') }} Via Agostino Chiodo 6, Savona, 17100
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <h5 class="mb-3">{{ __('footer.useful_links') }}</h5>
                <ul class="list-unstyled small mb-0">
                    <li><a href="{{ route('legal.privacy', ['locale' => $locale]) }}">{{ __('legal.privacy.title') }}</a></li>
                    <li><a href="{{ route('legal.cookies', ['locale' => $locale]) }}">{{ __('legal.cookies.title') }}</a></li>
                    <li><a href="{{ route('legal.terms', ['locale' => $locale]) }}">{{ __('legal.terms.title') }}</a></li>
                    <li><a href="{{ route('legal.notice', ['locale' => $locale]) }}">{{ __('legal.notice.title') }}</a></li>
                    <li><a href="{{ route('legal.accessibility', ['locale' => $locale]) }}">{{ __('legal.accessibility.title') }}</a></li>
                    <li><a href="{{ route('legal.cookie_preferences', ['locale' => $locale]) }}">{{ __('legal.cookie_preferences.title') }}</a></li>
                </ul>
            </div>
        </div>

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mt-4 pt-3 border-top small text-body-secondary">
            <div>© {{ date('Y') }} {{ config('app.name', 'TreehouseHub') }}.</div>
            <div class="mt-2 mt-md-0">
                <a class="text-body-secondary" href="{{ route('legal.privacy', ['locale' => $locale]) }}">{{ __('legal.privacy.title') }}</a>
                <span class="mx-2">•</span>
                <a class="text-body-secondary" href="{{ route('legal.cookies', ['locale' => $locale]) }}">{{ __('legal.cookies.title') }}</a>
            </div>
        </div>
    </div>
</footer>
