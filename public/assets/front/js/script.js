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

    // Existing hamburger menu code
    hamburgerIcon.addEventListener('click', function () {
        offcanvas.classList.add('active');
        navContent.classList.add('offcanvas-active');
    });

    closeBtn.addEventListener('click', function () {
        offcanvas.classList.remove('active');
        navContent.classList.remove('offcanvas-active');
    });

    // New code for mobile appointment button
    mobileAppointmentBtn.addEventListener('click', function(e) {
        e.preventDefault();
        // Close the mobile menu
        offcanvas.classList.remove('active');
        navContent.classList.remove('offcanvas-active');

        // Open your appointment form here
        // Assuming you have code to show the appointment form
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


// Date Picker and Flatpickr Time JS
function initializeAppointmentPickers() {
    const appointmentPicker = new easepick.create({
        element: document.getElementById('date-picker-appointment'),
        css: [
            'https://cdn.jsdelivr.net/npm/@easepick/bundle@1.2.1/dist/index.css'
        ],
        format: 'YYYY-MM-DD',
        lang: 'en-US',
        zIndex: 10
    });

    flatpickr("#time-picker-appointment", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true,
        minuteIncrement: 15
    });
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


// Chatbot

$(document).ready(function () {
    let questionCount = {};
    let totalQuestionCount = 0;
    let whatsappIconAdded = false;
    let questionsClickable = true;

    $('#chatbot-icon').click(function (e) {
        e.stopPropagation();
        $('#chatbot-container').toggleClass('show');
        $(this).toggleClass('active');
        if ($('#chatbot-container').hasClass('show')) {
            $('#chatbot-container').css({
                'visibility': 'visible',
                'opacity': 1,
                'transform': 'translateX(0)',
            });
        } else {
            $('#chatbot-container').css({
                'opacity': 0,
                'transform': 'translateX(100%)',
                'visibility': 'hidden',
            });
        }
    });

    $(document).click(function (e) {
        if (!$(e.target).closest('#chatbot-container').length && !$(e.target).is('#chatbot-icon')) {
            $('#chatbot-container').hide();
        }
    });

    $(document).on('click', '.question', function (e) {
        if (!questionsClickable) return;

        e.stopPropagation();

        const questionText = $(this).text();
        const answer = $(this).data('answer');
        const nextGroup = $(this).data('next');

        if (!questionCount[questionText]) {
            questionCount[questionText] = 0;
        }
        questionCount[questionText]++;
        totalQuestionCount++;

        if (questionCount[questionText] === 3) {
            $('#chat-response-inside').append('<p class="answer">Zəhmət olmasa klinikamızla əlaqə saxlayın.</p>');
            questionCount[questionText] = 0;
            return;
        }


        $('#chat-response-inside').append('<p class="answer">' + answer + '</p>');

        $('#chat-response-inside').scrollTop($('#chat-response-inside')[0].scrollHeight);

        if (nextGroup && questionGroups[nextGroup]) {
            questionGroups[nextGroup].forEach(subQuestion => {
                $('#chat-response-inside').append('<p class="next-question" data-answer="' + subQuestion.answer + '">' + subQuestion.question + '</p>');
            });
        }

        if (totalQuestionCount >= 9 && !whatsappIconAdded) {
            $('#chat-response-inside').append(`
                <p class="answer">Zəhmət olmasa WhatsApp ilə əlaqə saxlayın.</p>
                <div id="whatsapp-icon" style="position:fixed; bottom:20px; right:20px; width:50px; height:50px; background-color:#25d366; color:white; border-radius:50%; display:flex; align-items:center; justify-content:center; cursor:pointer; z-index:10000; box-shadow:0 2px 10px rgba(0,0,0,0.2);">
                    <i class="fab fa-whatsapp" style="font-size:30px;"></i>
                </div>
            `);
            whatsappIconAdded = true;
            questionsClickable = false;
        }

        $('#chat-response-inside').scrollTop($('#chat-response-inside')[0].scrollHeight);
    });

    $(document).on('click', '#whatsapp-icon', function () {
        const phoneNumber = '994776154585';
        const message = encodeURIComponent('Salam, suallarınızı cavabladım. Zəhmət olmasa mənimlə əlaqə saxlayın.');
        const whatsappUrl = `https://wa.me/${phoneNumber}?text=${message}`;
        window.open(whatsappUrl, '_blank');
    });

    $(document).on('click', '.next-question', function (e) {
        if (!questionsClickable) return;

        e.stopPropagation();

        const subQuestionText = $(this).text();
        const answer = $(this).data('answer');

        $('#chat-response-inside').append('<p class="answer">' + answer + '</p>');

        $('#chat-response-inside').scrollTop($('#chat-response-inside')[0].scrollHeight);
    });

    const questionGroups = {
        group1: [
            {
                question: "Klinikanızda istirahət günü varmı?",
                answer: "Bəli, klinikamız bazar günü bağlıdır.",
                nextGroup: 'group1_1'
            },
            {
                question: "Klinika təcili hallarda işləyirmi?",
                answer: "Bəli, təcili hallar üçün xüsusi xidmətimiz var.",
                nextGroup: 'group1_2'
            },
        ],
        group2: [
            {
                question: "Diş təmizlənməsi ağrılıdırmı?",
                answer: "Diş təmizlənməsi adətən ağrısız olur, lakin bəzi hallarda narahatlıq yarana bilər.",
                nextGroup: 'group2_1'
            },
            {
                question: "Neçə müddətdən bir diş təmizlənməsinə gəlmək lazımdır?",
                answer: "Hər 6 aydan bir diş təmizlənməsi tövsiyə olunur.",
                nextGroup: 'group2_2'
            },
        ],
        group3: [
            {
                question: "Ortodontik müalicə təklif edirsinizmi?",
                answer: "Bəli, biz ortodontik müalicə də təklif edirik.",
                nextGroup: 'group3_1'
            },
            {
                question: "Uşaqlar üçün diş müayinəsi xidmətiniz varmı?",
                answer: "Bəli, uşaqlar üçün xüsusi müayinə və müalicə xidmətimiz mövcuddur.",
                nextGroup: 'group3_2'
            },
        ],
        group4: [
            {
                question: "Steril avadanlıqlardan istifadə edirsinizmi?",
                answer: "Bəli, bütün avadanlıqlarımız tam steril və təhlükəsizdir.",
                nextGroup: 'group4_1'
            },
            {
                question: "Klinikada hansı texnologiyalardan istifadə olunur?",
                answer: "Biz lazer texnologiyası və digər müasir avadanlıqlardan istifadə edirik.",
                nextGroup: 'group4_2'
            },
        ],
        group5: [
            {
                question: "Onlayn qeydiyyatdan keçmək mümkündürmü?",
                answer: "Bəli, vebsaytımızdan onlayn qeydiyyat mümkündür.",
                nextGroup: 'group5_1'
            },
            {
                question: "Telefonla müayinə sifariş edə bilərəmmi?",
                answer: "Bəli, klinikamızın telefon nömrəsinə zəng edərək sifariş verə bilərsiniz.",
                nextGroup: 'group5_2'
            },
        ],
        group6: [
            {
                question: "Diş implantları nə qədər müddətə yerinə yetirilir?",
                answer: "Diş implantı adətən 2-3 mərhələdə tamamlanır və bu proses bir neçə ay çəkə bilər.",
                nextGroup: 'group6_1'
            },
            {
                question: "Diş implantlarına necə qulluq etmək lazımdır?",
                answer: "Diş implantlarına adi dişlər kimi diqqətli qulluq edilməlidir, yəni gündəlik fırçalama və diş ipi istifadəsi vacibdir.",
                nextGroup: 'group6_2'
            },
        ],
        group7: [
            {
                question: "Diş ağartma təhlükəsizdirmi?",
                answer: "Bəli, klinikamızda tətbiq olunan diş ağartma prosedurları tamamilə təhlükəsizdir.",
                nextGroup: 'group7_1'
            },
            {
                question: "Diş ağartma nəticələri nə qədər davamlıdır?",
                answer: "Diş ağartma nəticələri düzgün qulluq olduqda 1 ilə qədər davam edə bilər.",
                nextGroup: 'group7_2'
            },
        ],
        group8: [
            {
                question: "Diş dolğusu üçün nə qədər vaxt tələb olunur?",
                answer: "Diş dolğusu adətən 30-60 dəqiqə arasında tamamlanır.",
                nextGroup: 'group8_1'
            },
            {
                question: "Diş müalicəsi zamanı ağrı hiss olunurmu?",
                answer: "Diş müalicəsi zamanı lokal anesteziya istifadə edildiyi üçün ağrı hiss olunmur.",
                nextGroup: 'group8_2'
            },
        ],
        group9: [
            {
                question: "Klinikanızda hansı müayinə xidmətləri var?",
                answer: "Biz müayinələr, diaqnostikalar və müalicə xidmətləri təklif edirik.",
                nextGroup: 'group9_1'
            },
            {
                question: "Hansı diş müalicələri təklif edirsiniz?",
                answer: "Biz diş ağrıları, çürük müalicəsi və estetik müalicələr təklif edirik.",
                nextGroup: 'group9_2'
            },
        ],
    };
});



// ox

// script.js

// Yuxarıya qalxma ikonu
const backToTopButton = document.getElementById('backToTop');

// Scroll hadisəsini izləyin
window.onscroll = function() {
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
        backToTopButton.classList.add('show'); // İkonu göstərin
    } else {
        backToTopButton.classList.remove('show'); // İkonu gizlədin
    }
};
// arrow icon

backToTopButton.addEventListener('click', function(e) {
    e.preventDefault();
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});
// arrow icon end











