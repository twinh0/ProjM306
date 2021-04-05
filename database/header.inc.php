<?php

/**
 *   Classe d'acces aux donnees Utilise les services de la classe PDO
 *   Les attributs sont tous statiques, les 4 premiers pour la connexion
 *   $monPdo qui contiendra l'unique instance de la classe
 */
class ConnexionPdo
{

    private static $host = 'mysql:host=localhost';
    private static $bdd = 'dbname=baratie';
    private static $port = 'port=3306';
    private static $dbuser = 'root';
    private static $dbmdp = 'admin';
    private static $monPdo;
    private static $unPdo = null;

    //  Constructeur privé, crée l'instance de PDO qui sera sollicitée
    //  pour toutes les méthodes de la classe
    private function __construct()
    {
        ConnexionPdo::$unPdo = new PDO(ConnexionPdo::$host . ';' . ConnexionPdo::$bdd . ';' . ConnexionPdo::$port, ConnexionPdo::$dbuser, ConnexionPdo::$dbmdp);
        ConnexionPdo::$unPdo->query("SET CHARACTER SET utf8");
        ConnexionPdo::$unPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public function __destruct()
    {
        ConnexionPdo::$unPdo = null;
    }
    /**
     *  Fonction statique qui cree l'unique instance de la classe
     * Appel : $instanceMonPdo = MonPdo::getMonPdo();
     *   @return l'unique objet de la classe MonPdo
     */
    public static function getInstance()
    {
        if (self::$unPdo == null) {
            self::$monPdo = new ConnexionPdo();
        }
        return self::$unPdo;
    }
}
