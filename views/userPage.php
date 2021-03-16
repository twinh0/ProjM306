<?php
require_once('./database/header.inc.php');
require_once('./database/utilisateur.php');

//Variable qui stocke toutes les données qui concerne le compte de l'utilisateur
$userInfo = Utilisateur::SelectAllInfoFromUser($_SESSION['nomCompte']);

//Pour l'affichage, c-à-d w/o id and pwd
$displayInfo = $userInfo;
unset($displayInfo['idUtilisateur']);
unset($displayInfo['mdp']);


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Profile Page</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href="./styles/style.css" rel="stylesheet">
    <title>Page d'accueil</title>
</head>

<body class="loggedin">

    <div class="navigation">
        <?php
        include "nav.php";
        ?>
    </div>

    <div class="content">
        <h2>Welcome back <?= $userInfo['nomUtilisateur']; ?>!</h2>

        <div>
            <p>Les détails de votre compte:</p>
            <table>
                <?php
                foreach ($displayInfo as $key => $value) {
                    echo '<tr>';
                    echo '<td>';
                    switch ($key) {
                        case 'nomUtilisateur':
                            echo "Nom d'utilisateur: ";
                            break;
                        case 'prenom':
                            echo "Prénom: ";
                            break;
                        case 'nom':
                            echo "Nom: ";
                            break;
                        case 'age':
                            echo "Age: ";
                            break;
                        case 'numTel':
                            echo "Numéro de téléphone: ";
                            break;
                        case 'email':
                            echo "Email: ";
                            break;
                    }
                    echo '</td>';
                    echo '<td>';
                    if (isset($displayInfo[$key])) {
                        echo $displayInfo[$key];
                    }
                    echo '</td>';
                    echo '</tr>';
                }
                ?>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

</body>

</html>