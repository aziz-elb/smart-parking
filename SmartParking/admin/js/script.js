new DataTable('#example', {
    language: {
        info: 'Affichage de la page _PAGE_ sur _PAGES_',
        infoEmpty: 'Aucun enregistrement disponible',
        infoFiltered: '(filtré parmi un total de _MAX_ enregistrements)',
        lengthMenu: 'Afficher _MENU_ enregistrements par page',
        zeroRecords: 'Aucun résultat trouvé - désolé'
    }
});

// Modification de design de table------------------------
document.getElementById('dt-search-0').placeholder = 'Recherche';

// Récupérer l'élément de recherche par son ID
var searchInput = document.getElementById('dt-search-0');

// Ajouter la classe form-control-lg
searchInput.classList.add('form-control');

// Récupérer l'élément de table par son ID
var table = document.getElementById('example');

// Remplacer les classes existantes par les nouvelles classes Bootstrap
table.className = 'table  table-hover';


// Create a <style> element
var styleElement = document.createElement('style');

// Define CSS rules
var cssRules = `
    label[for="dt-search-0"] {
        display: none;
    }
    #dt-search-0 {
        background-color: white;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px 12px;
        width: 500px;
        margin-left: 0px;
    }

    /* Styles pour les appareils mobiles */
@media only screen and (max-width: 1024px) {
    #dt-search-0 {
        width: 300px; /* Réduire la largeur pour les appareils mobiles */
    }
}
    .page-link {
        color: #212F3C;
    }
    .active > .page-link,
    .page-link.active {
        z-index: 3;
        color: white;
        background-color: #212F3C;
        border-color: #212F3C;
    }
    
`;

// Add CSS rules to the <style> element
styleElement.appendChild(document.createTextNode(cssRules));

// Append the <style> element to the <head>
document.head.appendChild(styleElement);




