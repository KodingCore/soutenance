window.addEventListener("DOMContentLoaded", function()
{
    initDashboard();
})

//** -------------------------------- */
//*  Initialisation et écoute des clicks
//*  dans les liens de la nav de control
//** -------------------------------- */
function initDashboard()
{
    //* Noms des parties controllées par le dashboard
    const controlNavLinks = [
        document.getElementById("user-link"),
        document.getElementById("message-link"),
        document.getElementById("template-link"),
        document.getElementById("category-link"),
        document.getElementById("review-link"),
        document.getElementById("appointment-link")
    ];

    const addingNavLinks = [
        document.getElementById("add-category"),
        document.getElementById("add-template"),
        document.getElementById("add-quotation"),
        document.getElementById("add-appointment")
    ];

    //* Écoute des click dans la nav de control
    controlNavLinks.forEach(function(link){
        link.addEventListener("click", function(){
            
            //* Affichage du tableau
            fetchingControlDatas(link);
        })
    })

    //* Écoute des click dans la nav d'ajouts
    addingNavLinks.forEach(function(link){
        link.addEventListener("click", function(){
            
            //* Affichage du formaulaire d'ajout
            displayAddingForm(link);
        })
    })
}

//** ------------------------------ */
//*  Reset la section de control
//*  Reçoi la data et appel les 
//*  fonctions de créations du tableau
//** ------------------------------ */
function fetchingControlDatas(link)
{
    const controlSection = document.getElementById("control-section");

    fetch(`index.php?route=${link.id}`)
        .then(response => response.json())
        .then(data => 
        {   
            for(let key in data) //* pour chaques valeur de la data
            {
                controlSection.innerHTML = ""; //* On reset la section de control
                const className = key; //* Ecriture du titre du control
                setControlTitle(controlSection, className); //* Initialisation du titre de la section
                createStructureTable(controlSection); //* Création de la structure du tableau

                for(let attributName in data[className][0]) //* Pour chaques clées des valeurs d'une data
                {
                    completeHeaderTable(attributName); //* On défini le header du tableau
                }
                for(let object in data[key]) //* Pour chaques objet de la data
                {
                    completeBodyTable(className, data[key][object]); //* On appel la fonction de création du body
                }
            }
        })
        .catch(error => console.error("Une erreur s'est produite", error));
}

//** ------------------------------ */
//*  Initialise le titre de la section
//** ------------------------------ */
function setControlTitle(section, title)
{
    const controlTitle = document.createElement("h2");
    
    controlTitle.id = "control-title";
    controlTitle.textContent = "Panneau de control des " + title;
    section.appendChild(controlTitle);
}

//** ------------------------------- */
//*  Initialise la structure du tableau
//** ------------------------------- */
function createStructureTable(section)
{
    const controlTable = document.createElement("table");
    const headerTable = document.createElement("thead");
    const rowHeader = document.createElement("tr");
    const bodyTable = document.createElement("tbody");
    
    section.appendChild(controlTable);
    controlTable.appendChild(headerTable);

    headerTable.appendChild(rowHeader);
    rowHeader.id = "row-head";

    controlTable.appendChild(bodyTable);
    bodyTable.id = "body-table";
}

//** -------------------------- */
//*  Complète l'en-tête du tableau
//** -------------------------- */
function completeHeaderTable(headerCellName)
{
    const rowHeader = document.getElementById("row-head");
    const headCell = document.createElement("th");
    const textNodeCell = document.createTextNode(headerCellName);
    
    rowHeader.appendChild(headCell);
    headCell.appendChild(textNodeCell);
}

