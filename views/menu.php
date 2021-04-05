<?php
include("./database/header.inc.php");
require_once('./database/plat.php');

// $selectMenus = $bdd->query("SELECT * FROM plats");
$selectMenus = Plat::SelectAll();

// Id of the item added to the cart
$ajouterPanier = filter_input(INPUT_GET, 'ajouter', FILTER_SANITIZE_STRING);

//$quantitePourPlat = filter_input(INPUT_POST, 'quantitePourPlat', FILTER_VALIDATE_INT);

$keysForBasket = array("nomPlat", "descriptifPlat", "prixPlat");


// if(!isset($_SESSION['quantitePlat'])){
//     $_SESSION['quantitePlat'] = 1;
// }


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
                    echo "<div class='plat'>";
                    echo "<h2>" . $s["nomPlat"] . "</h2>";
                    echo "<p>" . $s["descriptifPlat"] . "</p>";
                    echo "<p class=\"prix\">" . $s["prixPlat"] . ".- </p>";
                    //echo "<input type='number' name='quantitePourPlat' style='position:relative;' min=1 max=10 placeholder='1'/>";
                    echo "<p>";
                    if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == true) {
                        echo "<a class='btn btn-success' href=\"index.php?action=menu&ajouter=" . $s["idPlats"] . "\">Ajouter au panier</a>";
                    } else {
                        echo "<a class='btn btn-success' href=\"index.php?action=connexion&accountExists=false\">Ajouter au panier</a>";
                    }
                    echo "</p>";
                    if (!isset($_SESSION["panier"])) {
                        $_SESSION["panier"] = array();
                    }
                    if ($ajouterPanier == $s["idPlats"]) {
                        // $_SESSION['quantitePlat'] = $quantitePourPlat;
                        // array_push($_SESSION['panier'], $_SESSION['quantitePlat']);
                        // $nouveauPlat = new Plat($s['idPlats'], $s['nomPlat'], $s['descriptifPlat'], $s['prixPlat'], $_SESSION['quantitePlat']);
                        // Plat::AddQuantiteAPlat($nouveauPlat);
                        unset($s['idPlats']);
                        array_push($_SESSION["panier"], array_combine($keysForBasket, $s));
                        header("Location: index.php?action=menu");
                    }
                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    //Source: https://stackoverflow.com/questions/19966417/prevent-typing-non-numeric-in-input-type-number

        document.querySelector("input").addEventListener("keypress", function(e) {
            const allowedChars = '0123456789';

            function contains(stringValue, charValue) {
                return stringValue.indexOf(charValue) > -1;
            }
            let invalidKey = e.key.length === 1 && !contains(allowedChars, e.key) ||
                e.key === '.' && contains(e.target.value, '.');
            invalidKey && e.preventDefault();
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>

</html>