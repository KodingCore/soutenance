const champ_username = register_form.elements["username"];
const champ_email = register_form.elements["email"];
const champ_password = register_form.elements["password"];
const champ_confirm_password = register_form.elements["confirm_password"];

const emailRegex = new RegExp("^[\\w-\\.]+@([\\w-]+\\.)+[\\w-]{2,4}$");
const usernameRegex = new RegExp("^[A-Za-z][A-Za-z0-9_]{7,29}$");
const passwordRegex = new RegExp("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/");

champ_email.addEventListener("change", function(){
    
    
    if(champ_email.value.length === 0 || !emailRegex.exec(champ_email.value))
    {
        champ_email.classList.add("erreur");
    }
    else
    {
        champ_email.classList.remove("erreur");
    }
})

champ_username.addEventListener("change", function(){
    
})

champ_password.addEventListener("change", function(){
    
})

champ_confirm_password.addEventListener("change", function(){
    
})