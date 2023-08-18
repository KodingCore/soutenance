//** ---------------------------------------------- */
//*  Cette fonction permet l'analyse d'entrées users
//*  Et renvoie un message d'erreur en cas de problème
//*  (Prend le formulaire en paramètre)
//** ---------------------------------------------- */
export function checkUserFields(form)
{
    //* Initialisation des variables de champs
    const champ_username = form.elements["username"]; 
    const champ_email = form.elements["email"];
    const champ_password = form.elements["password"];
    const champ_confirm_password = form.elements["confirm_password"];

    //* Initialisation des  elements d'affichages d'erreur
    const error_username = document.getElementById("error_username");
    const error_email = document.getElementById("error_email"); 
    const error_password = document.getElementById("error_password"); 
    const error_confirm_password = document.getElementById("error_confirm_password");

    let minCharPswrd = 12;
    let errorUsername = false;
    let errorEmail = false;
    let errorPasword = false;
    let errorConfirmPasword = false;

    //* regex >>> au moins une lettre ou un chiffre
    const usernameRegex = new RegExp("^[A-ZÀ-ÿa-z0-9-.]{2,50}$");
    //* regex >>> au moins une lettre ou un chiffre au début, un arobase, une lettre ou un chiffre après l'arobase, un point, deux lettres ou deux chiffres à la fin
    const emailRegex = new RegExp("^[\\w-.]+@([\\w-]+\\.)+[\\w-]{2,4}$");
    //* regex >>> au moins une majuscule, un chiffre, un caractère spécial, et 12 caractères
    const passwordRegex = new RegExp("^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^.&*-]).{" + minCharPswrd + ",}$");

    //* Control des différents champs
    champ_username.addEventListener("change", function () {
        checkRegex(champ_username, usernameRegex, "Username", error_username);
    });
    champ_email.addEventListener("change", function () {
        checkRegex(champ_email, emailRegex, "Email", error_email);
    });
    champ_password.addEventListener("change", function () {
        checkRegex(champ_password, passwordRegex, "Password", error_password);
        passwordChecker();
    });
    champ_confirm_password.addEventListener("change", function () {
        confirmPasswordChecker();
    });

    //** ------------------------------------- */
    //*  Analyse de la concordance entre 
    //*  les entrées password et confirm_password
    //*  Ainsi que de la longueuer de chaine
    //** ------------------------------------- */
    function passwordChecker()
    {

        //* Control du minimum de 12 caractères
        if(champ_password.value.length < minCharPswrd && champ_password.value.length > 0)
        {
            champ_password.classList.add("error");
            error_password.textContent = "Le password doit contenir au moins " + minCharPswrd + " caractères";
            errorPasword = true;
            
        }
        else
        {
            errorPasword = false;
        }
    }

    //** ------------------------------------- */
    //*  Analyse de la concordance entre 
    //*  les entrées password et confirm_password
    //** ------------------------------------- */
    function confirmPasswordChecker()
    {
        //* Control de l'égalité entre le password et le confirm_password
        if(champ_confirm_password.value !== champ_password.value && champ_confirm_password.value.length > 0)
        {
            champ_confirm_password.classList.add("error");
            error_confirm_password.textContent = "La confirmation du password doit être identique au password";
            errorConfirmPasword = true;
            
        }
        else
        {
            champ_confirm_password.classList.remove("error");
            error_confirm_password.textContent = "";
            errorConfirmPasword = false;
        }
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
            if(name === "Username")
            {
                error_field.textContent = "Uniquement lettres, chiffres, '-', '.' et espaces, de 2 à 50 caractères.";
            }
            else if(name === "Email")
            {
                error_field.textContent = "Uniquement lettres, chiffres, '-' et '.', de 2 à 50 caractères.";
            }
            else if(name === "Password")
            {
                error_field.textContent = "Doit contenir une majuscule, une minuscule, un chiffre et un caractère spécial";
            }
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
        if(error)
        {
            event.preventDefault();
        }
    })

}