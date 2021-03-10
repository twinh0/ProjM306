<?php

class Plat
{
    #region Champs

    private $idPlat;
    private $nomPlat;
    private $decriptifPlat;
    private $prixPlat;

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

    #endregion

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

    #endregion
}
