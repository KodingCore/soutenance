/**********************************************
Ce script est chargé sur toutes les pages
Il gère le click et la position du menu burger
**********************************************/

window.addEventListener("DOMContentLoaded", function() {
    const header = document.getElementsByTagName("header")[0];
    const burgerIcon = document.getElementById("burger-icon");
    const menu = document.getElementById("menu");

    const mainContainer = document.getElementsByTagName("main")[0];
    const navbar = document.getElementsByClassName("navbar")[0];

    navbar.style.cssText = `top: ${header.offsetHeight}px`;

    burgerIcon.addEventListener("click", () => {
        menu.classList.toggle("active");
    });

    mainContainer.addEventListener("click", () => {
        menu.classList.remove("active");
    })
})
