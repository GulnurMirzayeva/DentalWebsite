@extends('front.layouts.app')


{{-- SEO optimizasiya meta teqləri --}}
@section('title', 'saglam dis')
@section('meta_keywords', 'stomatoloq, diş həkimi, stomatologiya, diş müalicəsi, implant, ağız sağlamlığı')
@section('meta_description', 'Peşəkar stomatoloqlarımız tərəfindən təqdim edilən diş müalicəsi, implantlar, və estetik stomatologiya xidmətləri ilə dişlərinizi sağlam saxlayın.')
@section('og_title', 'Ana Səhifə - Stomatoloq Xidmətləri')
@section('og_description', 'Dişləriniz üçün ən yaxşı stomatoloji xidmətləri əldə edin. Bizim klinikamız müasir avadanlıqla təmin edilmişdir.')
@section('og_image', asset('assets/front/img/home-og-image.jpg'))
@section('og_url', url()->current())

@section('content')
   @include('front.home.background_slider')
    @include('front.services.our_services')
    @include('front.about.advantages')
{{--   @include('front.chatbot.index')--}}
   @include('front.home.appointment')
   @include('front.services.prices')
   @include('front.about.achievements')
   @include('front.home.home_blog')
    @include('front.about.testimonials')
    @include('front.home.gallery_slider')
    @include('front.contact.contact_form')
{{--   @include('front.chatbot.index')--}}

@endsection
