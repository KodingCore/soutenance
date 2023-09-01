window.addEventListener("DOMContentLoaded", function(){
    const header = document.getElementsByTagName("header")[0];
    const burgerIcon = document.getElementById("burger-icon");
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
    }
    if(view === undefined)
    {
        view = "homepage";
    }
    console.log("views recherchée : " + view);
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