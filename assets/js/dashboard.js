window.addEventListener("DOMContentLoaded", function()
{
    initDashboard();
})

//* -----------------------------------------------------------------------------
//* -----------------------------DATA INITIALISATION-----------------------------
//* -----------------------------------------------------------------------------

//** ----------------------------------- */
//*  Initialisation et écoute des clicks
//*  dans les liens de la nav de control
//** ----------------------------------- */
function initDashboard()
{
    //* Noms des parties controllées par le dashboard
    const controlNavLinks = [
        document.getElementById("user-link"),
        document.getElementById("info-link"),
        document.getElementById("message-link"),
        document.getElementById("template-link"),
        document.getElementById("category-link"),
        document.getElementById("review-link"),
        document.getElementById("appointment-link"),
        document.getElementById("quotation-link"),
        document.getElementById("tag-link")
    ];

    //* Écoute des click dans la nav de control
    controlNavLinks.forEach(function(link){
        link.addEventListener("click", function(){
            //* Affichage du tableau
            fetchingControlDatas(link);
        })
    })
}

//* -----------------------------------------------------------------------------
//* -----------------------------CRÉATION DU TABLEAU-----------------------------
//* -----------------------------------------------------------------------------

//** --------------------------------- */
//*  Reset la section de control
//*  Reçoi la data et appel les 
//*  fonctions de créations du tableau
//** --------------------------------- */
function fetchingControlDatas(link)
{
    const controlSection = document.getElementById("control-section");

    fetch(`index.php?route=${link.id}`)
        .then(response => 
            response.json()
            )
        .then(data => 
        {   
            for(let key in data) //* pour chaques valeur de la data
            {
                controlSection.innerHTML = ""; //* On reset la section de control
                setControlTitle(controlSection, key); //* Initialisation du titre de la section 
                createAddBtns(data[key][0], controlSection, link);
                createStructureTable(controlSection); //* Création de la structure du tableau
                for(let attributName in data[key][0]) //* Pour chaques attributs de la classe
                {
                    completeHeaderTable(attributName); //* On défini le header du tableau
                }
                for(let object in data[key]) //* Pour chaques objet de la data
                {
                    let bodyRow = completeBodyTable(data[key][object]); //* On appel la fonction de création du body
                    createControlBtns(data[key][0], link, bodyRow);
                }
            }
            initOptionsSelector();
            searchParams();
        })
        .catch(error => console.error("Une erreur s'est produite", error));
}

//** --------------------------- */
//*  Crée un bouton d'ajout en
//*  fonction du control choisit
//** --------------------------- */
function createAddBtns(attributsNames, controlSection, link)
{
    const controlName = link.id.split("-")[0];
    if(controlName === "template" || controlName === "category" || 
        controlName === "appointment" || controlName === "quotation")
    {
        const addBtn = document.createElement("button");
        addBtn.classList.add("add-btn");
        addBtn.id = "add-" + controlName;
        addBtn.textContent = "add " + controlName;
        controlSection.appendChild(addBtn);

        //* Écoute click d'ajout
        addBtn.addEventListener("click", function(){
            //* Affichage de la section d'ajout / d'édition
            displayAddEditForm(attributsNames, link, "add");
        })
    }
}

//** --------------------------------- */
//*  Initialise le titre de la section
//** --------------------------------- */
function setControlTitle(section, title)
{
    const controlTitle = document.createElement("h2");
    
    controlTitle.id = "control-title";
    controlTitle.textContent = "Panneau de control des " + title;
    section.appendChild(controlTitle);
}
//** ---------------------------------- */
//*  Initialise la structure du tableau
//** ---------------------------------- */
function createStructureTable(section)
{
    const controlTable = document.createElement("table");
    const headerTable = document.createElement("thead");
    const rowHeader = document.createElement("tr");
    const bodyTable = document.createElement("tbody");
    
    section.appendChild(controlTable);
    controlTable.id = "control-table";
    
    controlTable.appendChild(headerTable);

    headerTable.appendChild(rowHeader);
    rowHeader.id = "row-head";

    controlTable.appendChild(bodyTable);
    bodyTable.id = "body-table";
}

