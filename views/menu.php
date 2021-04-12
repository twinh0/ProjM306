<?php
include_once("./database/header.inc.php");
require_once('./database/plat.php');

if (isset($_SESSION['idPlats'])) {
    unset($_SESSION['idPlats']);
}

// $selectMenus = $bdd->query("SELECT * FROM plats");
$selectMenus = Plat::SelectAll();

//Bouton pour valider la quantité de plat
$validerQuantite = filter_input(INPUT_POST, 'validerQuantite');

$test = filter_input(INPUT_POST, 'idPlat');

// Id of the item added to the cart
$ajouterPanier = filter_input(INPUT_GET, 'ajouter', FILTER_SANITIZE_STRING);

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
            background-image: url("./ressources/kitchen.jpg");
        }
    </style>
    <div class="navigation">
        <?php
        include "nav.php";
        ?>
        <div id="affichage">
            <div id="texte">
                <style>
                    .dish {
                        margin-top: 5vh;
                    }

                    .card-img-top {
                        opacity: 100%;
                        border-radius: 50%;
                        padding: 5% 5% 0 5%;
                    }

                    .card-text {
                        text-align: left;
                    }

                    .prix {
                        margin: auto;
                        text-align: center;
                    }

                    .prix p {
                        margin-right: 20%;
                        margin-left: 5%;
                    }

                    .prix a{
                        margin-left: 20%;
                        margin-right: 5%;;
                    }
                    .modal-body {
                        margin: auto;
                    }
                </style>
                <div class="dish">
                    <?php
                    // Show the menu
                    foreach ($selectMenus as $s) {
                        echo "<form method='POST' action='#'>";
                        echo "<div class='card bg-dark text-light' style='margin:auto; margin-left:20vw; margin-right:20vw;'>";
                        switch ($s['nomPlat']) {
                            case "Poulet Tandoori":
                                echo "<img src='./ressources/tandoori.jpg' class='card-img-top' alt='...'>";
                                break;
                            case "Pizza Pepperoni":
                                echo "<img src='./ressources/pizzaMenu.jpg' class='card-img-top' alt='...'>";
                            default:
                                break;
                        }
                        echo "<div class='card-body'>";
                        echo "<h1 style='text-align:center;' class='card-title display-4'><b>" . $s["nomPlat"] . "</b></h1>";
                        echo "<p class='card-text'>Porta lorem mollis aliquam ut porttitor leo a diam sollicitudin tempor id eu nisl nunc mi ipsum faucibus vitae aliquet nec ullamcorper sit amet risus nullam eget felis eget nunc lobortis mattis aliquam faucibus purus in massa tempor nec feugiat nisl pretium fusce id velit ut tortor pretium viverra suspendisse</p>";

                        // Pour l'affichage de la description du plat stockée dans la bdd
                        // echo "<p class='card-text'>" . $s["descriptifPlat"] . "</p>";

                        //echo "<p class=\"prix\">" . $s["prixPlat"] . " CHF</p>";
                        echo "<br/>";
                        echo "<p>";
                        if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == true) {
                            // Modal trigger
                            //$_SESSION['idPlats'] = $s['idPlats'];
                            echo "<p class=\"prix\">" . $s["prixPlat"] . " CHF<a class='btn btn-outline-light btn-lg' data-bs-toggle='modal' name='idPlat' data-bs-target='#exampleModal' value='" . $_SESSION['idPlats'] = $s['idPlats'] . "'>Ajouter au panier</a></p>";
                            $idPlats = rtrim($_SESSION['idPlats'], "'>Ajouter au panier</a></p>");
                            $_SESSION['idPlats'] = $idPlats;
                            echo "<div class='modal fade text-dark' id='exampleModal' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>";
                            echo "<div class='modal-dialog'>";
                            echo "<div class='modal-content'>";
                            echo "<div class='modal-header'>";
                            echo "<h5 class='modal-title' id='exampleModalLabel'>Veuillez confirmer la quantité</h5>";
                            echo "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
                            echo "</div>";
                            echo "<div class='modal-body list-inline'>";
                            echo "<p class='list-inline-item'>Quantité: </p>" . "<input class='list-inline-item' style='width:auto; text-align:center;' type='number' id='quantitySelector' class='form-control' name='quantitePlat' value=" . $_SESSION['quantitePlat'] .  " min='1' max='10'/>";
                            echo "</div>";
                            echo "<div class='modal-footer'>";
                            echo "<button type='button' class='btn btn-danger' data-bs-dismiss='modal'>Fermer</button>";
                            // echo "<input type'hidden' name='idPlat' value='" . $_SESSION['idPlats'] ."' />";
                            echo "<input type='submit' name='validerQuantite' class='btn btn-success' type='submit' value='Valider la quantité'/>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                        } else {
                            echo "<a class='btn btn-outline-light btn-lg' href=\"index.php?action=connexion&accountExists=false\">Ajouter au panier</a>";
                        }
                        echo "</p>";
                        echo "</div>";

                        if (isset($validerQuantite)) {
                            if ($_POST['quantitePlat'] >= 1 && $_POST['quantitePlat'] <= 10) {
                                $quantiteDuPlat = $_POST['quantitePlat'];
                            }
                            $_SESSION['quantitePlat'] = $quantiteDuPlat;

                            if (!isset($_SESSION["panier"])) {
                                $_SESSION["panier"] = array();
                            }

                            if (isset($_SESSION['idPlats'])) {

                                $getPlat = Plat::GetPlatById($_SESSION['idPlats']);

                                if ($_SESSION['quantitePlat'] != 0) {

                                    unset($getPlat['idPlats']);
                                    $tableauPlat = array();
                                    $tableauPlat = $getPlat;
                                    $tableauPlat['quantitePlat'] = $_SESSION['quantitePlat'];

                                    array_push($_SESSION["panier"], array_combine($keysForBasket, $tableauPlat));
                                    //$_SESSION['quantitePlat'] = 0;
                                } else {
                                    //echo "<p class='alert alert-danger'>Veuillez séléctionner une quantité!</p>";
                                }
                            }
                        }

                        echo "</div>";
                        echo "</form>";
                        echo "<br/>";
                        echo "<br/>";
                        // unset($_SESSION['idPlats']);
                        unset($_SESSION['idPlats']);
                        unset($idPlats);
                        unset($validerQuantite);
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>

</html>