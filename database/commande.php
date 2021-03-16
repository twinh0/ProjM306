<?php

class Commande
{
    #region Champs

    private $idCommande;
    private $plat;
    private $aConfirmer;
    private $idUtilisateur;

    #endregion

    #region Propriétés

    /**
     * Get the value of idCommande
     */
    public function getIdCommande()
    {
        return $this->idCommande;
    }

    /**
     * Set the value of idCommande
     *
     * @return  self
     */
    public function setIdCommande($idCommande)
    {
        $this->idCommande = $idCommande;

        return $this;
    }

    /**
     * Get the value of plat
     */
    public function getPlat()
    {
        return $this->plat;
    }

    /**
     * Set the value of plat
     *
     * @return  self
     */
    public function setPlat($plat)
    {
        $this->plat = $plat;

        return $this;
    }

    /**
     * Get the value of aConfirmer
     */
    public function getAConfirmer()
    {
        return $this->aConfirmer;
    }

    /**
     * Set the value of aConfirmer
     *
     * @return  self
     */
    public function setAConfirmer($aConfirmer)
    {
        $this->aConfirmer = $aConfirmer;

        return $this;
    }

    /**
     * Get the value of idUtilisateur
     */
    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }

    /**
     * Set the value of idUtilisateur
     *
     * @return  self
     */
    public function setIdUtilisateur($idUtilisateur)
    {
        $this->idUtilisateur = $idUtilisateur;

        return $this;
    }

    #endregion

    #region Méthodes

    // public static function InsertIntoExistingOrder(Commande $uneCommande): array
    // {
    //     // $request = ConnexionPdo::getInstance()->prepare("INSERT INTO commandes(plat, idUtilisateur) VALUES (:plat, :idUtilisateur)");
        

        
        
    
    
    // }





    #endregion


}
