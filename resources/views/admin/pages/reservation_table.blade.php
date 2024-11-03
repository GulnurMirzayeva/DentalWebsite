<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Rezervasiya Məlumatları</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Xidmət</th>
                        <th>Ad</th>
                        <th>Email</th>
                        <th>Telefon</th>
                        <th>Tarix</th>
                        <th>Saat</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Xidmət</th>
                        <th>Ad</th>
                        <th>Email</th>
                        <th>Telefon</th>
                        <th>Tarix</th>
                        <th>Saat</th>
                        <th>Status</th>
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
                                        <button type="submit" class="btn btn-sm btn-success">Qəbul et</button>
                                    </form>
                                    <form method="POST" action="{{ route('reservations.reject', $reservation->id) }}" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">Qəbul etmə</button>
                                    </form>
                                @elseif($reservation->status === 'accepted')
                                    <span class="badge badge-success">Qəbul edilmiş</span>
                                @elseif($reservation->status === 'rejected')
                                    <span class="badge badge-danger">Qəbul edilməmiş</span>
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
                row.scrollIntoView({ behavior: "smooth", block: "start" });

                const offset = 300;
                const yOffset = -offset;
                const y = row.getBoundingClientRect().top + window.pageYOffset + yOffset;
                window.scrollTo({ top: y, behavior: 'smooth' });

                row.style.backgroundColor = "#ffffcc";

                setTimeout(() => {
                    row.style.backgroundColor = "";
                }, 3000);
            }
        }
    });
</script>
