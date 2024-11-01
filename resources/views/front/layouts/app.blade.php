<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'stomatoloq xidmetleri')</title>

    @vite(['resources/css/app.css'])

    {{-- SEO meta tags --}}
    <meta name="keywords" content="@yield('meta_keywords','stomatoloq,dis hekimi,dis mualicesi,implant,ortodontiya')">
    <meta name="description" content="@yield('meta_description', 'Peşəkar stomatoloq xidmətləri - diş müalicəsi, implantlar və ağız sağlamlığı üzrə xidmətlər.')">

    {{-- Open Graph Meta Tags --}}
    <meta property="og:title" content="@yield('og_title', 'Peşəkar Stomatoloq Xidmətləri')">
    <meta property="og:description" content="@yield('og_description', 'Diş müalicəsi, implantlar və ortodontiya xidmətləri.')">
    <meta property="og:image" content="@yield('og_image', asset('assets/front/img/favicon.jpg'))">
    <meta property="og:url" content="@yield('og_url', url()->current())">

    {{-- Robots --}}
    <meta name="robots" content="index, follow">
    {{--    Favicon    --}}
    <link rel="icon" href="{{ asset('assets/front/img/favicon.jpg') }}" type="image/x-icon">
    {{--    CSS     --}}
    <link rel="stylesheet" href="{{ asset('assets/front/css/style.css') }}">
    {{--    Font Family    --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    {{--    Font Awasome    --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{--    JQuery     --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{--   Alpine.JS   --}}
    <!-- Include easepick CSS and JS -->
    <link href="https://cdn.jsdelivr.net/npm/@easepick/bundle@1.2.1/dist/index.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/@easepick/bundle@1.2.1/dist/index.umd.js"></script>

    <!-- Include flatpickr CSS and JS -->
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    {{-- JSON-LD Structured Data --}}
    <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "Dentist",
          "name": "Peşəkar Stomatoloq Xidmətləri",
          "description": "Diş müalicəsi, implantlar və ağız sağlamlığı üzrə yüksək keyfiyyətli stomatoloq xidmətləri.",
          "image": "{{ asset('assets/front/img/favicon.jpg') }}",  <!-- Buraya saytınızın şəkil linkini əlavə edin -->
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "Nizami küçəsi 45",
        "addressLocality": "Bakı",
        "addressRegion": "AZ",
        "postalCode": "1000",
        "addressCountry": "Azərbaycan"
      },
      "telephone": "+994123456789",
      "priceRange": "$$"
    }
    </script>
</head>
<body>
@include('front.home.nav')

<div class="scroll-container">
    <main>
        @yield('content')
    </main>
</div>
{{--@include('front.chatbot.index')--}}

@include('front.home.footer')

<script src="{{ asset('assets/front/js/script.js') }}"></script>
@vite(['resources/js/app.js'])
</body>
</html>
