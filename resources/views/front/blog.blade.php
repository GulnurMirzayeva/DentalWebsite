@extends('front.layouts.app')

@section('title', __('blog'))

@section('header-text')
    {{ __('blog') }}
@endsection

@section('content')
    @include('front.help.sign_help')
    @include('front.home.appointment')
    @include('front.home.header')
    @include('front.blog.blog_grid')
@endsection
