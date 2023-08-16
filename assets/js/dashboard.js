window.addEventListener("DOMContentLoaded", function()
{
    initDashboard();
    displayDetailsUsers();
})


//** ------------------------------------- */
//* Fonction d'initialisation et d'écoute de
//* click dans les liens de la nav de control 
//** ------------------------------------- */
function initDashboard()
{
    const links = [
        document.getElementById("users-link"),
        document.getElementById("messages-link"),
        document.getElementById("templates-link"),
        document.getElementById("reviews-link")
    ];

    const sections = [
        document.getElementById("users-section"),
        document.getElementById("messages-section"),
        document.getElementById("templates-section"),
        document.getElementById("reviews-section")
    ];

    for(let i = 0; i < links.length; i++)
    {
        links[i].addEventListener("click", function(){
            toggleTables(sections, sections[i]);
        })
    }
}

//** --------------------------------------------- */
//* Cette fonction affiche/cache les sections, 
//* en fonction du lien clické dans la nav de control
//** --------------------------------------------- */
function toggleTables(sections, section)
{
    sections.forEach(function(sect)
    {
        
        if(section === sect)
        {
            
            sect.classList.remove("hidden");
            let table = sect.querySelector("table");
            initOptionsSelector(table);
            searchParams(table);
        }
        else
        {
            sect.classList.add("hidden");
        }
    })
}

//** --------------------------------------------------- */
//* Cette fonction sert à initialiser les options du select
//** --------------------------------------------------- */
function initOptionsSelector(table)
{
    const dataSelection = document.getElementById("data-selection");
    let theadsTab = table.querySelectorAll("th");
    while(dataSelection.childElementCount > 0)
    {
        dataSelection.removeChild(dataSelection.firstChild);
    }
    theadsTab.forEach(function(thead){
        let option = document.createElement("option");
        option.textContent = thead.textContent;
        dataSelection.appendChild(option);
    })
}

function searchParams(table) //* paramètre de la table choisie
{
    let searchbar = document.getElementById("searchbar"); //* get de l'input searchbar
    let select = document.getElementById("data-selection"); //* get l'élément de selection
    let colIndex; //* initialisation de la variable qui contient l'index de la colonne choisie
    let content;

    select.addEventListener("change", function(){ //* si l'option du select choisie à changée
        colIndex = select.selectedIndex; //* on récupère l'index de cette option
        content = searchbar.value.toLowerCase();
        displayLine(table, colIndex, content);
    })

    searchbar.addEventListener("keyup", function(){ //* Si le texte de la searchbar est modifier
        colIndex = select.selectedIndex; //* on récupère l'index de cette option
        content = searchbar.value.toLowerCase();
        displayLine(table, colIndex, content);
    })
}

function displayLine(table, colIndex, content)
{
    let tbody = table.querySelector("tbody"); //* get de l'élément body de la table choisie
    let trow = tbody.querySelectorAll("tr"); //* get des rows du tbody de la table choisie
    trow.forEach(function(row) //* Pour chaques lignes de la table
    { 
        row.classList.add("hidden"); //* on cache la ligne
        let datasTab = row.querySelectorAll("td"); //* on get toute les données de la ligne
        let i = 0;
        datasTab.forEach(function(data)
        {
            if(content !== undefined)
            {
                let dataContent = data.textContent.toLowerCase();
                if(dataContent.includes(content) && colIndex === i)
                {
                    row.classList.remove("hidden"); //* on affiche la ligne
                }
            }
            i++;
        })
    })
}

//** --------------------------------------------- */
//* Cette fonction affiche les détail de la sélection
//** --------------------------------------------- */
function displayDetailsUsers()
{
    let usersBtns = document.getElementsByClassName("user-btn");
    let usersBtnsArray = Array.from(usersBtns);

    usersBtnsArray.forEach(function(btnUser){
        btnUser.addEventListener("click", function(){
            usersBtnsArray.forEach(function(btnUser){
                let othersDetail = document.getElementById("detail-user" + btnUser.id);
                othersDetail.classList.add("hidden");
            })
            let detail = document.getElementById("detail-user" + btnUser.id);
            detail.classList.remove("hidden");
        })
    })
}