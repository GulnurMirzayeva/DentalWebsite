<div class="our_offer">
    <h1>{{ __('price-title') }}</h1>
    <p>{{ __('price-paragraph') }}</p>
</div>
<div class="our_offers_dentis">
    @foreach($packages as $package)
        <div class="our_offer_card">
            <h2>{{ $package->name }}</h2>
            <p style="padding-bottom: 20px">
                <i class="fa-solid fa-manat-sign" style="margin-right: 2px;"></i>
                <span class="span-package-price">{{ $package->price }}</span>/{{ __('session') }}
            </p>

            <ul class="best_offers">
                @foreach(explode(',', $package->service_name) as $index => $serviceName)
                    <li style="list-style: none; text-align: center; background-color: {{ $index % 2 === 0 ? '#fff' : '#f8f9fa' }}; margin-left: -2px">
                        {{ trim($serviceName) }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endforeach
</div>


