import { checkUserFields } from './checkUserFields.js';
import { checkInfoFields } from './checkInfoFields.js';

window.addEventListener("DOMContentLoaded", function(){
    
    const form = document.getElementById("account_form");
    
    checkUserFields(form);
    checkInfoFields(form);
    
})