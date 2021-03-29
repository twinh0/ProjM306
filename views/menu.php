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
                    echo "<div class='plat'>";
                    echo "<h2>" . $s["nomPlat"] . "</h2>";
                    echo "<p>" . $s["descriptifPlat"] . "</p>";
                    echo "<p class=\"prix\">" . $s["prixPlat"] . ".- </p>";
                    echo "<p>";
                    if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == true){
                        echo "<a class='btn btn-success' href=\"index.php?action=menu&ajouter=" . $s["idPlats"] . "\">Ajouter au panier</a>";
                    }else{
                        echo "<a class='btn btn-success' href=\"index.php?action=connexion&accountExists=false\">Ajouter au panier</a>";
                    }
                    echo "</p>";
                    if (!isset($_SESSION["panier"])) {
                        $_SESSION["panier"] = array();
                    }
                    if ($ajouterPanier == $s["idPlats"]) {
                        array_push($_SESSION["panier"], array($s["nomPlat"], $s["descriptifPlat"], $s["prixPlat"]));
                        header("Location: index.php?action=menu");
                    }
                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>

</html>