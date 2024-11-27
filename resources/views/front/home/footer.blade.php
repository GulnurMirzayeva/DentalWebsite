<div class="footer-part">
    <div class="footer-items">
        @php
            $contactDetails = \App\Models\ContactDetail::first();
        @endphp

        <div class="about-AygunCare">
            <h2>AygunCare</h2>
            <p>{{ __('footer-paragraph') }}</p>

            <div class="social-media-addresses">
                @if($contactDetails)
                    @if($contactDetails->facebook)
                        <a href="https://www.facebook.com/{{ $contactDetails->facebook }}" target="_blank">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                    @endif

                    @if($contactDetails->instagram)
                        <a href="https://www.instagram.com/{{ $contactDetails->instagram }}" target="_blank">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                    @endif
                @else
                    <p>Contact details are not available.</p>
                @endif
            </div>
        </div>


        <div class="quick-links">
            <h2>{{ __('links') }}</h2>
            <a href="{{ route('home') }}">{{ __('home') }}</a>
            <a href="{{ route('about') }}">{{ __('about') }}</a>
            <a href="{{ route('services') }}">{{ __('services') }}</a>
            <a href="{{ route('gallery') }}">{{ __('gallery') }}</a>
            <a href="{{ route('blog') }}">{{ __('blog') }}</a>
            <a href="{{ route('contact') }}">{{ __('contact') }}</a>
        </div>

        <div class="quick-services">
            <h2>{{ __('services') }}</h2>
            @foreach($footerServices->slice(-6) as $service)
                <a href="{{ route('services') }}#{{ Str::slug($service->title) }}">{{ $service->title }}</a>
            @endforeach
        </div>

        <div class="office-contact-data">
            <h2>{{ __('contact-us') }}</h2>
            <p><i class="fa-solid fa-map-location-dot"></i> {{ $contactDetails->address ?? 'Address not set' }}</p>
            <p><i class="fa-solid fa-phone"></i> {{ $contactDetails->phone ?? 'Phone not set' }}</p>
            <p><i class="fa-solid fa-envelope"></i> {{ $contactDetails->email ?? 'Email not set' }}</p>
            <p>
                <i class="fa-brands fa-square-instagram"></i>
                <a href="https://www.instagram.com/{{ $contactDetails->instagram ?? '' }}" target="_blank"
                    class="social-link">
                    {{ $contactDetails->instagram ?? 'Instagram not set' }}
                </a>
            </p>
            <p>
                <i class="fa-brands fa-square-facebook"></i>
                <a href="https://www.facebook.com/{{ $contactDetails->facebook ?? '' }}" target="_blank"
                    class="social-link">
                    {{ $contactDetails->facebook ?? 'Facebook not set' }}
                </a>
            </p>

        </div>
        <div class="copy">
            <p class="footer-copyright">Copyright ©2024 All rights reserved</p>

        </div>

        <a href="#" class="back-to-top" id="backToTop">
            <i class="fa-solid fa-up-long"></i>
        </a>
    </div>
</div>

<style>
    .social-link {
        color: white;
        text-decoration: none;
    }
</style>