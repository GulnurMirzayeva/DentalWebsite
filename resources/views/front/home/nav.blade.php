<div class="nav-content">
    <div class="nav-width">
        <div class="logo-part">
            <a href="{{ route('home') }}" class="logo-name">Aygun<span class="logo-name-span">Care</span></a>
        </div>
        <div style="display: flex">
            <ul class="nav-list-elements">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('about') }}">About</a></li>
                <li><a href="{{ route('services') }}">Services</a></li>
                <li><a href="{{ route('gallery') }}">Gallery</a></li>
                <li><a href="{{ route('blog') }}">Blog</a></li>
                <li><a href="{{ route('contact') }}">Contact</a></li>
                <li><a href="#" class="appointment-btn" id="nav-appointment-btn">Make an Appointment</a></li>
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
            <li style="margin-top: 30px"><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('about') }}">About</a></li>
            <li><a href="{{ route('services') }}">Services</a></li>
            <li><a href="{{ route('gallery') }}">Gallery</a></li>
            <li><a href="{{ route('blog') }}">Blog</a></li>
            <li><a href="{{ route('contact') }}">Contact</a></li>
            <li><a href="#" class="appointment-btn" id="nav-appointment-btn">Make an Appointment</a></li>
        </ul>
    </div>
</div>


@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const languageLinks = document.querySelectorAll('.dropdown-content a');

            languageLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault(); // Default davranışı dayandırırıq

                    const url = this.getAttribute('href');
                    document.body.style.cursor = 'wait';

                    // AJAX ilə sorğu göndəririk
                    fetch(url)
                        .then(response => {
                            if (response.ok) {
                                window.location.reload();
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            document.body.style.cursor = 'default';
                        });
                });
            });
        });
    </script>
@endsection
