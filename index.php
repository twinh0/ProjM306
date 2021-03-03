<?php
/**
 * iSar44
 * 
 *  02/03/2021, 20:35 -> Le problème avec la redirection est fixée
 * 
 */

 
require_once('./constants.php');

session_start([
    'cookie_lifetime' => 86400,
    'read_and_close'  => true,
]);
$id_session = session_id();

// $urlProj = $_SERVER['REQUEST_URI'];
// $tabPages = array($urlProj, $urlProj . ACCUEIL, $urlProj . MENU, $urlProj . CONNEXION, $urlProj . PANIER, $urlProj . ERROR);

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);

switch ($action) {

    case 'accueil':
        require __DIR__ . '/' . ACCUEIL;
        break;
    case 'menu':
        require __DIR__ . '/' . MENU;
        break;
    case 'connexion':
        require __DIR__ . '/' . CONNEXION;
        break;
    case 'panier':
        require __DIR__ . '/' . PANIER;
        break;
    default:
        require __DIR__ . '/' . ACCUEIL;
        break;

}
