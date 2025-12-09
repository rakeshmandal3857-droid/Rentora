// serviceLocation section scrooll 

const slider = document.querySelector(".slider");

function scrollToLeft(){
    slider.scrollBy({
        left: '400',
        behavior: 'smooth'
    })
}
function scrollToRight(){
    slider.scrollBy({
        left: '-400',
        behavior: 'smooth'
    })
}

// testimoials carousel

const testimonialsSlider = document.querySelector(".testimonials-slider");
const slides = document.querySelectorAll('.slide');

const slideWidth = slides[0].offsetWidth;

function nextSlide(){
    testimonialsSlider.scrollBy({
        left: slideWidth,
        behavior: 'smooth'
    });
}
function prevSlide(){
    testimonialsSlider.scrollBy({
        left: -slideWidth,
        behavior: 'smooth'
    });
}

setInterval(nextSlide,3000);
