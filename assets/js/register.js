/***************************************************
Ce script est chargé dans la page register
Il fait appel à checkUserFields.js pour controller 
les entrées utilisateurs d'enrégistrement de compte
***************************************************/

import { checkUserFields } from './checkUserFields.js';

window.addEventListener("DOMContentLoaded", function(){

    const form = document.getElementById("register_form");

    checkUserFields(form);
    
})