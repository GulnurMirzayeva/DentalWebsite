 <div class="contact-section">
    <div class="opening-hours">
        <h2 class="opening-hours__title">{{ __('working-hours') }}</h2>
        <ul class="opening-hours__list">
            @php
                $today = now();
            @endphp

            @foreach(range(0, 5) as $i)
                @php
                    $date = $i === 0 ? $today : $today->copy()->addDays($i);
                    $dayName = $date->translatedFormat('j F');

                    $dayOfWeek = $date->dayOfWeek;

                    if ($dayOfWeek == 0) {
                        $workingHours = __('rest-days');
                    } elseif ($date->day % 2 == 0) {
                        $workingHours = "14:00 - 18:00";
                    } else {
                        $workingHours = "09:00 - 13:00";
                    }
                @endphp
                <li class="opening-hours__item">
                    <span class="opening-hours__day">{{ $dayName }}: {{ $workingHours }}</span>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="contact-form__container">
        <h2 class="contact-form__title">{{ __('get-in-touch') }}</h2>
        <form id="contactForm" class="contact-form" action="{{ route('admin.contact.store') }}" method="POST">
            @csrf
            <div class="contact-form__row contact-form__row--spaced">
                <div class="contact-form__field-group contact-form__field-group--narrow">
                    <input type="text" id="fullname" name="fullname" class="contact-form__input" required
                           placeholder=" ">
                    <label for="fullname" class="contact-form__label">{{ __('name') }}</label>
                </div>
                <div class="contact-form__field-group contact-form__field-group--narrow">
                    <input type="tel" id="phone" name="phone" class="contact-form__input" required placeholder=" "
                           pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '')" title="Only numbers are allowed">
                    <label for="phone" class="contact-form__label">{{ __('phone') }}</label>
                </div>
            </div>
            <div class="contact-form__row contact-form__row--spaced">
                <div class="contact-form__field-group contact-form__field-group--narrow">
                    <input type="email" id="email" name="email" class="contact-form__input" placeholder=" ">
                    <label for="email" class="contact-form__label">{{ __('email') }} ({{ __('optional') }})</label>
                </div>
                <div class="contact-form__field-group contact-form__field-group--narrow">
                    <input type="text" id="subject" name="subject" class="contact-form__input" required placeholder=" ">
                    <label for="subject" class="contact-form__label">{{ __('subject') }}</label>
                </div>
            </div>
            <div class="contact-form__field-group">
                <textarea id="message" name="message" class="contact-form__textarea contact-form__textarea--large"
                          required placeholder=" "></textarea>
                <label for="message" class="contact-form__label">{{ __('message') }}</label>
            </div>
            <button type="submit" class="contact-form__submit-btn">
                <span class="contact-form__submit-text">{{ __('send-message') }}</span>
                <span class="contact-form__submit-icon">&#10148;</span>
            </button>
        </form>
    </div>
</div>

