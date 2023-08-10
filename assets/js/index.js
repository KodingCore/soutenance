window.addEventListener("DOMContentLoaded", function(){
    const register_form = document.getElementById("register_form");
    
    const champ_username = register_form.elements["username"]; 
    const champ_email = register_form.elements["email"];
    const champ_password = register_form.elements["password"];
    const champ_confirm_password = register_form.elements["confirm_password"];

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

    checkRegex("username", champ_username, usernameRegex);
    checkRegex("email", champ_email, emailRegex);
    checkRegex("password", champ_password, passwordRegex);
    checkRegex("confirm password", champ_confirm_password, passwordRegex);

    champ_confirm_password.addEventListener("change", function(){
        if(champ_confirm_password.value !== champ_password.value)
        {
            champ_confirm_password.classList.add("erreur");
        }
        else
        {
            champ_confirm_password.classList.remove("erreur");
        }
    })

    champ_password.addEventListener("change", function(){
        if(champ_confirm_password.value !== champ_password.value)
        {
            champ_confirm_password.classList.add("erreur");
        }
        else
        {
            champ_confirm_password.classList.remove("erreur");
        }
    })

    function checkRegex(name, field, reg)
    {
        field.addEventListener("change", function(){

            if(!reg.exec(field.value))
            {
                field.classList.add("erreur");
                error_username.textContent = "faux";
            }
            else
            {
                field.classList.remove("erreur");
            }
        })
    }
})