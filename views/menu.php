<?php

include_once("./database/header.inc.php");
require_once('./database/plat.php');

// $selectMenus = $bdd->query("SELECT * FROM plats");
$selectMenus = Plat::SelectAll();

// Id of the item added to the cart
$ajouterPanier = filter_input(INPUT_GET, 'ajouter', FILTER_SANITIZE_STRING);

//Bouton pour valider la quantité de plat
$validerQuantite = filter_input(INPUT_POST, 'validerQuantite');

//Clé pour chaque élément du tableau qui représentera la panier de l'utilisateur
$keysForBasket = array("nomPlat", "descriptifPlat", "prixPlat", "quantitePlat");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <link href="./styles/style.css" rel="stylesheet">
    <title>Menu</title>
</head>

<body>
    <style>
        body {
            height: 100vh;
            background-image: linear-gradient(to right top, #da9eff, #2984b5);
        }
    </style>
    <div class="navigation">
        <?php
        include "nav.php";
        ?>
        <div id="affichage">
            <div id="texte">
                <?php
                // Show the menu
                foreach ($selectMenus as $s) {
                    echo "<form method='POST' action='#'>";
                    echo "<div class='plat'>";
                    echo "<h2>" . $s["nomPlat"] . "</h2>";
                    echo "<p>" . $s["descriptifPlat"] . "</p>";
                    echo "<p class=\"prix\">" . $s["prixPlat"] . " CHF</p>";
                    if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == true) {
                        echo "<input style='width:auto;' type='number' class='form-control' name='quantitePlat' value=" . $_SESSION['quantitePlat'] .  " min='1' max='10'/>";
                        echo "<input style='width:auto; margin:auto;' name='validerQuantite' class='form-control btn-info' type='submit' value='Valider la quantité'/>";
                    }
                    echo "<br/>";
                    echo "<p>";
                    if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == true) {
                        echo "<a class='btn btn-success' href=\"index.php?action=menu&ajouter=" . $s["idPlats"] . "\">Ajouter au panier</a>";
                    } else {
                        echo "<a class='btn btn-success' href=\"index.php?action=connexion&accountExists=false\">Ajouter au panier</a>";
                    }
                    echo "</p>";

                    if (isset($validerQuantite)) {
                        if ($_POST['quantitePlat'] >= 1 && $_POST['quantitePlat'] <= 10) {
                            $quantiteDuPlat = $_POST['quantitePlat'];
                        }
                        $_SESSION['quantitePlat'] = $quantiteDuPlat;
                    }

                    if (!isset($_SESSION["panier"])) {
                        $_SESSION["panier"] = array();
                    }

                    if ($ajouterPanier == $s["idPlats"]) {

                        if (isset($_SESSION['quantitePlat'])) {

                            unset($s['idPlats']);
                            $tableauPlat = array();
                            $tableauPlat = $s;
                            $tableauPlat['quantitePlat'] = $_SESSION['quantitePlat'];

                            array_push($_SESSION["panier"], array_combine($keysForBasket, $tableauPlat));
                            $_SESSION['quantitePlat'] = 0;
                        } else {
                            
                            echo "<p class='alert alert-danger'>Veuillez séléctionner une quantité!</p>";
                        }
                    }
                    echo "</div>";
                    echo "</form>";
                }
                ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>

</html>