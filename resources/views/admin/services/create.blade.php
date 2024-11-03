@extends('admin.layouts.admin')

@section('title', 'Services')

@section('content')
    <div class="container mt-4 mb-4">
        <h1 class="mb-4">Yeni Xidmət Əlavə Et</h1>

        <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="icon">Icon</label>
                    <input type="file" name="icon" class="form-control-file" required>
                </div>

                <div class="form-group col-md-6">
                    <label for="title_az">Başlıq (AZ)</label>
                    <input type="text" maxlength="19" oninput="checkLength(this)" name="title[az]" class="form-control" placeholder="Başlığı daxil edin" required>
                </div>

                <div class="form-group col-md-6">
                    <label for="title_ru">Название (RU)</label>
                    <input type="text" maxlength="19" oninput="checkLength(this)" name="title[ru]" class="form-control" placeholder="Введите название" required>
                </div>

                <div class="form-group col-md-6">
                    <label for="title_en">Title (EN)</label>
                    <input type="text" maxlength="19" oninput="checkLength(this)" name="title[en]" class="form-control" placeholder="Enter the title" required>
                </div>
            </div>

            <div class="form-group">
                <label for="description_az">Məzmun (AZ)</label>
                <textarea name="description[az]" maxlength="300" oninput="checkLength(this)" class="form-control" rows="3" placeholder="Məzmunu daxil edin" required></textarea>
            </div>

            <div class="form-group">
                <label for="description_ru">Описание (RU)</label>
                <textarea name="description[ru]" maxlength="300" oninput="checkLength(this)" class="form-control" rows="3" placeholder="Введите описание" required></textarea>
            </div>

            <div class="form-group">
                <label for="description_en">Description (EN)</label>
                <textarea name="description[en]" maxlength="300" oninput="checkLength(this)" class="form-control" rows="3" placeholder="Enter the description" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Əlavə Et</button>
        </form>
    </div>
@endsection

<script>
    function checkLength(input) {
        const maxLength = parseInt(input.getAttribute("maxlength")); // Max length from the attribute
        if (input.value.length > maxLength) {
            alert(`Maksimum ${maxLength} simvol yazıla bilər.`);
            input.value = input.value.substring(0, maxLength); // Remove extra characters
        }
    }
</script>
