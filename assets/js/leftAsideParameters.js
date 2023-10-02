window.addEventListener("DOMContentLoaded", function() {
    leftAside();
    succesDown();
})

function leftAside() {
    const leftAsideBtn = document.getElementById("left-aside-access");
    const leftAside = document.getElementById("left-aside");
    const arrowLeftAsideBtn = leftAsideBtn.getElementsByTagName("i")[0];
    const noLeftAsideViews = [
        "contact",
        "account",
        "shop",
        "login",
        "register",
        "request"
    ]
    const url = window.location.href;
    let view = url.split("=")[1];

    if (view !== undefined) {
        if (view.includes("&")) {
            view = view.split("&")[0];
        }
        if (view.includes("#")) {
            view = view.split("#")[0];
        }
    }
    if (view === undefined || view === "disconnect") {
        view = "homepage";
    }

    if (!noLeftAsideViews.includes(view)) {
        const mainContainer = document.getElementById(`${view}-container`);

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

        mainContainer.addEventListener("click", () => {
            leftAside.classList.remove("active");
            leftAsideBtn.style.cssText = `left: ${leftAside.offsetWidth}px`;
            arrowLeftAsideBtn.classList.replace("fa-caret-left", "fa-caret-right");
        })
    }
    else {
        leftAsideBtn.classList.add("hidden");
    }
}


function succesDown()
{
    setTimeout(function() {
        const succesElement = document.getElementsByClassName("success")[0];
        console.log(succesElement);
        if(succesElement)
        {
            succesElement.remove();
        }
    }, 2500); 
}