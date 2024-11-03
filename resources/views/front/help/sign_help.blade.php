<div class="chatbot-icon" onclick="redirectToChat()">
    <i class="fa-solid fa-question"></i>
    <span class="tooltip">FAQ</span>

</div>

<script>
    function redirectToChat() {
        window.location.href = "{{ route('front.help.questions_answers') }}";
    }
</script>
