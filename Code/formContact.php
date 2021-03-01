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

        $content = "From: " . $prenom . ' ' . $nom . "\n Email: $email \n Message: $message";
        $recipient = "iliya.srkhn@eduge.ch";
        $mailheader = "From: $email \r\n";
        mail($recipient, $sujet, $content, $mailheader) or die("Une erreur est survenue");
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

                    <!--Grid column-->
                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <label for="name" class="">Votre Prénom: </label>
                            <input type="text" id="name" name="prenom" class="form-control">
                        </div>
                    </div>

                    <!--Grid column-->
                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <label for="name" class="">Votre Nom: </label>
                            <input type="text" id="name" name="nom" class="form-control">
                        </div>
                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-md-12">
                        <div class="md-form mb-0">
                            <label for="email" class="">Votre courriel: </label>
                            <input type="text" id="email" name="email" class="form-control">
                        </div>
                    </div>
                    <!--Grid column-->

                </div>
                <!--Grid row-->

                <!--Grid row-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="md-form mb-0">
                            <label for="subject" class="">Sujet: </label>
                            <input type="text" id="subject" name="sujet" class="form-control">
                        </div>
                    </div>
                </div>
                <!--Grid row-->

                <!--Grid row-->
                <div class="row">

                    <!--Grid column-->
                    <div class="col-md-12">

                        <div class="md-form">
                            <label for="message">Votre message: </label>
                            <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea"></textarea>
                        </div>

                    </div>
                </div>
                <!--Grid row-->
                <div class="text-center text-md-left">
                    <br />
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
                    <p>Rue du bol 18, 1202 Genève</p>
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