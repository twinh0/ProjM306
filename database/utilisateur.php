<?php

class Utilisateur
{
    #region Champs

    private $idUtilisateur;
    private $nomUtilisateur;
    private $prenom;
    private $nom;
    private $age;
    private $numTel;
    private $email;
    private $mdp;

    #endregion

    #region Propriétés

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

    /**
     * Get the value of nomUtilisateur
     */
    public function getNomUtilisateur()
    {
        return $this->nomUtilisateur;
    }

    /**
     * Set the value of nomUtilisateur
     *
     * @return  self
     */
    public function setNomUtilisateur($nomUtilisateur)
    {
        $this->nomUtilisateur = $nomUtilisateur;

        return $this;
    }

    /**
     * Get the value of prenom
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     *
     * @return  self
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get the value of nom
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of age
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set the value of age
     *
     * @return  self
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get the value of numTel
     */
    public function getNumTel()
    {
        return $this->numTel;
    }

    /**
     * Set the value of numTel
     *
     * @return  self
     */
    public function setNumTel($numTel)
    {
        $this->numTel = $numTel;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of mdp
     */
    public function getMdp()
    {
        return $this->mdp;
    }

    /**
     * Set the value of mdp
     *
     * @return  self
     */
    public function setMdp($mdp)
    {
        $this->mdp = $mdp;

        return $this;
    }

    #endregion

    #region Méthodes

    /**
     * Fonction qui retourne toutes lignes de la table utilisateur
     * 
     * @return array
     */
    public static function SelectAll(): array
    {
        $request = ConnexionPdo::getInstance()->prepare("SELECT * FROM utilisateur");
        $request->setFetchMode(PDO::FETCH_ASSOC);
        $request->execute();

        $resultFromReq = $request->fetchAll();
        return $resultFromReq;
        die();
    }

    /**
     * Fonction qui retourne la ligne avec le mdp dans la bdd en fonction du nom de l'utilisateur
     *
     * @param string $unNomutilisateur
     * @return array
     */
    public static function FindByUsername(string $unNomutilisateur): array
    {
        $request = ConnexionPdo::getInstance()->prepare("SELECT mdp FROM utilisateur WHERE nomUtilisateur = :nomUtilisateur");
        $request->bindParam(":nomUtilisateur", $unNomutilisateur, PDO::PARAM_STR, 45);
        $request->setFetchMode(PDO::FETCH_ASSOC);
        $request->execute();

        $resultFromReq = $request->fetch();
        return $resultFromReq;
        die();
    }

    /**
     * Fonction qui vérifie si l'utilisateur existe déjà dans la bdd en fonction du nom de l'utilisateur ou de l'email founi
     * 
     * @param string $unNomutilisateur
     * @param string $unEmail
     * @return array
     */
    public static function CheckIfUserExists(string $unNomutilisateur, string $unEmail): array
    {
        $request = ConnexionPdo::getInstance()->prepare("SELECT * FROM utilisateur WHERE nomUtilisateur = :nomUtilisateur OR email = :email");
        $request->bindParam(":nomUtilisateur", $unNomutilisateur, PDO::PARAM_STR, 45);
        $request->bindParam(":email", $unEmail, PDO::PARAM_STR);
        $request->setFetchMode(PDO::FETCH_ASSOC);
        $request->execute();

        $resultFromReq = $request->fetchAll();
        return $resultFromReq;
        die();
    }


    /**
     * Fonction qui permet d'insérer un nouvel utilisateur dans la bdd
     *
     * @param Utilisateur $unUtilisateur
     * @return boolean
     */
    public static function AddUser(Utilisateur $unUtilisateur): bool
    {
        $request = ConnexionPdo::getInstance()->prepare("INSERT INTO utilisateur (nomUtilisateur, prenom, nom, age, numTel, email, mdp) VALUES (:nomUtilisateur, :prenom, :nom, :age, :numTel, :email, :mdp)");

        $username = $unUtilisateur->getNomUtilisateur();
        $prenom = $unUtilisateur->getPrenom();
        $nom = $unUtilisateur->getNom();
        $age = $unUtilisateur->getAge();
        $numTel = $unUtilisateur->getNumTel();
        $email = $unUtilisateur->getEmail();
        $mdp = $unUtilisateur->getMdp();

        $request->bindParam(':nomUtilisateur', $username, PDO::PARAM_STR, 45);
        $request->bindParam(':prenom', $prenom, PDO::PARAM_STR, 30);
        $request->bindParam(':nom', $nom, PDO::PARAM_STR, 50);
        $request->bindParam(':age', $age, PDO::PARAM_INT);
        $request->bindParam(':numTel', $numTel, PDO::PARAM_STR, 30);
        $request->bindParam(':email', $email, PDO::PARAM_STR);
        $request->bindParam(':mdp', $mdp, PDO::PARAM_STR, 255);

        $insertionSuccessful = $request->execute();
        return $insertionSuccessful;
    }

    #endregion
}
