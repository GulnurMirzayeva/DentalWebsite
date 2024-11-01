@extends('admin.layouts.admin')

@section('title', 'Create Pricing Package')

@section('content')
    <div class="container">
        <h1>Create Pricing Package</h1>

        <form action="{{ route('pricing.store') }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-header">
                    Package Details
                </div>
                <div class="card-body">
                    @foreach(['az' => 'Azerbaijani', 'ru' => 'Russian', 'en' => 'English'] as $locale => $language)
                        <div class="form-group">
                            <label>{{ $language }} Name</label>
                            <input type="text" name="name[{{ $locale }}]" class="form-control" required>
                        </div>
                    @endforeach

                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" name="price" class="form-control" step="0.01" required>
                    </div>

                    <div class="form-group" id="services-container">
                        <label>Select Services</label>
                        <div class="service-group">
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
                        <button type="button" id="add-service" class="btn btn-secondary">Add Service</button>
                    </div>

                    <button type="submit" class="btn btn-primary">Create Package</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let servicesContainer = document.getElementById('services-container');
            let addServiceButton = document.getElementById('add-service');
            let serviceCount = 1;

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
                    alert('You can only add up to 5 services.');
                }
            });
        });
    </script>
@endsection
