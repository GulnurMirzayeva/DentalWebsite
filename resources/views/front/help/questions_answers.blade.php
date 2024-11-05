<!DOCTYPE html>
<html>
<head>
    <title>FAQ</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
<div class="page-wrapper">
    <div class="faq-container">
        <h2 class="faq-title">{{ __('questions-answers') }}</h2>

        <div class="faq-list">
            <div class="faq-item">
                <div class="question">
                    <h3>{{ __('question1') }}</h3>
                    <div class="icon">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
                <div class="answer">
                    <p>{{ __('answer1') }}</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="question">
                    <h3>{{ __('question2') }}</h3>
                    <div class="icon">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
                <div class="answer">
                    <p>{{ __('answer2') }}</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="question">
                    <h3>{{ __('question3') }}</h3>
                    <div class="icon">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
                <div class="answer">
                    <p>{{ __('answer3') }}</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="question">
                    <h3>{{ __('question4') }}</h3>
                    <div class="icon">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
                <div class="answer">
                    <p>{{ __('answer4') }}</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="question">
                    <h3>{{ __('question5') }}</h3>
                    <div class="icon">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
                <div class="answer">
                    <p>{{ __('answer5') }}</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="question">
                    <h3>{{ __('question6') }}</h3>
                    <div class="icon">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
                <div class="answer">
                    <p>{{ __('answer6') }}</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="question">
                    <h3>{{ __('question7') }}</h3>
                    <div class="icon">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
                <div class="answer">
                    <p>{{ __('answer7') }}</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="question">
                    <h3>{{ __('question8') }}</h3>
                    <div class="icon">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
                <div class="answer">
                    <p>{{ __('answer8') }}</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="question">
                    <h3>{{ __('question9') }}</h3>
                    <div class="icon">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
                <div class="answer">
                    <p>{{ __('answer9') }}</p>
                </div>
            </div>
        </div>

        <div class="faq-item contact-item" style="margin-top: 18px">
            <div class="question">
                <h3>{{ __('question10') }}</h3>
                <div class="icon">
                    <i class="fas fa-chevron-down"></i>
                </div>
            </div>
            <div class="answer">
                <p>
                    <a href="https://wa.me/+994502923161" class="whatsapp-link" target="_blank">
                        <i class="fab fa-whatsapp"></i> {{ __('answer10') }}
                    </a>
                </p>
            </div>
        </div>

        <button onclick="goBack()" class="back-button">
            {{ __('go-back') }}
        </button>
    </div>
</div>

<style>
    body {
        margin: 0;
        min-height: 100vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #333;
    }

    .page-wrapper {
        min-height: 100vh;
        padding: 2rem 1rem;
        background:
            radial-gradient(circle at 10% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 20%),
            radial-gradient(circle at 90% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 20%),
            radial-gradient(circle at 30% 70%, rgba(255, 255, 255, 0.1) 0%, transparent 20%);
        display: flex;
        align-items: center;
    }

    .faq-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 2rem;
        background: rgba(255, 255, 255, 0.95);
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .faq-title {
        text-align: center;
        color: #2d3748;
        font-size: 2.25rem;
        margin-bottom: 2.5rem;
        font-weight: 700;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
    }

    .faq-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .faq-item {
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        overflow: hidden;
        background: white;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .faq-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .question {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.25rem 1.5rem;
        cursor: pointer;
        transition: background-color 0.3s ease;
        border-left: 4px solid transparent;
    }

    .question:hover {
        background-color: #f7fafc;
        border-left-color: #667eea;
    }

    .question h3 {
        margin: 0;
        font-size: 1.1rem;
        font-weight: 600;
        color: #2d3748;
    }

    .icon {
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #f7fafc;
        transition: all 0.3s ease;
    }

    .icon i {
        color: #667eea;
        font-size: 0.875rem;
        transition: transform 0.3s ease;
    }

    .faq-item.active .icon {
        background: #667eea;
    }

    .faq-item.active .icon i {
        transform: rotate(180deg);
        color: white;
    }

    .answer {
        max-height: 0;
        overflow: hidden;
        transition: all 0.3s ease-in-out;
        background-color: #f8fafc;
    }

    .faq-item.active .answer {
        max-height: 1000px;
    }

    .answer p {
        margin: 0;
        padding: 1.25rem 1.5rem;
        line-height: 1.6;
        color: #4a5568;
    }

    .back-button {
        display: block;
        margin: 2rem auto 0;
        padding: 0.75rem 1.5rem;
        background: #667eea;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .back-button:hover {
        background: #5a67d8;
        transform: translateY(-2px);
    }

    .whatsapp-link {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #25D366;
        text-decoration: none;
        font-weight: 600;
        font-size: 1.1rem;
        transition: color 0.3s ease;
    }

    .whatsapp-link:hover {
        color: #128C7E;
    }

    .whatsapp-link i {
        font-size: 1.5rem;
    }

    .contact-item .answer {
        background-color: white;
    }

    @media (max-width: 768px) {
        .faq-container {
            padding: 1.5rem;
        }

        .faq-title {
            font-size: 1.75rem;
        }

        .question h3 {
            font-size: 1rem;
        }
    }
</style>

<script>
    document.querySelectorAll('.question').forEach(question => {
        question.addEventListener('click', () => {
            const faqItem = question.closest('.faq-item');
            const wasActive = faqItem.classList.contains('active');

            // Close all FAQ items
            document.querySelectorAll('.faq-item').forEach(item => {
                item.classList.remove('active');
            });

            // If the clicked item wasn't active before, open it
            if (!wasActive) {
                faqItem.classList.add('active');
            }
        });
    });

    function goBack() {
        window.history.back();
    }
</script>
</body>
</html>
