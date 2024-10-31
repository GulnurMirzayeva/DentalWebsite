@extends('admin.layouts.admin')

@section('title', 'Qiymət Paketləri')

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

    <h1>Qiymət Paketləri</h1>

    <a href="{{ route('pricing.create') }}" class="btn btn-primary mb-3">Paket Əlavə Et</a>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>Ad (AZ)</th>
                <th>Ad (RU)</th>
                <th>Ad (EN)</th>
                <th>Qiymət</th>
                <th>Xidmət (AZ)</th>
                <th>Xidmət (RU)</th>
                <th>Xidmət (EN)</th>
                <th>Proses</th>
            </tr>
            </thead>
            <tbody>
            @foreach($packages as $package)
                <tr>
                    <!-- Azerbaijani Name -->
                    <td>{{ $package->translate('az')->name ?? 'N/A' }}</td>
                    <!-- Russian Name -->
                    <td>{{ $package->translate('ru')->name ?? 'N/A' }}</td>
                    <!-- English Name -->
                    <td>{{ $package->translate('en')->name ?? 'N/A' }}</td>
                    <!-- Price -->
                    <td>{{ $package->price }}</td>
                    <!-- Services in Azerbaijani -->
                    <td>
                        @foreach($package->services as $service)
                            {{ $service->translate('az')->title ?? 'N/A' }}<br>
                        @endforeach
                    </td>
                    <!-- Services in Russian -->
                    <td>
                        @foreach($package->services as $service)
                            {{ $service->translate('ru')->title ?? 'N/A' }}<br>
                        @endforeach
                    </td>
                    <!-- Services in English -->
                    <td>
                        @foreach($package->services as $service)
                            {{ $service->translate('en')->title ?? 'N/A' }}<br>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('pricing.edit', $package->id) }}" class="btn btn-primary">Düzənlə</a>
                        <form action="{{ route('pricing.destroy', $package->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Sil</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
