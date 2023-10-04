//** ---------------------------------------------- */
//*  Ce comprends une gestion du "left-aside"
//*  De suppression visuel des messages de succès
//*  Ainsi qu'une gestion "prévisionnel" de cookies
//** ---------------------------------------------- */

window.addEventListener("DOMContentLoaded", function() {
    leftAside();
    succesDown();
    //cookies();
})


//** ---------------------------------------------- */
//*  Cette fonction permet l'affichage du left-aside
//*  seulement sur certaines pages
//*  (Prend le formulaire en paramètre)
//** ---------------------------------------------- */
function leftAside() {
    
    //* Récupération des éléments du DOM
    const title = document.getElementsByTagName("h1")[0];
    const leftAsideBtn = document.getElementById("left-aside-access");
    const leftAside = document.getElementById("left-aside");
    const arrowLeftAsideBtn = leftAsideBtn.getElementsByTagName("i")[0];
    
    //* Association des vues
    const url = window.location.href;
    let view = url.split("=")[1];
    const noLeftAsideViews = [
        "contact",
        "account",
        "shop",
        "login",
        "register",
        "request",
        "not-found",
        "about"
    ]
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
    else if (title.textContent.includes("À propos de moi")) {
        view = "about";
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
    else if (title.textContent.includes("Erreur 404!")) {
        view = "not-found";
    }

    if (view !== undefined) {
        if (view.includes("&")) {
            view = view.split("&")[0];
        }
        if (view.includes("#")) {
            view = view.split("#")[0];
        }
    }

    if (view === undefined || view === "disconnect" || view.includes("homepage")) {
        view = "homepage";
    }
    if (view.includes("request")) {
        view = "request";
    }

    //* Si la page inclue une barre latérale gauche
    if (!noLeftAsideViews.includes(view)) {
        const mainContainer = document.getElementsByTagName("main")[0];
        //* Gestion de la barre latérale gauche (leftAside)
        leftAsideBtn.addEventListener("click", () => {

            leftAside.classList.toggle("active");
            leftAsideBtn.style.cssText = `left: ${leftAside.offsetWidth}px`;
            if (arrowLeftAsideBtn.classList.contains("fa-caret-right")) {
                arrowLeftAsideBtn.classList.replace("fa-caret-right", "fa-caret-left");
            }
            else {
                arrowLeftAsideBtn.classList.replace("fa-caret-left", "fa-caret-right");
            }
        })
        //* Nettoyage de la vue
        mainContainer.addEventListener("click", () => {
            leftAside.classList.remove("active");
            leftAsideBtn.style.cssText = `left: ${leftAside.offsetWidth}px`;
            arrowLeftAsideBtn.classList.replace("fa-caret-left", "fa-caret-right");
        })
    }
    //* Si la page n'inclue pas de barre latérale gauche
    else 
    {
        //* On cache le bouton du leftAside
        leftAsideBtn.classList.add("hidden");
    }
}

//** ---------------------------------------------- */
//*  Cette fonction supprime les messages de succès
//*  Après un certain temps
//** ---------------------------------------------- */
function succesDown()
{
    setTimeout(function() {
        const succesElement = document.getElementsByClassName("success")[0];
        if(succesElement)
        {
            succesElement.remove();
        }
    }, 2500); 
}


//** ---------------------------------------------- */
//*  Fonction en stand-by, car pas d'utilisation 
//*  de cookies sur ce site
//** ---------------------------------------------- */
function cookies()
{
    const btnSuccess = document.querySelector('.btn-success');
    const btnDeny = document.querySelector('.btn-deny');
    
    const cookies = document.querySelector('.cookies');
    
    // Vérifier si l'utilisateur a déjà accepté ou refusé les cookies
    const cookiesAccepted = getCookie('cookiesAccepted');
    const cookiesDenied = getCookie('cookiesDenied');

    // Afficher ou masquer la section des cookies en conséquence
    if (!cookiesAccepted && !cookiesDenied) {
        cookies.style.display = 'block';
    } else {
        cookies.style.display = 'none';
    }
    
    btnSuccess.addEventListener('click', function(){
        setCookie('cookiesAccepted', 'true', 365); // Valable pendant 1 an
        cookies.style.display = 'none';
        cookies.style.opacity ="0";
    });
    btnDeny.addEventListener('click', function(){
        setCookie('cookiesDenied', 'true', 365); // Valable pendant 1 an
        cookies.style.display = 'none';
        cookies.style.opacity ="0";
    });
}

// Fonctions pour gérer les cookies
function setCookie(name, value, days) 
{
    const expires = new Date();
    expires.setTime(expires.getTime() + days * 24 * 60 * 60 * 1000);
    document.cookie = name + '=' + value + ';expires=' + expires.toUTCString();
}    

function getCookie(name) 
{
    const match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
    if (match) return match[2];
}