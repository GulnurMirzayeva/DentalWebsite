@extends('admin.layouts.admin')

@section('title', 'Yeni Qiymət Paketi Yarat')

@section('content')
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h1 class="text-primary mb-4">Yeni Qiymət Paketi Yarat</h1>

    <form action="{{ route('pricing.store') }}" method="POST" class="shadow p-4 bg-light rounded">
        @csrf
        <div class="form-row">
            <!-- Azerbaijani Title -->
            <div class="form-group col-md-4">
                <label for="name_az">Ad (AZ)</label>
                <input type="text" name="name[az]" id="name_az" class="form-control" placeholder="Paket Adını daxil edin" required>
            </div>

            <!-- Russian Title -->
            <div class="form-group col-md-4">
                <label for="name_ru">Название (RU)</label>
                <input type="text" name="name[ru]" id="name_ru" class="form-control" placeholder="Введите название" required>
            </div>

            <!-- English Title -->
            <div class="form-group col-md-4">
                <label for="name_en">Title (EN)</label>
                <input type="text" name="name[en]" id="name_en" class="form-control" placeholder="Enter the title" required>
            </div>
        </div>

        <!-- Price Field -->
        <div class="form-group mb-3">
            <label for="price" class="form-label">Qiymət (AZN)</label>
            <input type="number" name="price" id="price" step="0.01" class="form-control" placeholder="Qiymət daxil edin" required>
        </div>

        <!-- Services Field (Multilingual) -->
        <div class="form-row">
            <!-- Services in Azerbaijani -->
            <div class="form-group col-md-4">
                <label for="services_az" class="form-label">Xidmətlər (AZ)</label>
                <select name="services[az][]" id="services_az" class="form-control" multiple required>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}">{{ $service->translate('az')->title ?? $service->title }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Services in Russian -->
            <div class="form-group col-md-4">
                <label for="services_ru" class="form-label">Услуги (RU)</label>
                <select name="services[ru][]" id="services_ru" class="form-control" multiple required>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}">{{ $service->translate('ru')->title ?? $service->title }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Services in English -->
            <div class="form-group col-md-4">
                <label for="services_en" class="form-label">Services (EN)</label>
                <select name="services[en][]" id="services_en" class="form-control" multiple required>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}">{{ $service->translate('en')->title ?? $service->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary mt-3 w-100">Paketi Yarat</button>
    </form>
@endsection
