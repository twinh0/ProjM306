<?php
include("./database/header.inc.php");
require_once('./database/plat.php');

// $selectMenus = $bdd->query("SELECT * FROM plats");
$selectMenus = Plat::SelectAll();

// Id of the item added to the cart
$ajouterPanier = filter_input(INPUT_GET, 'ajouter', FILTER_SANITIZE_STRING);

// See if the session "panier" exist
// if(!isset($_SESSION["panier"])){
//     $_SESSION["panier"] = array();
// }
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
        <div id="affichage">
            <div id="texte">
                <?php
                // Show the menu
                foreach ($selectMenus as $s) {
                    echo "<h2>" . $s["nomPlat"] . "</h2>";
                    echo "<p>" . $s["descriptifPlat"] . "</p>";
                    echo "<p class=\"prix\">" . $s["prixPlat"] . ".- </p>";

                    //Ajout de l'input type "number" pour sélectionner la quantité de chaque produit
                    // echo "<input type='number' name='quantite' value='1' min='1'/>";
                    // echo nl2br("<br/>");


                    echo "<a style=\" color:#d08352;\" href=\"index.php?action=menu&ajouter=" . $s["idPlats"] . "\">Ajouter au panier</a>";
                    if(!isset($_SESSION["panier"])){
                        $_SESSION["panier"] = array();
                    }         
                    if ($ajouterPanier == $s["idPlats"]) {
                        array_push($_SESSION["panier"], array($s["nomPlat"], $s["descriptifPlat"], $s["prixPlat"]));
                        header("Location: index.php?action=menu");
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>

</html>