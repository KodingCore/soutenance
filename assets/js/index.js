let champ_username = register_form.elements["username"];
let champ_email = register_form.elements["email"];
let champ_password = register_form.elements["password"];
let champ_confirm_password = register_form.elements["confirm_password"];

champ_email.addEventListener("change", function(){
    if(!champ_email.value.includes('@') && champ_email.value.length > 0 || !champ_email.value.contain('.') && champ_email.value.length > 0)
    {
        champ_email.classList.add("erreur");
    }
    else
    {
        champ_email.classList.remove("erreur");
    }
})

    // if(champ_username.value.length > 49 || champ_username.value === ""){
    //     form_OK = false;
    //     champ_username.classList.add("erreur");
    // }
    // else
    // {
    //     champ_nom.classList.remove("erreur");
    // }
    // let regex = '/^[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*@[a-z0-9]+([_|\.|-]­{1}[a-z0-9]+)*[\.]{1}[a-z]{2,6}$/';
    // if (regex.exec(champ_email.value) === null || champ_email.value.length > 49 || champ_email.value === "") {
    //     form_OK = false;
    //     champ_email.classList.add("erreur");
    // }
    // else
    // {
    //     champ_nom.classList.remove("erreur");
    // }
    // if(champ_password.value.length > 49 || champ_password.value === "" || champ_password.value != champ_confirm_password.value){
    //     form_OK = false;
    //     champ_password.classList.add("erreur");
    // }
    // else
    // {
    //     champ_nom.classList.remove("erreur");
    // }
    
    // if(champ_confirm_password.value.length > 49 || champ_confirm_password.value === "")
    // {
    //     form_OK = false;
    //     champ_password.classList.add("erreur");
    // }
    // else
    // {
    //     champ_nom.classList.remove("erreur");
    // }
