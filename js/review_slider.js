let index = 0;

function moveSlide(step) {
    const slides = document.querySelector(".carousel-wrapper");
    const totalSlides = document.querySelectorAll(".review-slide").length;
    
    index = (index + step + totalSlides) % totalSlides;
    
    slides.style.transform = `translateX(-${index * 100}%)`;
}

setInterval(() => moveSlide(1), 5000);