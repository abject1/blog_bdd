const menuBurger = document.querySelector('#menuBurger');
const nav = document.querySelector('nav');
const spanTrois = document.querySelector('#spanNotSeen');
const spanUn = document.querySelector('#spanUn');
const spanDeux = document.querySelector('#spanDeux');

menuBurger.addEventListener('click', () => {
    nav.classList.toggle('navSeen');
    spanTrois.classList.toggle('spanNotSeen');
    spanUn.classList.toggle('spanRotateUn');
    spanDeux.classList.toggle('spanRotateDeux');
})