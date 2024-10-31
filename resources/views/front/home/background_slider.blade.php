
<div class="background_slider">
    <div class="slider-images">
        <div class="background-slider-overlay"></div>
        @if($sliderImages->isNotEmpty())
            @foreach($sliderImages as $index => $slider)
                <img src="{{ asset('storage/' . $slider->file) }}" alt="Slider Image {{ $index + 1 }}" class="slider-image {{ $index === 0 ? 'active' : '' }}">
            @endforeach
        @else
            <img src="{{ $defaultImageSlider }}" alt="Default Image" class="slider-image active">
        @endif
    </div>
    <div class="slider-controls">
        <button class="prev-slide"></button>
        <button class="next-slide"></button>
    </div>

    <div class="background-slider-content">
        <h1>Diş sağlamlığınıza <br> dəyər veririk</h1>
        <p class="bck-slider-paragraph">Məqsədimiz, hər bir xəstəmizin ehtiyaclarına uyğun fərdi .<br> müalicə planı hazırlayaraq, rahat və sağlam bir gülüş qazandırmaqdır.</p>
        <button id="appointment-btn" class="appointment-btn">Make an Appointment</button>
    </div>
</div>

<div class="card_slider_container">
    <div class="card_slider">
        <div class="emergency_cases">
            <h2>Emergency Cases</h2>
            <p class="emergency-paragraph">Təcili hallarda dərhal <br> yardım göstərmək üçün hazırıq.</p>
            <span class="phone_number">{{ $contactDetails->phone ?? 'Phone not set' }}</span>
        </div>
        <div class="working_hours">
            <h2>İş Saatları</h2>
            <ul>
                @php
                    $today = now();
                @endphp

                @foreach(range(0, 5) as $i)
                    @php
                        $date = $i === 0 ? $today : $today->copy()->addDays($i);
                        $dayName = $date->translatedFormat('j F');

                        $dayOfWeek = $date->dayOfWeek;

                        if ($dayOfWeek == 0) {
                            $workingHours = "İstirahət Günü";
                        } elseif ($date->day % 2 == 0) {
                            $workingHours = "14:00 - 18:00";
                        } else {
                            $workingHours = "09:00 - 13:00";
                        }
                    @endphp
                    <li>
                        {{ $dayName }}: {{ $workingHours }}
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="custom_appointment">
            <h2 class="appointment-title">Make an Appointment</h2>
            <form id="custom_appointmentForm" method="POST" action="{{ route('reservation.store') }}">
                @csrf
                <div class="form-row">
                    <div class="input-group">
                        <select id="department" name="department" style="color: rgba(255, 255, 255, 0.7); font-size: 16px" class="selecting-services">
                            <option value="" disabled selected>Services</option>
                            @foreach($allServices as $service)
                                <option value="{{ $service->id }}">{{ $service->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group">
                        <input type="text" id="name" name="name" placeholder="Name" required>
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="input-group">
                        <input type="email" id="email" name="email" placeholder="Email">
                        <i class="fa-solid fa-paper-plane"></i>
                    </div>
                </div>
                <div class="form-row">
                    <div class="date-input-group">
                        <input
                            type="text"
                            id="date-picker-main"
                            name="date"
                            placeholder="Date"
                            readonly
                            required
                            class="input-with-icon"
                        />
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="time-input-group ">
                        <input
                            type="text"
                            id="time-picker-main"
                            name="time"
                            placeholder="Time"
                            readonly
                            required
                            class="input-with-icon"
                        />
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="input-group">
                        <input type="tel" id="phone" name="phone" placeholder="Phone" required
                               pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                               title="Only numbers are allowed">
                        <i class="fas fa-phone"></i>
                    </div>
                </div>
                <button type="submit" class="button" id="appointment-btn button">Make an appointment</button>
            </form>
        </div>

    </div>
</div>

<!-- Date Picker and Flatpickr Time JS -->
<script src="https://cdn.jsdelivr.net/npm/@easepick/bundle@1.2.1/dist/index.umd.min.js"></script>
<script>
    const picker = new easepick.create({
        element: document.getElementById('date-picker-main'),
        css: [
            'https://cdn.jsdelivr.net/npm/@easepick/bundle@1.2.1/dist/index.css'
        ],
        format: 'YYYY-MM-DD',
        lang: 'en-US',
        zIndex: 10
    });

    flatpickr("#time-picker-main", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true,
        minuteIncrement: 15
    });
    //
    // document.getElementById('appointment-btn').addEventListener('click', function() {
    //     const appointmentForm = document.getElementById('custom_appointmentForm');
    //     appointmentForm.submit();
    // });

</script>
