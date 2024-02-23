<?php 

/* Insère le header que l'on va chercher dans un fichier  à part. contient le doctype et tout le début du code qui va se répêter sur toutes les pages */
    require_once('templates/header.php');
    // si on fait require() plusieurs fois, ça va insérer le code plusieurs fois si on fait require_once() ça n'incluera le code qu'une fois même si on l'a mis plusieurs fois.
    require_once('lib/recipes.php');

    //appel de la fonction get recipes qui appelle toutes les recettes
$recipes = getRecipes($pdo);

?>

<h1>Liste des recettes</h1>


        <div class="row">
            <?php foreach ($recipes as $key => $recipe) { 
                include('templates/recipe_partial.php');
            } ?>

            <!-- Insère le footer que l'on va chercher dans un fichier à part. Le footer contient la balise html fermante-->
            <?php
                require('templates/footer.php');
            ?>
            
        
        