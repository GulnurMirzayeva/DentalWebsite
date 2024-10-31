@extends('admin.layouts.admin')

@section('title', 'Yeni Blog Əlavə Et')

@section('content')
    <div class="container mt-4 mb-4">
        <h1 class="mb-4">Yeni Blog Əlavə Et</h1>

        <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <!-- Azerbaijani Title and Date -->
                <div class="form-group col-md-6">
                    <label for="title_az">Başlıq (AZ)</label>
                    <input type="text" name="title[az]" class="form-control" placeholder="Başlığı daxil edin" required>
                </div>

                <div class="form-group col-md-6">
                    <label for="date">Tarix</label>
                    <input type="date" name="date" class="form-control" required>
                </div>

                <!-- Russian Title -->
                <div class="form-group col-md-6">
                    <label for="title_ru">Название (RU)</label>
                    <input type="text" name="title[ru]" class="form-control" placeholder="Введите название" required>
                </div>

                <!-- English Title -->
                <div class="form-group col-md-6">
                    <label for="title_en">Title (EN)</label>
                    <input type="text" name="title[en]" class="form-control" placeholder="Enter the title" required>
                </div>
            </div>

            <!-- Azerbaijani, Russian, and English Descriptions for First Image -->
            <div class="form-group">
                <label for="image_one">Birinci Resim</label>
                <input type="file" name="image_one" class="form-control-file">
            </div>

            <div class="form-group">
                <label for="description_one_az">Birinci Resim Açıqlaması (AZ)</label>
                <textarea name="description_one[az]" class="form-control" rows="3" placeholder="Birinci resim üçün açıqlama yazın"></textarea>
            </div>

            <div class="form-group">
                <label for="description_one_ru">Описание первой картинки (RU)</label>
                <textarea name="description_one[ru]" class="form-control" rows="3" placeholder="Введите описание для первой картинки"></textarea>
            </div>

            <div class="form-group">
                <label for="description_one_en">First Image Description (EN)</label>
                <textarea name="description_one[en]" class="form-control" rows="3" placeholder="Enter description for the first image"></textarea>
            </div>

            <!-- Azerbaijani, Russian, and English Descriptions for Second Image -->
            <div class="form-group">
                <label for="image_two">İkinci Resim</label>
                <input type="file" name="image_two" class="form-control-file">
            </div>

            <div class="form-group">
                <label for="description_two_az">İkinci Resim Açıqlaması (AZ)</label>
                <textarea name="description_two[az]" class="form-control" rows="3" placeholder="İkinci resim üçün açıqlama yazın"></textarea>
            </div>

            <div class="form-group">
                <label for="description_two_ru">Описание второй картинки (RU)</label>
                <textarea name="description_two[ru]" class="form-control" rows="3" placeholder="Введите описание для второй картинки"></textarea>
            </div>

            <div class="form-group">
                <label for="description_two_en">Second Image Description (EN)</label>
                <textarea name="description_two[en]" class="form-control" rows="3" placeholder="Enter description for the second image"></textarea>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Saxla</button>
        </form>
    </div>
@endsection
