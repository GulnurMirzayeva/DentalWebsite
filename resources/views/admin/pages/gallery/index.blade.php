@extends('admin.layouts.admin')

@section('title', 'Gallery')

@section('content')
    <div class="container">
        <h1>Qaleriya</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary mb-3">Yeni şəkil əlavə et</a>

        <div class="table-responsive">
            <table class="table table-hover table-sm">
                <thead class="table-dark">
                <thead class="thead-light">
                <tr>
                    <th scope="col">Şəkil</th>
                    <th scope="col">Məzmun</th>
                    <th scope="col">Alt Yazı</th>
                    <th scope="col">Proses</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($images as $image)
                    <tr>
                        <td><img src="{{ $image->image }}" alt="{{ $image->alt_text }}" class="img-thumbnail" style="max-width: 100px; height: auto;"></td>
                        <td>{{ $image->description }}</td>
                        <td>{{ $image->alt_text }}</td>
                        <td>
                            <a href="{{ route('admin.gallery.edit', $image->id) }}" class="btn btn-primary btn-sm mb-1 mr-1">Düzənlə</a>
                            <form action="{{ route('admin.gallery.destroy', $image->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm mb-1">Sil</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
