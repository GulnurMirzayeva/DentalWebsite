@extends('admin.layouts.admin')

@section('title', 'Blog')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Bloq Düzənlə</h1>

        <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="title_az">Başlıq (AZ)</label>
                    <input type="text" class="form-control" id="title_az" name="title[az]" value="{{ $blog->translate('az')->title }}" required>
                </div>

                <div class="form-group col-md-6">
                    <label for="title_ru">Название (RU)</label>
                    <input type="text" class="form-control" id="title_ru" name="title[ru]" value="{{ $blog->translate('ru')->title }}" required>
                </div>

                <div class="form-group col-md-6">
                    <label for="title_en">Title (EN)</label>
                    <input type="text" class="form-control" id="title_en" name="title[en]" value="{{ $blog->translate('en')->title }}" required>
                </div>

                <div class="form-group col-md-6">
                    <label for="date">Tarix</label>
                    <input type="date" class="form-control" id="date" name="date" value="{{ $blog->date }}" required>
                </div>
            </div>

            <div class="form-group">
                <label for="image_one">Birinci Rəsim</label>
                @if($blog->image_one)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $blog->image_one) }}" alt="Birinci Resim" width="150" class="img-thumbnail">
                    </div>
                @endif
                <input type="file" class="form-control-file" id="image_one" name="image_one">
            </div>

            <div class="form-group">
                <label for="description_one_az">Birinci Rəsim Açıqlaması (AZ)</label>
                <textarea class="form-control" id="description_one_az" name="description_one[az]" rows="5" placeholder="Birinci resim üçün açıqlama yazın">{{ $blog->translate('az')->description_one }}</textarea>
            </div>
            <div class="form-group">
                <label for="description_one_ru">Описание первой картинки (RU)</label>
                <textarea class="form-control" id="description_one_ru" name="description_one[ru]" rows="5" placeholder="Введите описание для первой картинки">{{ $blog->translate('ru')->description_one }}</textarea>
            </div>
            <div class="form-group">
                <label for="description_one_en">First Image Description (EN)</label>
                <textarea class="form-control" id="description_one_en" name="description_one[en]" rows="5" placeholder="Enter description for the first image">{{ $blog->translate('en')->description_one }}</textarea>
            </div>

            <div class="form-group">
                <label for="image_two">İkinci Rəsim</label>
                @if($blog->image_two)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $blog->image_two) }}" alt="İkinci Resim" width="150" class="img-thumbnail">
                    </div>
                @endif
                <input type="file" class="form-control-file" id="image_two" name="image_two">
            </div>

            <div class="form-group">
                <label for="description_two_az">İkinci Rəsim Açıqlaması (AZ)</label>
                <textarea class="form-control" id="description_two_az" name="description_two[az]" rows="5" placeholder="İkinci resim üçün açıqlama yazın">{{ $blog->translate('az')->description_two }}</textarea>
            </div>
            <div class="form-group">
                <label for="description_two_ru">Описание второй картинки (RU)</label>
                <textarea class="form-control" id="description_two_ru" name="description_two[ru]" rows="5" placeholder="Введите описание для второй картинки">{{ $blog->translate('ru')->description_two }}</textarea>
            </div>
            <div class="form-group">
                <label for="description_two_en">Second Image Description (EN)</label>
                <textarea class="form-control" id="description_two_en" name="description_two[en]" rows="5" placeholder="Enter description for the second image">{{ $blog->translate('en')->description_two }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Yenilə</button>
        </form>

        <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" style="margin-top: 10px;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger mb-3">Sil</button>
        </form>
    </div>
@endsection
