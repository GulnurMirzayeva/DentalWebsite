<section class="blog-section">
    <div class="main-container">
        <div class="content-wrapper">
            <div class="main-content">
                <h2 class="article-title">{{ $blog->title }}</h2>
                <p class="article-paragraph">{{ $blog->description_one }}</p>
                <p class="article-image-container">
                    <img src="{{ asset('storage/' . $blog->image_one) }}" alt="{{ $blog->title }}"
                         class="article-image">
                </p>

                <p class="article-paragraph">{{ $blog->description_two }}</p>
                <p class="article-image-container">
                    @if($blog->image_two)
                        <img src="{{ asset('storage/' . $blog->image_two) }}" alt="{{ $blog->title }}"
                             class="article-image">
                    @endif
                </p>


                <div class="comments-section">
                    <h3 class="comments-title">{{ $blog->blog_comments->count() }} {{ __('comment') }}</h3>
                    <ul class="comment-list">
                        @foreach($blog_comments as $blog_comment)
                            <li class="comment-item">
                                <div class="comment-content">
                                    <h3 class="commenter-name">{{ $blog_comment->name }}</h3>
                                    <div class="comment-meta">{{ $blog_comment->created_at->format('F d, Y') }}
                                        at {{ $blog_comment->created_at->format('h:i A') }}</div>
                                    <p class="comment-text">{{ $blog_comment->comment }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    <div class="comment-form-container">
                        <h3 class="comment-form-title">{{ __('comments-add') }}</h3>
                        <form action="{{ route('comment.store', $blog->id) }}" method="POST" class="comment-form">
                            @csrf
                            <div class="form-group">
                                <label for="name" class="form-label">{{ __('name') }} *</label>
                                <input type="text" class="form-input" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label">Email *</label>
                                <input type="email" class="form-input" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="message" class="form-label">{{ __('message') }}</label>
                                <textarea id="message" name="comment" cols="30" rows="10" class="form-textarea"
                                          required></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="{{ __('send-comment') }}" class="submit-button">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="sidebar">
                <div class="recent-blog-box">
                    <h3 class="sidebar-title">{{ __('last-blog') }}</h3>
                    @foreach($recentBlogs as $recentBlog)
                        <div class="recent-blog-item">
                            <a href="{{ route('blog.show', $recentBlog->slug) }}" class="recent-blog-image"
                               style="background-image: url( {{ asset('storage/' . $recentBlog->image_one) }} );"></a>
                            <div class="recent-blog-content">
                                <h3 class="recent-blog-title"><a
                                        href="{{ route('blog.show', $recentBlog->slug) }}">{{ Str::limit($recentBlog->title, 30) }}</a>
                                </h3>
                                <div class="recent-blog-meta">
                                    <div><a href="#"><span
                                                class="meta-icon calendar"></span> {{ $recentBlog->created_at->format('M. d, Y') }}
                                        </a></div>
                                    <div><a href="#"><span
                                                class="meta-icon chat"></span> {{ $recentBlog->blog_comments->count() }}
                                            {{ __('comment') }}</a></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

