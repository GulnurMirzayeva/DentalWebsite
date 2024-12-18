@extends('admin.layouts.admin')

@section('title', 'Gallery')

@section('content')
<div class="container">
    <h1>Şəkili Düzənlə</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif


    <form action="{{ route('admin.gallery.update', $image->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')


        <div class="form-group">
            <label for="image">Şəkil</label>
            <input type="file" name="image" class="form-control">
            @if ($image->image)
            <img src="{{ Storage::url($image->image) }}" alt="{{ $image->alt_text }}" width="200">
            @endif
        </div>

        <div class="form-group">
            <label for="alt_text">Alternativ Text</label>
            <input type="text" name="alt_text" class="form-control" value="{{ $image->alt_text }}">
        </div>

        <div class="form-group">
            <label for="description">Məzmun</label>
            <textarea name="description" class="form-control">{{ $image->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Şəkili Yenilə</button>
    </form>
</div>
@endsection
