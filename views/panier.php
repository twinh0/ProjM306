<?php
include("./database/header.inc.php");

$insertCart = $bdd->prepare("INSERT INTO commandes(plat, idUtilisateur) VALUES (?, ?)");

// submit button
$submit = filter_input(INPUT_POST, 'submit');
// delete the cart
$sup = filter_input(INPUT_GET, 'sup', FILTER_SANITIZE_STRING);

// input the cart on a database when the user give us is phone number
if($submit){
    // See if the num is not null
    if($num != null){
        for ($row = 0; $row < count($_SESSION["panier"]); $row++) {
            $insertCart->execute(array($_SESSION["panier"][$row][0], $num));
        }
        echo "<script>alert(\"Votre commande a bien été prise en compte !\")</script>";
    }
}

# delete the cart
if($sup == true){
    // Destroy the session if is setted
    if(isset($_SESSION["panier"])){
        session_destroy();
    }
    header("Location: panier.php");
}

// See if the session "panier" exist
if (!isset($_SESSION["panier"])) {
    $_SESSION["panier"] = array();
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
        <div class="container">
                <a class="text-danger" href="panier.php?sup=true">Vider le panier</a>
                <?php
                // Show your cart
                for ($row = 0; $row < count($_SESSION["panier"]); $row++) {
                    echo "<h2>" . $_SESSION["panier"][$row][0] . "</h2>";
                    echo "<p>" . $_SESSION["panier"][$row][1] . "</p>";
                    echo "<p class=\"prix\">" . $_SESSION["panier"][$row][2] . ".- </p>";
                }
                ?>
            </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>

</html>