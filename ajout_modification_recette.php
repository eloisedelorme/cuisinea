<?php 

    /* Insère le header que l'on va chercher dans un fichier  à part. contient le doctype et tout le début du code qui va se répêter sur toutes les pages */
        require_once('templates/header.php');

        // on verifie que l'utilisateur est connecté. sinon on redirige.
        if(!isset($_SESSION['user'])){
            header('location: login.php');
        }

        // si on fait require() plusieurs fois, ça va insérer le code plusieurs fois si on fait require_once() ça n'incluera le code qu'une fois même si on l'a mis plusieurs fois.
        require_once('lib/recipes.php');
        require_once('lib/tools.php');
        require_once('lib/category.php');

        

        $errors = [];
        $messages = [];

        $categories = getCategories($pdo);

        $recipe = [
            'title' => '',
            'description' => '',
            'ingredients' => '',
            'instructions' => '',
            'category_id' => '',
        ];



if (isset($_POST['saveRecipe'])) {
    $fileName = null;
    // on test si un fichier a été envoyé
    if (isset($_FILES['file']['tmp_name']) && $_FILES['file']['tmp_name'] |= '') {
        $checkImage = getimagesize($_FILES['file']['tmp_name']);
        if ($checkImage !== false) {
            // si c'est une image on déplace le fichier dans uploads
            // pour renommer le fichier on utilise uniqID

            $fileName = uniqid().'-'.slugify($_FILES['file']['name']);

            move_uploaded_file($_FILES['file']['tmp_name'], _RECIPES_IMG_PATH_.$fileName);
        } else {
            //Sinon on affiche un message d'érreur
            $errors[] = "Le fichier doit être une image";
        }
    }

    
    if (!$errors) {
        $res = saveRecipe($pdo, $_POST['category'], $_POST['title'], $_POST['description'], $_POST['ingredients'], $_POST['instructions'], $fileName);
        
        if ($res) {
            $messages[] = 'La recette a bien été sauvegardée';
        } else {
            $errors[] = 'La recette n\'a pas été sauvegardée';
        }
    }
    $recipe = [
        'title' => $_POST['title'],
        'description' => $_POST['description'],
        'ingredients' => $_POST['ingredients'],
        'instructions' => $_POST['instructions'],
        'category_id' => $_POST['category'],
    ];

}

?>

<h1>Ajouter une recette</h1>

<?php foreach ($messages as $message) { ?>
    <div class="alert alert-success">
        <?=$message; ?>
    </div>
<?php }?>

<?php foreach ($errors as $error) { ?>
    <div class="alert alert-danger">
        <?=$error; ?>
    </div>
<?php }?>

<!-- On crée un formulaire enctype="multipart/form-data" pour pouvoir récupèrer les données dans php-->
<form method="POST" enctype="multipart/form-data" >
    <div class="mb-3">
        <!--for fait le lien avec id pour faire le lien entre le label et l'input -->
        <label for="title" class="form-label">Titre</label>
        <input type="text" name="title" id="title" class="form-control">
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea  name="description" id="description" class="form-control" cols="30" row="5"></textarea>
    </div>
    <div class="mb-3">
        <label for="ingredients" class="form-label">Ingrédients</label>
        <textarea  name="ingredients" id="ingredients" class="form-control" cols="30" row="5"></textarea>
    </div>
    <div class="mb-3">
        <label for="instructions" class="form-label">Instructions</label>
        <textarea type="text" name="instructions" id="instructions" class="form-control" cols="30" row="5"></textarea>
    </div>
    <div class="mb-3">
        <label for="category" class="form-label">Catégories</label>
        <select  name="category" id="category" class="form-select">
        <?php foreach ($categories as $category) { ?>
                <option value="<?=$category['id']; ?>" <?php if ($recipe['category_id'] == $category['id']) { echo 'selected="selected"'; } ?>><?=$category['name'];?></option>
            <?php } ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="file" class="form-label">Image</label>
        <input type="file" name="file" id="file">
    </div>

    <input type="submit" value="Enregistrer" name="saveRecipe" class="btn btn-primary">




</form>


        
            <!-- Insère le footer que l'on va chercher dans un fichier  à part. Le footer contient la balise html fermante-->
            <?php
                require('templates/footer.php');
            ?>
            
        
        