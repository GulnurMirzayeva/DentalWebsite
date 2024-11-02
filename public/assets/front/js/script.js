// Navbar JS
window.addEventListener("scroll", function () {
    var navbar = document.querySelector(".nav-content");
    var headerHeight = 440;

    if (window.scrollY > headerHeight) {
        navbar.classList.add("scrolled");
    } else {
        navbar.classList.remove("scrolled");
    }
});


const hamburgerIcon = document.querySelector('.hamburger-icon');
const navList = document.querySelector('.nav-list-elements');

hamburgerIcon.addEventListener('click', () => {
    navList.classList.toggle('active');
});


document.addEventListener('DOMContentLoaded', function () {
    const hamburgerIcon = document.querySelector('.hamburger-icon');
    const closeBtn = document.querySelector('.btn-close');
    const offcanvas = document.getElementById('navOffcanvas');
    const navContent = document.querySelector('.nav-content');
    const appointmentBtn = document.getElementById('nav-appointment-btn');
    const mobileAppointmentBtn = document.querySelector('#navOffcanvas .appointment-btn');

    hamburgerIcon.addEventListener('click', function () {
        offcanvas.classList.add('active');
        navContent.classList.add('offcanvas-active');
    });

    closeBtn.addEventListener('click', function () {
        offcanvas.classList.remove('active');
        navContent.classList.remove('offcanvas-active');
    });

    mobileAppointmentBtn.addEventListener('click', function(e) {
        e.preventDefault();
        offcanvas.classList.remove('active');
        navContent.classList.remove('offcanvas-active');


        const appointmentForm = document.getElementById('appointment-form');
        const overlay = document.getElementById('overlay');
        if (appointmentForm && overlay) {
            appointmentForm.classList.remove('hidden');
            overlay.classList.remove('hidden');
        }
    });
});


// Multilanguage Dropdown
document.addEventListener('DOMContentLoaded', function() {
    var languageDropdown = document.querySelector('.dropdown-content');

    if (languageDropdown) languageDropdown.style.display = 'none';

    document.querySelector('.language i').addEventListener('click', function() {
        languageDropdown.style.display = languageDropdown.style.display === 'block' ? 'none' : 'block';
        this.classList.toggle('open');
    });

    window.addEventListener('click', function(event) {
        if (!event.target.closest('.language')) {
            if (languageDropdown.style.display === 'block') {
                languageDropdown.style.display = 'none';
                document.querySelector('.language i').classList.remove('open');
            }
        }
    });
});


// Missions-goals JS
function showContent(sectionId) {
    const sections = document.getElementsByClassName('content-section');
    for (let section of sections) {
        section.classList.add('hidden');
        section.classList.remove('fade-in');
    }
    const activeSection = document.getElementById(sectionId);
    activeSection.classList.remove('hidden');
    setTimeout(() => {
        activeSection.classList.add('fade-in');
    }, 1);

    const buttons = document.getElementsByClassName('content-button');
    for (let button of buttons) {
        button.classList.remove('active');
    }
    event.target.classList.add('active');
}


