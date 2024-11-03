@extends('front.layouts.app')

@section('title', 'Gallery')

@section('header-text')
    {{ __('gallery') }}
@endsection

@section('content')
    @include('front.home.header')
    @include('front.gallery.gallery_grid')
    @include('front.home.appointment')
@endsection
