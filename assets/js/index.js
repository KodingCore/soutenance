window.addEventListener("DOMContentLoaded", function()
{
    leftAside();
})

function leftAside()
{
    const leftAsideBtn = document.getElementById("left-aside-access");
    const leftAside = document.getElementById("left-aside");
    const arrowLeftAsideBtn = leftAsideBtn.getElementsByTagName("i")[0];

    leftAsideBtn.addEventListener("click", () => {
        leftAside.classList.toggle("active");
        console.log("lol");
        leftAsideBtn.style.cssText = `left: ${leftAside.offsetWidth}px`;
        if(arrowLeftAsideBtn.classList.contains("fa-caret-right"))
        {
            arrowLeftAsideBtn.classList.replace("fa-caret-right", "fa-caret-left");
        }
        else
        {
            arrowLeftAsideBtn.classList.replace("fa-caret-left", "fa-caret-right");
        }
        
    })
}