// Testimonial JS
document.addEventListener('DOMContentLoaded', function () {
    const testimonialsSlider = document.getElementById('slider');

    if (!testimonialsSlider) {
        console.warn('Testimonials slider not found on this page.');
        return;
    }

    const dotsContainer = document.getElementById('dots-container');
    let testimonialsSlides = [];
    let testimonialsDots = [];
    let testimonialsCurrentIndex = 0;
    let startX, moveX;
    let isMoving = false;

    const cardContents = ['Card 1', 'Card 2', 'Card 3', 'Card 4', 'Card 5'];
    const totalSlides = cardContents.length;

    function createSlides() {
        for (let i = 0; i < totalSlides * 3; i++) {
            const slide = document.createElement('div');
            slide.className = 'slide';
            slide.textContent = cardContents[i % totalSlides];
            testimonialsSlider.appendChild(slide);
        }
        testimonialsSlides = document.querySelectorAll('.slide');
    }

    function createDots() {
        for (let i = 0; i < totalSlides; i++) {
            const dot = document.createElement('div');
            dot.className = 'dot';
            dot.onclick = () => moveToTestimonialsSlide(i);
            dotsContainer.appendChild(dot);
        }
        testimonialsDots = document.querySelectorAll('.dot');
    }

    function getSlideWidth() {
        if (window.innerWidth <= 768) {
            return testimonialsSlider.clientWidth;
        }
        return testimonialsSlider.clientWidth / 3;
    }

    function updateSlider() {
        const slideWidth = getSlideWidth();
        const offset = window.innerWidth > 768 ? slideWidth : 0;
        testimonialsSlider.style.transform = `translateX(-${(testimonialsCurrentIndex + totalSlides) * slideWidth - offset}px)`;
        updateDots();
    }

    function updateDots() {
        const activeDotIndex = mod(testimonialsCurrentIndex, totalSlides);
        testimonialsDots.forEach((dot, index) => {
            dot.classList.toggle('active', index === activeDotIndex);
        });
    }

    function moveToTestimonialsSlide(index) {
        testimonialsCurrentIndex = index;
        updateSlider();
    }

    function mod(n, m) {
        return ((n % m) + m) % m;
    }

    function checkTestimonialsBoundary() {
        const slideLimit = totalSlides - 1;
        if (testimonialsCurrentIndex < 0) {
            testimonialsCurrentIndex = slideLimit;
            updateSlider();
        } else if (testimonialsCurrentIndex > slideLimit) {
            testimonialsCurrentIndex = 0;
            updateSlider();
        }
    }

    testimonialsSlider.addEventListener('mousedown', (e) => {
        startX = e.clientX;
        isMoving = true;
        testimonialsSlider.style.transition = 'none';
        e.preventDefault();
    });

    testimonialsSlider.addEventListener('mousemove', (e) => {
        if (!isMoving) return;
        moveX = e.clientX - startX;
        const slideWidth = getSlideWidth();
        const offset = window.innerWidth > 768 ? slideWidth : 0;
        testimonialsSlider.style.transform = `translateX(calc(-${(testimonialsCurrentIndex + totalSlides) * slideWidth - offset}px + ${moveX}px))`;
    });

    testimonialsSlider.addEventListener('mouseup', finishMovement);
    testimonialsSlider.addEventListener('mouseleave', finishMovement);

    function finishMovement() {
        if (!isMoving) return;
        isMoving = false;
        const slideWidth = getSlideWidth();
        if (Math.abs(moveX) > slideWidth / 3) {
            testimonialsCurrentIndex += moveX > 0 ? -1 : 1;
        }
        testimonialsSlider.style.transition = 'transform 0.3s ease-out';
        updateSlider();
        checkTestimonialsBoundary();
    }

    testimonialsSlider.addEventListener('touchstart', (e) => {
        startX = e.touches[0].clientX;
        isMoving = true;
        testimonialsSlider.style.transition = 'none';
    });

    testimonialsSlider.addEventListener('touchmove', (e) => {
        if (!isMoving) return;
        const touch = e.touches[0];
        moveX = touch.clientX - startX;
        const slideWidth = getSlideWidth();
        const offset = window.innerWidth > 768 ? slideWidth : 0;
        testimonialsSlider.style.transform = `translateX(calc(-${(testimonialsCurrentIndex + totalSlides) * slideWidth - offset}px + ${moveX}px))`;
        e.preventDefault();
    });

    testimonialsSlider.addEventListener('touchend', finishMovement);

    const autoSlideInterval = 3000;

    function startAutoSlide() {
        setInterval(() => {
            testimonialsCurrentIndex++;
            updateSlider();
            checkTestimonialsBoundary();
        }, autoSlideInterval);
    }

    window.addEventListener('resize', () => {
        updateSlider();
    });

    createSlides();
    createDots();
    updateSlider();
    startAutoSlide();
});


// Achievements JS
const startYear = 2005;
const currentYear = new Date().getFullYear();
const experience = currentYear - startYear;

const experienceElement = document.querySelector('.experience');

if (experienceElement) {
    experienceElement.innerText = experience;
} else {
    console.warn('Experience part not found here.');
}

document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('nav-appointment-btn').addEventListener('click', function () {
        document.getElementById('overlay').classList.remove('hidden');
        document.getElementById('appointment-form').classList.remove('hidden');

        initializeAppointmentPickers();
    });

    document.getElementById('appointment-btn').addEventListener('click', function () {
        document.getElementById('overlay').classList.remove('hidden');
        document.getElementById('appointment-form').classList.remove('hidden');

        initializeAppointmentPickers();
    });
});


// Slider JS
document.addEventListener('DOMContentLoaded', function () {
    const images = document.querySelectorAll('.slider-image');
    const prevButton = document.querySelector('.prev-slide');
    const nextButton = document.querySelector('.next-slide');
    const dots = document.querySelectorAll('.slider-controls button');
    let currentIndex = 0;
    const totalImages = images.length;

    if (!images) {
        console.warn('This function not found on this page.');
        return;
    }

    images[currentIndex].classList.add('active');
    dots[currentIndex].classList.add('active');

    function showSlide(index) {
        images.forEach(image => image.classList.remove('active'));
        dots.forEach(dot => dot.classList.remove('active'));
        images[index].classList.add('active');
        dots[index].classList.add('active');
    }

    function nextSlide() {
        currentIndex = (currentIndex + 1) % totalImages;
        showSlide(currentIndex);
    }

    function prevSlide() {
        currentIndex = (currentIndex - 1 + totalImages) % totalImages;
        showSlide(currentIndex);
    }

    dots.forEach((dot, index) => {
        dot.addEventListener('click', function () {
            currentIndex = index;
            showSlide(currentIndex);
        });
    });

    let slideInterval = setInterval(nextSlide, 5000);

    if (nextButton) {
        nextButton.addEventListener('click', function () {
            nextSlide();
            resetInterval();
        });
    }

    if (prevButton) {
        prevButton.addEventListener('click', function () {
            prevSlide();
            resetInterval();
        });
    }

    function resetInterval() {
        clearInterval(slideInterval);
        slideInterval = setInterval(nextSlide, 5000);
    }
});


