<?php

class Commande
{
    #region Champs

    private $idCommande;
    private $lstPlats;
    private $estConfirme;
    private $dateCommande;
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
         * Get the value of lstPlats
         */ 
        public function getLstPlats()
        {
            return $this->lstPlats;
        }
    
        /**
         * Set the value of lstPlats
         *
         * @return  self
         */ 
        public function setLstPlats($lstPlats)
        {
            $this->lstPlats = $lstPlats;
    
            return $this;
        }
    
        /**
         * Get the value of estConfirme
         */ 
        public function getEstConfirme()
        {
            return $this->estConfirme;
        }
    
        /**
         * Set the value of estConfirme
         *
         * @return  self
         */ 
        public function setEstConfirme($estConfirme)
        {
            $this->estConfirme = $estConfirme;
    
            return $this;
        }
    
        /**
         * Get the value of dateCommande
         */ 
        public function getDateCommande()
        {
            return $this->dateCommande;
        }
    
        /**
         * Set the value of dateCommande
         *
         * @return  self
         */ 
        public function setDateCommande($dateCommande)
        {
            $this->dateCommande = $dateCommande;
    
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
    public static function Add(Commande $uneCommande): bool
    {
        $request = ConnexionPdo::getInstance()->prepare("INSERT INTO commandes(lstPlats, estConfirme, dateCommande, idUtilisateur) VALUES (:lstPlats, :estConfirme, :dateCommande, :idUtilisateur)");

        $lstPlats = $uneCommande->getLstPlats();
        $estConfirme = $uneCommande->getEstConfirme();
        $dateCommande = $uneCommande->getDateCommande();
        $idUtilisateur = $uneCommande->getIdUtilisateur();

        $request->bindParam(':lstPlats', $lstPlats);
        $request->bindParam(':estConfirme', $estConfirme);
        $request->bindParam(':dateCommande', $dateCommande);
        $request->bindParam(':idUtilisateur', $idUtilisateur);

        $insertionSuccessful = $request->execute();
        return $insertionSuccessful;
    }

    /**
     * Retourne les commandes de l'utilisateur en fonction de son id dans la bdd
     *
     * @param integer $idUtilisateur
     * @return array
     */
    public static function GetOrdersByUserId(int $idUtilisateur): array{

        $request = ConnexionPdo::getInstance()->prepare('SELECT dateCommande, lstPlats FROM commandes WHERE idUtilisateur = :idUtilisateur');

        $request->bindParam(":idUtilisateur", $idUtilisateur, PDO::PARAM_INT);
        $request->setFetchMode(PDO::FETCH_ASSOC);
        $request->execute();
    
        $resultFromReq = $request->fetchAll();
        return $resultFromReq;

    }



    #endregion

}
