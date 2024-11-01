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

    .gallery-grid-container {
        padding: var(--grid-gap);
        display: grid;
        gap: var(--grid-gap);
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        grid-auto-rows: 150px;
        max-width: 1200px;
        margin: 50px auto;
        counter-reset: gridCounter;
    }

    .gallery-grid-item {
        position: relative;
        background: var(--background-color);
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: var(--item-border-radius);
        box-shadow: 0 4px 8px var(--shadow-color);
        transition: transform var(--transition-speed) ease, box-shadow var(--transition-speed) ease;
        overflow: hidden;
        opacity: 0;
        transform: scale(0.95);
        animation: galleryFadeInUp 0.5s forwards;
    }

    .gallery-grid-item::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.1);
        transition: background var(--transition-speed) ease;
        pointer-events: none;
    }

    .gallery-grid-item:hover {
        transform: translateY(-10px) scale(1.05);
        box-shadow: 0 6px 12px var(--hover-shadow-color);
        background: rgba(0, 0, 0, 0.0);
    }

    .gallery-grid-item--medium,
    .gallery-grid-item--large {
        grid-row: span 2;
        grid-column: span 2;
    }

    .gallery-grid-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: var(--item-border-radius);
    }

    @media screen and (min-width: 40em) {
        .gallery-grid-container {
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            grid-auto-rows: 200px;
        }
    }

    @media screen and (min-width: 64em) {
        .gallery-grid-container {
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            grid-auto-rows: 250px;
        }
    }

    @keyframes galleryFadeInUp {
        0% {
            opacity: 0;
            transform: translateY(20px) scale(0.95);
        }
        100% {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .gallery-navigation-container {
        display: flex;
        justify-content: center;
        align-items: center;
        max-width: 1200px;
        margin: 30px auto;
        padding: 20px 0;
        gap: 0.5rem;
    }

    .gallery-button {
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

    .gallery-button:hover {
        background: var(--button-hover-gradient);
        transform: translateY(-5px) scale(1.05);
        box-shadow: 0 12px 24px var(--hover-shadow-color);
    }

    .gallery-pagination {
        display: flex;
        gap: 0.2rem;
    }

    .gallery-pagination-button {
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

    .gallery-pagination-button:hover {
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

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const gridItems = document.querySelectorAll('.gallery-grid-item');
        gridItems.forEach((item, index) => {
            setTimeout(() => {
                item.style.opacity = '1';
            }, index * 100);
        });
    });
</script>

<div class="gallery-grid-container">
    @foreach ($images as $image)
        <div class="gallery-grid-item {{ $loop->index % 3 == 0 ? 'gallery-grid-item--large' : ($loop->index % 6 == 0 ? 'gallery-grid-item--medium' : '') }}">
            <img src="{{ asset($image->image) }}" alt="{{ $image->alt_text }}" class="gallery-grid-image">
        </div>
    @endforeach
</div>

<div class="gallery-navigation-container">
    @if ($images->onFirstPage())
        <span class="gallery-button gallery-button--previous disabled">&#8249; {{ __('prev') }}</span>
    @else
        <a href="{{ $images->previousPageUrl() }}" class="gallery-button gallery-button--previous">&#8249; {{ __('prev') }}</a>
    @endif

    <div class="gallery-pagination">
        @foreach ($images->getUrlRange(1, $images->lastPage()) as $page => $url)
            @if ($page == $images->currentPage())
                <span class="gallery-pagination-button active" aria-current="page">{{ $page }}</span>
            @else
                <a href="{{ $url }}" class="gallery-pagination-button">{{ $page }}</a>
            @endif
        @endforeach
    </div>

    @if ($images->hasMorePages())
        <a href="{{ $images->nextPageUrl() }}" class="gallery-button gallery-button--next">{{ __('next') }} &#8250;</a>
    @else
        <span class="gallery-button gallery-button--next disabled">{{ __('next') }} &#8250;</span>
    @endif
</div>
