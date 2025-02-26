document.addEventListener("DOMContentLoaded", function () {
    let currentSlide = 0;
    const slides = document.querySelectorAll('.slider img');
    const totalSlides = slides.length;

    function showNextSlide() {
        slides[currentSlide].classList.remove('active');

        currentSlide = (currentSlide + 1) % totalSlides;

        slides[currentSlide].classList.add('active');
    }

    setInterval(showNextSlide, 3000);
});