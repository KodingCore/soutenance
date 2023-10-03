console.log('JS connecté !');

//je séléctionne et je stock
//bouton .btn-success;
const btnSuccess = document.querySelector('.btn-success');
console.log(btnSuccess);

//DIV cookies
const cookies = document.querySelector('.cookies');
console.log(cookies);

btnSuccess.addEventListener('click', function(){
    console.log('bouton cliqué !');
    cookies.style.opacity ="0";
});