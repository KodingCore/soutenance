window.addEventListener("DOMContentLoaded", function(){
    
    const makeReviewElement = document.getElementById("make-review-section");
    const starsElements = makeReviewElement.getElementsByClassName("fa-star");
    const stars = Array.from(starsElements);
    
    const rating = document.getElementById("rating");
    
    let value = 0;

    
    //* Pour toutes les étoiles
    for (let i = 0; i < stars.length; i++)
    {
        stars[i].addEventListener("mouseover", function() 
        {
            //* Remplie toutes les étoiles qui précèdent celle survolé ainsi qu'elle-même
            for (let j = 0; j < stars.length; j++)
            {
                if(j <= i)
                {
                    stars[j].classList.remove("fa-regular");
                    stars[j].classList.add("fa-solid");
                }
                else
                {
                    stars[j].classList.remove("fa-solid");
                    stars[j].classList.add("fa-regular");
                }
                
            }
        });
        stars[i].addEventListener("mouseleave", function() 
        {
            //*Toutes les étoiles sont vides, sauf si on a sauvegarder un nombre d'étoiles
            
                for (let i = 0; i < stars.length; i++)
                {
                    if(value > 0)
                    {
                        if(i <= value)
                        {
                            stars[i].classList.remove("fa-regular");
                            stars[i].classList.add("fa-solid");
                        }
                        else
                        {
                            stars[i].classList.remove("fa-solid");
                            stars[i].classList.add("fa-regular");
                        }
                    }
                    else
                    {
                        stars[i].classList.remove("fa-solid");
                        stars[i].classList.add("fa-regular");
                    }
            }
        });
        stars[i].addEventListener("click", function() 
        {
            //* Sauvegarde du nombre d'étoiles remplies
            //* Ajout de l'attribut "value" pour la sauvegarde
            value = i;
            rating.setAttribute("value", value + 1);
            
        });
    }
})