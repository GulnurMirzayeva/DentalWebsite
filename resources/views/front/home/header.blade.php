<div>
    <div style="background-image: url('{{ $backgroundImage }}'); height: 450px; background-size: cover" class="background-image">
        <div class="header-overlay"></div>
    </div>
    <div class="header-content-part">
        <div class="header-a-tags">
            <a href="{{ route('home') }}">{{ __('home') }}</a>
            <a href="{{ route('about') }}">{{ __('about') }}</a>
        </div>
        <p class="header-paragraph">@yield('header-text')</p>
    </div>
</div>
