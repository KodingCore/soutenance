window.addEventListener("DOMContentLoaded", function()
{
    initDashboard();
})


//** ------------------------------------------------- */
//* Fonction d'initialisation des tables et,
//* d'écoute de click dans les liens de la nav de control 
//** ------------------------------------------------- */
function initDashboard()
{
    const links = [
        document.getElementById("users-link"),
        document.getElementById("messages-link"),
        document.getElementById("templates-link"),
        document.getElementById("reviews-link")
    ];

    const tables = [
        document.getElementById("users-table"),
        document.getElementById("messages-table"),
        document.getElementById("templates-table"),
        document.getElementById("reviews-table")
    ];

    for(let i = 0; i < links.length; i++)
    {
        links[i].addEventListener("click", function(){
            toggleTables(tables, tables[i]);
        })
    }
}

//** --------------------------------------------- */
//* Cette fonction affiche/cache les tables, 
//* en fonction du lien clické dans la nav de l'aside
//** --------------------------------------------- */
function toggleTables(tables, table)
{
    tables.forEach(function(tab)
    {
        if(table === tab)
        {
            tab.classList.remove("hidden");
            initOptionsSelector(tab);
            searchbarDashboard(tab);
        }
        else
        {
            tab.classList.add("hidden");
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

// function colloneSelected()

function searchbarDashboard(table) //* paramètre de la table choisie
{
    let searchbar = document.getElementById("searchbar"); //* get de l'input searchbar
    let tbody = table.querySelector("tbody"); //* get de l'élément body de la table choisie
    let trow = tbody.querySelectorAll("tr"); //* get des rows du tbody de la table choisie
    let select = document.getElementById("data-selection"); //* get l'élément de selection
    let colIndex; //* initialisation de la variable qui contient l'index de la colonne choisie
    let colSearch;

    select.addEventListener("change", function(){ //* si l'option du select choisie à changée
        colIndex = select.selectedIndex; //* on récupère l'index de cette option
    })   
    
    trow.forEach(function(row){ //* Pour chaques lignes de la table
        
        let datasTab = row.querySelectorAll("td"); //* on get toute les données de la ligne

        row.classList.remove("hidden"); //* on affiche la ligne

        let i = 0;

        searchbar.addEventListener("keyup", function(){ //* Si le texte de la searchbar est modifier

        })

        select.addEventListener("change", function(){ //* si l'option du select change
            
        })

        // datasTab.forEach(function(data){
        //     if(i === colIndex)
        //     {
        //         searchbar.addEventListener("keyup", function(){
        //             let content = data.textContent.toLowerCase();
        //             if(data.classList.contains("email"))
        //             {
        //                 content = content.split("@")[0];
        //             }
                
        //             if(content.includes(searchbar.value))
        //             {
        //                 row.classList.remove("hidden");
        //             }
        //         })
        //     }
        //     i++;
        // })
    })

    
    
    // searchbar.addEventListener("keyup", function(){
    //     datas.forEach(function(data)
    //     {
    //         data.parentNode.classList.add("hidden");
    //     })
    //     datas.forEach(function(data)
    //     {
    //         let content = data.textContent.toLowerCase();
    //         if(data.classList.contains("email"))
    //         {
    //             content = content.split("@")[0];
    //         }

    //         if(content.includes(searchbar.value))
    //         {
    //             data.parentNode.classList.remove("hidden");
    //         }
    //     })
    //     if(searchbar.value === null)
    //     {
    //         datas.forEach(function(data)
    //         {
    //             data.parentNode.classList.remove("hidden");
    //         })
    //     }
    // })
}