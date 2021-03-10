<?php
session_start();
?>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap');

    .nav-link {

        display: inline-block !important;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="./index.php?action=accueil">
            <img src="./ressources/logoBaratie.png" alt="logo" width="100" height="100" class="d-inline-block align-top">
            <div style="display: inline; font-size: 3em; font-family: 'Dancing Script', cursive;"><i>Baratie</i></div>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="font-size: 20px;">
                <li class="nav-item">
                    <a class="nav-link" name="choice" value="home" href="./index.php?action=accueil">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" name="choice" value="menu" href="./index.php?action=menu">Menu</a>
                </li>
                <li class="nav-item" id="lienSignUpSignIn">
                    <a class="nav-link" name="choice" value="connexion" href="./index.php?action=connexion&accountExists=false">Inscription</a>
                    &nbsp;
                    <a class="nav-link" name="choice" value="connexion" href="./index.php?action=connexion&accountExists=true">Connexion</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" name="choice" value="panier" href="./index.php?action=panier">Panier</a>
                </li>
            </ul>
        </div>
    </div>
</nav>