<div class="slider-carousel-section">
    <div class="slider-carousel-wrapper">
        <div class="slider-carousel-track">
            @foreach(App\Models\Gallery::orderBy('created_at', 'asc')->get() as $image)
                <img src="{{ asset($image->image) }}" alt="{{ $image->alt_text }}">
            @endforeach

            @foreach(App\Models\Gallery::orderBy('created_at', 'asc')->take(2)->get() as $image)
                <img src="{{ asset($image->image) }}" alt="{{ $image->alt_text }}">
            @endforeach
        </div>
        <button class="slider-carousel-arrow slider-carousel-arrow-left">&#10094;</button>
        <button class="slider-carousel-arrow slider-carousel-arrow-right">&#10095;</button>
    </div>
</div>

<script>
    const carouselTrack = document.querySelector('.slider-carousel-track');
    const totalImages = document.querySelectorAll('.slider-carousel-track img').length;
    let currentIndex = 0;
    let imagesVisible = 4;
    let slideInterval;

    function startAutoSlide() {
        slideInterval = setInterval(() => {
            slideCarouselRight();
        }, 7000);
    }

    function stopAutoSlide() {
        clearInterval(slideInterval);
    }

    function slideCarouselLeft() {
        stopAutoSlide();
        currentIndex--;
        if (currentIndex < 0) {
            currentIndex = totalImages - imagesVisible;
        }
        updateCarouselPosition();
        startAutoSlide();
    }

    function slideCarouselRight() {
        stopAutoSlide();
        currentIndex++;
        if (currentIndex >= totalImages - imagesVisible) {
            currentIndex = 0;
            carouselTrack.style.transition = 'none';
            updateCarouselPosition();
            setTimeout(() => {
                carouselTrack.style.transition = 'transform 0.6s ease-in-out';
            }, 20);
        } else {
            updateCarouselPosition();
        }
        startAutoSlide();
    }

    function updateCarouselPosition() {
        const offset = -(currentIndex * (100 / imagesVisible));
        carouselTrack.style.transform = `translateX(${offset}%)`;
    }

    function adjustVisibleImages() {
        const screenWidth = window.innerWidth;
        if (screenWidth <= 480) {
            imagesVisible = 1;
        } else if (screenWidth <= 767) {
            imagesVisible = 2;
        } else if (screenWidth <= 1024) {
            imagesVisible = 3;
        } else {
            imagesVisible = 4;
        }
        updateCarouselPosition();
    }

    document.querySelector('.slider-carousel-arrow-left').addEventListener('click', slideCarouselLeft);
    document.querySelector('.slider-carousel-arrow-right').addEventListener('click', slideCarouselRight);

    startAutoSlide();
    adjustVisibleImages();
    window.addEventListener('resize', adjustVisibleImages);
</script>
