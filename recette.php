<?php

/* Insère le header que l'on va chercher dans un fichier  à part. contient le doctype et tout le début du code qui va se répêter sur toutes les pages */
require_once('templates/header.php');
// si on fait require() plusieurs fois, ça va insérer le code plusieurs fois si on fait require_once() ça n'incluera le code qu'une fois même si on l'a mis plusieurs fois.
require_once('lib/recipes.php');

require_once('lib/tools.php');



//On récupère l'id qui est dans l'url (recette.php?id=xx)
$id = (int)$_GET['id'];

$recipe = getRecipeById($pdo , $id);


if ($recipe) {
    // Mettre une image par défaut s'il n'y a pas d'image. L'image apr défaut est cuisine_2 dans images


    // on appelle la fonction linesToArray qui est dans tools.php .
    $ingredients = linesToArray($recipe['ingredients']);
    $instructions = linesToArray($recipe['instructions']);
    ?>



    <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
        <div class="col-10 col-sm-8 col-lg-6">
            <img src="<?=getRecipeImage($recipe['image']); ?>" class="d-block mx-lg-auto img-fluid" alt="<?=$recipe['title']; ?>" width="700" height="500" loading="lazy">
        </div>
        <div class="col-lg-6">
            <h1 class="display-5 fw-bold lh-1 mb-3"><?=$recipe['title']; ?></h1>
            <p class="lead"><?=$recipe['description']; ?></p>
        </div>
    </div>

    <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
        <h2>Ingrédients</h2>
        <ul class="list-group">
            <?php foreach($ingredients as $key => $ingredient ){ ?>
                <li class="list-group-item"><?=$ingredient ;?></li>
            <?php }
            ?>
        </ul>
    </div>

    <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
        <h2>Instructions</h2>
        <ol class="list-group list-group-numbered">
            <?php foreach($instructions as $key => $instruction ){ ?>
                <li class="list-group-item"><?=$instruction ;?></li>
            <?php }
            ?>
        </ol>
    </div>

<?php } else {
    ?> <h1 class="text-center">Recette introuvable </h1>
<?php }; ?> 

<!-- Insère le footer que l'on va chercher dans un fichier  à part. Le footer contient la balise html fermante-->
<?php
require('templates/footer.php');
?>