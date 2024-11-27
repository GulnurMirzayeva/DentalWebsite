@extends('front.layouts.app')

@section('title', __('blog-detail'))

@section('header-text')
    {{ __('blog-detail') }}
@endsection

@section('content')
    @include('front.help.sign_help')
    @include('front.home.header')
    @include('front.blog.blog_detail')
    @include('front.home.appointment')
@endsection
