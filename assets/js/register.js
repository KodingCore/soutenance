window.addEventListener("DOMContentLoaded", function(){

    const form = document.getElementById("account_form");
    checkUserFields(form);
})

import { checkUserFields } from './checkUserFields.js';

window.addEventListener("DOMContentLoaded", function(){

    const form = document.getElementById("register_form");

    checkUserFields(form);
    
})