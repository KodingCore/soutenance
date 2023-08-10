window.addEventListener("DOMContentLoaded", function()
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
            toggleTables(tables[i]);
        })
    }

    function toggleTables(table)
    {
        tables.forEach(function(tab)
        {
            if(table === tab)
            {
                tab.classList.remove("hidden");
            }
            else
            {
                tab.classList.add("hidden");
            }
        })
    }
})