@extends('front.layouts.app')

@section('title', 'Blog')

@section('header-text')
    {{ __('blog-detail') }}
@endsection

@section('content')
    @include('front.home.header')
    @include('front.blog.blog_detail')
    @include('front.home.appointment')
@endsection
