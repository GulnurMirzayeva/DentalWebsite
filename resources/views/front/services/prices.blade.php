<div class="our_offer">
    <h1>Our Best Offers</h1>
    <p>Our offer is valid during this month</p>
</div>
<div class="our_offers_dentis">
    @foreach($packages as $package)
        <div class="our_offer_card">
            <h2>{{ $package->name }}</h2>
            <p style="padding-bottom: 20px">
                <i class="fa-solid fa-manat-sign" style="margin-right: 2px;"></i>
                <span class="span-package-price">{{ $package->price }}</span>/sessiya
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


