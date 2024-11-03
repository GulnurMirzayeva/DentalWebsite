@extends('admin.layouts.admin')

@section('title', 'Header Image')

@section('content')
    <div class="container">
        <h1>Başlıq Şəkili Detalları</h1>

        <div class="card">
            <div class="card-header">
                <h2>Şəkil Detalı</h2>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="header_image">Başlıq Şəkli:</label><br>
                    <img src="{{ asset('storage/' . $headerImage->header_image) }}" alt="Header Image" width="300">
                </div>
                <div class="form-group">
                    <label for="created_at">Yaradılma Tarixi:</label>
                    <p>{{ $headerImage->created_at->format('d-m-Y H:i:s') }}</p>
                </div>
                <div class="form-group">
                    <label for="updated_at">Yeniləmə Tarixi:</label>
                    <p>{{ $headerImage->updated_at->format('d-m-Y H:i:s') }}</p>
                </div>
                <a href="{{ route('header_images.index') }}" class="btn btn-primary">Başlıq Şəkillərinə Geri Dön</a>
            </div>
        </div>
    </div>
@endsection
