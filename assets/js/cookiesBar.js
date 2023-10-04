/* Script à ajouter au cas ou les cookies seraient présents sur le site */


const btnSuccess = document.querySelector('.btn-success');
const cookies = document.querySelector('.cookies');

btnSuccess.addEventListener('click', function(){
    cookies.style.display = "none";
});