<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Reservation Data</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Service</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th> <!-- Column for status -->
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Service</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th> <!-- Column for status -->
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($reservations as $reservation)
                        <tr id="reservation-{{ $reservation->id }}">
                            <td>{{ $reservation->service->title ?? 'No Service' }}</td>
                            <td>{{ $reservation->name }}</td>
                            <td>{{ $reservation->email }}</td>
                            <td>{{ $reservation->phone }}</td>
                            <td>{{ $reservation->date }}</td>
                            <td>{{ $reservation->time }}</td>
                            <td>
                                @if($reservation->status === 'pending')
                                    <form method="POST" action="{{ route('reservations.accept', $reservation->id) }}" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">Accept</button>
                                    </form>
                                    <form method="POST" action="{{ route('reservations.reject', $reservation->id) }}" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                    </form>
                                @elseif($reservation->status === 'accepted')
                                    <span class="badge badge-success">Accepted</span>
                                @elseif($reservation->status === 'rejected')
                                    <span class="badge badge-danger">Rejected</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (window.location.hash) {
            const row = document.querySelector(window.location.hash);
            if (row) {
                // Scroll to the row
                row.scrollIntoView({ behavior: "smooth", block: "start" });

                // Adjust scroll position for offset (e.g., 100px above the element)
                const offset = 300;  // Adjust this value for how far above you want the element to appear
                const yOffset = -offset;
                const y = row.getBoundingClientRect().top + window.pageYOffset + yOffset;
                window.scrollTo({ top: y, behavior: 'smooth' });

                // Highlight the row
                row.style.backgroundColor = "#ffffcc";  // Yellow highlight

                // Remove the highlight after 3 seconds
                setTimeout(() => {
                    row.style.backgroundColor = "";
                }, 3000);
            }
        }
    });
</script>
