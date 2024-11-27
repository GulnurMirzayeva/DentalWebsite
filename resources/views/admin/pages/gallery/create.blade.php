@extends('admin.layouts.admin')

@section('title', 'Gallery')

@section('content')
<div class="container">
    <h1>Yeni Şəkil Yüklə</h1>

    <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary mb-3">Şəkil Listinə Geri Dön</a>


    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="image">Şəkil Yüklə</label>
            <input type="file" name="image" id="image" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="alt_text">Alternativ Text (istəyə bağlı)</label>
            <input type="text" name="alt_text" id="alt_text" class="form-control">
        </div>
        <div class="form-group">
            <label for="description">Məzmun (istəyə bağlı)</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Şəkil Yüklə</button>
    </form>
</div>
@endsection
