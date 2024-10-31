@extends('admin.layouts.admin')

@section('title', 'Header Image')

@section('content')
    <div class="container">
        <h1>Yeni Başlıq Şəkli Əlavə Et</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('header_images.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="header_image">Başlıq Şəkli Seç</label>
                <input type="file" name="header_image" id="header_image" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Yüklə</button>
        </form>
    </div>
@endsection
