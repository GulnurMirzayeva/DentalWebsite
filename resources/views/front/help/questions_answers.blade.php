<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('question-title') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('assets/front/img/favicon.jpg') }}" type="image/x-icon">
    <style>
        :root {
            --blue: #2f89fc;
            --white: #fff;
            --light: #f8f9fa;
            --teal: #2cbcbc;
            --cyan: #21aac4;
            --violet: rgba(93, 82, 186, 1);
            --light-gray: #cfd0d1;
            --dark: #343a40;
            --gray: #6c757d;
        }
        body {
            background: linear-gradient(to right, var(--violet), var(--cyan));
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Poppins', sans-serif;
            color: var(--white);
            overflow-y: auto;
        }
        .faq-container {
            background-color: var(--white);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            max-width: 600px;
            width: 100%;
            color: var(--dark);
        }
        .faq-container h2 {
            text-align: center;
            margin-bottom: 30px;
            color: var(--dark);
            font-family: 'Poppins', sans-serif;
        }
        .faq-item {
            margin-bottom: 20px;
        }
        .question {
            font-size: 18px;
            color: var(--blue);
            font-weight: 600;
            cursor: pointer;
            margin-bottom: 5px;
        }
        .question i {
            margin-left: 10px;
            transition: transform 0.3s ease;
        }
        .answer {
            font-size: 16px;
            color: var(--gray);
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
            padding: 0 10px;
            background-color: var(--light-gray);
            border-radius: 5px;
            margin-top: 5px;
        }
        .back-button {
            width: 100%;
            font-size: 16px;
            padding: 12px;
            border-radius: 5px;
            background-color: var(--blue);
            color: var(--white);
            border: none;
            cursor: pointer;
            margin-top: 20px;
        }
        .back-button:hover {
            background-color: var(--teal);
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
<div class="faq-container">
    <h2>{{ __('questions-answers') }}</h2>
    <div class="faq-item">
        <h3 class="question">{{ __('question1') }} <i class="fas fa-chevron-down"></i></h3>
        <p class="answer">{{ __('answer1') }}</p>
    </div>
    <div class="faq-item">
        <h3 class="question">{{ __('question2') }} <i class="fas fa-chevron-down"></i></h3>
        <p class="answer">{{ __('answer2') }}</p>
    </div>
    <div class="faq-item">
        <h3 class="question">{{ __('question3') }} <i class="fas fa-chevron-down"></i></h3>
        <p class="answer">{{ __('answer3') }}</p>
    </div>
    <div class="faq-item">
        <h3 class="question">{{ __('question4') }} <i class="fas fa-chevron-down"></i></h3>
        <p class="answer">{{ __('answer4') }}</p>
    </div>
    <div class="faq-item">
        <h3 class="question">{{ __('question5') }} <i class="fas fa-chevron-down"></i></h3>
        <p class="answer">{{ __('answer5') }}</p>
    </div>
    <div class="faq-item">
        <h3 class="question">{{ __('question6') }} <i class="fas fa-chevron-down"></i></h3>
        <p class="answer">{{ __('answer6') }}</p>
    </div>
    <div class="faq-item">
        <h3 class="question">{{ __('question7') }} <i class="fas fa-chevron-down"></i></h3>
        <p class="answer">{{ __('answer7') }}</p>
    </div>
    <div class="faq-item">
        <h3 class="question">{{ __('question8') }} <i class="fas fa-chevron-down"></i></h3>
        <p class="answer">{{ __('answer8') }}</p>
    </div>
    <div class="faq-item">
        <h3 class="question">{{ __('question9') }} <i class="fas fa-chevron-down"></i></h3>
        <p class="answer">{{ __('answer9') }}</p>
    </div>
    <button onclick="goBack()" class="back-button">{{ __('go-back') }}</button>
</div>

<script>
    const questions = document.querySelectorAll('.question');

    questions.forEach(question => {
        question.addEventListener('click', () => {
            const answer = question.nextElementSibling;
            const icon = question.querySelector('i');

            if (answer.style.maxHeight) {
                answer.style.maxHeight = null;
                icon.style.transform = 'rotate(0deg)';
            } else {
                answer.style.maxHeight = answer.scrollHeight + "px";
                icon.style.transform = 'rotate(180deg)';

                answer.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    function goBack() {
        window.history.back();
    }
</script>
</body>
</html>