// Appointment JS
document.addEventListener('DOMContentLoaded', function () {
    const sliderAppointmentBtn = document.getElementById('appointment-btn');
    const navAppointmentBtns = document.querySelectorAll('.appointment-btn');
    const overlay = document.getElementById('overlay');
    const appointmentForm = document.getElementById('appointment-form');


    function showAppointmentForm(event) {
        event.preventDefault();
        if (overlay && appointmentForm) {
            overlay.classList.remove('hidden');
            appointmentForm.classList.remove('hidden');
        } else {
            console.error('Overlay or appointment form not found');
        }
    }

    function hideAppointmentForm() {
        if (overlay && appointmentForm) {
            overlay.classList.add('hidden');
            appointmentForm.classList.add('hidden');
        }
    }

    navAppointmentBtns.forEach(btn => {
        btn.addEventListener('click', showAppointmentForm);
    });

    if (sliderAppointmentBtn) {
        sliderAppointmentBtn.addEventListener('click', showAppointmentForm);
    }

    if (overlay) {
        overlay.addEventListener('click', hideAppointmentForm);
    }

    const closeBtn = document.querySelector('.btn-close');
    if (closeBtn) {
        closeBtn.addEventListener('click', hideAppointmentForm);
    }
});


// Arrow starts
const backToTopButton = document.getElementById('backToTop');

window.onscroll = function() {
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
        backToTopButton.classList.add('show');
    } else {
        backToTopButton.classList.remove('show');
    }
};
backToTopButton.addEventListener('click', function(e) {
    e.preventDefault();
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});
// Arrow ends

// Date

document.addEventListener('DOMContentLoaded', function () {
    let dateSelected = false;

    // Initialize flatpickr for date pickers
    ["#date-picker-appointment", "#date-picker-main"].forEach(function (selector) {
        const dateInput = document.querySelector(selector);
        if (dateInput) {
            flatpickr(dateInput, {
                minDate: "today",
                dateFormat: "Y-m-d",
                onChange: function (selectedDates, dateStr, instance) {
                    dateSelected = !!selectedDates.length;
                    updateAvailableTimes(dateStr);
                    toggleTimePickers(dateSelected);
                }
            });
        }
    });

    function updateAvailableTimes(dateStr) {
        const currentTime = new Date();
        let minTime = "00:00";

        if (dateStr === currentTime.toISOString().split('T')[0]) { // If the selected date is today
            const currentHour = currentTime.getHours();
            const currentMinute = currentTime.getMinutes();
            minTime = `${String(currentHour).padStart(2, '0')}:${String(currentMinute).padStart(2, '0')}`;
        }

        ["#time-picker-appointment", "#time-picker-main"].forEach(function (selector) {
            const timeInput = document.querySelector(selector);
            if (timeInput) {
                // Clear any existing flatpickr instance
                if (timeInput._flatpickr) {
                    timeInput._flatpickr.destroy();
                }


                flatpickr(timeInput, {
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: "H:i",
                    time_24hr: true,
                    minTime: minTime,
                    minuteIncrement: 15,
                    disableMobile: true
                });

                // Clear the value if it's invalid
                if (timeInput.value) {
                    const [selectedHour, selectedMinute] = timeInput.value.split(':').map(Number);
                    const selectedDate = new Date();
                    selectedDate.setHours(selectedHour, selectedMinute, 0);

                    const minDate = new Date();
                    const [minHour, minMinute] = minTime.split(':').map(Number);
                    minDate.setHours(minHour, minMinute, 0);

                    if (selectedDate < minDate) {
                        timeInput.value = ''; // Clear the invalid time
                    }
                }
            }
        });
    }

    // Function to enable/disable time pickers
    function toggleTimePickers(enabled) {
        ["#time-picker-appointment", "#time-picker-main"].forEach(function (selector) {
            const timeInput = document.querySelector(selector);
            if (timeInput) {
                timeInput.disabled = !enabled;
            }
        });
    }

    // Initially disable time pickers
    toggleTimePickers(false);
});


// Date ends
