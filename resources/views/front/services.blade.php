@extends('front.layouts.app')

@section('title', __('services'))

@section('header-text')
    {{ __('our-services') }}
@endsection

@section('content')
    @include('front.home.header')
    @include('front.home.appointment')
    @include('front.services.our_services')
    @include('front.about.achievements')
    @include('front.services.prices')
@endsection
