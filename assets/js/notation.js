window.addEventListener("DOMContentLoaded", function(){
    
    const makeReviewElement = document.getElementById("make-review-section");
    
    const starsElements = makeReviewElement.getElementsByClassName("fa-star");
    let locked = false;
    const stars = Array.from(starsElements);
    
    stars.forEach(function(star)
    {
        star.classList.remove("fa-solid");
        star.classList.add("fa-regular");
    })
    
    for (let index = 0; index < stars.length; index++)
    {
        stars[index].addEventListener("mouseover", function() 
        {
            stars.forEach(function(star)
            {
                star.classList.add("fa-regular");
                star.classList.remove("fa-solid");
            });
            console.log("L'élément " + index + " est survolé !");
            for(let i = 0; i <= index; i++)
            {
                stars[i].classList.remove("fa-regular");
                stars[i].classList.add("fa-solid");
            }
        });
        stars[index].addEventListener("mouseleave", function() {
            stars.forEach(function(star)
            {
                if(!locked)
                {
                    star.classList.add("fa-regular");
                    star.classList.remove("fa-solid");
                }
                
            });
            console.log("La souris a quitté l'élément " + index + " !");
        });
        stars[index].addEventListener("click", function() {
            stars.forEach(function(star)
            {
                locked = true;
            });
            console.log("La souris a quitté l'élément " + index + " !");
        });
    }
})