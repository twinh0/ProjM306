<?php
require_once('./database/header.inc.php');

#region Deprecated Code
// $username = filter_input(INPUT_POST, FILTER_SANITIZE_STRING);
// $prenom = filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_STRING);
// $nom = filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_STRING);
// $numTel = filter_input(INPUT_POST, 'numTel', FILTER_SANITIZE_STRING);
// $age = filter_input(INPUT_POST, 'age', FILTER_SANITIZE_NUMBER_INT);
// $mdp = filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_STRING);
#endregion

$seConnecter = filter_input(INPUT_POST, 'valider');

//REGEX validation
$regexAlphabet = '/^[a-zA-Z ]*$/';
$regexAlphaNumeric = '/[a-zA-Z0-9]+$/';
$regexNumeric = '/^[0-9]+$/';
$regexEmail = '/([\w\-]+\@[\w\-]+\.[\w\-]+)/';


$regexNumTel = '/(\+41)\s(\d{2})\s(\d{3})\s(\d{2})\s(\d{2})/';

//At least 8 characters, must contain at least 1 number, 1 uppercase character and 1 lowercase character
$regexMdp = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/';

//Output for errors
$globalError = "Votre formulaire a été mal renseigné. Veuiller réessayer à nouveau!";


//Tableau des variables non validées
$nonValidatedVarsArray = $_POST;
unset($nonValidatedVarsArray['valider']);

//Tableau des variables validées
$validatedVarsArray = array();

//Affichage du formulaire d'inscription ou connexion en fonction de la valeur de $accountExists
$accountExists = filter_input(INPUT_GET, 'accountExists', FILTER_SANITIZE_STRING);

/**
 * Script pour la création d'un compte + vérification si le compte existe
 */
