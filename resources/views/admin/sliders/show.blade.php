@extends('admin.layouts.admin')

@section('title', 'Sliders')

@section('content')
    <div class="container my-4">
        <h1 class="mb-4">Slider Şəkil Detalı</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card mb-3">
            <div class="card-header">
                <h4>Şəkil ID: {{ $slider->id }}</h4>
            </div>
            <div class="card-body">
                <h5 class="card-title">Şəkil</h5>
                <div class="row">
                    <div class="col-md-12">
                        <h6>Slider Image</h6>
                        @if($slider->file)
                            <img src="{{ asset('storage/' . $slider->file) }}" alt="Slider Image" class="img-fluid">
                        @else
                            <p>No Image Available</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('sliders.edit', $slider->id) }}" class="btn btn-warning">Düzənlə</a>
                <form action="{{ route('sliders.destroy', $slider->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this image?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Sil</button>
                </form>
                <a href="{{ route('sliders.index') }}" class="btn btn-secondary">Listə Geri Dön</a>
            </div>
        </div>
    </div>
@endsection
