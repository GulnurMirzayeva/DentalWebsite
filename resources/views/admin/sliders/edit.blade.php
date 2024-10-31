@extends('admin.layouts.admin')

@section('title', 'Sliders')

@section('content')
    <div class="container my-4">
        <h1 class="mb-4">Slider Şəkli Düzənlə</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('sliders.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="file" class="form-label">Slider Şəkli Yenilə</label>
                <input type="file" class="form-control @error('file') is-invalid @enderror" name="file" id="file">
                @error('file')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @if($slider->file)
                    <img src="{{ asset('storage/' . $slider->file) }}" alt="Current Slider Image" class="mt-3" width="100">
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Yenilə</button>
        </form>
    </div>
@endsection
