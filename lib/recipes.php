<?php 

    function getRecipeById(PDO $pdo, int $id) {
                // Prépare une requête SQL qui sélectionne toutes les colonnes (*) de la table "recipes"
        // où la colonne "id" correspond à la valeur liée au paramètre ":identifiant".
        $query = $pdo->prepare("SELECT * FROM recipes WHERE id = :identifiant");

        // Lie la valeur de la variable `$id` au paramètre ":identifiant".
        // L'indice `PDO::PARAM_INT` indique que la valeur doit être traitée comme un entier.(Trés important pour la sécurité !)
        $query->bindParam(':identifiant', $id, PDO::PARAM_INT);
        // Exécute la requête SQL préparée.
        $query->execute();
        // Récupère la première ligne du jeu de résultats sous forme de tableau associatif et la stocke dans la variable `$recipe`.
        // Si aucune ligne correspondante n'est trouvée, `$recipe` sera `false`.
        return $query->fetch();

    }
    //fonction qui gère une image par défaut si la recette n'a pas d'image
    function getRecipeImage(string|null $image){
        if ($image === null){
            return _ASSETS_IMG_PATH_.'cuisine_2.webp';
        } else {
            return _RECIPES_IMG_PATH_.$image;
        }
    }

    // fonction qui récupère les recettes pour la page recettes paramètre par défaut $limit = null

    function getRecipes(PDO $pdo, int $limit = null) {

        // Définir la requête SQL de base. $sql = 'SELECT * FROM recipes ORDER BY RAND() DESC' pour afficher aléatoirement les recettes ;
        $sql = 'SELECT * FROM recipes ORDER BY id DESC' ;
        
        // Si un nombre limite de recettes est spécifié, ajouter la clause LIMIT.
        if ($limit) {
            $sql .= ' LIMIT :limit';
        }

        // Préparer la requête pour éviter les injections SQL.
        $query = $pdo->prepare($sql);

        // Si un nombre limite de recettes est spécifié, lier le paramètre :limit.
        if ($limit) {
            $query->bindParam(':limit', $limit , PDO::PARAM_INT);
        }
        
        // Exécuter la requête et récupérer les résultats et retourner le tableau des recettes.
        $query->execute();
        return $query->fetchAll();
    }

    /* 

Fonction getRecipes(PDO $pdo, int $limit = null) :

Cette fonction récupère des recettes d'une base de données à l'aide d'une connexion PDO et optionnellement limite le nombre de recettes retournées.

Décomposition du code :

Paramètres:

$pdo: Un objet PDO représentant la connexion à la base de données.
$limit (facultatif, valeur par défaut = null): Un entier indiquant le nombre maximum de recettes à récupérer.
Construction de la requête SQL:

La variable $sql est initialisée avec la requête de base qui sélectionne toutes les colonnes (*) de la table recipes et les ordonne par id de manière décroissante (DESC).
Si le paramètre $limit est fourni, on ajoute la clause LIMIT :limit à la requête pour limiter le nombre de résultats.
Préparation de la requête:

La méthode $pdo->prepare($sql) prépare la requête SQL, ce qui permet d'éviter les injections SQL.
Liaison de paramètres (si $limit est fourni):

Si le paramètre $limit est présent, on utilise $query->bindParam(':limit', $limit , PDO::PARAM_INT) pour lier la valeur de $limit au paramètre :limit dans la requête préparée. Cela indique au pilote PDO que la valeur doit être traitée comme un entier.
Exécution de la requête:

La méthode $query->execute() exécute la requête préparée.
Récupération des résultats:

La méthode $query->fetchAll() récupère toutes les lignes du jeu de résultats sous forme d'un tableau associatif à deux dimensions.
Retour des résultats:

La fonction retourne le tableau associatif contenant les recettes récupérées. */

function saveRecipe(PDO $pdo, int $category, string $title, string $description, string $ingredients, string $instructions, string|null $image) {
    $sql = "INSERT INTO `recipes` (`id`, `category_id`, `title`, `description`, `ingredients`, `instructions`, `image`) VALUES (NULL, :category_id, :title, :description, :ingredients, :instructions, :image);";
    $query = $pdo->prepare($sql);
    $query->bindParam(':category_id', $category, PDO::PARAM_INT);
    $query->bindParam(':title', $title, PDO::PARAM_STR);
    $query->bindParam(':description', $description, PDO::PARAM_STR);
    $query->bindParam(':ingredients', $ingredients, PDO::PARAM_STR);
    $query->bindParam(':instructions', $instructions, PDO::PARAM_STR);
    $query->bindParam(':image', $image, PDO::PARAM_STR);
    return $query->execute();
}

?>