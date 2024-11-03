@extends('admin.layouts.admin')

@section('title', 'Contact')

@section('content')
    <div class="container">
        <h1 class="text-center">Əlaqə Mesajları</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-sm">
                <thead class="thead-light">
                <tr>
                    <th scope="col">Ad Soyad</th>
                    <th scope="col">Telefon</th>
                    <th scope="col">Email</th>
                    <th scope="col">Message</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($messages as $message)
                    <tr id="message-{{ $message->id }}">
                        <td>{{ $message->fullname }}</td>
                        <td>{{ $message->phone }}</td>
                        <td>{{ $message->email }}</td>
                        <td>
                            <button type="button" class="btn btn-link p-0" data-toggle="modal" data-target="#messageModal{{ $message->id }}">
                                Mesaja bax
                            </button>

                            <div class="modal fade" id="messageModal{{ $message->id }}" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel{{ $message->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="messageModalLabel{{ $message->id }}">Message from {{ $message->fullname }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <strong>Subject:</strong> {{ $message->subject }}<br><br>
                                            {{ $message->message }}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Bağla</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            @if($message->viewed)
                                <span class="badge badge-success">Baxıldı</span>
                            @else
                                <span class="badge badge-warning">Baxılmayıb</span>
                            @endif
                        </td>
                        <td>
                            <!-- Delete Form -->
                            <form action="{{ route('admin.contact.delete', $message->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Sil</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No messages received yet.</td>
                        <td colspan="5" class="text-center">Mesaj Yoxdur.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @foreach ($messages as $message)
            $('#messageModal{{ $message->id }}').on('hidden.bs.modal', function () {
                // Trigger markAsViewed when the modal is closed
                markAsViewed({{ $message->id }});
            });
            @endforeach
        });

        function markAsViewed(id) {
            fetch(`/admin/contact/${id}/markAsViewed`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
            }).then(response => {
                if (response.ok) {
                    location.reload(); // Reload the page to update the status
                }
            }).catch(error => {
                console.error('Error:', error);
            });
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if (window.location.hash) {
                const element = document.querySelector(window.location.hash);
                if (element) {
                    element.classList.add('highlight');  // Apply the highlight class
                    element.scrollIntoView({ behavior: 'smooth' }); // Smooth scrolling to the element

                    // Optionally, remove the highlight class after a few seconds
                    setTimeout(() => {
                        element.classList.remove('highlight');
                    }, 2000);  // Remove after 2 seconds
                }
            }
        });
    </script>
    <style>.highlight {
            background-color: #ffeb3b;
            animation: highlight-animation 2s ease-in-out;
        }

        @keyframes highlight-animation {
            0% { background-color: #ffeb3b; }
            100% { background-color: transparent; }
        }
    </style>
@endsection
