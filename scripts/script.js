// script
window.onload = function(){

    // Selecting the cards
    let cardOne = document.getElementsByClassName('card')[0];
    let cardTwo = document.getElementsByClassName('card')[1];

    // Selecting the divs with the black images
    let blackImage1 = document.getElementsByClassName('black')[0];
    let blackImage2 = document.getElementsByClassName('black')[1];

    // Selecting the divs with the white images
    let whiteImage1 = document.getElementsByClassName('white')[0];
    let whiteImage2 = document.getElementsByClassName('white')[1];

    // Adding toggling classes every time the mouse enters cardOne
    cardOne.addEventListener('mouseenter', () => {
        blackImage1.classList.toggle("hide");
        whiteImage1.classList.toggle("active");
    });

    // Adding toggling classes every time the mouse leaves cardOne
    cardOne.addEventListener('mouseleave', () => {
        blackImage1.classList.toggle("hide");
        whiteImage1.classList.toggle("active");
    });

    // Adding toggling classes every time the mouse enters cardTwo
    cardTwo.addEventListener('mouseenter', () => {
        blackImage2.classList.toggle("hide");
        whiteImage2.classList.toggle("active");
    });

    // Adding toggling classes every time the mouse leaves cardTwo
    cardTwo.addEventListener('mouseleave', () => {
        blackImage2.classList.toggle("hide");
        whiteImage2.classList.toggle("active");
    });

}