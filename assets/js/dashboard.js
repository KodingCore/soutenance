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
    const links = [ //* L'ordre est important ici
        document.getElementById("users-link"),
        document.getElementById("messages-link"),
        document.getElementById("templates-link"),
        document.getElementById("reviews-link")
    ];

    const sections = [ //* L'ordre est important ici
        document.getElementById("users"),
        document.getElementById("messages"),
        document.getElementById("templates"),
        document.getElementById("reviews")
    ];

    for(let i = 0; i < links.length; i++)
    {
        links[i].addEventListener("click", function(){
            toggleTables(sections, sections[i]);
            displayDetails(sections[i]);
        })
    }

    
}

//** -------------------------------------- */
//*  afficher/cacher les sections, en fonction
//*  du lien clické dans la nav de control
//** -------------------------------------- */
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
            if(section.id === "templates")
            {
                section.innerHTML = '<button id="add-template">Add a template</button>';
            }
        }
        else
        {
            sect.classList.add("hidden");
        }
    })
}

//** ----------------------------- */
//*  Initialise les options du select
//*  En fonction de la categorie
//** ----------------------------- */
function initOptionsSelector(table)
{
    const columnSelection = document.getElementById("column-selection"); //* Récuperation du select
    let theadsTab = table.querySelectorAll("th"); //* Récuperation des en-têtes du tableau
    while(columnSelection.childElementCount > 0)
    {
        columnSelection.removeChild(columnSelection.firstChild);
    }
    theadsTab.forEach(function(thead){
        let option = document.createElement("option");
        option.textContent = thead.textContent;
        columnSelection.appendChild(option);
    })
}

//** --------------------------------------------- */
//*  Écoute les relachement clavier dans la searchbar
//*  Et les changements d'options du selecteur
//*  Calcul la colonne résultante
//** --------------------------------------------- */
function searchParams(table) //* paramètre de la table choisie
{
    let searchbar = document.getElementById("searchbar"); //* Récuperation de l'input searchbar
    let select = document.getElementById("column-selection"); //* Récuperation l'élément de selection
    let colIndex; //* initialisation de la variable qui contient l'index de la colonne choisie
    let content; //* Variable du contenu de tête de colonne

    select.addEventListener("change", function(){ //* Si l'option du select choisie à changée
        colIndex = select.selectedIndex; //* Récupèration de l'index de cette option
        content = searchbar.value.toLowerCase(); //* Définie le contenu en lowercase pour la comparaison
        displayLine(table, colIndex, content);
    })

    searchbar.addEventListener("keyup", function(){ //* Si le texte de la searchbar est modifier
        colIndex = select.selectedIndex; //* Récuperation de l'index de cette option
        content = searchbar.value.toLowerCase(); //* Définie le contenu en lowercase pour la comparaison
        displayLine(table, colIndex, content);
    })
}

//** ------------------------------ */
//*  Check le matching de la searchbar
//*  Et affiche la ligne en fonction
//*  Cache les autres lignes
//** ------------------------------ */
function displayLine(table, colIndex, content)
{
    let tbody = table.querySelector("tbody"); //* Récuperation de l'élément body de la table choisie
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

//** -------------------------------- */
//*  Affiche les détails de la sélection
//** -------------------------------- */
function displayDetails(sectionUsed) {
    let detailSection = document.querySelector("#details");
    let btns = sectionUsed.getElementsByClassName("row-btn");
    let btnsArray = Array.from(btns);
    let route = sectionUsed.id;

    detailSection.classList.add("hidden");

    btnsArray.forEach(function(btn) {
        btn.addEventListener("click", function() {
            let target = btn.id;
            
            fetch(`index.php?route=${route}&id=${target}`)
                .then(response => response.json())
                .then(data => {

                    let i = 0;
                    detailSection.classList.remove("hidden");
                    

                    for (let key in data) {
                        
                        if (data.hasOwnProperty(key)) {
                            
                            if(i === 0)
                            {   
                                detailSection.innerHTML = 
                                '<div id="detail-title">' +
                                    '<h3>Détails ' + route + '</h3>' +
                                '</div>'
                                ;
                            }
                            if(key === "role")
                            {
                                detailSection.innerHTML = detailSection.innerHTML +
                                `<label for="role">Role :</label>
                                <input name="role" type="text" value="${data["role"]}"/>`;
                            }
                            else
                            {
                                detailSection.innerHTML = detailSection.innerHTML +`
                                    <p>${key} : ${data[key]}</p>
                                `;
                            }
                            
                            i++;
                        }
                    }
                })
                .catch(error => console.error("Une erreur s'est produite", error));
        });
    });
}
