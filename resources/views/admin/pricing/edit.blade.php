@extends('admin.layouts.admin')

@section('title', 'Pricing Package')

@section('content')
    <div class="container">
        <h1>Qiymət Paketini Düzənlə</h1>

        <form action="{{ route('pricing.update', $package->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-header">
                    Paket detayları
                </div>
                <div class="card-body">
                    @foreach(['az' => 'Azerbaijani', 'ru' => 'Russian', 'en' => 'English'] as $locale => $language)
                        <div class="form-group">
                            <label>{{ $language }} Ad</label>
                            <input type="text" name="name[{{ $locale }}]" class="form-control"
                                   value="{{ $package->translate($locale)->name ?? '' }}" required>
                        </div>
                    @endforeach

                    <div class="form-group">
                        <label>Qiymət</label>
                        <input type="number" name="price" class="form-control" step="0.01"
                               value="{{ $package->price }}" required>
                    </div>

                    <div class="form-group" id="services-container">
                        <label>Xidmət seç</label>

                        @foreach($package->services as $index => $packageService)
                            <div class="service-group">
                                @foreach(['az' => 'Azerbaijani', 'ru' => 'Russian', 'en' => 'English'] as $locale => $language)
                                    <div class="form-group">
                                        <label>{{ $language }} Xidmət</label>
                                        <select name="service_id[{{ $locale }}][]" class="form-control">
                                            <option value="">Xidmət seç</option>
                                            @foreach($services as $service)
                                                <option value="{{ $service->id }}"
                                                    {{ $packageService->id == $service->id ? 'selected' : '' }}>
                                                    {{ $service->translate($locale)->title ?? $service->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach

                        <button type="button" id="add-service" class="btn btn-secondary">Xidmət əlavə et</button>
                    </div>

                    <button type="submit" class="btn btn-primary">Əlavə et</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let servicesContainer = document.getElementById('services-container');
            let addServiceButton = document.getElementById('add-service');
            let serviceCount = {{ count($package->services) }};

            addServiceButton.addEventListener('click', function () {
                if (serviceCount < 5) {
                    serviceCount++;

                    let serviceGroup = document.createElement('div');
                    serviceGroup.classList.add('service-group');

                    serviceGroup.innerHTML = `
                        <div class="form-group">
                            <label>Select Services</label>
                            @foreach(['az' => 'Azerbaijani', 'ru' => 'Russian', 'en' => 'English'] as $locale => $language)
                    <div class="form-group">
                        <label>{{ $language }} Service</label>
                                <select name="service_id[{{ $locale }}][]" class="form-control">
                                    <option value="">Select a service</option>
                                    @foreach($services as $service)
                    <option value="{{ $service->id }}">
                                        {{ $service->translate($locale)->title ?? $service->title }}
                    </option>
@endforeach
                    </select>
                </div>
@endforeach
                    </div>
`;
                    servicesContainer.appendChild(serviceGroup);
                } else {
                    alert('Yalnız  xidmət əlavə edə bilərsən.');
                }
            });
        });
    </script>
@endsection
