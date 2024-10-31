@extends('admin.layouts.admin')

@section('title', 'About Image')

@section('content')
    <div class="container">
        <h1>Yeni Haqqımızda Şəkli Əlavə Et</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('about_images.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="about_image">Şəkil Seç</label>
                <input type="file" name="about_image" id="about_image" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Yüklə</button>
        </form>
    </div>
@endsection
