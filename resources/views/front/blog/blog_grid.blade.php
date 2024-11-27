<div class="blog-cards-2">
    @foreach($blogs as $blog)
        <div class="blog-card">
            <a href="{{ route('blog.show', optional($blog)->slug) }}">
                <img src="{{ asset('storage/' . $blog->image_one) }}" alt="{{ $blog->title }}">
            </a>
            <div class="blog-card-content">
                <div class="blog-card-meta">
                    <span class="date"><i class="far fa-calendar-alt"></i> {{ $blog->date }}</span>
                    <span class="comments-count"><i class="far fa-comments"></i> {{ $blog->comments_count }} {{ __('comment') }}</span>
                </div>
                <div class="blog-card-text">
                    <a href="{{ route('blog.show', $blog->slug) }}">
                        <h3 class="blog-card-title">{{ $blog->title }}</h3>
                    </a>
                    <p class="blog-card-description">{{ $blog->description_one }}</p>
                    <a href="{{ route('blog.show', $blog->slug) }}" class="read-more">{{ __('read-more') }}</a>
                </div>
            </div>
        </div>
    @endforeach
</div>

{{-- Pagination bölməsi yalnız 6-dan çox blog varsa görünəcək --}}
@if($blogs instanceof \Illuminate\Pagination\LengthAwarePaginator && $blogs->total() > 6)
    <div class="gallery-navigation-container">
        @if ($blogs->onFirstPage())
            <span class="gallery-button gallery-button--previous disabled">&#8249; {{ __('prev') }}</span>
        @else
            <a href="{{ $blogs->previousPageUrl() }}" class="gallery-button gallery-button--previous">&#8249; {{ __('prev') }}</a>
        @endif

        <div class="gallery-pagination">
            @foreach ($blogs->getUrlRange(1, $blogs->lastPage()) as $page => $url)
                @if ($page == $blogs->currentPage())
                    <span class="gallery-pagination-button active" aria-current="page">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" class="gallery-pagination-button">{{ $page }}</a>
                @endif
            @endforeach
        </div>

        @if ($blogs->hasMorePages())
            <a href="{{ $blogs->nextPageUrl() }}" class="gallery-button gallery-button--next">{{ __('next') }} &#8250;</a>
        @else
            <span class="gallery-button gallery-button--next disabled">{{ __('next') }} &#8250;</span>
        @endif
    </div>
@endif




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