//** ----------------------------- */
//*  Complète l'en-tête du tableau
//** ----------------------------- */
function completeHeaderTable(headerCellName)
{
    const rowHeader = document.getElementById("row-head");
    const headCell = document.createElement("th");
    const textNodeCell = document.createTextNode(headerCellName);
    
    if(headerCellName.toLowerCase().includes("id"))
    {
        headCell.classList.add("col-id");
    }
    else
    {
        headCell.classList.add("col-other");
    }

    rowHeader.appendChild(headCell);
    headCell.appendChild(textNodeCell);
}

//** ---------------------------- */
//*  Complète le corps du tableau
//** ---------------------------- */
function completeBodyTable(objectForCellsValues)
{
    const bodyTable = document.getElementById("body-table");
    const bodyRow = document.createElement("tr");

    bodyTable.appendChild(bodyRow);
    for(let key in objectForCellsValues)
    {
        const cell = document.createElement("td");
        
        if(key.toLowerCase().includes("id"))
        {
            cell.classList.add("col-id");
        }
        else
        {
            cell.classList.add("col-other");
        }
        bodyRow.appendChild(cell);
        const textNodeCell = document.createTextNode(objectForCellsValues[key]);
        cell.appendChild(textNodeCell);
    }
    return bodyRow;
}

//** --------------------------------- */
//*  Crée les boutons de fin de lignes
//*  pour éditer ou supprimer
//** --------------------------------- */
function createControlBtns(attributsNames, link, row)
{
    const className = link.id.split("-")[0];
    if(className === "template" || className === "category" || className === "appointment" || className === "quotation" || className === "user")
    {
        const editBtn = document.createElement("button");
        editBtn.classList.add("edit-btn");
        editBtn.id = "edit" + row.firstChild.textContent;
        row.appendChild(editBtn);
        editBtn.textContent = "Éditer";
        editBtn.addEventListener("click", function(){
            //* Affichage de la section d'ajout / d'édition
            displayAddEditForm(attributsNames, link, "edit", row);
        })
    }
    
    const removeBtn = document.createElement("button");
    removeBtn.classList.add("remove-btn");
    removeBtn.id = "remove" + row.firstChild.textContent;
    row.appendChild(removeBtn);
    removeBtn.textContent = "Supprimer";
    removeBtn.addEventListener("click", function(){
        const idRow = row.getElementsByTagName("td")[0].textContent;
        removeData(link, className, idRow);
    })
}

//* -----------------------------------------------------------------------------
//* -----------------------------------RECHERCHE---------------------------------
//* -----------------------------------------------------------------------------

//** ---------------------------------- */
//*  Initialise les options du select
//*  en fonction de la class controllée
//** ---------------------------------- */
function initOptionsSelector()
{
    const columnSelection = document.getElementById("column-selection"); //* Récuperation du select
    const theadsTab = document.querySelectorAll("th"); //* Récuperation des en-têtes du tableau
    while(columnSelection.childElementCount > 0)
    {
        columnSelection.removeChild(columnSelection.firstChild);
    }
    theadsTab.forEach(function(thead)
    {
        const option = document.createElement("option");
        option.textContent = thead.textContent;
        columnSelection.appendChild(option);
    })
}

//** ------------------------------------------------- */
//*  Écoute les relachements clavier dans la searchbar
//*  et les changements d'options du selecteur
//*  Calcul la colonne résultante
//** ------------------------------------------------- */
function searchParams()
{
    const taleau = document.getElementById("control-table");
    const searchbar = document.getElementById("searchbar"); //* Récuperation de l'input searchbar
    const select = document.getElementById("column-selection"); //* Récuperation l'élément de selection
    let colIndex; //* initialisation de la variable qui contient l'index de la colonne choisie
    let content; //* Variable du contenu de tête de colonne

    select.addEventListener("change", function() //* Si l'option du select choisie à changée
    {
        colIndex = select.selectedIndex; //* Récupèration de l'index de cette option
        content = searchbar.value.toLowerCase(); //* Définie le contenu en lowercase pour la comparaison
        displayLine(taleau, colIndex, content);
    })

    searchbar.addEventListener("keyup", function() //* Si le texte de la searchbar est modifier
    {
        colIndex = select.selectedIndex; //* Récuperation de l'index de cette option
        content = searchbar.value.toLowerCase(); //* Définie le contenu en lowercase pour la comparaison
        displayLine(taleau, colIndex, content);
    })
}

