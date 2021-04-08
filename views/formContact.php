<?php
ini_set('SMTP', "smtp.gmail.com");
ini_set('smtp_port', "25");
ini_set('sendmail_from', "baratie.info@gmail.com");

/**
 * Méthode qui envoie les données du formulaire à notre adresse email
 *
 * @param string $email
 * @param string $subject
 * @param string $text
 * @return void
 */
function EnvoiEmailAdmin($email, $subject, $text)
{
    $ourEmailAdress = ini_get('sendmail_from');

    $destinataire = $email;
    $subjectSend = $subject;
    $textSend = $text;
    $headers = "From: " . $destinataire . "\r\n";

    mail($ourEmailAdress, $subjectSend, $textSend, $headers);
}

/**
 * Méthode qui envoie une confirmation de réception de la demande au client
 *
 * @param string $email
 * @param string $subject
 * @return void
 */
function EnvoiEmailUser($email, $subject)
{
    $ourEmailAdress = ini_get('sendmail_from');

    $destinataire = $email;
    $subjectSend = $subject;
    $text = "Votre email a bien été reçu! Nous vous recontacterons dans les plus brefs délais";
    $headers = "From: " . $ourEmailAdress . "\r\n";

    mail($destinataire, $subjectSend, $text, $headers);
}

//REGEX validation
$regexAlphabet = '/^[a-zA-Z ]*$/';
$regexAlphaNumeric = '/[a-zA-Z0-9]+$/';
$regexNumeric = '/^[0-9]+$/';
$regexEmail = '/([\w\-]+\@[\w\-]+\.[\w\-]+)/';

const NB_POST = 6;

$preValidationUserValues = $_POST;
$postValidationUserValues = array();

unset($preValidationUserValues['envoyer']);

$envoyer = filter_input(INPUT_POST, 'envoyer');

//Script pour le formulaire de contact:
if ($envoyer) {

    if (count($_POST) == NB_POST) {

        foreach ($preValidationUserValues as $key => $value) {

            switch ($key) {

                case 'prenomContact':
                    if (preg_match($regexAlphabet, $_POST['prenomContact'])) {

                        $fname = $_POST['prenomContact'];
                        array_push($postValidationUserValues, $fname);
                    }
                    break;
                case 'nomContact':
                    if (preg_match($regexAlphabet, $_POST['nomContact'])) {

                        $lname = $_POST['nomContact'];
                        array_push($postValidationUserValues, $lname);
                    }
                    break;
                case 'emailContact':
                    if (preg_match($regexEmail, $_POST['emailContact'])) {

                        $email = $_POST['emailContact'];
                        array_push($postValidationUserValues, $email);
                    }
                    break;
                case 'sujetContact':

                    $sujet = $_POST['sujetContact'];
                    array_push($postValidationUserValues, $sujet);

                    break;
                case 'messageContact':
                    if (preg_match($regexAlphaNumeric, $_POST['messageContact'])) {

                        $message = $_POST['messageContact'];
                        array_push($postValidationUserValues, $message);
                    }
                    break;
            }
        }
        EnvoiEmailAdmin($email, $sujet, $message);
        EnvoiEmailUser($email, $sujet);
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
            <form method="POST" action="#">

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
                            <input type="text" name="prenomContact" class="form-control" id="floatingInput" placeholder="random">
                            <label for="floatingInput">Votre prénom</label>
                        </div>
                    </div>

                    <!--Grid column-->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" name="nomContact" class="form-control" id="floatingInput" placeholder="random">
                            <label for="floatingInput">Votre nom</label>
                        </div>
                    </div>

                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="email" name="emailContact" class="form-control" id="floatingInput" placeholder="random@hello.com">
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
                            <input type="text" name="sujetContact" class="form-control" id="floatingInput" placeholder="random.">
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
                            <textarea class="form-control" name="messageContact" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
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
                    <p>baratie.info@gmail.com</p>
                </li>
            </ul>
        </div>
        <!--Grid column-->

    </div>

</section>