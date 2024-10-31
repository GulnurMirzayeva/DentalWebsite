<div class="our_offer">
    <h1>Our Best Offers</h1>
    <p>Our offer is valid during this month</p>
</div>
<div class="our_offers_dentis">
    @foreach($packages as $package)
        <div class="our_offer_card">
            <h2>{{$package->name}}</h2>
            <p><i class="fa-solid fa-manat-sign" style="margin-right: 2px;"></i> <span class="span-package-price">{{$package->price}}</span>/sessiya</p>

            <ul class="best_offers">
                @php
                    $services = explode(',', $package->service_ids);
                @endphp

                @foreach($services as $service)
                    <li style="list-style: none">{{ trim($service) }}</li>
                @endforeach
            </ul>
        </div>
    @endforeach
</div>

