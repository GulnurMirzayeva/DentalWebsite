<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search -->
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"
          onsubmit="return handleSearch(event)">
        <div class="input-group">
            <input id="searchInput" type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                   aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>


    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                 aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small"
                               placeholder="Search for..." aria-label="Search"
                               aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <!-- Nav Item - Reservations -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="reservationsDropdown" role="button"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-calendar-alt fa-fw"></i>
                <!-- Counter - Reservations -->
                @php
                    // Fetch the latest 5 reservations with 'pending' status
                    $pendingReservationsCount = App\Models\Reservation::where('status', 'pending')->count();
                    $latestPendingReservations = App\Models\Reservation::where('status', 'pending')
                        ->orderBy('created_at', 'desc')
                        ->take(5)
                        ->get();
                @endphp
                <span class="badge badge-danger badge-counter">{{ $pendingReservationsCount }}</span>
            </a>
            <!-- Dropdown - Reservations -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                 aria-labelledby="reservationsDropdown">
                <h6 class="dropdown-header">
                    Reservations Center
                </h6>
                @forelse($latestPendingReservations as $reservation)
                    <a class="dropdown-item d-flex align-items-center"
                       href="{{ route('admin.reservation', ['reservation_id' => $reservation->id]) }}#reservation-{{ $reservation->id }}">
                        <div class="font-weight-bold">
                            <div class="text-truncate">{{ $reservation->name }} - {{ $reservation->date }}
                                at {{ $reservation->time }}</div>
                            <div class="small text-gray-500">{{ $reservation->email }}
                                · {{ $reservation->created_at->diffForHumans() }}</div>
                        </div>
                    </a>
                @empty
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="font-weight-bold">
                            <div class="text-truncate">No new reservations</div>
                        </div>
                    </a>
                @endforelse
                <a class="dropdown-item text-center small text-gray-500" href="{{ route('admin.reservation') }}">Read
                    More Reservations</a>
            </div>
        </li>

        <!-- Nav Item - Comments -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="commentsDropdown" role="button"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-comments fa-fw"></i>
                <!-- Counter - Comments -->
                @php
                    // Fetch the latest 5 comments without filtering by status
                    $comments = App\Models\BlogComment::orderBy('created_at', 'desc')->take(5)->get();
                @endphp
                <span class="badge badge-danger badge-counter">{{ $comments->count() }}</span>
            </a>
            <!-- Dropdown - Comments -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                 aria-labelledby="commentsDropdown">
                <h6 class="dropdown-header">
                    Comment Center
                </h6>
                @forelse($comments as $comment)
                    <a class="dropdown-item d-flex align-items-center"
                       href="{{ route('admin.comments.index', ['comment_id' => $comment->id]) }}">
                        <div class="font-weight-bold">
                            <div class="text-truncate">{{ Str::limit($comment->content, 50) }}</div>
                            <div class="small text-gray-500">{{ $comment->name }}
                                · {{ $comment->created_at->diffForHumans() }}</div>
                        </div>
                    </a>
                @empty
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="font-weight-bold">
                            <div class="text-truncate">No new comments</div>
                        </div>
                    </a>
                @endforelse
                <a class="dropdown-item text-center small text-gray-500" href="{{ route('admin.comments.index') }}">Read
                    More Comments</a>
            </div>
        </li>


        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <!-- Counter - Messages -->
                @php
                    $messages = App\Models\ComplaintSuggestion::where('viewed', false)
                                ->orderBy('created_at', 'desc')
                                ->take(5)
                                ->get();
                @endphp
                <span class="badge badge-danger badge-counter">{{ $messages->count() ?? '0' }}</span>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                 aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                    Message Center
                </h6>
                @forelse($messages as $message)
                    <a class="dropdown-item d-flex align-items-center"
                       href="{{ route('admin.contact.show') }}#message-{{ $message->id }}">
                        <div class="dropdown-list-image mr-3">
                            <img class="rounded-circle" src="img/undraw_profile_1.svg" alt="...">
                            <div class="status-indicator bg-success"></div>
                        </div>
                        <div class="font-weight-bold">
                            <div class="text-truncate">{{ $message->subject }}</div>
                            <div class="small text-gray-500">{{ $message->fullname }}
                                · {{ $message->created_at->diffForHumans() }}</div>
                        </div>
                    </a>
                @empty
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="font-weight-bold">
                            <div class="text-truncate">No new messages</div>
                        </div>
                    </a>
                @endforelse
                <a class="dropdown-item text-center small text-gray-500" href="{{ route('admin.contact.show') }}">Read
                    More Messages</a>
            </div>
        </li>


        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                <img class="img-profile rounded-circle"
                     src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : asset('img/undraw_profile.svg') }}"
                     width="40" height="40">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                 aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('admin.profile') }}">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <div class="dropdown-divider"></div>
                <!-- Logout Form -->
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </button>
                </form>
            </div>
        </li>
    </ul>

</nav>


<script>
    function handleSearch(event) {
        event.preventDefault();

        const query = document.getElementById('searchInput').value.toLowerCase();

        const pages = {
            "blogs": "{{ route('admin.blogs.index') }}",
            "gallery": "{{ route('admin.gallery.index') }}",
            "slider": "{{ route('sliders.index') }}",
            {{--"comment": "{{ route('comments') }}",--}}
                {{--"price": "{{ route("admin.pricing.index") }}",--}}
                {{--"contact": "{{ route("admin/contact-details") }}",--}}
                {{--"suggestion": "{{ route("admin/contact") }}",--}}
                {{--"services": "{{ route('services') }}",--}}
            "header image": "{{ route('header_images.index') }}",
            "about image": "{{ route('about_images.index') }}",
            "reservation data": "{{ route('admin.reservation') }}",
        };

        if (pages[query]) {
            window.location.href = pages[query];
        } else {
            alert('Page not found!');
        }
    }
</script>
<!-- End of Topbar -->
