@extends('admin.layouts.admin')

@section('title', 'Services')

@section('content')
    <div class="container mt-4 mb-4">
        <h1 class="mb-4">Xidməti Düzənlə</h1>

        <form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="icon">Icon</label>
                <input type="file" class="form-control-file" id="icon" name="icon">
                <img src="{{ asset('storage/'.$service->icon) }}" width="50" alt="{{ $service->title }}">
            </div>

            <div class="form-group">
                <label for="title_az">Başlıq (AZ)</label>
                <input type="text" maxlength="19" oninput="checkLength(this)" class="form-control" id="title_az" name="title[az]" value="{{ optional($service->translate('az'))->title }}" required>
            </div>

            <div class="form-group">
                <label for="title_ru">Название (RU)</label>
                <input type="text" maxlength="19" oninput="checkLength(this)" class="form-control" id="title_ru" name="title[ru]" value="{{ optional($service->translate('ru'))->title }}" required>
            </div>

            <div class="form-group">
                <label for="title_en">Title (EN)</label>
                <input type="text" maxlength="19" oninput="checkLength(this)" class="form-control" id="title_en" name="title[en]" value="{{ optional($service->translate('en'))->title }}" required>
            </div>

            <div class="form-group">
                <label for="description_az">Məzmun (AZ)</label>
                <textarea class="form-control" maxlength="300" oninput="checkLength(this)" id="description_az" name="description[az]" rows="3" required>{{ optional($service->translate('az'))->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="description_ru">Описание (RU)</label>
                <textarea class="form-control" maxlength="300" oninput="checkLength(this)" id="description_ru" name="description[ru]" rows="3" required>{{ optional($service->translate('ru'))->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="description_en">Description (EN)</label>
                <textarea class="form-control" maxlength="300" oninput="checkLength(this)" id="description_en" name="description[en]" rows="3" required>{{ optional($service->translate('en'))->description }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Yenilə</button>
        </form>
    </div>
@endsection

<script>
    function checkLength(input) {
        const maxLength = input.getAttribute("maxlength");
        if (input.value.length > maxLength) {
            alert(`Maksimum ${maxLength} simvol yazıla bilər.`);
            input.value = input.value.substring(0, maxLength);
        }
    }
</script>
