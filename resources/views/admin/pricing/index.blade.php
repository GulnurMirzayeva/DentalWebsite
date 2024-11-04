@extends('admin.layouts.admin')

@section('title', 'Pricing Packages')

@section('content')
    <div class="container">
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

        <a href="{{ route('pricing.create') }}" class="btn btn-primary mb-3">Yeni paket yarat</a>

        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Ad (AZ)</th>
                <th>Ad (RU)</th>
                <th>Ad (EN)</th>
                <th>Qiymət</th>
                <th>Xidmət (AZ)</th>
                <th>Xidmət (RU)</th>
                <th>Xidmət (EN)</th>
                <th>Proseslər</th>
            </tr>
            </thead>
            <tbody>
            @foreach($packages as $package)
                <tr>
                    <td>{{ $package->translate('az')->name ?? 'N/A' }}</td>
                    <td>{{ $package->translate('ru')->name ?? 'N/A' }}</td>
                    <td>{{ $package->translate('en')->name ?? 'N/A' }}</td>
                    <td>{{ $package->price }}</td>
                    <td>{{ $package->translate('az')->service_name ?? 'N/A' }}</td>
                    <td>{{ $package->translate('ru')->service_name ?? 'N/A' }}</td>
                    <td>{{ $package->translate('en')->service_name ?? 'N/A' }}</td>

                    <td>
                        <a href="{{ route('pricing.edit', $package->id) }}" class="btn btn-sm btn-warning">Düzənlə</a>
                        <form action="{{ route('pricing.destroy', $package->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Sil</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
