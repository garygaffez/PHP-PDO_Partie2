<?php

require_once (dirname(__FILE__)."/../utils/database.php");

class Patients {
    private $id;
    private $lastname;
    private $firstname;
    private $birthdate;
    private $phone;
    private $mail;
    private $connectPDO;

    public function __construct($lastname, $firstname, $birthdate, $phoneNumber, $email){
        $this->connectPDO = Database::connect();
        $this->setLastname($lastname);
        $this->setFirstname($firstname);
        $this->setBirthdate($birthdate);
        $this->setPhone($phoneNumber);
        $this->setMail($email);
    }

    public function setId($id){
        $this->id = $id;
    }
    public function getId(){
        return $this->id;
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
     * fonction permettant d'insérer dans la base de données les données récupérées avec set
     * @return true si tout va bien
     * 
     * @return string si erreur
     */

    public function new(){
        try {
            $sql = "INSERT INTO `patients`(`lastname`, `firstname`, `birthdate`, `phone`, `mail`) 
                    VALUES (:lastname, :firstname, :birthdate, :phone, :mail)";
            $query = $this->connectPDO->prepare($sql);
            $query->bindValue(":lastname", $this->getLastname(), PDO::PARAM_STR);
            $query->bindValue(":firstname", $this->getFirstname(), PDO::PARAM_STR);
            $query->bindValue(":birthdate", $this->getBirthdate(), PDO::PARAM_STR);
            $query->bindValue(":phone", $this->getPhone(), PDO::PARAM_STR);
            $query->bindValue(":mail", $this->getMail(), PDO::PARAM_STR);

            return $query->execute();

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }

    }

    /**
     * Permet de rechercher tous les patients
     * @param string $search la chaine à rechercher
     * @param string $limite
     * @param string $offset
     * 
     * @return array un tableau de la liste des patients
     * @return PDOException 
     */
    public static function findAll(string $search = '',string $selectpatientNumber = '',string $offset = '') {
        
        try {
            $connectPDOStatic = Database::connect();
            if ( $selectpatientNumber == '' && $offset == '') {
                $sql = "SELECT * FROM `patients` ORDER BY `lastname`;";
                $sth = $connectPDOStatic->prepare($sql);
            } else {
                $sql = "SELECT * FROM `patients` WHERE `lastname` LIKE :search OR `firstname` LIKE :search ORDER BY `lastname` LIMIT :selectpatientNumber OFFSET :offset;";
                //!!!! prepare sécurise la requête pour éviter les injections SQL : TRES IMPORTANT POUR LA SECURITE !!!!
                $sth = $connectPDOStatic->prepare($sql);

                $sth->bindValue(":search", '%'.$search.'%', PDO::PARAM_STR);

                $sth->bindValue(":selectpatientNumber", $selectpatientNumber, PDO::PARAM_INT);

                $sth->bindValue(":offset", $offset, PDO::PARAM_INT);
            }
        

            $sth->execute();;

            $users = $sth->fetchAll();

            var_dump($users);

            if (!$users) {
                throw new PDOException(ERROR);
            }else if(empty($users)) {
                throw new PDOException(ERROR_NOT_FOUND);
            }else {
                return $users;            
            }

        } catch (PDOException $e) {
            return $e;
        }
    }



    /**
     * @return int nombre de patients
     */
    public static function getNumber(string $search = '') {
        
        try {
            $sql = "SELECT count(`id`) AS `countPatient` FROM `patients` WHERE `lastname` LIKE :resultSearch OR `firstname` LIKE :resultSearch ORDER BY `lastname`;";

            $connectPDOStatic = Database::connect();

            $sth = $connectPDOStatic->prepare($sql);

            $sth->bindValue(":resultSearch", '%'.$search.'%', PDO::PARAM_STR);

            $sth->execute();

            return $sth->fetchColumn();

        } catch (PDOException $e) {
            return $e;
        }
    }


    /**
     * affiche un patient de la bdd
     */
    public static function find(int $id) {
        
        try {
            $sql = "SELECT * FROM `patients` WHERE `id` = :id";

            $connectPDOStatic = Database::connect();

            $sth = $connectPDOStatic->prepare($sql);

            $sth->bindValue(":id", $id, PDO::PARAM_INT);

            $sth->execute();
            //on récupere les données
            $patient = $sth->fetch();
var_dump($patient);
            if (!$patient) {
                throw new PDOException(ERROR_NOT_FOUND);
            }

            return $patient;

        } catch (PDOException $e) {
            return $e;
        }
    }


    /**
     * Mettre à jour un patient de la bdd
     */
    public function update($id) {

        try {
            $sql = "UPDATE `patients` SET `lastname` = :lastname, `firstname` = :firstname, `birthdate` = :birthdate, `phone` = :phone, `mail` = :mail WHERE `id` = :id";

            $sth = $this->connectPDO->prepare($sql);
            
            $sth->bindValue(":id", $id, PDO::PARAM_INT);
            $sth->bindValue(":lastname", $this->getLastname(), PDO::PARAM_STR);
            $sth->bindValue(":firstname", $this->getFirstname(), PDO::PARAM_STR);
            $sth->bindValue(":birthdate", $this->getBirthdate(), PDO::PARAM_STR);
            $sth->bindValue(":phone", $this->getPhone(), PDO::PARAM_STR);
            $sth->bindValue(":mail", $this->getMail(), PDO::PARAM_STR);
            return $sth->execute();
            } catch (PDOException $e) {
                return  $e->getMessage();
            }
    }


//methode permettant de supprimer un patient (et les rdv en changeant la clé étrangére de RESTRICT à CASCADE)
    public static function delete($id) {
        
        try {
            //on récupére les données
            $sql = "DELETE FROM `patients` WHERE `id` = :id;";

            $connectPDOStatic = Database::connect();

            $sth = $connectPDOStatic->prepare($sql);

            $sth->bindValue(":id", $id, PDO::PARAM_INT);

            return $sth->execute();


        } catch (PDOException $e) {
            return $e;
        }
    }


    public static function search(string $search = '') {
        
        try {
            $sql = "SELECT * FROM `patients` WHERE `lastname` LIKE :search OR `firstname` LIKE :search ORDER BY `lastname`;";
            //!!!! prepare sécurise la requête pour éviter les injections SQL : TRES IMPORTANT POUR LA SECURITE !!!!

            $connectPDOStatic = Database::connect();
            
            $sth = $connectPDOStatic->prepare($sql);

            $sth->bindValue(":search", '%'.$search.'%', PDO::PARAM_STR);

            $sth->execute();
            //on récupere les données
            $search = $sth->fetchAll();

            if (!$search) {
                throw new PDOException(ERROR_NOT_FOUND);
            }

            return $search;

        } catch (PDOException $e) {
            return $e;
        }
    }


    
    /**
     *  fonction permettant de vérifier si un utilisateur existe déjà en verifiant si l'adresse mail est 
     *  déjà présente dans la base de données
     * @return bool
     */
    public function isMailExists(): bool {
        $sql = ("SELECT `mail` FROM `patients` WHERE `mail`= :mail;");
        $query = $this->connectPDO->prepare($sql);
        $query->bindValue(":mail", $this->getMail(), PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetchColumn();
        if ($result === false){
            return false;
        }else{
            return true;
        }
        
    }


}