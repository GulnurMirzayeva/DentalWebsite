@extends('admin.layouts.admin')

@section('title', 'Header Image')

@section('content')
    <div class="container">
        <h1>Başlıq Şəklini Düzənlə</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('header_images.update', $headerImage->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="header_image">Hal-hazırdakı Başlıq Şəkli</label><br>
                <img src="{{ asset('storage/' . $headerImage->header_image) }}" alt="Header Image" width="150">
            </div>

            <div class="form-group">
                <label for="header_image">Yeni Başlıq Şəkli Seç (optional)</label>
                <input type="file" name="header_image" id="header_image" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Yenilə</button>
        </form>
    </div>
@endsection
