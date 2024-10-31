@extends('front.layouts.app')

@section('title', 'Services')

@section('header-text')
    Our Services
@endsection

@section('content')
    @include('front.home.header')
    @include('front.home.appointment')
    @include('front.services.our_services')
    @include('front.about.achievements')
    @include('front.services.prices')

@endsection
