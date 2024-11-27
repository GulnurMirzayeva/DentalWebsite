@extends('admin.layouts.admin')

@section('title', 'Contact Details')

@section('content')
    <div class="container">
        <h1>Əlaqə Detallarını Düzənlə</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('admin.contact-details.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="address">Adres:</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ $contactDetails->address ?? '' }}">
            </div>
            <div class="form-group">
                <label for="map">Xəritə:</label>
                <input type="text" class="form-control" id="map" name="map" value="{{ $contactDetails->map ?? '' }}">
            </div>
            <div class="form-group">
                <label for="phone">Telefon:</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ $contactDetails->phone ?? '' }}">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $contactDetails->email ?? '' }}">
            </div>
            <div class="form-group">
                <label for="instagram">Instagram:</label>
                <div class="input-group">
                    <div class="input-group-prepend d-none d-sm-block">
                        <span class="input-group-text">https://instagram.com/</span>
                    </div>
                    <input type="text" class="form-control" id="instagram" name="instagram" value="{{ $contactDetails->instagram ?? '' }}">
                    <div class="input-group-append">
                        <a href="https://instagram.com/{{ $contactDetails->instagram ?? '' }}" target="_blank" class="btn btn-outline-secondary">Go</a>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="facebook">Facebook:</label>
                <div class="input-group">
                    <div class="input-group-prepend d-none d-sm-block"> {{-- Hidden on mobile --}}
                        <span class="input-group-text">https://facebook.com/</span>
                    </div>
                    <input type="text" class="form-control" id="facebook" name="facebook" value="{{ $contactDetails->facebook ?? '' }}">
                    <div class="input-group-append">
                        <a href="https://facebook.com/{{ $contactDetails->facebook ?? '' }}" target="_blank" class="btn btn-outline-secondary">Go</a>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mb-3">Detalları Yenilə</button>
        </form>
    </div>
@endsection
