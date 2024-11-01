<div class="missions-goals-general">
    <div class="missions-goals">
        <div class="content-for-missions-goals">
            <div class="buttons">
                <button onclick="showContent('what-we-do')" class="content-button active">{{ __('our-doings') }}</button>
                <button onclick="showContent('our-mission')" class="content-button">{{ __('our-mission') }}</button>
                <button onclick="showContent('our-goal')" class="content-button">{{ __('our-goal') }}</button>
            </div>
            <div id="what-we-do" class="content-section">
                <h2>{{ __('our-doings-title') }}</h2>
                <p>{{ __('our-doings-paragraph-1') }}</p>
                <p>{{ __('our-doings-paragraph-2') }}</p>
            </div>
            <div id="our-mission" class="content-section hidden">
                <h2>{{ __('our-missions-title') }}</h2>
                <p>{{ __('our-missions-paragraph-1') }}</p>
                <p>{{ __('our-missions-paragraph-2') }}</p>
            </div>
            <div id="our-goal" class="content-section hidden">
                <h2>{{ __('our-goal-title') }}</h2>
                <p>{{ __('our-goal-paragraph') }}</p>
            </div>
        </div>
        <div class="high-quality-services-image">
            <img src="{{ asset('assets/front/img/missions-goals.jpg') }}" alt="High Quality Services">
        </div>
    </div>
</div>
