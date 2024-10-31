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
    let imagesVisible = 4; // Adjusted dynamically based on screen size
    let slideInterval;

    // Start auto sliding
    function startAutoSlide() {
        slideInterval = setInterval(() => {
            slideCarouselRight();
        }, 7000); // 7 seconds interval
    }

    // Stop auto sliding
    function stopAutoSlide() {
        clearInterval(slideInterval);
    }

    // Function to slide left
    function slideCarouselLeft() {
        stopAutoSlide();
        currentIndex--;
        if (currentIndex < 0) {
            currentIndex = totalImages - imagesVisible;
        }
        updateCarouselPosition();
        startAutoSlide(); // Restart timer after manual slide
    }

    // Function to slide right
    function slideCarouselRight() {
        stopAutoSlide();
        currentIndex++;
        if (currentIndex >= totalImages - imagesVisible) {
            currentIndex = 0; // Loop back to the first image after the duplicated set
            carouselTrack.style.transition = 'none'; // Remove transition for the reset
            updateCarouselPosition();
            setTimeout(() => {
                carouselTrack.style.transition = 'transform 0.6s ease-in-out'; // Reapply transition
            }, 20);
        } else {
            updateCarouselPosition();
        }
        startAutoSlide(); // Restart timer after manual slide
    }

    // Update the position of the carousel
    function updateCarouselPosition() {
        const offset = -(currentIndex * (100 / imagesVisible)); // Adjust dynamically
        carouselTrack.style.transform = `translateX(${offset}%)`;
    }

    // Adjust visible images based on screen size
    function adjustVisibleImages() {
        const screenWidth = window.innerWidth;
        if (screenWidth <= 480) {
            imagesVisible = 1; // 1 image on mobile
        } else if (screenWidth <= 767) {
            imagesVisible = 2; // 2 images on small tablets
        } else if (screenWidth <= 1024) {
            imagesVisible = 3; // 3 images on tablets
        } else {
            imagesVisible = 4; // 4 images on desktops
        }
        updateCarouselPosition();
    }

    // Add event listeners to the arrows
    document.querySelector('.slider-carousel-arrow-left').addEventListener('click', slideCarouselLeft);
    document.querySelector('.slider-carousel-arrow-right').addEventListener('click', slideCarouselRight);

    // Start auto-slide initially and adjust based on window size
    startAutoSlide();
    adjustVisibleImages();
    window.addEventListener('resize', adjustVisibleImages);
</script>
