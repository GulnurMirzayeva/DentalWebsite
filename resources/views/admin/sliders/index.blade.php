@extends('admin.layouts.admin')

@section('title', 'Sliders')

@section('content')
    <div class="container my-4">
        <h1 class="mb-4">Arxa Fon Slider Şəkli</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <a href="{{ route('sliders.create') }}" class="btn btn-primary mb-3">Yeni Şəkil Əlavə Et</a>

        @if($sliderImages->isEmpty())
            <p>No background slider images available.</p>
        @else
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Şəkil</th>
                    <th>Proses</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sliderImages as $slider)
                    <tr>
                        <td>{{ $slider->id }}</td>
                        <td>
                            @if($slider->file)
                                <img src="{{ asset('storage/' . $slider->file) }}" alt="Slider Image" width="100">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('sliders.edit', $slider->id) }}" class="btn btn-sm btn-primary">Düzənlə</a>

                            <form action="{{ route('sliders.destroy', $slider->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this image?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Sil</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
