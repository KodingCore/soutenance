//** ---------------------------------------------- */
//*  Cette fonction permet l'analyse d'entrées infos
//*  Et renvoie un message d'erreur en cas de problème
//*  (Prend le formulaire en paramètre)
//** ---------------------------------------------- */
export function checkInfoFields(form)
{
    //* Initialisation des variables de champs
    const champ_first_name = form.elements["first_name"]; 
    const champ_last_name = form.elements["last_name"];
    const champ_tel = form.elements["tel"];
    const champ_address = form.elements["address"];
    const champ_zip = form.elements["zip"];
    const champ_city = form.elements["city"];

    //* Initialisation des elements d'affichages d'erreur
    const error_first_name = document.getElementById("error_first_name");
    const error_last_name = document.getElementById("error_last_name"); 
    const error_tel = document.getElementById("error_tel"); 
    const error_address = document.getElementById("error_address");
    const error_zip = document.getElementById("error_zip"); 
    const error_city = document.getElementById("error_city");

    //* Initialisation des regex
    const namesCityRegex = new RegExp("^[A-ZÀ-ÿa-z\\s\\-]{2,50}$");
    const telRegex = new RegExp("^[0-9]{10,10}$");
    const addressRegex = new RegExp("^\\d+[0-9A-ZÀ-ÿa-z\\s\\-]{2,50}$");                           
    const zipRegex = new RegExp("^[0-9]{2,15}$");
    
    //* Appel de la fonction général de controls
    globalControl();

    //* Control général des champs de saisie
    function globalControl()
    {
        champ_first_name.addEventListener("change", function () {
            checkRegex(champ_first_name, namesCityRegex, "Prénom", error_first_name);
        });
        champ_last_name.addEventListener("change", function () {
            checkRegex(champ_last_name, namesCityRegex, "Nom", error_last_name);
        });
        champ_tel.addEventListener("change", function () {
            checkRegex(champ_tel, telRegex, "Téléphone", error_tel);
        });
        champ_address.addEventListener("change", function () {
            checkRegex(champ_address, addressRegex, "Adresse", error_address);
        });
        champ_zip.addEventListener("change", function () {
            checkRegex(champ_zip, zipRegex, "Code postal", error_zip);
        });
        champ_city.addEventListener("change", function () {
            checkRegex(champ_city, namesCityRegex, "Ville", error_city);
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
            if(name === "Prénom")
            {
                error_field.textContent = "Uniquement lettres, chiffres, '-' et espaces, de 2 à 50 caractères.";
            }

            if(name === "Nom")
            {
                error_field.textContent = "Uniquement lettres, chiffres, '-' et espaces, de 2 à 50 caractères.";
            }

            if(name === "Téléphone")
            {
                error_field.textContent = "Uniquement 10 chiffres.";
            }

            if(name === "Adresse")
            {
                error_field.textContent = "Uniquement lettres, chiffres, '-' et espaces, de 2 à 50 caractères. Commence par un numéro.";
            }

            if(name === "Code postal")
            {
                error_field.textContent = "Uniquement lettres et chiffres, de 2 à 15 caractères.";
            }

            if(name === "Ville")
            {
                error_field.textContent = "Uniquement lettres, chiffres, '-' et espaces, de 2 à 50 caractère";
            }
            error_field.textContent = outputText;
        }
        else
        {
            input_field.classList.remove("error");
            error_field.textContent = "";
        }
    }

    //* Empêche la soumition du formulaire s'il y a une erreur
    form.addEventListener("submit", function(event)
    {
        if(error_first_name.textContent || error_last_name.textContent || error_tel || error_address || error_zip || error_city)
        {
            event.preventDefault();
        }
    })
}