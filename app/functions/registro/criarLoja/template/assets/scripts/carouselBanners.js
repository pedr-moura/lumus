// ações para carousel nos banners

let currentIndex = 0;
const slides = document.querySelectorAll('.carousel-item');
const indicators = document.querySelectorAll('.indicator');

function updateCarousel() {
const carouselInner = document.querySelector('.carousel-inner');
carouselInner.style.transform = `translateX(-${currentIndex * 100}%)`;

indicators.forEach((indicator, index) => {
    indicator.classList.toggle('active', index === currentIndex);
});
}

function goToSlide(index) {
currentIndex = index;
updateCarousel();
}

function nextSlide() {
currentIndex = (currentIndex + 1) % slides.length;
updateCarousel();
}

setInterval(nextSlide, 5000);
