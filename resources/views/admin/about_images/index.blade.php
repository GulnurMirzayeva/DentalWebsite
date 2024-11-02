@extends('admin.layouts.admin')

@section('title', 'About Image')

@section('content')
    <div class="container">
        <h1>Haqqımızda Şəkilləri</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('about_images.create') }}" class="btn btn-primary mb-3">Yeni Şəkil Əlavə Et</a>

        @if($aboutImages->count())
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Şəkil</th>
                    <th>Proses</th>
                </tr>
                </thead>
                <tbody>
                @foreach($aboutImages as $aboutImage)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><img src="{{ asset('storage/' . $aboutImage->about_image) }}" alt="About Image" class="img-fluid" style="max-width: 150px;"></td>
                        <td>
                            <a href="{{ route('about_images.show', $aboutImage->id) }}" class="btn btn-success">Bax</a>
                            <a href="{{ route('about_images.edit', $aboutImage->id) }}" class="btn btn-primary">Düzənlə</a>
                            <form action="{{ route('about_images.destroy', $aboutImage->id) }}" method="POST" class="d-inline">
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
            <p>No about images available.</p>
        @endif
    </div>
@endsection
