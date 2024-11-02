@extends('front.layouts.app')

@section('title', 'Blog')

@section('header-text')
    {{ __('blog') }}
@endsection

@section('content')
    @include('front.home.appointment')
    @include('front.home.header')
    @include('front.blog.blog_grid')
@endsection
