
window.addEventListener("DOMContentLoaded", function(){
    const form = document.getElementById("contact_form");
    checkMessageFields(form)
})


//** -------------------------------------------------------- */
//*  Cette fonction permet l'analyse des entrées d'un message
//*  Et renvoie un message d'erreur en cas de problème
//*  (Prend le formulaire en paramètre)
//** -------------------------------------------------------- */
function checkMessageFields(form)
{
    //* Initialisation des variables de champs
    const champ_subject = form.elements["subject"]; 
    const champ_content = form.elements["content"];

    //* Initialisation des elements d'affichages d'erreur
    const error_subject = document.getElementById("error_subject");
    const error_content = document.getElementById("error_content");
    
    console.log(form);
    console.log(error_content);

    //* Initialisation des regex
    const subjectRegex = new RegExp(`^[a-zA-Z0-9.,!?&;:()<>\"'\\s]{4,50}$`);
    const contentRegex = new RegExp(`^[a-zA-Z0-9.,!?&;:()<>\"'\\s]{10,2048}$`);
    
    //* Appel de la fonction général de controls
    globalControl();

    //* Control général des champs de saisie
    function globalControl()
    {
        champ_subject.addEventListener("change", function () {
            checkRegex(champ_subject, subjectRegex, "subject", error_subject);
        });
        champ_content.addEventListener("change", function () {
            checkRegex(champ_content, contentRegex, "content", error_content);
        });
    }

    //** ----------------------------------------------------- */
    //*  check une chaine de caractères par un regex
    //*  Puis renvoie un message d'erreur si le test ne passe pas
    //** ----------------------------------------------------- */
    function checkRegex(input_field, reg, name, error_field)
    {
        if(!reg.exec(input_field.value))
        {
            input_field.classList.add("error");
            error_field.classList.add("content-write");
            
            if(name === "subject")
            {
                error_field.textContent = "Doit faire entre 4 et 50 caractères.";
            }

            if(name === "content")
            {
                error_field.textContent = "Doit faire entre 10 et 2048 caractères.";
                
            }

            
        }
        else
        {
            error_field.classList.remove("content-write");
            input_field.classList.remove("error");
            error_field.textContent = "";
        }
    }

    //* Empêche la soumition du formulaire s'il y a une erreur
    form.addEventListener("submit", function(event)
    {
        if(error_subject.textContent || error_content.textContent)
        {
            event.preventDefault();
        }
    })
}