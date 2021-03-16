<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href="./styles/style.css" rel="stylesheet">
    <title>Page d'accueil</title>
</head>

<body>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap');
    </style>
    <div class="navigation">
        <?php
        include "nav.php";
        ?>
    </div>
    <div class="main">
        <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 style="font-family: 'Dancing Script', cursive; font-size: 3em;">Bienvenue chez <i>Restaurant Baratie</i></h1>
                        <p style="font-family: 'Dancing Script', cursive; font-size: 1em;">Da place 2b 4 ur food</p>
                    </div>
                    <img src="./ressources/restaurant1.jpg" class="d-block w-100" alt="restaurant">
                </div>
                <div class="carousel-item">
                    <img src="./ressources/wine.jpg" class="d-block w-100" alt="vin">
                    <div class="carousel-caption d-none d-md-block position-absolute top-0 start-50 translate-middle-x col-10 col-sm-10 col-md-10">
                        <h1 style="font-family: 'Dancing Script', cursive; font-size: 3em;">Notre cave à vin est l'endroit idéal pour se mettre une sombre mine</h1>
                        <p style="font-family: 'Dancing Script', cursive; font-size: 1em;">Da place 2b 4 ur food</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="./ressources/salon.jpg" class="d-block w-100" alt="salon">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <div id="contactForm">
        <?php
        include 'formContact.php'
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>


    <!-- reference to Google Authentication  -->
    <!-- <script src="https://apis.google.com/js/platform.js" async defer></script> -->
</body>

</html>