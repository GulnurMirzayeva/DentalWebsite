@extends('front.layouts.app')

@section('title', 'Contact')

@section('header-text')
    Contact Us
@endsection

@section('content')
    @include('front.home.header')
    @include('front.contact.contact_details')
    @include('front.contact.contact_form')
    @include('front.home.appointment')
@endsection
