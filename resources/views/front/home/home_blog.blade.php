<div class="our_offer">
    <h1>{{ __('blog-title') }}</h1>
    <p style="width: 70%; margin: auto; margin-bottom: 40px">{{ __('blog-paragraph') }}</p>
</div>
<div class="blog-cards">
    @foreach($blogs as $blog)
        @if($blog->slug)
            <div class="blog-card">
                <a href="{{ route('blog.show', $blog->slug) }}">
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
        @endif
    @endforeach
</div>
