<?php
require_once('./database/header.inc.php');

$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$prenom = filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_STRING);
$nom = filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_STRING);
$numTel = filter_input(INPUT_POST, 'numTel', FILTER_SANITIZE_STRING);
$age = filter_input(INPUT_POST, 'age', FILTER_SANITIZE_NUMBER_INT);
$mdp = filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_STRING);
$seConnecter = filter_input(INPUT_POST, 'valider');

//REGEX validation
$regexAlphabet = '/^[a-zA-Z ]*$/';
$regexAlphaNumeric = '/[a-zA-Z0-9]+$/';
$regexNumeric = '/^[0-9]+$/';
$regexEmail = '/([\w\-]+\@[\w\-]+\.[\w\-]+)/';
$regexNumTel = '/(\b(0041|0)|\B\+41)(\s?\(0\))?(\s)?[1-9]{2}(\s)?[0-9]{3}(\s)?[0-9]{2}(\s)?[0-9]{2}\b/';
//At least 8 characters, must contain at least 1 number, 1 uppercase character and 1 lowercase character
$regexMdp = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/';

//Output for errors
$usernameError = "";
$prenomError = "";
$nomError = "";
$ageError = "";
$emailError = "";
$numTelError = "";
$mdpError = "";

if ($seConnecter) {

    if (empty($_POST['username'])) {
        $usernameError = "Veuillez rentrer un nom d'utilisateur";
    } else {

        if (preg_match($regexAlphaNumeric, $_POST['username'])) {
            $username = $_POST['username'];
        } else {
            $usernameError = "Le nom d'utilisateur doit comporter uniquement des lettres et/ou des chiffres";
        }
    }

    if(empty($_POST['prenom'])){
        $prenomError = "Veuillez renseigner votre prénom";
    }else{

        if(preg_match($regexAlphabet, $_POST['prenom'])){
            $prenom = $_POST['prenom'];
        }else{
            $prenomError = "Votre prénom doit contenir uniquement des lettres";
        }
    }

    if(empty($_POST['nom'])){
        $prenomError = "Veuillez renseigner votre prénom";
    }else{

        if(preg_match($regexAlphabet, $_POST['nom'])){
            $prenom = $_POST['nom'];
        }else{
            $prenomError = "Votre nom doit contenir uniquement des lettres";
        }
    }

    if(empty($_POST['age'])){
        $ageError = "Veuillez renseigner votre âge";
    }else{

        if(preg_match($regexNumeric, $_POST['age'])){
            $age = $_POST['age'];
        }else{
            $ageError = "Votre âge doit contenir uniquement des chiffres";
        }
    }


    if(empty($_POST['email'])){
        $emailError = "Veuillez renseigner votre email";
    }else{

        if(preg_match($regexEmail, $_POST['email'])){
            $email = $_POST['email'];
        }else{
            $emailError = "Votre email est incorrect";
        }
    }

    if(empty($_POST['numTel'])){
        $prenomError = "Veuillez renseigner votre numéro de téléphone";
    }else{

        if(preg_match($regexNumTel, $_POST['numTel'])){
            $numTel = $_POST['numTel'];
        }else{
            $prenomError = "Votre numéro de téléphone doit correspondre au format : + 41 XX XXX XX XX";
        }
    }

    if (empty($_POST['mdp'])) {

        $mdpError = "Veuillez renseigner votre mot de passe";
    } else {

        if (preg_match($regexMdp, $_POST['mdp'])) {
            $mdp = $_POST['mdp'];
        } else {
            $mdpError = "Minimum 8 caractères, minimum 1 chiffre, une majuscule et une minuscule";
        }
        
    }


    if ($username != null && $prenom != null && $nom != null && $email != null && $age != null) {

        try {
            //Requête préparée
            $insertNewUser = $bdd->prepare("INSERT INTO utilisateur (prenom, nom, age, numTel, email, mdp) VALUES (:prenom, :nom, :age, :numTel, :email, :mdp)");
            $insertNewUser->bindParam(':prenom', $prenom);
            $insertNewUser->bindParam(':nom', $nom);
            $insertNewUser->bindParam(':age', $age);
            $insertNewUser->bindParam(':numTel', $numTel);
            $insertNewUser->bindParam(':email', $email);
            $insertNewUser->bindParam(':mdp', $mdp);

            //Execution de la requête
            $insertNewUser->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}

?>

<div class="body-background">
    <div class="container-fluid d-flex justify-content-center align-items-center h-100">
        <div class="card p-3 text-center py-4">
            <form method="POST" action="#">
                <h4>Create account</h4>
                <div> <span>Already have an account?</span> <a href="#" class="text-decoration-none">Signin</a> </div>
                <div class="mt-3 px-3"> <input type="text" name="username" class="form-control" placeholder="Nom d'utilisateur" required> </div>
                <div class="input-group px-3 mt-3"> <input type="text" class="form-control" name="fname" placeholder="Prénom" aria-label="Username" required> <span></span> <input type="text" class="form-control" name="lname" placeholder="Nom" aria-label="Server" required> </div>
                <div class="mt-3 px-3"> <input type="number" name="age" placeholder="Votre âge" class="form-control" min="18" required /> </div>
                <div class="mt-3 px-3"> <input type="email" name="email" placeholder="Votre email" class="form-control" required /> </div>
                <div class="mt-3 px-3"> <input type="tel" name="numTel" class="form-control" placeholder="Numéro de téléphone, format: +41 XX XXX XX XX" pattern="/(\b(0041|0)|\B\+41)(\s?\(0\))?(\s)?[1-9]{2}(\s)?[0-9]{3}(\s)?[0-9]{2}(\s)?[0-9]{2}\b/" required> </div>
                <div class="mt-3 px-3"> <input type="password" name="mdp" placeholder="Votre mot de passe" class="form-control" required /> </div>
                <div class="mt-3 d-grid px-3"> <input type="submit" name="valider" value="Se connecter" class="btn btn-primary btn-block btn-signup text-uppercase" />
                    <div class="px-3">
                        <!-- <div class="mt-2 form-check d-flex flex-row"> <input class="form-check-input" type="checkbox" value="" id="services"> <label class="form-check-label ms-2" for="services"> I have read and agree to the terms. </label> </div> -->
                    </div>
            </form>
        </div>
    </div>
</div>