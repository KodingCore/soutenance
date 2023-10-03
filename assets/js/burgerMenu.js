window.addEventListener("DOMContentLoaded", function() {
    const title = document.getElementsByTagName("h1")[0];
    const header = document.getElementsByTagName("header")[0];
    const burgerIcon = document.getElementById("burger-icon");
    const menu = document.getElementById("menu");
    const url = window.location.href;
    let view = url.split("=")[1];

    if (title.textContent.includes("Accueil")) {
        view = "homepage";
    }
    else if (title.textContent.includes("Connexion")) {
        view = "login";
    }
    else if (title.textContent.includes("Vitrine")) {
        view = "shop";
    }
    else if (title.textContent.includes("Mon compte")) {
        view = "account";
    }
    else if (title.textContent.includes("Dashboard")) {
        view = "dashboard";
    }
    else if (title.textContent.includes("Envoyer un message")) {
        view = "contact";
    }
    else if (title.textContent.includes("Créer un compte")) {
        view = "register";
    }
    else if (title.textContent.includes("Politique de confidentialité")) {
        view = "gnu";
    }
    else if (title.textContent.includes("Demandez votre site sur-mesure")) {
        view = "request";
    }

    if (view !== undefined) {
        if (view.includes("&")) {
            view = view.split("&")[0];
        }
        if (view.includes("#")) {
            view = view.split("#")[0];
        }
    }

    const mainContainer = document.getElementById(`${view}-container`);
    const navbar = document.getElementsByClassName("navbar")[0];

    navbar.style.cssText = `top: ${header.offsetHeight}px`;

    burgerIcon.addEventListener("click", () => {
        menu.classList.toggle("active");
    });

    mainContainer.addEventListener("click", () => {
        menu.classList.remove("active");
    })
})
