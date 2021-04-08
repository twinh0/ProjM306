<?php
session_start();


if(isset($_GET['sup'])){
    unset($_SESSION['panier']);
}

if (!isset($_SESSION['quantitePlat'])) {
    $_SESSION['quantitePlat'] = 1;
}
?>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap');
</style>

<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
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
                <?php if (!isset($_SESSION['isLoggedIn'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" name="choice" value="connexion" href="./index.php?action=connexion&accountExists=false">Inscription</a>
                    </li>
                    <li>
                        <a class="nav-link" name="choice" value="connexion" href="./index.php?action=connexion&accountExists=true">Connexion</a>
                    </li>
                <?php endif; ?>
                <?php if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == true) : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Mon compte
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li class="nav-item">
                                <a class="dropdown-item" href="./index.php?action=userPage">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="dropdown-item" href="./index.php?action=panier">Panier</a>
                            </li>
                            <li class="nav-item">
                                <a class="dropdown-item" href="./index.php?action=logout">Se déconnecter</a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>