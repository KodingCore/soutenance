window.addEventListener("DOMContentLoaded", function(){
    const templatesSection = document.getElementById("templates-section");
    let pictures = templatesSection.getElementsByTagName("img");
    pictures = Array.from(pictures);
    console.log(window.innerWidth);
    pictures.forEach(picture => {
        let pictureCenter = picture.offsetLeft + (picture.offsetWidth / 2);
        let windowCenter = window.innerWidth / 2;
        let positionDifference = pictureCenter - windowCenter;
        console.log("centre de l'image " + pictureCenter + "  centre de la fenetre " + windowCenter + "  Différence " + positionDifference);
        if(positionDifference < 50 && positionDifference > -50)
        {
            picture.classList.add("center-picture");
        }
        else if(positionDifference > 50)
        {
            picture.classList.add("right-picture");
        }
        else if(positionDifference < -50)
        {
            picture.classList.add("left-picture");
        }
    });
});