<div id="overlay" class="overlay hidden"></div>

<div id="appointment-form" class="form-modal hidden">

    <form id="custom_appointmentForm" method="POST" action="{{ route('reservation.store') }}">
        @csrf
        <div class="appointment-form-row">
            <div class="service-selection-group">
                <select id="department" name="department" class="service-select" required>
                    <option value="" disabled selected class="service-select-option">{{ __('services') }}</option>
                    @foreach($allServices as $service)
                        <option value="{{ $service->id }}" class="service-select-option">{{ $service->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="name-input-group">
                <input type="text" id="name" name="name" placeholder="{{ __('name') }}" required>
                <i class="fas fa-user"></i>
            </div>
            <div class="email-input-group">
                <input type="email" id="email" name="email" placeholder="{{ __('email') }}" required>
                <i class="fa-solid fa-paper-plane"></i>
            </div>
        </div>
        <div class="appointment-form-row">
            <div class="date-input-group">
                <input
                    type="text"
                    id="date-picker-appointment"
                    name="date"
                    placeholder="{{ __('date') }}"
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
                    placeholder="{{ __('time') }}"
                    readonly
                    required
                    class="input-with-icon"
                />
                <i class="fas fa-clock"></i>
            </div>
            <div class="phone-input-group">
                <input type="tel" id="phone" name="phone" placeholder="{{ __('phone') }}" required
                       pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                       title="Only numbers are allowed">
                <i class="fas fa-phone"></i>
            </div>
        </div>
        <button type="submit" class="appointment-submit-btn">{{ __('appointment') }}</button>
    </form>
</div>



