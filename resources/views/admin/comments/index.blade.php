@extends('admin.layouts.admin')

@section('title', 'Comments')

@section('content')
    <h1>Şərhlər</h1>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Adı</th>
                <th scope="col">Email</th>
                <th scope="col">Şərh</th>
                <th scope="col">Proses</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($comments as $comment)
                <tr id="comment-{{ $comment->id }}">
                    <td>{{ $comment->id }}</td>
                    <td>{{ $comment->name }}</td>
                    <td>{{ $comment->email }}</td>
                    <td>{{ $comment->comment }}</td>
                    <td>
                        <!-- Delete button -->
                        <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" class="d-inline w-100">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger w-100">Sil</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const hash = window.location.hash;
            if (hash) {
                const element = document.querySelector(hash);
                if (element) {
                    element.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    element.classList.add('highlight');

                    setTimeout(() => {
                        element.classList.remove('highlight');
                    }, 2000);
                }
            }
        });
    </script>

    <style>
        .highlight {
            background-color: #ffeb3b;
            animation: highlight-animation 2s ease-in-out;
        }

        @keyframes highlight-animation {
            0% { background-color: #ffeb3b; }
            100% { background-color: transparent; }
        }
    </style>
@endsection
