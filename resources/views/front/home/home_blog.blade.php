<div class="our_offer">
    <h1>Diş Sağlamlığı haqqında Ən Son Məsləhətlər və Yeniliklər</h1>
    <p>Bloqumuzu ziyarət edin və diş sağlamlığınızı qorumaq üçün faydalı məsləhətlər, müasir stomatoloji trendləri <br> və estetik gülüş yaratma yollarını öyrənin! Daim yenilənən yazılarımızla sağlam gülüşə bir addım daha yaxın olun.</p>
</div>
<div class="blog-cards">
    @foreach($blogs as $blog)
    <div class="blog-card">
        <a href="{{ route('blog.show', $blog->slug) }}">
            <img src="{{ asset('storage/' . $blog->image_one) }}" alt="{{ $blog->title }}">
        </a>
        <div class="blog-card-content">
            <div class="blog-card-meta">
                <span class="date"><i class="far fa-calendar-alt"></i> {{ $blog->date }}</span>
                <span class="comments-count"><i class="far fa-comments"></i> {{ $blog->comments_count }} şərh</span>
            </div>
            <div class="blog-card-text">
                <a href="{{ route('blog.show', $blog->slug) }}">
                    <h3 class="blog-card-title">{{ $blog->title }}</h3>
                </a>
                <p class="blog-card-description">{{ $blog->description_one }}</p>
                <a href="{{ route('blog.show', $blog->slug) }}" class="read-more">Read more</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