//** ------------------------- */
//*  Complète le corps du tableau
//** ------------------------- */
function completeBodyTable(className, objectForcellsValues)
{
    const bodyTable = document.getElementById("body-table");
    const bodyRow = document.createElement("tr");

    bodyTable.appendChild(bodyRow);

    let i = 0;
    for(let key in objectForcellsValues)
    {
        const cell = document.createElement("td");
        bodyRow.appendChild(cell);
        if(i === 0)
        {
            const buttonCell = document.createElement("button");
            buttonCell.classList.add("row-btn");
            buttonCell.id = objectForcellsValues[key];
            const textNodeCell = document.createTextNode(objectForcellsValues[key]);
            cell.appendChild(buttonCell);
            buttonCell.appendChild(textNodeCell);
            buttonCell.addEventListener("click", function() {
                fetchingControlDetails(className, buttonCell.id);
            });
        }
        else
        {
            const textNodeCell = document.createTextNode(objectForcellsValues[key]);
            cell.appendChild(textNodeCell);
        }
        i++;
    }
}

function fetchingControlDetails(className, rowId) //* !!!!!!!!!!!!!!!!!!!!!!!!!!!
{
    console.log(className, rowId); //* ex:    users   701

    fetch(`index.php?route=fetch-${route}&id=${target}`)
        .then(response => response.json())
        .then(data => 
        {   
            console.loog(data);
            // displayDetails(dataExtract, route, detailSection);
        })
        .catch(error => console.error("Une erreur s'est produite", error));
}



//*  REAL END ---- REAL END ---- REAL END ---- REAL END ---- REAL END ---- REAL END 
//* --------------------------------------------------------------------------------
//* --------------------------------------------------------------------------------
//* --------------------------------------------------------------------------------
//** ------------------------------------- */
//*  Ecoute les clicks de sélections de ligne
//*  puis appel la fonction d'affichage
//** ------------------------------------- */
function detailButtonsListener(section) 
{
    const detailSection = document.querySelector("#details");
    const btns = section.getElementsByClassName("row-btn");
    const btnsArray = Array.from(btns);
    
    detailSection.classList.add("hidden");

    btnsArray.forEach(function(btn) 
    {
        btn.addEventListener("click", function() 
        {
            let target = btn.id;
            let route = section.id;
            fetch(`index.php?route=${route}&id=${target}`)
                .then(response => response.json())
                .then(data => 
                {   
                    let dataExtract;
                    for(let key in data)
                    {
                        dataExtract = data[key];
                    }

                    displayDetails(dataExtract, route, detailSection);
                })
                .catch(error => console.error("Une erreur s'est produite", error));
        });
    });
}

//** ------------------------------------------- */
//*  Affiche les détails d'une sélection du tableau
//** ------------------------------------------- */
function displayDetails(data, route, detailSection)
{
    detailSection.classList.remove("hidden");
    let i = 0;      
    for (let key in data) 
    {
        if (data.hasOwnProperty(key)) 
        {
            if(i === 0)
            {   
                detailSection.innerHTML = '<div id="detail-title"><h3>Détails ' + route + '</h3></div>';
            }

            if(key === "Rôle")
            {
                if(data["Rôle"] === "user")
                {
                    detailSection.innerHTML = detailSection.innerHTML + `
                    <label>Role :</label>
                    <label for="role" class="switch">
                    <input type="checkbox" name="role" id="role">
                    <span class="slider round"></span>
                    </label>
                    `;
                }
                else if(data["Rôle"] === "admin")
                {
                    detailSection.innerHTML = detailSection.innerHTML + `
                    <label>Role :</label>
                    <label for="role" class="switch">
                    <input type="checkbox" name="role" id="role" checked>
                    <span class="slider round"></span>
                    </label>
                    `;
                }
                let adminChecker = document.getElementById("role");
                adminChecker.addEventListener("click", function(){
                    alert(id);
                    adminSliderChecker(data["ID de l'utilisateur"]);
                });
            }
            else
            {
                if(data[key] !== null)
                {
                    detailSection.innerHTML = detailSection.innerHTML + `
                    <p>${key} : ${data[key]}</p>
                    `;
                }
                else
                {
                    detailSection.innerHTML = detailSection.innerHTML + `
                    <p>${key} : null</p>
                    `;
                }
            }
        }
        i++;
    }
}