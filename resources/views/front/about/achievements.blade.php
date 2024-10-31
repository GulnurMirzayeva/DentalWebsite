<div class="achievements-section">
    <div class="achievement-explanation">
        <h1 class="achievement-title">Achievements</h1>
        <p class="achievement-paragraph">Dr Aygün sizə rahat və güvənli mühitdə ən yüksək keyfiyyətli müalicə ilə sağlam gülüşlər yaratmağa hazırdır.</p>
    </div>
    <div style="background-image: url('{{ $backgroundImage }}'); height: 250px; background-size: cover" class="indicator-of-achievement">
        <div class="achievement-overlay"></div>
        <div class="achievement-scores">
            <div class="years-of-experience">
                <h4>Years of experience</h4>
                <p class="experience"></p>
            </div>
            @php
                use App\Models\Reservation;
                use Carbon\Carbon;

                $totalReservations = Reservation::count(); // Count all reservations
                $annualReservations = Reservation::whereYear('date', Carbon::now()->year)->count(); // Count this year's reservations
            @endphp

            <div class="happy-smiling-customer">
                <h4>Happy smiling customer</h4>
                <p class="all-customer">{{ $totalReservations }}</p>
            </div>
            <div class="patients-per-year">
                <h4>Patients per year</h4>
                <p class="yearly-customer">{{ $annualReservations }}</p>
            </div>
        </div>
    </div>
</div>
