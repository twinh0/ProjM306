<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href="../styles/style.css" rel="stylesheet">
    <title>Transaction</title>
    <style>
        a:hover {
            text-decoration: none;
        }
    </style>
</head>

<body onload="typeWriter()">
    <div class="navigation">
        <?php
        include "nav.php";
        ?>
        <?php
        // variable qui vérifie si la transaction est bonne
        $validOuNon = true;
        // vérification de la validation de la transaction (simulation)
        // Verification passée
        if ($validOuNon == true) {
        ?>
            <main class="popUpTransaction">
                <section class="container-fluid jumbotron mt-5">
                    <section class="row justify-content-center">
                        <section class="col-6 col-sm-6 col-md-6 bg-dark text-white p-5 border border-dark rounded">
                            <div class="container">
                                <div id="quiz">
                                    <h1 class="text-success text-center">Paiement effectué</h1>

                                    <h4 class="text-center">Votre paiement à été effectué avec succès ! votre commende va bientôt être prise en charge.</h4>

                                    <p class="text-center" id="patienter"></p>
                                </div>
                            </div>
                        </section>
                        <a href="home.php" class="text-danger">
                            <p class="text-danger text-center">Revenir à la page d'accueil</p>
                        </a>
                    </section>
                </section>
            </main>
        <?php
        }
        // Verification pas passée
        else {
        ?>
            <main class="popUpTransaction">
                <section class="container-fluid jumbotron mt-5">
                    <section class="row justify-content-center">
                        <section class="col-6 col-sm-6 col-md-6 bg-dark text-white p-5 border border-dark rounded">
                            <div class="container">
                                <div id="quiz">
                                    <h1 class="text-danger text-center">Paiement non effectué</h1>

                                    <h4 class="text-center">Il y a eu un problème avec votre transaction. veuillez retenter .</h4>

                                    <p class="text-center" id="patienter"></p>
                                </div>
                            </div>
                        </section>
                        <a href="home.php" class="text-success">
                            <p class="text-success text-center">Revenir à la page d'accueil</p>
                        </a>
                    </section>
                </section>
            </main>
        <?php
        }
        ?>
    </div>
    <script>
        var i = 0;
        var txt = 'Veuillez patienter...'; /* The text */
        var speed = 100; /* The speed/duration of the effect in milliseconds */

        function typeWriter() {
            if (i < txt.length) {
                document.getElementById("patienter").innerHTML += txt.charAt(i);
                i++;
                setTimeout(typeWriter, speed);
            }
        }

        setTimeout(function() {
            window.location.href = "home.php"; // redirige vers la page d'accueil (home.php)
        }, 5000); // 5000ms = 5 secondes
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>

</html>