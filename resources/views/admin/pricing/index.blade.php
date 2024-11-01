@extends('admin.layouts.admin')

@section('title', 'Pricing Packages')

@section('content')
    <div class="container">
        <h1>Pricing Packages</h1>

        <a href="{{ route('pricing.create') }}" class="btn btn-primary mb-3">Create New Package</a>

        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Name (AZ)</th>
                <th>Name (RU)</th>
                <th>Name (EN)</th>
                <th>Price</th>
                <th>Service (AZ)</th>
                <th>Service (RU)</th>
                <th>Service (EN)</th>
                <th>Actions</th>
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
                        <a href="{{ route('pricing.edit', $package->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('pricing.destroy', $package->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
