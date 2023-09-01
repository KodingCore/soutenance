window.addEventListener("DOMContentLoaded", function()
{
    leftAside();
})

function leftAside()
{
    const leftAsideBtn = document.getElementById("left-aside-access");
    const leftAside = document.getElementById("left-aside");
    const arrowLeftAsideBtn = leftAsideBtn.getElementsByTagName("i")[0];
    const noLeftAsideViews = [
        "contact",
        "account",
        "shop",
        "login",
        "register"
    ]
    const url = window.location.href;
    let view = url.split("=")[1];
    
    if(view !== undefined && view.includes("#"))
    {
        view = view.replace("#", "");
    }
    if(view === undefined)
    {
        view = "homepage";
    }

    if(!noLeftAsideViews.includes(view))
    {
        const mainContainer = document.getElementsByClassName(`${view}-container`)[0];

        leftAsideBtn.addEventListener("click", () => {

            leftAside.classList.toggle("active");
            leftAsideBtn.style.cssText = `left: ${leftAside.offsetWidth}px`;
            console.log(leftAside.offsetWidth + " " + leftAsideBtn.offsetLeft);
            if(arrowLeftAsideBtn.classList.contains("fa-caret-right"))
            {
                arrowLeftAsideBtn.classList.replace("fa-caret-right", "fa-caret-left");
            }
            else
            {
                arrowLeftAsideBtn.classList.replace("fa-caret-left", "fa-caret-right");
            }
        })

        mainContainer.addEventListener("click", () => {
            leftAside.classList.remove("active");
            leftAsideBtn.style.cssText = `left: ${leftAside.offsetWidth}px`;
            arrowLeftAsideBtn.classList.replace("fa-caret-left", "fa-caret-right");
        })
    }
    else
    {
        leftAsideBtn.classList.add("hidden");
    }
}