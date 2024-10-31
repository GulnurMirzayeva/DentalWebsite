@extends('admin.layouts.admin')

@section('title', 'About Image Details')

@section('content')
    <div class="container">
        <h1>Haqqımızda Şəkil Detalları</h1>

        <div class="card">
            <div class="card-header">
                <h2>Şəkil Detalları</h2>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="about_image">Haqqımızda Şəkli:</label><br>
                    <img src="{{ asset('storage/' . $aboutImage->about_image) }}" alt="About Image" width="300">
                </div>
                <div class="form-group">
                    <label for="created_at">Yaradılma Tarixi:</label>
                    <p>{{ $aboutImage->created_at->format('d-m-Y H:i:s') }}</p>
                </div>
                <div class="form-group">
                    <label for="updated_at">Yeniləmə Tarixi:</label>
                    <p>{{ $aboutImage->updated_at->format('d-m-Y H:i:s') }}</p>
                </div>
                <a href="{{ route('about_images.index') }}" class="btn btn-primary">Şəkil Listinə Geri Dön</a>
            </div>
        </div>
    </div>
@endsection