//** --------------------------------- */
//*  Check le matching de la searchbar
//*  et affiche les lignes en fonction
//*  Cache les autres lignes
//** --------------------------------- */
function displayLine(table, colIndex, content)
{
    let tbody = table.querySelector("#body-table"); //* Récuperation de l'élément body de la table choisie
    let trow = tbody.querySelectorAll("tr"); //* Récuperation des rows du tbody de la table choisie
    trow.forEach(function(row) //* Chaques lignes de la table
    { 
        row.classList.add("hidden"); //* Cacher la ligne
        let datasRow = row.querySelectorAll("td"); //* Récuperation de toute les données de la ligne
        let i = 0; //* Itération
        datasRow.forEach(function(data) //* Pour chaque données de cette ligne
        {
            if(content !== undefined) //* S'il y a un contenu
            {
                let dataContent = data.textContent.toLowerCase(); //* Récuration de la data en lowercase
                //* Si la data inclue ce qui est dans la searchbar, 
                //* et que ceci se trouve dans la colonne qui est recherchée
                if(dataContent.includes(content) && colIndex === i)  
                {
                    row.classList.remove("hidden"); //* on affiche la ligne
                }
            }
            i++; //* Itération
        })
    })
}

//* -----------------------------------------------------------------------------
//* -------------------------AJOUT/EDITION/SUPPRESSION---------------------------
//* -----------------------------------------------------------------------------

//** ---------------------------------------- */
//*  Génère le formulaire d'ajout
//*  en récuperant en paramètres
//*  les attributs de la calsse par le fatech
//** ---------------------------------------- */
function displayAddEditForm(attributsNames, link, action, row = null) //* action >>> "edit" ou "add"
{
    const addEditSection = document.getElementById("add-edit-section"); //* Variable contenant la section d'ajout / édition
    addEditSection.innerHTML = ""; //* On reset la section d'ajout / d'édition

    const className = link.id.split("-")[0]; //* Récupération du nom de la classe en splitant le lien de la nav correspondante

    const addEditFormTitle = document.createElement("h2"); //* Création du titre de la section
    
    if(action === "add") //* Si l'action est d'ajouter
    {
        addEditFormTitle.textContent = "Ajouter un(e) "; //* On set le text du titre pour l'ajout
    }
    else if(action === "edit") //* Si l'action est d'éditer
    {
        addEditFormTitle.textContent = "Éditer un(e) "; //* On set le text du titre pour l'édition
    }
    addEditFormTitle.textContent = addEditFormTitle.textContent + className; //* Ajout du nom de la classe au titre de la section
    addEditSection.appendChild(addEditFormTitle); //* Ajout de l'élément de titre h2

    const addEditForm = document.createElement("form"); //* Création du formulaire de la section
    addEditSection.appendChild(addEditForm); //* Ajout du formulaire de la section

    let i = 0; //* itération
    let inputsElements = []; //* Tableau vide qui contiendra les inputs du formulaire

    for(let attribut in attributsNames) //* Pour chaque attributs de la classe
    {
        if(i === 0 && action === "edit") //* Si l'iteration est à 0 (ID) et que l'action est d'éditer
        {
            const idCell = row.getElementsByTagName("td")[0]; //* On récupère la cellude de l'id
            const fieldsetElement = document.createElement("fieldset"); //* On crée un element fieldset
            addEditForm.appendChild(fieldsetElement); //* On Ajoute le fieldset

            const idElement = document.createElement("p"); //* On crée un element p
            idElement.textContent = attribut + ":" + idCell.textContent; //* On set le texte de l'élément p avec l'attribut et l'id
            fieldsetElement.appendChild(idElement);  //* On Ajoute le p
        }
        if(i > 0 && className !== "user") //* Si l'ittération est supérieur à 0 et que la class n'est pas user
        {
            const fieldsetElement = document.createElement("fieldset");
            addEditForm.appendChild(fieldsetElement);

            const labelElement = document.createElement("label");
            labelElement.textContent = attribut;
            labelElement.setAttribute("for", "input-" + attribut)
            fieldsetElement.appendChild(labelElement);

            let inputElement = null;
            
            if(attribut.toLowerCase().includes("contenu") || attribut.toLowerCase().includes("description"))
            {
                inputElement = document.createElement("textarea");
            }
            else
            {
                inputElement = document.createElement("input");
            }
            
            if(attribut.toLowerCase().includes("id"))
            {
                inputElement.setAttribute("type", "number");
            }
            else if(attribut.toLowerCase().includes("date"))
            {
                inputElement.setAttribute("type", "date");
            }
            else if(attribut.toLowerCase().includes("heure"))
            {
                inputElement.setAttribute("type", "time");
            }
            else
            {
                inputElement.setAttribute("type", "text");
            }
            inputElement.id = "input-" + attribut;

            if(action === "edit")
            {
                const cellsRow = row.getElementsByTagName("td");
                inputElement.value = cellsRow[i].textContent;
            }

            fieldsetElement.appendChild(inputElement);

            inputsElements.push(inputElement);
        }
        if(i !== 0 && className === "user")
        {
            const cellsRow = row.getElementsByTagName("td");

            const fieldsetElement = document.createElement("fieldset");
            addEditForm.appendChild(fieldsetElement);

            const labelElement = document.createElement("label");
            
            labelElement.textContent = attribut;
            labelElement.setAttribute("for", "input-" + attribut)
            fieldsetElement.appendChild(labelElement);

            let element = null;
            let info = null;
            
            if(attribut.toLowerCase().includes("rôle"))
            {
                element = document.createElement("input");
                element.setAttribute("type", "checkbox");
                if(cellsRow[i].textContent === "admin")
                {
                    element.setAttribute("checked", "");
                }
            }
            else
            {
                info = document.createElement("p");
                info.textContent = cellsRow[i].textContent;
            }
            if(element)
            {
                fieldsetElement.appendChild(element);
                inputsElements.push(element);
            }
            else
            {
                fieldsetElement.appendChild(info);
            }
            
        }
        i++;
    }
    const addEditBtn = document.createElement("button");
    if(action === "add")
    {
        addEditBtn.textContent = "Ajouter";
    }
    else if(action === "edit")
    {
        addEditBtn.textContent = "Éditer";
    }
    
    addEditForm.appendChild(addEditBtn);

    addEditBtn.addEventListener("click", function(event){
        event.preventDefault();
        if(action === "add")
        {
            addData(className, inputsElements, link);
        }
        else if(action === "edit")
        {
            editData(className, inputsElements, row.getElementsByTagName("td")[0].textContent, link);
        }
    })
}


