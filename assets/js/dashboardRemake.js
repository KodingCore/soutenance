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
        document.getElementById("review-link")
    ];

    //* Écoute des click dans la nav de control
    controlNavLinks.forEach(function(link){
        link.addEventListener("click", function(){
            
            //* Affichage du tableau
            fetchingDatas(link);
        })
    })
}

function fetchingDatas(link)
{
    const controlSection = document.getElementById("control-section");

    fetch(`index.php?route=${link.id}`)
        .then(response => response.json())
        .then(data => 
        {   
            let className;
            for(let key in data) //* pour chaques valeur de la data
            {
                //* On reset la section de control
                controlSection.innerHTML = "";
                //* Ecriture du titre du control
                className = key;
                setControlTitle(controlSection, className);
                //* Création de la structure de la table
                createStructureTable(controlSection);
                
                
                for(let attributName in data[className][0]) //* Pour chaques clées des valeurs dans la data
                {
                    //* On défini le header du tableau
                    completeHeaderTable(attributName);
                    
                }
            }
        })
        .catch(error => console.error("Une erreur s'est produite", error));
}

function setControlTitle(section, title)
{
    const controlTitle = document.createElement("h2");
    
    controlTitle.id = "control-title";
    controlTitle.textContent = "Panneau de control des " + title;
    section.appendChild(controlTitle);
}

function createStructureTable(section)
{
    const controlTable = document.createElement("table");
    const headerTable = document.createElement("thead");
    const rowHeader = document.createElement("tr");
    rowHeader.id = "row-head";
    const bodyTable = document.createElement("tbody");
    bodyTable.id = "body-table";

    section.appendChild(controlTable);
    controlTable.appendChild(headerTable);
    headerTable.appendChild(rowHeader);

    controlTable.appendChild(bodyTable);
}

function completeHeaderTable(headerCellName)
{
    const rowHeader = document.getElementById("row-head");
    const headCell = document.createElement("th");
    const textNodeCell = document.createTextNode(headerCellName);
    
    rowHeader.appendChild(headCell);
    headCell.appendChild(textNodeCell);
    // console.log(headerCellsNames);

    
}