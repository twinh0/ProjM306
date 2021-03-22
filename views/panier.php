<?php
include("./database/header.inc.php");
include("./database/commande.php");
include('./database/utilisateur.php');

//$insertCart = $bdd->prepare("INSERT INTO commandes(plat, idUtilisateur) VALUES (?, ?)");
$insertCart = new Commande();

$userInfo = Utilisateur::SelectAllInfoFromUser($_SESSION['nomCompte']);

// submit button
$submit = filter_input(INPUT_POST, 'submit');
// delete the cart
$sup = filter_input(INPUT_GET, 'sup', FILTER_SANITIZE_STRING);

# delete the cart
if ($sup == true) {
    // Destroy the session if is setted
    if (isset($_SESSION["panier"])) {
        $_SESSION["panier"] = array();
    }
    header("Location: index.php?action=panier");
}

// See if the session "panier" exist
if (!isset($_SESSION["panier"])) {
    $_SESSION["panier"] = array();
}

if ($submit) {
    // If the user exist the command is put in the bdd and the user is redirect to transaction.php
    for ($row = 0; $row < count($_SESSION["panier"]); $row++) {
        //$insertCart->execute(array($_SESSION["panier"][$row][0], "1")); // ID UTILISATEUR A REMPLIR
        $insertCart->setLstPlats(json_encode($_SESSION["panier"]));
        $insertCart->setEstConfirme("1");
        $insertCart->setDateCommande(date('Y-m-d H:i:s'));
        $insertCart->setIdUtilisateur($userInfo["idUtilisateur"]);
    }
    Commande::add($insertCart);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href="../styles/style.css" rel="stylesheet">
    <title>Panier</title>
</head>

<body>
    <div class="navigation">
        <?php
        include "nav.php";
        ?>
        <form action="#" method="POST">
            <div class="formBorder">
                <!-- Payer par paypal -->
                <button>Connecter paypal</button>
                <input type="submit" name="submit" value="Ok" placeholder="Etape suivante">
            </div>
        </form>
        <div class="container">
            <a class="text-danger" href="index.php?action=panier&sup=true">Vider le panier</a>
            <?php
            // Show your cart
            for ($row = 0; $row < count($_SESSION["panier"]); $row++) {
                echo "<h2>" . $_SESSION["panier"][$row][0] . "</h2>";
                echo "<p>" . $_SESSION["panier"][$row][1] . "</p>";
                echo "<p>" . $_SESSION["panier"][$row][2] . ".- </p>";
            }
            ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>

</html>