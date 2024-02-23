<?php 
    // Quand on sort une partie du code de la page, il faut faire un require ou include pour rattacher le code au fichier.
    require_once('lib/session.php');
    require_once('lib/config.php');
    require_once('lib/pdo.php');

    // On récupère le chemin pour savoir sur quelle page on est et on prends ce qu'il y a après le dernier / 

    $currentPage = basename($_SERVER['SCRIPT_NAME']);



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/override-bootstrap.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</head>

<body>

    <div class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
            <a href="index.php" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
                <img src="assets/images/logo-cuisinea-horizontal.jpg" alt="Logo Cuisinea" width="250">
            </a>
            <ul class="nav nav-pills col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <!--Pour chaque élément du tableau mainMenu (situé dans le fichier config.php), la clé donne la valeur (clé = page.php, value = Nom de la page) -->
                <?php foreach($mainMenu as $key => $value) {  ?> 
                    <li class="nav-item"><a href="<?=$key; ?>" class="nav-link <?php if ($currentPage === $key) { echo('active'); }?>"><?= $value ; ?></a></li>
                <?php } ?>
                <!-- ?php if ($currentPage === $key) { echo('active'); }? : Si la page courrante est égale à la clé, alors on ajoute la classe active -->
            </ul>
            <div class="col-md-3 text-end">
                <?php if(!isset($_SESSION['user'])) { ?>
                    <a href="login.php" class="btn btn-outline-primary me-2">Se connecter</a>
                    <a href="inscription.php" class="btn btn-outline-primary me-2">S'inscrire</a>
                <?php } else { ?>
                    <a href="logout.php" class="btn btn-primary">Se déconnecter</a>
                <?php } ?>
            </div>
        </header>

    