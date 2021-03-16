<?php
require_once('./database/header.inc.php');
require_once('./database/utilisateur.php');

//Variable qui stocke toutes les données qui concerne le compte de l'utilisateur
$userInfo = Utilisateur::SelectAllInfoFromUser($_SESSION['nomCompte']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href="./styles/style.css" rel="stylesheet">
    <title>Menu</title>
</head>

<body>
    <div class="navigation">
        <?php
        include "nav.php";
        ?>
        <div class="content">
            <h2>Votre compte a été créé</h2>
            <p>Pour voir la page de votre profil, clickez sur ce lien: <a href="./index.php?action=userPage">Votre compte</p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>

</html>