<div id="overlay" class="overlay hidden"></div>

<div id="appointment-form" class="form-modal hidden">

    <form id="custom_appointmentForm" method="POST" action="{{ route('reservation.store') }}">
        @csrf
        <div class="appointment-form-row">
            <div class="service-selection-group">
                <select id="department" name="department" class="service-select" required>
                    <option value="" disabled selected class="service-select-option">Services</option>
                    @foreach($allServices as $service)
                        <option value="{{ $service->id }}" class="service-select-option">{{ $service->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="name-input-group">
                <input type="text" id="name" name="name" placeholder="Name" required>
                <i class="fas fa-user"></i>
            </div>
            <div class="email-input-group">
                <input type="email" id="email" name="email" placeholder="Email" required>
                <i class="fa-solid fa-paper-plane"></i>
            </div>
        </div>
        <div class="appointment-form-row">
            <div class="date-input-group">
                <input
                    type="text"
                    id="date-picker-appointment"
                    name="date"
                    placeholder="Date"
                    readonly
                    required
                    class="input-with-icon"
                />
                <i class="fas fa-calendar-alt"></i>
            </div>
            <div class="time-input-group">
                <input
                    type="text"
                    id="time-picker-appointment"
                    name="time"
                    placeholder="Time"
                    readonly
                    required
                    class="input-with-icon"
                />
                <i class="fas fa-clock"></i>
            </div>
            <div class="phone-input-group">
                <input type="tel" id="phone" name="phone" placeholder="Phone" required
                       pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                       title="Only numbers are allowed">
                <i class="fas fa-phone"></i>
            </div>
        </div>
        <button type="submit" class="appointment-submit-btn">Make an Appointment</button>
    </form>
</div>

<script>
    //
    // document.getElementById('appointment-btn').addEventListener('click', function() {
    //     const appointmentForm = document.getElementById('custom_appointmentForm');
    //     appointmentForm.submit();
    // });
</script>

