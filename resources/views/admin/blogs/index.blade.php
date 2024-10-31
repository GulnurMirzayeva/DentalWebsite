@extends('admin.layouts.admin')

@section('title', 'Blogs')

@section('content')
    <h1>Bloglar</h1>
    <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary mb-3">Yeni Blog Əlavə Et</a>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>Şəkil</th>
                <th>Başlıq (AZ)</th>
                <th>Başlıq (RU)</th>
                <th>Başlıq (EN)</th>
                <th>Məzmun (AZ)</th>
                <th>Məzmun (RU)</th>
                <th>Məzmun (EN)</th>
                <th>Tarix</th>
                <th>Proseslər</th>
            </tr>
            </thead>
            <tbody>
            @foreach($blogs as $blog)
                <tr>
                    <td>
                        @if($blog->image_one)
                            <img src="{{ asset('storage/' . $blog->image_one) }}" alt="{{ $blog->title }}" class="img-fluid rounded" style="max-width: 100px;">
                        @else
                            <span class="text-muted">Şəkil Yox</span>
                        @endif
                    </td>
                    <!-- Azerbaijani Title -->
                    <td>{{ Str::limit($blog->translate('az')->title, 30) }}</td>
                    <!-- Russian Title -->
                    <td>{{ Str::limit($blog->translate('ru')->title, 30) }}</td>
                    <!-- English Title -->
                    <td>{{ Str::limit($blog->translate('en')->title, 30) }}</td>
                    <!-- Azerbaijani Description -->
                    <td>{{ Str::limit($blog->translate('az')->description_one, 30) }}</td>
                    <!-- Russian Description -->
                    <td>{{ Str::limit($blog->translate('ru')->description_one, 30) }}</td>
                    <!-- English Description -->
                    <td>{{ Str::limit($blog->translate('en')->description_one, 30) }}</td>
                    <td>{{ $blog->date }}</td>
                    <td>
                        <a href="{{ route('admin.blogs.edit', $blog) }}" class="btn btn-primary btn-sm w-100 mb-1">Düzənlə</a>
                        <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST" class="d-inline w-100">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm w-100">Sil</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
