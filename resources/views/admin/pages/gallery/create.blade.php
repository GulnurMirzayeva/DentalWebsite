{{-- Extend from your admin layout --}}
@extends('admin.layouts.admin')

@section('title', 'Gallery')

{{-- Content Section --}}
@section('content')
<div class="container">
    <h1>Yeni Şəkil Yüklə</h1>

    {{-- Back to Image List --}}
    <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary mb-3">Şəkil Listinə Geri Dön</a>

    {{-- Image Upload Form --}}
    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="image">Şəkil Yüklə</label>
            <input type="file" name="image" id="image" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="alt_text">Alternativ Text (optional)</label>
            <input type="text" name="alt_text" id="alt_text" class="form-control">
        </div>
        <div class="form-group">
            <label for="description">Məzmun (optional)</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>
{{--        <div class="form-group">--}}
{{--            <label for="order">Order</label>--}}
{{--            <input type="number" name="order" id="order" class="form-control">--}}
{{--        </div>--}}
        <button type="submit" class="btn btn-primary">Şəkil Yüklə</button>
    </form>
</div>
@endsection
