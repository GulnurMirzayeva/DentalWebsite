<div class="nav-content">
    <div class="nav-width">
        <div class="logo-part">
            <a href="{{ route('home') }}" class="logo-name">Aygun<span class="logo-name-span">Care</span></a>
        </div>
        <div style="display: flex">
            <ul class="nav-list-elements">
                <li><a href="{{ route('home') }}">{{ __('home') }}</a></li>
                <li><a href="{{ route('about') }}">{{ __('about') }}</a></li>
                <li><a href="{{ route('services') }}">{{ __('services') }}</a></li>
                <li><a href="{{ route('gallery') }}">{{ __('gallery') }}</a></li>
                <li><a href="{{ route('blog') }}">{{ __('blog') }}</a></li>
                <li><a href="{{ route('contact') }}">{{ __('contact') }}</a></li>
                <li><a href="#" class="appointment-btn" id="nav-appointment-btn">{{ __('appointment') }}</a></li>
            </ul>
            <div class="for-language">
                <div class="language">
                    <i class="fa-solid fa-globe"></i>
                    <div class="dropdown-content">
                        @foreach(Config::get('translatable.locales') as $locale)
                            <a href="{{ route('set.language', ['locale' => $locale]) }}"
                               class="{{ Config::get('translatable.locale') === $locale ? 'active' : '' }}">
                                {{ strtoupper($locale) }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="hamburger-icon">
                <i class="fas fa-bars"></i>
            </div>
        </div>

    </div>
</div>

<div class="offcanvas" id="navOffcanvas">
    <div class="offcanvas-header">
        <button type="button" class="btn-close" aria-label="Close">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <div class="offcanvas-body">
        <ul class="nav-list-elements">
            <li style="margin-top: 30px"><a href="{{ route('home') }}">{{ __('home') }}</a></li>
            <li><a href="{{ route('about') }}">{{ __('about') }}</a></li>
            <li><a href="{{ route('services') }}">{{ __('services') }}</a></li>
            <li><a href="{{ route('gallery') }}">{{ __('gallery') }}</a></li>
            <li><a href="{{ route('blog') }}">{{ __('blog') }}</a></li>
            <li><a href="{{ route('contact') }}">{{ __('contact') }}</a></li>
            <li><a href="#" class="appointment-btn" id="nav-appointment-btn">{{ __('appointment') }}</a></li>
        </ul>
    </div>
</div>



