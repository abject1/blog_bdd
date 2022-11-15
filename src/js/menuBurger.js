const menuBurger = document.querySelector('#menuBurger');
const nav = document.querySelector('nav');
const spanTrois = document.querySelector('#spanNotSeen');
const spanUn = document.querySelector('#spanUn');
const spanDeux = document.querySelector('#spanDeux');
const menuOpen = 0;

menuBurger.addEventListener('click', () => {
    nav.classList.toggle('navSeen');
    spanTrois.classList.toggle('spanNotSeen');
    spanUn.classList.toggle('spanRotateUn');
    spanDeux.classList.toggle('spanRotateDeux');
    menuOpen = 1;
})

if (menuOpen === 1) {
    window.addEventListener('click', () => {
    nav.classList.remove('navSeen');
    spanTrois.classList.remove('spanNotSeen');
    spanUn.classList.remove('spanRotateUn');
    spanDeux.classList.remove('spanRotateDeux');
})
}