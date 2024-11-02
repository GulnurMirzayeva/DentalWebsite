@extends('admin.layouts.admin')

@section('title', 'Sliders')

@section('content')
    <div class="container my-4">
        <h1 class="mb-4">Yeni Slider Şəkli Əlavə Et</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('sliders.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group mb-3">
                <label for="file" class="form-label">Slider Şəkli Yüklə</label>
                <input type="file" class="form-control @error('file') is-invalid @enderror" name="file" id="file" required>
                @error('file')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Yüklə</button>
        </form>
    </div>
@endsection
