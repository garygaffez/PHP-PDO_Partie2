<?php

require_once (dirname(__FILE__)."/../utils/database.php");

class Patients {
    private $lastname;
    private $firstname;
    private $birthdate;
    private $phone;
    private $mail;
    private $pdo;

    public function __construct(){
        $this->pdo = connect();
    }

    public function setLastname($lastname){
        $this->lastname = $lastname;
    }
    public function getLastname(){
        return $this->lastname;
    }

    public function setFirstname($firstname){
        $this->firstname = $firstname;
    }
    public function getFirstname(){
        return $this->firstname;
    }

    public function setBirthdate($birthdate){
        $this->birthdate = $birthdate;
    }
    public function getBirthdate(){
        return $this->birthdate;
    }

    public function setPhone($phone){
        $this->phone = $phone;
    }
    public function getPhone(){
        return $this->phone;
    }

    public function setMail($mail){
        $this->mail = $mail;
    }
    public function getMail(){
        return $this->mail;
    }

    /**
     *  fonction permettant de vérifier si un utilisateur existe déjà en verifiant si l'adresse mail est 
     *  déjà présente dans la base de données
     * @return bool
     */
    public function isMailExists(): bool {
        $sql = ("SELECT `mail` FROM `patients` WHERE `mail`= :mail;");
        $query = $this->pdo->prepare($sql);
        $query->bindValue(":mail", $this->getMail(), PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetchColumn();
        if ($result === false){
            return false;
        }else{
            return true;
        }
        
    }

    /**
     * fonction permettant d'insérer dans la base de données les données récupérées avec set
     * @return true si tout va bien
     * 
     * @return string si erreur
     */
    public function insert(){

        try {
            $sql = "INSERT INTO `patients`(`lastname`, `firstname`, `birthdate`, `phone`, `mail`) 
                    VALUES (:lastname, :firstname, :birthdate, :phone, :mail)";

            $query = $this->pdo->prepare($sql);

            $query->bindValue(":lastname", $this->getLastname(), PDO::PARAM_STR);
            $query->bindValue(":firstname", $this->getFirstname(), PDO::PARAM_STR);
            $query->bindValue(":birthdate", $this->getBirthdate(), PDO::PARAM_STR);
            $query->bindValue(":phone", $this->getPhone(), PDO::PARAM_STR);
            $query->bindValue(":mail", $this->getMail(), PDO::PARAM_STR);

            $query->execute();
            
            return true;
            
        } catch (PDOException $e) {
            return $e->getMessage();
        }

    }

    /**
     * affiche les patients de la bdd
     */
    public function findAll() {
        
        try {
            //on récupére les données
            $sql = "SELECT * FROM `patients` ORDER BY `lastname`";
            //on execute la requête
            $sth = $this->pdo->query($sql);
            //on récupere les données
            $users = $sth->fetchAll();

            return $users;

        } catch (PDOException $e) {
            $errorMessage = 'Error !';
            return $errorMessage;
        }
    }


    /**
     * affiche un patient de la bdd
     */
    public static function find(int $id) {
        
        try {
            $sql = "SELECT * FROM `patients` WHERE `id` = :id";

            $pdo = connect();

            $sth = $pdo->prepare($sql);

            $sth->bindValue(":id", $id, PDO::PARAM_INT);

            $sth->execute();
            //on récupere les données
            $patient = $sth->fetch();

            return $patient;
        } catch (PDOException $e) {
            $errorMessage = 'Error !';
        }
    }


    /**
     * Mettre à jour un patient de la bdd
     */
    public  function update($id) {

        try {
            //on récupére les données
            $sql = "UPDATE `patients` SET `lastname` = :lastname, `firstname` = :firstname, `birthdate` = :birthdate, `phone` = :phone, `mail` = :mail WHERE `id` = :id";

            $sth = $this->pdo->prepare($sql);
            
            $sth->bindValue(":id", $id, PDO::PARAM_INT);
            $sth->bindValue(":lastname", $this->getLastname(), PDO::PARAM_STR);
            $sth->bindValue(":firstname", $this->getFirstname(), PDO::PARAM_STR);
            $sth->bindValue(":birthdate", $this->getBirthdate(), PDO::PARAM_STR);
            $sth->bindValue(":phone", $this->getPhone(), PDO::PARAM_STR);
            $sth->bindValue(":mail", $this->getMail(), PDO::PARAM_STR);

            $sth->execute();
            } catch (PDOException $e) {
                $errorMessage = 'Error !';
            }
    }


}