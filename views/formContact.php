<?php

$prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_STRING);
$nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_EMAIL);
$sujet = filter_input(INPUT_POST, 'sujet', FILTER_SANITIZE_STRING);
$message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

$envoyer = filter_input(INPUT_POST, 'envoyer');

//Script pour le formulaire de contact:


if ($envoyer) {

    if ($prenom != null && $nom != null && $email != null && $message != null && $message != null) {

        $content = "From: $prenom \n Email: $email \n Message: $message";
        // $recipient =  /* admin email address */;
        $mailheader = "From: $email \r\n";
        mail($recipient, $sujet, $content, $mailheader); //or die("Une erreur est survenue");
        echo "Email envoyé";
    }
}



?>

<section class="mb-4">

    <!--Section heading-->
    <h2 class="h1-responsive font-weight-bold text-center my-4">Contacter nous</h2>
    <!--Section description-->
    <p class="text-center w-responsive mx-auto mb-5">Avez-vous une question à nous poser? N'hésitez pas à nous contacter directement. Notre équipe vous recontactera le plus vite possible afin de vous aider.</p>

    <div class="row">

        <!--Grid column-->
        <div class="col-md-9 mb-md-0 mb-5">
            <form id="contact-form" name="contact-form" action="#" method="POST">

                <!--Grid row-->
                <div class="row">
                    <style>
                        .form-floating {
                            font-size: 18px;
                            margin-bottom: 10px;
                        }
                    </style>

                    <!--Grid column-->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" name="prenom" class="form-control" id="floatingInput" placeholder="random">
                            <label for="floatingInput">Votre prénom</label>
                        </div>
                    </div>

                    <!--Grid column-->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" name="nom" class="form-control" id="floatingInput" placeholder="random">
                            <label for="floatingInput">Votre nom</label>
                        </div>
                    </div>

                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="email" name="email" class="form-control" id="floatingInput" placeholder="random@hello.com">
                            <label for="floatingInput">Votre email</label>
                        </div>
                    </div>
                    <!--Grid column-->

                </div>
                <!--Grid row-->

                <!--Grid row-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" name="sujet" class="form-control" id="floatingInput" placeholder="random.">
                            <label for="floatingInput">Sujet</label>
                        </div>
                    </div>
                </div>
                <!--Grid row-->

                <!--Grid row-->
                <div class="row">

                    <!--Grid column-->
                    <div class="col-md-12">
                        <div class="form-floating">
                            <textarea class="form-control" name="message "placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                            <label for="floatingTextarea2">Votre Message</label>
                        </div>
                    </div>
                </div>
                <!--Grid row-->
                <div class="text-center text-md-left">
                    <input type="submit" name="envoyer" class="btn btn-primary" value="Envoyer" />
                    <!-- <a class="btn btn-primary" onclick="document.getElementById('contact-form').submit();">Send</a> -->
                </div>
            </form>

            <div class="status"></div>
        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-md-3 text-center">
            <ul class="list-unstyled mb-0">
                <li><i class="fas fa-map-marker-alt fa-2x"></i>
                    <p>Rue du Rhône 80, 1204 Genève</p>
                </li>

                <li><i class="fas fa-phone mt-4 fa-2x"></i>
                    <p>+ 41 22 123 45 67</p>
                </li>

                <li><i class="fas fa-envelope mt-4 fa-2x"></i>
                    <p>contact@mdbootstrap.com</p>
                </li>
            </ul>
        </div>
        <!--Grid column-->

    </div>

</section>