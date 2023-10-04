/********************************************************************
Ce script est chargé dans la page account
Il fait appel aux deux scripts de vérifications d'entrées utilisateurs
*********************************************************************/

import { checkUserFields } from './checkUserFields.js';
import { checkInfoFields } from './checkInfoFields.js';

window.addEventListener("DOMContentLoaded", function(){
    
    const form = document.getElementById("account_form");
    
    checkUserFields(form);
    checkInfoFields(form);
    
});