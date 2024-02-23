<?php

function getCategories(PDO $pdo) {

    // Définir la requête SQL de base. $sql = 'SELECT * FROM recipes ORDER BY RAND() DESC' pour afficher aléatoirement les recettes ;
    $sql = 'SELECT * FROM categories' ;

    $query = $pdo->prepare($sql);

    $query->execute();
    return $query->fetchAll();
}