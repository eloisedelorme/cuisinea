<?php 

// constante contenant le début du code chemin pour les liens
    define('_RECIPES_IMG_PATH_', 'uploads/recipes/');
    define('_ASSETS_IMG_PATH_', 'assets/images/');
// constante qui donne le nombre de recettes sur la page d'accueil
    define('_HOME_RECIPES_LIMIT_', 3);



// Tableau contenant les liens pour la nav barre
        $mainMenu = [
            'index.php' => 'Accueil',
            'recettes.php' => 'Nos recettes',
            'ajout_modification_recette.php' => 'Ajouter/Modifer une recette'
        ];

//Ce fichier contiendra uniquement du php, la fermeture de la balise est donc facultative.
?>