//** ------------------------------- */
//*  Ajoute la data si validation du
//*  formaulaire d'ajout
//** ------------------------------- */
function addData(className, inputs, link)
{
    let stringRoute = `index.php?route=add-${className}`;
    for(let key in inputs)
    {
        stringRoute = stringRoute + `&${key}=${inputs[key].value}`;
    }
    fetch(stringRoute)
        .then(result => {
            fetchingControlDatas(link);
        })
        .catch(error => {
            console.error('Une erreur est survenue :', error);
        });
}

//** ------------------------------ */
//*  Édite la data si validation du
//*  formulaire d'édition
//** ------------------------------ */
function editData(className, inputs, id, link)
{
    console.log(className + " " + inputs + " " + id + " " + link)

    let stringRoute = `index.php?route=edit-${className}&id=${id}`;
    for(let key in inputs)
    {
        if(className !== "user")
        {
            stringRoute = stringRoute + `&${key}=${inputs[key].value}`;
        }
        else
        {
            if(inputs[key].checked)
            {
                stringRoute = stringRoute + `&${key}=admin`;
            }
            else
            {
                stringRoute = stringRoute + `&${key}=user`;
            }
            
        }
    }
    console.log(stringRoute);
    fetch(stringRoute)
        .then(result => {
            fetchingControlDatas(link);
        })
        .catch(error => {
            console.error('Une erreur est survenue :', error);
        });
}

//** --------------------------------- */
//*  Supprime la data par click sur le
//*  bouton de suppression de la ligne
//** --------------------------------- */
function removeData(link, className, id)
{
    fetch(`index.php?route=delete-${className}&id=${id}`)
        .then(result => {
            fetchingControlDatas(link);
        })
        .catch(error => {
          console.error('Une erreur est survenue :', error);
        });
}