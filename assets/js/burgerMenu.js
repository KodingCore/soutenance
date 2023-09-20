window.addEventListener("DOMContentLoaded", function(){
    const title = document.getElementsByTagName("h1")[0];
    const header = document.getElementsByTagName("header")[0];
    const burgerIcon = document.getElementById("burger-icon");
    const succesSpan = document.getElementsByClassName("succes")[0]; //* On récupère le span de message de succès pour controlé s'il y a eut redirection
    const menu = document.getElementById("menu");
    const url = window.location.href;
    let view = url.split("=")[1];
    if(view !== undefined)
    {
        if(view.includes("&"))
        {
            view = view.split("&")[0];
        }
        if(view.includes("#"))
        {
            view = view.split("#")[0];
        }

        if(view === "login" && succesSpan.textContent != null)
        {
            view = "register";
        }
    }
    if(view === undefined || title.textContent === "Accueil")
    {
        view = "homepage";
    }

    const mainContainer = document.getElementsByClassName(`${view}-container`)[0];
    const navbar = document.getElementsByClassName("navbar")[0];
    
    navbar.style.cssText = `top: ${header.offsetHeight}px`;

    burgerIcon.addEventListener("click", () => {
        menu.classList.toggle("active");
    });

    mainContainer.addEventListener("click", () => {
        menu.classList.remove("active");
    })
})