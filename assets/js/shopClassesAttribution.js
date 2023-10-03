window.addEventListener("DOMContentLoaded", function() {
    setClasses();

    function setClasses() {
        const templatesSection = document.getElementById("templates-section");
        let pictures = templatesSection.getElementsByTagName("img");
        pictures = Array.from(pictures);
        pictures.forEach(picture => {
            
            if (picture.classList.contains("center-picture")) {
                picture.classList.remove("center-picture");
                picture.addEventListener("click", function() {
                    picture.classList.remove("center-picture");
                });
            }
            if (picture.classList.contains("left-picture")) {
                picture.classList.remove("left-picture");
                picture.addEventListener("click", function() {
                    picture.classList.remove("left-picture");
                });
            }
            if (picture.classList.contains("right-picture")) {
                picture.classList.remove("right-picture");
                picture.addEventListener("click", function() {
                    picture.classList.remove("right-picture");
                });
            }

            let pictureCenter = picture.offsetLeft + (picture.offsetWidth / 2);
            let windowCenter = window.innerWidth / 2;
            let positionDifference = pictureCenter - windowCenter;
            if (positionDifference < 50 && positionDifference > -50) {
                picture.classList.add("center-picture");
            }
            else if (positionDifference > 50) {
                picture.classList.add("right-picture");
            }
            else if (positionDifference < -50) {
                picture.classList.add("left-picture");
            }
            
        });
    }

    if (window.addEventListener) {
        window.addEventListener('resize', function() {
            setClasses();
        }, true);
    }

})