if ($seConnecter) {

    if (count($_POST) == 8) {

        foreach ($nonValidatedVarsArray as $key => $value) {

            switch ($key) {

                case 'username':
                    if (preg_match($regexAlphaNumeric, $_POST['username'])) {
                        $username = $_POST['username'];

                        array_push($validatedVarsArray, $username);
                    }
                    break;
                case 'fname':
                    if (preg_match($regexAlphabet, $_POST['fname'])) {
                        $prenom = $_POST['fname'];

                        array_push($validatedVarsArray, $prenom);
                    }
                    break;
                case 'lname':
                    if (preg_match($regexAlphabet, $_POST['lname'])) {
                        $nom = $_POST['lname'];

                        array_push($validatedVarsArray, $nom);
                    }
                    break;
                case 'age':
                    if (preg_match($regexNumeric, $_POST['age'])) {
                        $age = $_POST['age'];

                        array_push($validatedVarsArray, $age);
                    }
                    break;
                case 'email':
                    if (preg_match($regexEmail, $_POST['email'])) {
                        $email = $_POST['email'];

                        array_push($validatedVarsArray, $email);
                    }
                    break;
                case 'numTel':
                    if (preg_match($regexNumTel, $_POST['numTel'])) {
                        $numTel = $_POST['numTel'];

                        array_push($validatedVarsArray, $numTel);
                    }
                    break;
                case 'mdp':
                    if (preg_match($regexMdp, $_POST['mdp'])) {
                        $mdp = md5($_POST['mdp']);

                        array_push($validatedVarsArray, $mdp);
                    }
                    break;
                default:
                    break;
            }
        }
    }

    if (count($validatedVarsArray) == count($nonValidatedVarsArray)) {

        try {

            $checkIfUserExists = $bdd->prepare("SELECT * FROM utilisateur WHERE nomUtilisateur = :nomUtilisateur OR email = :email");
            $checkIfUserExists->bindParam(':nomUtilisateur', $username);
            $checkIfUserExists->bindParam(':email', $email);

            $checkIfUserExists->execute();

            $resultatCheckUser = $checkIfUserExists->fetchAll(PDO::FETCH_ASSOC);

            if (empty($resultatCheckUser)) {
                //Requête préparée
                $insertNewUser = $bdd->prepare("INSERT INTO utilisateur (nomUtilisateur, prenom, nom, age, numTel, email, mdp) VALUES (:nomUtilisateur, :prenom, :nom, :age, :numTel, :email, :mdp)");
                $insertNewUser->bindParam(':nomUtilisateur', $username);
                $insertNewUser->bindParam(':prenom', $prenom);
                $insertNewUser->bindParam(':nom', $nom);
                $insertNewUser->bindParam(':age', $age);
                $insertNewUser->bindParam(':numTel', $numTel);
                $insertNewUser->bindParam(':email', $email);
                $insertNewUser->bindParam(':mdp', $mdp);

                //Execution de la requête
                $insertNewUser->execute();
                
                header('Location: ./index.php?action=accountCreated');

            } else {
                echo '<div class="container-fluid d-flex justify-content-center align-items-center h-100">';
                echo '<div id="errorOutput" class="alert alert-danger alert-dismissible fade show" role="alert">';
                echo "Un compte existe déjà pour ce nom d'utilisateur/email";
                echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                echo '</div>';
                echo '</div>';
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo '<div class="container-fluid d-flex justify-content-center align-items-center h-100">';
        echo '<div id="errorOutput" class="alert alert-danger alert-dismissible fade show" role="alert">';
        echo $globalError;
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
        echo '</div>';
    }
}
?>

<?php if (filter_var($accountExists, FILTER_VALIDATE_BOOLEAN)) : ?>
    <div class="body-background">
        <div class="container-fluid d-flex justify-content-center align-items-center h-100">
            <div class="card p-3 text-center py-4">
                <form method="POST" action="#">
                    <h4>Je possède un compte</h4>
                    <div class="mt-3 px-3"> <input type="text" name="usernameLogin" class="form-control" placeholder="Nom d'utilisateur" required> </div>
                    <div class="mt-3 px-3"> <input type="password" name="mdpLogin" placeholder="Votre mot de passe" class="form-control" required /> </div>
                    <div class="mt-3 d-grid px-3"> <input type="submit" name="valider" value="Se connecter" class="btn btn-primary btn-block btn-signup text-uppercase" />
                </form>
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="body-background">
        <div class="container-fluid d-flex justify-content-center align-items-center h-100">
            <div class="card p-3 text-center py-4">
                <form method="POST" action="#">
                    <h4>Créer un compte</h4>
                    <div> <span>Avez-vous un compte existant?</span> <a href="./index.php?action=connexion&accountExists=true" class="text-decoration-none">Me connecter</a> </div>
                    <div class="mt-3 px-3"> <input type="text" name="username" class="form-control" placeholder="Nom d'utilisateur" value="<?php if (isset($username)) {
                                                                                                                                                echo $username;
                                                                                                                                            } ?>" required> </div>
                    <div class="input-group px-3 mt-3"> <input type="text" class="form-control" name="fname" placeholder="Prénom" value="<?php if (isset($prenom)) {
                                                                                                                                                echo $prenom;
                                                                                                                                            } ?>" aria-label="Username" required><span></span> <input type="text" class="form-control" name="lname" placeholder="Nom" aria-label="Server" value="<?php if (isset($nom)) {
                                                                                                                                                                                                                                                                                                        echo $nom;
                                                                                                                                                                                                                                                                                                    } ?>" required> </div>
                    <div class="mt-3 px-3"> <input type="number" name="age" placeholder="Votre âge" class="form-control" min="18" value="<?php if (isset($age)) {
                                                                                                                                                echo $age;
                                                                                                                                            } ?>" required /> </div>
                    <div class="mt-3 px-3"> <input type="email" name="email" placeholder="Votre email" class="form-control" value="<?php if (isset($email)) {
                                                                                                                                        echo $email;
                                                                                                                                    } ?>" required /> </div>
                    <div class="mt-3 px-3"> <input type="tel" name="numTel" class="form-control" placeholder="Numéro de téléphone, format: +41 XX XXX XX XX" value="<?php if (isset($numTel)) {
                                                                                                                                                                        echo $numTel;
                                                                                                                                                                    } ?>" required> </div>
                    <div class="mt-3 px-3"> <input type="password" name="mdp" placeholder="Votre mot de passe" class="form-control" required /> </div>
                    <div class="mt-3 d-grid px-3"> <input type="submit" id="createAccount" name="valider" value="Créer le compte" class="btn btn-primary btn-block btn-signup text-uppercase"/>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>
