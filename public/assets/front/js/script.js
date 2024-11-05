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

document.addEventListener('DOMContentLoaded', function () {
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

    // Tarih seçiciyi yapılandır
    ["#date-picker-appointment", "#date-picker-main"].forEach(function (selector) {
        const dateInput = document.querySelector(selector);
        if (dateInput) {
            flatpickr(dateInput, {
                minDate: "today",
                dateFormat: "Y-m-d",
                disable: [
                    function (date) {
                        return date.getDay() === 0; // Pazar günlerini devre dışı bırak
                    }
                ],
                onChange: function (selectedDates, dateStr, instance) {
                    dateSelected = !!selectedDates.length;
                    updateAvailableTimes(dateStr);
                    toggleTimePickers(dateSelected);
                }
            });
        }
    });

    // Zaman seçeneklerini güncelle
    function updateAvailableTimes(dateStr) {
        const selectedDate = new Date(dateStr);
        const dayOfMonth = selectedDate.getDate();
        let startHour, endHour;

        if (dayOfMonth % 2 === 0) {
            startHour = 15; // 3 PM
            endHour = 19; // 7 PM
        } else {
            startHour = 9; // 9 AM
            endHour = 14; // 2 PM
        }

        const allSelectors = ["#time-picker-appointment", "#time-picker-main"];
        allSelectors.forEach(function (selector) {
            populateTimeOptions(selector, startHour, endHour, dateStr);
        });

        toggleTimePickers(true);
    }

    // Zaman seçeneklerini doldur
    function populateTimeOptions(selector, startHour, endHour, dateStr) {
        const selectElement = document.querySelector(selector);
        if (!selectElement) return;

        selectElement.innerHTML = ""; // Mevcut seçenekleri temizle

        const defaultOption = document.createElement('option');
        defaultOption.value = "";
        defaultOption.disabled = true;
        defaultOption.selected = true;
        defaultOption.textContent = "Saat Seçin";
        selectElement.appendChild(defaultOption);

        const today = new Date();
        const currentHour = today.getHours();
        const selectedDate = new Date(dateStr);

        // Saat seçeneklerini oluştur
        for (let hour = startHour; hour <= endHour; hour++) {
            // Bugünün geçmiş saatlerini tamamen atla
            if (selectedDate.toDateString() === today.toDateString() && hour <= currentHour) {
                continue; // Geçmiş saatleri atla
            }

            const hourString = formatHour(hour);
            const option = document.createElement('option');
            option.value = hourString;
            option.textContent = hourString;

            // Zaman dilimi dolu mu kontrol et
            checkTimeAvailability(dateStr, hourString, function (isTaken) {
                if (isTaken) {
                    option.style.color = "red"; // Uygun olmayan seçenekleri renklendir
                    option.textContent += " (Dolu)";
                    option.disabled = true; // Seçeneği devre dışı bırak
                }
                selectElement.appendChild(option);
            });
        }
    }


    function formatHour(hour) {
        return `${hour.toString().padStart(2, '0')}:00`;
    }

    function toggleTimePickers(enabled) {
        ["#time-picker-appointment", "#time-picker-main"].forEach(function (selector) {
            const timeInput = document.querySelector(selector);
            if (timeInput) {
                timeInput.disabled = !enabled;
            }
        });
    }

    // Zaman uygunluk kontrol fonksiyonu
    function checkTimeAvailability(date, time, callback) {
        $.ajax({
            url: '/check-time-availability',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                date: date,
                time: time
            },
            success: function (response) {
                callback(response.taken);
            },
            error: function (xhr, status, error) {
                console.error('Zaman uygunluk kontrolü hatası:', error);
                callback(false);
            }
        });
    }

    // Form gönderimi sırasında AJAX kullanarak rezervasyon yap
    function setupForm(formObj) {
        $(formObj.form).on('submit', function (e) {
            e.preventDefault(); // Sayfanın yeniden yüklenmesini engelle

            const formData = $(this).serialize();

            $.ajax({
                url: '/reservations',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                success: function (response) {
                    if (response.success) {
                        alert(response.message); // Başarı mesajını göster
                    } else {
                        alert('Bir hata oluştu. Lütfen tekrar deneyin.');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Rezervasyon hatası:', error);
                    alert('Bir hata oluştu. Lütfen tekrar deneyin.');
                }
            });
        });
    }

    setupForm(forms.main);
    setupForm(forms.modal);
});



// Date ends
