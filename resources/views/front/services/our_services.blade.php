<div class="container-for-services">
    <div class="information_about_services">
        <h1>Diş müalicə xidmətləri: Sağlam və gözəl gülüşə gedən yol</h1>
        <p>Sağlam və estetik baxımdan mükəmməl bir gülüş yaratmaq üçün müxtəlif stomatoloji xidmətlər təklif edirik.</p>
    </div>

    <div class="our_services">
        @foreach($services as $service)
            <div class="our_services_dentis">
                <div class="servis_icon">
                    <img src="{{ asset('images/'.$service->icon) }}" alt="{{ $service->title }}">
                </div>
                <div class="our_service_information">
                    <h2>{{ $service->title }}</h2>
                    <p>{{ $service->description }}</p>
                </div>
            </div>
        @endforeach
    </div>
        <div class="pagination">
        @if($services instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <div class="gallery-navigation-container">
                    @if ($services->onFirstPage())
                        <span class="gallery-button gallery-button--previous disabled">&#8249; Prev</span>
                    @else
                        <a href="{{ $services->previousPageUrl() }}" class="gallery-button gallery-button--previous">&#8249; Prev</a>
                    @endif

                    <div class="gallery-pagination">
                        @foreach ($services->getUrlRange(1, $services->lastPage()) as $page => $url)
                            @if ($page == $services->currentPage())
                                <span class="gallery-pagination-button active" aria-current="page">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="gallery-pagination-button">{{ $page }}</a>
                            @endif
                        @endforeach
                    </div>

                    @if ($services->hasMorePages())
                        <a href="{{ $services->nextPageUrl() }}" class="gallery-button gallery-button--next">Next &#8250;</a>
                    @else
                        <span class="gallery-button gallery-button--next disabled">Next &#8250;</span>
                    @endif
                </div>

        </div>
        @endif
    </div>


<style>
    :root {
        --grid-gap: 1rem;
        --item-border-radius: 12px;
        --text-color: #333;
        --background-color: #f8f9fa;
        --shadow-color: rgba(0, 0, 0, 0.1);
        --hover-shadow-color: rgba(0, 0, 0, 0.3);
        --button-gradient: linear-gradient(80deg, var(--blue), var(--teal));
        --button-hover-gradient: linear-gradient(135deg, var(--teal), var(--blue));
        --button-text-color: #ffffff;
        --button-border-radius: 10px;
        --button-padding: 14px 28px;
        --pagination-button-radius: 10px;
        --pagination-button-size: 40px;
        --transition-speed: 0.4s;
    }

    .pagination .gallery-navigation-container {
        display: flex;
        justify-content: center;
        align-items: center;
        max-width: 1200px;
        margin: auto;
        padding: 20px 0;
        gap: 0.5rem;
    }

    .pagination .gallery-button {
        text-decoration: none;
        display: inline-block;
        padding: var(--button-padding);
        background: var(--button-gradient);
        color: var(--button-text-color);
        border-radius: var(--button-border-radius);
        transition: background var(--transition-speed) ease, transform var(--transition-speed) ease, box-shadow var(--transition-speed) ease;
        box-shadow: 0 8px 16px var(--shadow-color);
        font-size: 18px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        text-align: center;
        border: none;
    }

    .pagination .gallery-button:hover {
        background: var(--button-hover-gradient);
        transform: translateY(-5px) scale(1.05);
        box-shadow: 0 12px 24px var(--hover-shadow-color);
    }

    .pagination .gallery-pagination {
        display: flex;
        gap: 0.2rem;
    }

    .pagination .gallery-pagination-button {
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: var(--pagination-button-size);
        height: var(--pagination-button-size);
        background: var(--button-gradient);
        color: var(--button-text-color);
        border-radius: var(--pagination-button-radius);
        transition: background var(--transition-speed) ease, transform var(--transition-speed) ease, box-shadow var(--transition-speed) ease;
        box-shadow: 0 4px 8px var(--shadow-color);
        font-size: 16px;
        font-weight: 600;
    }

    .pagination .gallery-pagination-button:hover {
        background: var(--button-hover-gradient);
        transform: translateY(-3px);
        box-shadow: 0 8px 16px var(--hover-shadow-color);
    }

    @media screen and (max-width: 768px) {
        .gallery-button {
            font-size: 16px;
            padding: 10px 20px;
        }
        .gallery-pagination-button {
            width: 25px;
            height: 30px;
            font-size: 14px;
        }
    }

    @media screen and (max-width: 480px) {
        .gallery-button {
            font-size: 14px;
            padding: 8px 16px;
        }
        .gallery-pagination-button {
            width: 20px;
            height: 25px;
            font-size: 12px;
        }
    }

</style>
