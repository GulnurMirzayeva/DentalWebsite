@extends('admin.layouts.admin')

@section('title', 'Qiymət Paketi Düzənlə')

@section('content')
    <div class="container mt-0">
        <h1 class="mt-4">Qiymət Paketi Düzənlə</h1>

        <form action="{{ route('pricing.update', $package->id) }}" method="POST" class="mt-3">
            @csrf
            @method('PUT')

            <div class="form-row">
                <!-- Azerbaijani Name -->
                <div class="form-group col-md-4 mb-2">
                    <label for="name_az" class="mb-1">Ad (AZ)</label>
                    <input type="text" name="name[az]" id="name_az" class="form-control" value="{{ $package->translate('az')->name }}" required>
                </div>

                <!-- Russian Name -->
                <div class="form-group col-md-4 mb-2">
                    <label for="name_ru" class="mb-1">Название (RU)</label>
                    <input type="text" name="name[ru]" id="name_ru" class="form-control" value="{{ $package->translate('ru')->name }}" required>
                </div>

                <!-- English Name -->
                <div class="form-group col-md-4 mb-2">
                    <label for="name_en" class="mb-1">Name (EN)</label>
                    <input type="text" name="name[en]" id="name_en" class="form-control" value="{{ $package->translate('en')->name }}" required>
                </div>
            </div>

            <div class="form-row">
                <!-- Price -->
                <div class="form-group col-md-4 mb-2">
                    <label for="price" class="mb-1">Qiymət</label>
                    <input type="number" name="price" id="price" class="form-control" value="{{ $package->price }}" required>
                </div>
            </div>

            <div class="form-group mb-2">
                <label for="services_az">Xidmətlər (AZ)</label>
                <div id="services-container-az">
                    @foreach($package->services as $service)
                        @if($service->pivot->language == 'az')
                            <div class="input-group mb-2">
                                <input type="text" name="services[az][]" class="form-control" value="{{ $service->translate('az')->title }}" required>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-danger remove-service">Sil</button>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <button type="button" id="add-service-az" class="btn btn-secondary mt-0">Xidmət Əlavə Et</button>
            </div>

            <div class="form-group mb-2">
                <label for="services_ru">Xidmətlər (RU)</label>
                <div id="services-container-ru">
                    @foreach($package->services as $service)
                        @if($service->pivot->language == 'ru')
                            <div class="input-group mb-2">
                                <input type="text" name="services[ru][]" class="form-control" value="{{ $service->translate('ru')->title }}" required>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-danger remove-service">Sil</button>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <button type="button" id="add-service-ru" class="btn btn-secondary mt-0">Xidmət Əlavə Et</button>
            </div>

            <div class="form-group mb-2">
                <label for="services_en">Xidmətlər (EN)</label>
                <div id="services-container-en">
                    @foreach($package->services as $service)
                        @if($service->pivot->language == 'en')
                            <div class="input-group mb-2">
                                <input type="text" name="services[en][]" class="form-control" value="{{ $service->translate('en')->title }}" required>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-danger remove-service">Sil</button>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <button type="button" id="add-service-en" class="btn btn-secondary mt-0">Xidmət Əlavə Et</button>
            </div>

            <button type="submit" class="btn btn-primary mt-0">Paket Düzənlə</button>
        </form>
    </div>

    <script>
        document.querySelectorAll('[id^="add-service-"]').forEach(button => {
            button.addEventListener('click', function() {
                const lang = this.id.split('-')[2]; // 'az', 'ru' ya da 'en'
                const container = document.getElementById(`services-container-${lang}`);
                const newService = document.createElement('div');
                newService.className = 'input-group mb-2';
                newService.innerHTML = `
                    <input type="text" name="services[${lang}][]" class="form-control" required>
                    <div class="input-group-append">
                        <button type="button" class="btn btn-danger remove-service">Sil</button>
                    </div>
                `;
                container.appendChild(newService);
            });
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-service')) {
                e.target.closest('.input-group').remove();
            }
        });
    </script>
@endsection
