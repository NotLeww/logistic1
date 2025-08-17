document.addEventListener('DOMContentLoaded', function () {
    const slides = document.querySelectorAll('.form-slide');
    let currentSlide = 0;

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.toggle('active', i === index);
        });
    }

    document.querySelectorAll('.next-button').forEach(btn => {
        btn.addEventListener('click', function () {
            if (currentSlide < slides.length - 1) {
                currentSlide++;
                showSlide(currentSlide);
            }
        });
    });

    document.querySelectorAll('.prev-button').forEach(btn => {
        btn.addEventListener('click', function () {
            if (currentSlide > 0) {
                currentSlide--;
                showSlide(currentSlide);
            }
        });
    });

    showSlide(currentSlide);
});