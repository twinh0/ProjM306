<?php
require_once('./database/header.inc.php');
require_once('./database/utilisateur.php');
require_once('./database/commande.php');

//Variable qui stocke toutes les données qui concerne le compte de l'utilisateur
$userInfo = Utilisateur::SelectAllInfoFromUser($_SESSION['nomCompte']);

$infoCommande = Commande::GetOrdersByUserId($userInfo['idUtilisateur']);

//Pour l'affichage, c-à-d w/o id and pwd
$displayInfo = $userInfo;
unset($displayInfo['idUtilisateur']);
unset($displayInfo['mdp']);

$prixTotal = 0;

$amountHistory = array();

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
            <p class="display-6">Les détails de votre compte:</p>
            <br />
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
        <div>
            <p class="display-6">Historique des commandes:</p>
            <br/>
            <table class="table table-striped table-bordered table-hover">
                <thead style="text-align:center;">
                    <tr>
                        <th>Date de la commande</th>
                        <th>Liste des plats</th>
                        <th>Prix Total</th>
                    </tr>
                </thead>
                <tbody style="text-align:center; vertical-align:middle;">
                    <?php
                    if (!empty($userInfo)) {
                        foreach ($infoCommande as $key => $value) {
                            $platsItems = json_decode($infoCommande[$key]['lstPlats'], true);
                            echo "<tr>";
                            echo "<td style='text-align:center;' >" . $infoCommande[$key]['dateCommande'] . "</td>";
                            echo "<td style='height:10px; overflow:hidden;'>";
                            foreach ($platsItems as $p) {
                                echo "Plat: " . $p['nomPlat'] . "<br/>Description: "  .  $p['descriptifPlat'] . "<br/>Prix unitaire: " .  $p['prixPlat'] . "<br/>Quantité: " . $p['quantitePlat'] . "x<br/><br/>";
                                $prixTotal += $p['prixPlat'] * $p['quantitePlat'];
                            }
                            echo "</td>";
                            echo "<td class='display-6'>" . number_format($prixTotal, 2) . "</td>";
                            echo "</tr>";

                            array_push($amountHistory, $prixTotal);

                            if (isset($prixTotal)) {
                                $prixTotal = 0;
                            }
                        }
                    }
                    ?>
                </tbody>
                <tfoot style="text-align:center; vertical-align:middle;">
                    <tr>
                        <td colspan="2" style="font-size:large;">Total:</td>
                        <td class='display-6'>
                            <?php
                            $total = 0;

                            foreach ($amountHistory as $prix) {
                                $total += $prix;
                            }
                            echo "<b>" . number_format($total, 2) . " CHF</b>";


                            ?>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

</body>

</html>