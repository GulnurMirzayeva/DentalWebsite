@extends('front.layouts.app')

@section('title', __('contact'))

@section('header-text')
    {{ __('contact-us') }}
@endsection

@section('content')
    @include('front.home.header')
    @include('front.contact.contact_details')
    @include('front.contact.contact_form')
    @include('front.home.appointment')
@endsection
