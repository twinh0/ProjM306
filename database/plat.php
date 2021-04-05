<?php

class Plat
{
    #region Champs

    private $idPlat;
    private $nomPlat;
    private $decriptifPlat;
    private $prixPlat;

    // private $quantitePlat;

    #endregion

    #region Propriétés

    /**
     * Get the value of idPlat
     */
    public function getIdPlat()
    {
        return $this->idPlat;
    }

    /**
     * Set the value of idPlat
     *
     * @return  self
     */
    public function setIdPlat($idPlat)
    {
        $this->idPlat = $idPlat;

        return $this;
    }

    /**
     * Get the value of nomPlat
     */
    public function getNomPlat()
    {
        return $this->nomPlat;
    }

    /**
     * Set the value of nomPlat
     *
     * @return  self
     */
    public function setNomPlat($nomPlat)
    {
        $this->nomPlat = $nomPlat;

        return $this;
    }

    /**
     * Get the value of decriptifPlat
     */
    public function getDecriptifPlat()
    {
        return $this->decriptifPlat;
    }

    /**
     * Set the value of decriptifPlat
     *
     * @return  self
     */
    public function setDecriptifPlat($decriptifPlat)
    {
        $this->decriptifPlat = $decriptifPlat;

        return $this;
    }

    /**
     * Get the value of prixPlat
     */
    public function getPrixPlat()
    {
        return $this->prixPlat;
    }

    /**
     * Set the value of prixPlat
     *
     * @return  self
     */
    public function setPrixPlat($prixPlat)
    {
        $this->prixPlat = $prixPlat;

        return $this;
    }

    // /**
    //  * Get the value of quantitePlat
    //  */
    // public function getQuantitePlat()
    // {
    //     return $this->quantitePlat;
    // }

    // /**
    //  * Set the value of quantitePlat
    //  *
    //  * @return  self
    //  */
    // public function setQuantitePlat($quantitePlat)
    // {
    //     $this->quantitePlat = $quantitePlat;

    //     return $this;
    // }

    #endregion

    // public function __construct($unIdPlat, $unNomPlat, $unDecriptifPlat, $unPrixPlat, $uneQuantitePlat){

    //     $this->setIdPlat($unIdPlat);
    //     $this->setNomPlat($unNomPlat);
    //     $this->setDecriptifPlat($unDecriptifPlat);
    //     $this->setPrixPlat($unPrixPlat);
    //     $this->setQuantitePlat($uneQuantitePlat);

    // }

    #region Méthodes

    /**
     * Fonction qui retourne toutes lignes de la table plat
     * 
     * @return array
     */
    public static function SelectAll(): array
    {
        $request = ConnexionPdo::getInstance()->prepare("SELECT * FROM plats");
        $request->setFetchMode(PDO::FETCH_ASSOC);
        $request->execute();

        $resultFromReq = $request->fetchAll();
        return $resultFromReq;
        die();
    }


    // /**
    //  * 
    //  *
    //  * @param Plat $unPlat
    //  * @return boolean
    //  */
    // public static function AddQuantiteAPlat(Plat $unPlat): bool{

    //     $request = ConnexionPdo::getInstance()->prepare("INSERT INTO inclurequantite(quantitePlat, idPlat) VALUES (:quantitePlat, :idPlat)");

    //     $quantitePlat = $unPlat->getQuantitePlat();
    //     $idPlat = $unPlat->getIdPlat();

    //     $request->bindParam(':quantitePlat', $quantitePlat);
    //     $request->bindParam(':idPlat', $idPlat);

    //     $insertionSuccessful = $request->execute();
    //     return $insertionSuccessful;
    // }

    #endregion
}
