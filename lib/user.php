<?php

function addUser(PDO $pdo, string $first_name, string $last_name, string $email, string $password)
{

    // Requête SQL pour insérer un nouvel utilisateur dans la table `users`
    $sql = "INSERT INTO `users` (`first_name`, `last_name`, `email`, `password`, `role`) VALUES (:first_name, :last_name, :email, :password, :role);";

    // Préparation de la requête pour une exécution sécurisée
    $query = $pdo->prepare($sql);

    // Hachage du mot de passe avant de l'enregistrer dans la base de données
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Définition du rôle par défaut de l'utilisateur (à personnaliser si besoin)
    $role = 'subscriber';

    // Liaison des paramètres aux marqueurs de position dans la requête préparée
    $query->bindParam(':first_name', $first_name, PDO::PARAM_STR);
    $query->bindParam(':last_name', $last_name, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->bindParam(':role', $role, PDO::PARAM_STR);

    // Exécution de la requête préparée
    return $query->execute(); // Retourne true si l'insertion a réussi, false sinon
}

function verifyUserLoginPassword(PDO $pdo, string $email, string $password)
{
    // Prépare une requête SQL pour récupérer les informations d'un utilisateur en fonction de son adresse email
    $query = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    //// Lie la valeur de la variable $email au marqueur de position :email dans la requête préparée
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    // Exécute la requête préparée
    $query->execute();
    // Récupère la première ligne de résultat de la requête
    $user = $query->fetch();

    // Si un utilisateur a été trouvé et que le mot de passe fourni correspond
    if ($user && password_verify($password, $user['password'])) {
        // Retourne les informations de l'utilisateur
        return $user;
    } else {
        // Sinon (utilisateur non trouvé ou mot de passe incorrect)
        // Retourne false
        return false;
    }
}
