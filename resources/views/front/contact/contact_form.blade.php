<div class="contact-map-container">
    <div class="map-size">
        @php
            $contactDetails = \App\Models\ContactDetail::first();
            $defaultMap = "26 Rashid Behbudov St";
            $map = $contactDetails->map ?? $defaultMap;
        @endphp
        <iframe width="100%" height="600" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q={{ urlencode($map) }}&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">
        </iframe>
    </div>

    <div class="contact-details-section">
        <div class="contact-detail-item">
            <i class="fa-solid fa-map-location-dot contact-icon"></i>
            <div class="contact-info">
                <div class="contact-title">{{ __('address') }}</div>
                <div class="contact-value">{{ $contactDetails->address ?? 'Address not set' }}</div>
            </div>
        </div>
        <div class="contact-detail-item">
            <i class="fa-solid fa-phone-flip contact-icon"></i>
            <div class="contact-info">
                <div class="contact-title">{{ __('phone') }}</div>
                <div class="contact-value">{{ $contactDetails->phone ?? 'Phone not set' }}</div>
            </div>
        </div>
        <div class="contact-detail-item">
            <i class="fa-solid fa-envelope contact-icon"></i>
            <div class="contact-info">
                <div class="contact-title">{{ __('email') }}</div>
                <div class="contact-value">{{ $contactDetails->email ?? 'Email not set' }}</div>
            </div>
        </div>
        <div class="contact-detail-item">
            <i class="fa-brands fa-square-instagram contact-icon"></i>
            <div class="contact-info">
                <div class="contact-title">{{ __('instagram') }}</div>
                <div class="contact-value">
                    <a href="https://www.instagram.com/{{ $contactDetails->instagram ?? '' }}" target="_blank" class="social-link-contact instagram-link">
                        {{ $contactDetails->instagram ?? 'Instagram not set' }}
                    </a>
                </div>
            </div>
        </div>
        <div class="contact-detail-item">
            <i class="fa-brands fa-square-facebook contact-icon"></i>
            <div class="contact-info">
                <div class="contact-title">{{ __('facebook') }}</div>
                <div class="contact-value">
                    <a href="https://www.facebook.com/{{ $contactDetails->facebook ?? '' }}" target="_blank" class="social-link-contact facebook-link">
                        {{ $contactDetails->facebook ?? 'Facebook not set' }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
    <style>
        .social-link-contact {
            text-decoration: none;
            color: var(--gray-dark) ;
        }
    </style>
