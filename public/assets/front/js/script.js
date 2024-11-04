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

    mobileAppointmentBtn.addEventListener('click', function (e) {
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
document.addEventListener('DOMContentLoaded', function () {
    var languageDropdown = document.querySelector('.dropdown-content');

    if (languageDropdown) languageDropdown.style.display = 'none';

    document.querySelector('.language i').addEventListener('click', function () {
        languageDropdown.style.display = languageDropdown.style.display === 'block' ? 'none' : 'block';
        this.classList.toggle('open');
    });

    window.addEventListener('click', function (event) {
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

window.onscroll = function () {
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
        backToTopButton.classList.add('show');
    } else {
        backToTopButton.classList.remove('show');
    }
};
backToTopButton.addEventListener('click', function (e) {
    e.preventDefault();
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});
// Arrow ends

// Date

document.addEventListener('DOMContentLoaded', function() {
    const overlay = document.getElementById('overlay');
    const appointmentModal = document.getElementById('appointment-form');
    const appointmentBtn = document.getElementById('appointment-btn');

    const forms = {
        main: {
            form: document.querySelector('.custom_appointment form'),
            timeInput: document.getElementById('time-picker-main'),
            dateInput: document.getElementById('date-picker-main')
        },
        modal: {
            form: document.getElementById('appointment-form').querySelector('form'),
            timeInput: document.getElementById('time-picker-appointment'),
            dateInput: document.getElementById('date-picker-appointment')
        }
    };

    let dateSelected = false;

    ["#date-picker-appointment", "#date-picker-main"].forEach(function(selector) {
        const dateInput = document.querySelector(selector);
        if (dateInput) {
            flatpickr(dateInput, {
                minDate: "today",
                dateFormat: "Y-m-d",
                disable: [
                    function(date) {
                        return date.getDay() === 0;
                    }
                ],
                onChange: function(selectedDates, dateStr, instance) {
                    dateSelected = !!selectedDates.length;
                    updateAvailableTimes(dateStr);
                    toggleTimePickers(dateSelected);

                    // Automatically adjust the time input to the beginning of the valid time range
                    if (dateSelected) {
                        const timeInput = selector.includes('main') ?
                            document.getElementById('time-picker-main') :
                            document.getElementById('time-picker-appointment');

                        const minTime = getMinTimeForDate(dateStr);
                        timeInput.value = minTime;
                    }
                }
            });
        }
    });

    function getMinTimeForDate(dateStr) {
        const selectedDate = new Date(dateStr);
        const dateOfMonth = selectedDate.getDate();

        // Determine the beginning hour based on the date
        if (dateOfMonth % 2 === 0) {
            return "15:00"; // Beginning of working hours for even days
        } else {
            return "09:00"; // Beginning of working hours for odd days
        }
    }

    function updateAvailableTimes(dateStr) {
        const selectedDate = new Date(dateStr);
        const dayOfWeek = selectedDate.getDay();
        const dateOfMonth = selectedDate.getDate();
        let minTime, maxTime;

        if (dayOfWeek === 0) {
            toggleTimePickers(false);
            return;
        }

        if (dateOfMonth % 2 === 0) {
            minTime = "15:00";
            maxTime = "19:30";
        } else {
            minTime = "09:00";
            maxTime = "14:00";
        }

        ["#time-picker-appointment", "#time-picker-main"].forEach(function(selector) {
            const timeInput = document.querySelector(selector);
            if (timeInput) {
                if (timeInput._flatpickr) {
                    timeInput._flatpickr.destroy();
                }

                flatpickr(timeInput, {
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: "H:i",
                    time_24hr: true,
                    minTime: minTime,
                    maxTime: maxTime,
                    minuteIncrement: 30,
                    disableMobile: true,
                    onChange: async function(selectedDates, timeStr, instance) {
                        const dateInput = timeInput.id.includes('main') ?
                            document.getElementById('date-picker-main') :
                            document.getElementById('date-picker-appointment');

                        if (dateInput.value && timeStr) {
                            const isTaken = await checkTimeAvailability(dateInput.value, timeStr);
                            if (isTaken) {
                                timeInput.style.borderColor = '#ff4444';
                                timeInput.setCustomValidity('This time slot is already taken. Please select another time.');
                            } else {
                                timeInput.style.borderColor = '';
                                timeInput.setCustomValidity('');
                            }
                            timeInput.reportValidity();
                        }
                    }
                });

                // Add minute rounding logic
                timeInput.addEventListener('input', function() {
                    const [hour, minute] = timeInput.value.split(':').map(Number);
                    let adjustedHour = hour;
                    let adjustedMinute = minute;

                    if (minute >= 1 && minute <= 29) {
                        adjustedMinute = 30;
                    } else if (minute >= 31 && minute <= 59) {
                        adjustedMinute = 0;
                        adjustedHour = (hour + 1) % 24; // Wrap around to 00 if hour exceeds 23
                    }

                    timeInput.value = `${String(adjustedHour).padStart(2, '0')}:${String(adjustedMinute).padStart(2, '0')}`;
                });
            }
        });

        toggleTimePickers(true);
    }

    function toggleTimePickers(enabled) {
        ["#time-picker-appointment", "#time-picker-main"].forEach(function(selector) {
            const timeInput = document.querySelector(selector);
            if (timeInput) {
                timeInput.disabled = !enabled;
            }
        });
    }

    function openModal() {
        overlay.classList.remove('hidden');
        appointmentModal.classList.remove('hidden');
    }

    function closeModal() {
        overlay.classList.add('hidden');
        appointmentModal.classList.add('hidden');
    }

    if (appointmentBtn) {
        appointmentBtn.addEventListener('click', openModal);
    }

    if (overlay) {
        overlay.addEventListener('click', closeModal);
    }

    async function checkTimeAvailability(date, time) {
        try {
            const response = await fetch('/check-time-availability', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ date, time })
            });

            const data = await response.json();
            return data.taken;
        } catch (error) {
            console.error('Error checking time availability:', error);
            return false;
        }
    }

    function setupForm(formElements) {
        const { form, timeInput, dateInput } = formElements;

        if (!form) return;

        form.addEventListener('submit', async function(e) {
            e.preventDefault();

            const date = dateInput.value;
            const time = timeInput.value;

            if (date && time) {
                const isTaken = await checkTimeAvailability(date, time);
                if (isTaken) {
                    timeInput.style.borderColor = '#ff4444';
                    alert('This time slot is no longer available. Please select another time.');
                    return;
                }
            }

            const formData = new FormData(form);
            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(Object.fromEntries(formData))
                });

                const data = await response.json();

                if (response.ok) {
                    alert(data.message);
                    form.reset();
                    if (appointmentModal && !appointmentModal.classList.contains('hidden')) {
                        closeModal();
                    }
                } else {
                    alert(data.message || 'An error occurred. Please try again.');
                }
            } catch (error) {
                console.error('Error submitting form:', error);
                alert('An error occurred. Please try again.');
            }
        });
    }

    setupForm(forms.main);
    setupForm(forms.modal);

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !appointmentModal.classList.contains('hidden')) {
            closeModal();
        }
    });

    appointmentModal.addEventListener('click', function(e) {
        e.stopPropagation();
    });

    toggleTimePickers(false);
});
