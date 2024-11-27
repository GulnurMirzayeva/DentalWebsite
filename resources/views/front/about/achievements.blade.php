<div class="achievements-section">
    <div class="achievement-explanation">
        <h1 class="achievement-title">{{ __('achievements-title') }}</h1>
        <p class="achievement-paragraph">{{ __('achievements-paragraph') }}</p>
    </div>
    <div style="background-image: url('{{ $backgroundImage }}'); height: 250px; background-size: cover" class="indicator-of-achievement">
        <div class="achievement-overlay"></div>
        <div class="achievement-scores">
            <div class="years-of-experience">
                <h4>{{ __('years-of-experience') }}</h4>
                <p class="experience"></p>
            </div>
            @php
                use App\Models\Reservation;
                use Carbon\Carbon;

                $totalReservations = Reservation::count();
                $annualReservations = Reservation::whereYear('date', Carbon::now()->year)->count();
            @endphp

            <div class="happy-smiling-customer">
                <h4>{{ __('smiling-customer') }}</h4>
                <p class="all-customer">{{ $totalReservations }}</p>
            </div>
            <div class="patients-per-year">
                <h4>{{ __('all-patients') }}</h4>
                <p class="yearly-customer">{{ $annualReservations }}</p>
            </div>
        </div>
    </div>
</div>
