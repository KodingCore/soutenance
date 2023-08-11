export function checkUserFields(form)
{
    const champ_username = form.elements["username"]; 
    const champ_email = form.elements["email"];
    const champ_password = form.elements["password"];
    const champ_confirm_password = form.elements["confirm_password"];

    const error_username = document.getElementById("error_username");
    const error_email = document.getElementById("error_email"); 
    const error_password = document.getElementById("error_password"); 
    const error_confirm_password = document.getElementById("error_confirm_password"); 

    //* regex >>> au moins une lettre ou un chiffre
    const usernameRegex = new RegExp("^[A-Za-z][A-Za-z0-9_]{0,49}$");
    //* regex >>> au moins une lettre ou un chiffre au début, un arobase, une lettre ou un chiffre après l'arobase, un point, deux lettres ou deux chiffres à la fin
    const emailRegex = new RegExp("^[\\w-\\.]+@([\\w-]+\\.)+[\\w-]{2,4}$");
    //* regex >>> au moins une majuscule, un chiffre, un caractère spécial, et 8 caractères
    const passwordRegex = new RegExp("^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$");

    checkRegex(champ_username, usernameRegex, "username", error_username);
    checkRegex(champ_email, emailRegex,"email", error_email);
    checkRegex(champ_password, passwordRegex,"password", error_password);
    checkRegex(champ_confirm_password, passwordRegex, "confirm_password", error_confirm_password);

    

    champ_password.addEventListener("change", function(){
        if(champ_confirm_password.value !== champ_password.value && champ_confirm_password.value.length > 0)
        {
            champ_confirm_password.classList.add("erreur");
            error_confirm_password.textContent = "La confirmation du password doit être identique au password";
        }
        else if(champ_password.value.length < 8 && champ_password.value.length > 0)
        {
            champ_password.classList.add("erreur");
            error_password.textContent = "La password doit contenir au moins 8 caractères";
        }
        else
        {
            champ_confirm_password.classList.remove("erreur");
            error_confirm_password.textContent = "";
        }
    })

    champ_confirm_password.addEventListener("change", function(){
        if(champ_confirm_password.value !== champ_password.value)
        {
            champ_confirm_password.classList.add("erreur");
            error_confirm_password.textContent = "La confirmation du password doit être identique au password";
        }
        else
        {
            champ_confirm_password.classList.remove("erreur");
            error_confirm_password.textContent = "";
        }
    })

    function checkRegex(input_field, reg, name, error_field)
    {
        input_field.addEventListener("change", function(){
            if(!reg.exec(input_field.value))
            {
                input_field.classList.add("erreur");
                if(name !== "password")
                {
                    error_field.textContent = name + " non-conforme";
                }
                else if(input_field.length > 0)
                {
                    error_field.textContent = "Le password doit contenir une majuscule, une minuscule, un chiffre et un caractère spécial";
                }
            }
            else
            {
                input_field.classList.remove("erreur");
                error_field.textContent = "";
            }
        })
    }

    form.addEventListener("submit", function(event){
        if(error_username.value !== null || error_email.value !== null || champ_password.value !== null || error_confirm_password !== null)
        {
            event.preventDefault();
        }
    })
}