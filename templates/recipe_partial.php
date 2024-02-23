<!-- Cette page contient les cartes de recettes que l'on retrouve sur la page index et sur la page recettes -->


<div class="col-md-4">
    <div class="card mb-3">
        <img src="<?=getRecipeImage($recipe['image']); ?>" class="card-img-top" alt="<?=$recipe['title'];?>" style="height:300px">
        <div class="card-body">
            <h5 class="card-title"><?=$recipe['title']; ?></h5>
            <p class="card-text"><?=$recipe['description']; ?></p>
            <!-- On récupère la clé Key du for each de l'onglet index.php-->
            <a href="recette.php?id=<?=$recipe['id']?>" class="btn btn-primary">voir la recette</a>
        </div>
    </div>
</div>