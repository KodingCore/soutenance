//** ---------------------------------------------- */
//*  Cette fonction permet l'analyse d'entrées users
//*  Et renvoie un message d'erreur en cas de problème
//*  (Prend le formulaire en paramètre)
//** ---------------------------------------------- */
export function checkUserFields(form)
{
    //* Initialisation des variables de champs de saisie
    const champUsername = form.elements["username"]; 
    const champEmail = form.elements["email"];
    const champPassword = form.elements["password"];
    const champConfirmPassword = form.elements["confirm_password"];

    //* Initialisation des elements d'affichages d'erreur
    const errorUsername = document.getElementById("error_username");
    const errorEmail = document.getElementById("error_email"); 
    const errorPassword = document.getElementById("error_password"); 
    const errorConfirmPassword = document.getElementById("error_confirm_password");

    //* variable de minimum de caractères du mot de passe
    const minCharPswrd = 12;

    //* Initialisation des regex
    const usernameRegex = new RegExp("^[A-ZÀ-ÿa-z0-9-.]{2,50}$");
    const emailRegex = new RegExp("^[\\w-.]{2,30}@([\\w-]{2,15}\\.)+[\\w-]{2,4}$");
    const passwordRegex = new RegExp("^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^.&*-]).{" + minCharPswrd + ",}$");

    //* Appel de la fonction général de controls
    globalControl();

    //* Control général des champs de saisie
    function globalControl()
    {
        champUsername.addEventListener("change", function () {
            errorUsername.classList.remove("content-write");
            errorUsername.classList.remove("error");
            errorUsername.textContent = "";
            checkRegex(champUsername, usernameRegex, "username", errorUsername);
        });
        champEmail.addEventListener("change", function () {
            errorEmail.classList.remove("content-write");
            errorEmail.classList.remove("error");
            errorEmail.textContent = "";
            checkRegex(champEmail, emailRegex, "email", errorEmail);
        });
        champPassword.addEventListener("change", function () {
            errorPassword.classList.remove("content-write");
            errorPassword.classList.remove("error");
            errorPassword.textContent = "";
            checkRegex(champPassword, passwordRegex, "password", errorPassword);
            confirmPasswordChecker();
        });
        champConfirmPassword.addEventListener("change", function () {
            errorConfirmPassword.classList.remove("content-write");
            errorConfirmPassword.classList.remove("error");
            errorConfirmPassword.textContent = "";
            confirmPasswordChecker();
        });
    }

    //** ------------------------------------- */
    //*  Analyse de la concordance entre 
    //*  les entrées password et confirm_password
    //** ------------------------------------- */
    function confirmPasswordChecker()
    {
        //* Control de l'égalité entre le password et le confirm_password
        if(champConfirmPassword.value !== champPassword.value && champConfirmPassword.value.length > 0)
        {
            champConfirmPassword.classList.add("error");
            errorConfirmPassword.textContent = "La confirmation du password doit être identique au password"; 
            errorConfirmPassword.classList.add("content-write");
        }
        else
        {
            champConfirmPassword.classList.remove("error");
            errorConfirmPassword.classList.remove("content-write");
            errorConfirmPassword.textContent = "";
        }
    }

    //** ----------------------------------------------------- */
    //*  Check une chaine de caractères par un regex
    //*  Puis renvoie un message d'erreur si le test ne passe pas
    //** ----------------------------------------------------- */
    function checkRegex(input_field, reg, name, error_field)
    {

        if(!reg.exec(input_field.value))
        {
            input_field.classList.add("error");
            if(name === "username")
            {
                error_field.textContent = "Uniquement lettres, chiffres, '-', '.' et espaces, de 2 à 50 caractères.";
                error_field.classList.add("content-write");
            }
            else if(name === "email")
            {
                error_field.textContent = "Uniquement lettres, chiffres, '-' et '.', de 2 à 50 caractères. Le TLD dois faire 4 caractères maximum.";
                error_field.classList.add("content-write");
            }
            else if(name === "password")
            {
                error_field.textContent = "Doit contenir une majuscule, une minuscule, un chiffre et un caractère spécial, au moins 12 caractères";
                error_field.classList.add("content-write");
            }
            error_field.classList.remove("hidden");
        }
        else
        {
            input_field.classList.remove("error");
            error_field.classList.remove("content-write");
            error_field.textContent = "";
        }
    }

    //* Empêche la soumition du formulaire s'il y a une erreur
    form.addEventListener("submit", function(event)
    {
        //* Remplacement des espaces par une chaine vide
        errorUsername.textContent = errorUsername.textContent.replace(/\s/g, "");
        errorEmail.textContent = errorEmail.textContent.replace(/\s/g, "");
        errorPassword.textContent = errorPassword.textContent.replace(/\s/g, "");
        errorConfirmPassword.textContent = errorConfirmPassword.textContent.replace(/\s/g, "");
        
        if(errorUsername.textContent || errorEmail.textContent || errorPassword.textContent || errorConfirmPassword.textContent)
        {
            event.preventDefault();
        }
    })

}