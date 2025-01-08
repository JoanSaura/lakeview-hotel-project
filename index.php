<?php $root = $_SERVER['DOCUMENT_ROOT']; ?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/student071/dwes/files/common-files/header.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/student071/dwes/files/sandbox/try.php'; ?>


<div id="home-container">

<div id="home">
  <div class="home-header">
  <h3>Welcome to MIRACLE Hotel</h3>
  </div>
  <div class="slider">
    <img src="/student071/dwes/img/1.jpg" alt="Image 1" class="active">
    <img src="/student071/dwes/img/2.jpg" alt="Image 2">
  </div>
</div>

  <script>
let currentSlide = 0;
const slides = document.querySelectorAll('.slider img');
const totalSlides = slides.length;

function showNextSlide() {
    slides[currentSlide].classList.remove('active');
    
    currentSlide = (currentSlide + 1) % totalSlides;

    slides[currentSlide].classList.add('active');
}

setInterval(showNextSlide, 3000); 
  </script>
</div>

<?php include $root . '/student071/dwes/files/common-files/footer.php'; ?>