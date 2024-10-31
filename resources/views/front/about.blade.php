@extends('front.layouts.app')

@section('title', 'About')

@section('header-text')
    About Us
@endsection

@section('content')
    @include('front.home.header')
    @include('front.home.appointment')
    @include('front.about.missions_goals')
    @include('front.about.advantages')
    @include('front.about.testimonials')
    @include('front.about.achievements')
@endsection
