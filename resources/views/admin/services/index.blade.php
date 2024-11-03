@extends('admin.layouts.admin')

@section('title', 'Services')

@section('content')
    <h1>Xidmətlər</h1>
    <a href="{{ route('admin.services.create') }}" class="btn btn-primary mb-3">Yeni Xidmət Əlavə Et</a>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>Icon</th>
                <th>Başlıq (AZ)</th>
                <th>Başlıq (RU)</th>
                <th>Başlıq (EN)</th>
                <th>Məzmun (AZ)</th>
                <th>Məzmun (RU)</th>
                <th>Məzmun (EN)</th>
                <th>Proses</th>
            </tr>
            </thead>
            <tbody>
            @foreach($services as $service)
                <tr>
                    <td>
                        @if($service->icon)
                            <img src="{{ asset('storage/'.$service->icon) }}" width="50" alt="{{ $service->title }}">
                        @else
                            <span class="text-muted">Icon Yox</span>
                        @endif
                    </td>
                    <td>{{ Str::limit(optional($service->translate('az'))->title ?? 'Başlıq Yox', 16) }}</td>
                    <td>{{ Str::limit(optional($service->translate('ru'))->title ?? 'Başlıq Yox', 16) }}</td>
                    <td>{{ Str::limit(optional($service->translate('en'))->title ?? 'Başlıq Yox', 16) }}</td>
                    <td>{{ Str::limit(optional($service->translate('az'))->description ?? 'Məzmun Yox', 100) }}</td>
                    <td>{{ Str::limit(optional($service->translate('ru'))->description ?? 'Məzmun Yox', 100) }}</td>
                    <td>{{ Str::limit(optional($service->translate('en'))->description ?? 'Məzmun Yox', 100) }}</td>
                    <td>
                        <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-sm btn-primary mb-1 w-100">Düzənlə</a>
                        <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="d-inline w-100">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger w-100" onclick="return confirm('Əminsinizmi?')">Sil</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
