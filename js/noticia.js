// Seleciona os slides
var slides = document.querySelectorAll('.slide');
var seta = document.querySelector('#seta_btn1');

// Seleciona os botões de rádio
var radioButtons = document.querySelectorAll('[name="radio-btn"]');

// Define o índice do slide atual
var currentSlide = 0;

// Adiciona a classe 'active' ao slide atual
slides[currentSlide].classList.add('active');

// Função para avançar para o próximo slide
function nextSlide() {
    slides[currentSlide].classList.remove('active');
    currentSlide = (currentSlide + 1) % slides.length;
    slides[currentSlide].classList.add('active');
    radioButtons[currentSlide].checked = true;
}

var contar_body_total = 0;
var contar_body = 1;

document.addEventListener('keydown', function(event) {
    const ANCORA = document.createElement("a");
    const numero_slide = document.getElementById('numero_slide').value - 1;
    switch (event.key){
        case "ArrowLeft":
            slides[currentSlide].classList.remove('active');
            if (currentSlide === 0) {
                currentSlide = numero_slide;
            } else {
                currentSlide = (currentSlide - 1) % slides.length;
            }
            slides[currentSlide].classList.add('active');
            radioButtons[currentSlide].checked = true;
            break;
            
        case "ArrowRight":
                slides[currentSlide].classList.remove('active');
                currentSlide = (currentSlide + 1) % slides.length;
                slides[currentSlide].classList.add('active');
                radioButtons[currentSlide].checked = true;
            break;
    } 
});

var slideInterval = setInterval(nextSlide, 25000);

// Adiciona evento de clique aos botões de rádio
for (var i = 0; i < radioButtons.length; i++) {
    radioButtons[i].addEventListener('click', function() {
        clearInterval(slideInterval);
        var selectedSlide = this.id.slice(-1) - 1;
        slides[currentSlide].classList.remove('active');
        slides[selectedSlide].classList.add('active');
        currentSlide = selectedSlide;
        slideInterval = setInterval(nextSlide, 10000);
    });
}

var currentScreen;

if (localStorage.getItem("currentScreen")){
    currentScreen = parseInt(localStorage.getItem("currentScreen"));
    if(currentScreen > 2){
        currentScreen = 1;
    }
}else{
    currentScreen = 1;
}