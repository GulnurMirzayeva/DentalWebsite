@extends('admin.layouts.admin')

@section('title', 'Comments')

@section('content')
    <div class="container mt-4">
        <h1>Şərhi Düzənlə</h1>

        <form action="{{ route('admin.comments.update', $comment->id) }}" method="POST" class="mt-4">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Ad:</label>
                <input type="text" name="name" value="{{ $comment->name }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" value="{{ $comment->email }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="comment">Şərh:</label>
                <textarea name="comment" class="form-control" rows="5" required>{{ $comment->comment }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Yenilə</button>
        </form>
    </div>
@endsection
