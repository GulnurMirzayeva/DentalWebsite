@extends('admin.layouts.admin')

@section('title', 'About Image')

@section('content')
    <div class="container">
        <h1>Şəkli Düzənlə</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('about_images.update', $aboutImage->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="about_image">Hal-hazırdakı Şəkil</label><br>
                <img src="{{ asset('storage/' . $aboutImage->about_image) }}" alt="About Image" width="150">
            </div>

            <div class="form-group">
                <label for="about_image">Yeni Şəkil Seç (optional)</label>
                <input type="file" name="about_image" id="about_image" class="form-control">
            </div>

            <button type="submit" class="btn btn-success">Yenilə</button>
        </form>
    </div>
@endsection
