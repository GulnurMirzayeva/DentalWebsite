@extends('admin.layouts.admin')

@section('title', 'Header Image')

@section('content')
    <div class="container">
        <h1>Başlıq Şəkli</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('header_images.create') }}" class="btn btn-primary mb-3">Başlıq Şəkli Əlavə Et</a>

        @if($headerImages->count())
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Şəkil</th>
                    <th>Proses</th>
                </tr>
                </thead>
                <tbody>
                @foreach($headerImages as $headerImage)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><img src="{{ asset('storage/' . $headerImage->header_image) }}" alt="Header Image" class="img-fluid" style="max-width: 150px;"></td>
                        <td>
                            <a href="{{ route('header_images.show', $headerImage->id) }}" class="btn btn-success">Bax</a>
                            <a href="{{ route('header_images.edit', $headerImage->id) }}" class="btn btn-primary">Düzənlə</a>
                            <form action="{{ route('header_images.destroy', $headerImage->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Sil</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>No header images available.</p>
        @endif
    </div>
@endsection
