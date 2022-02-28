<?php

require_once (dirname(__FILE__)."/../utils/database.php");

require_once (dirname(__FILE__)."/../utils/config.php");


class Appointment {
    private $_idPatient;
    private $_dateHour;
    private $_id;
    private $_connectPDO;

    public function __construct($titi, $dateHour){
        $this->_connectPDO = Database::connect();
        $this->setIdPatient($titi);
        $this->setDateHour($dateHour);
    }


    public function setIdPatient($tata){
        $this->_idPatient = $tata;
    }
    public function getidPatient(){
        return $this->_idPatient;
    }


    public function setDateHour($dateHour){
        $this->_dateHour = $dateHour;
    }
    public function getDateHour(){
        return $this->_dateHour;
    }

    public function setId($id){
        $this->_id = $id;
    }
    public function getId(){
        return $this->_id;
    }

    public function new(){

        try {
            $sql = "INSERT INTO `appointments`(`dateHour`, `idPatients`) 
                    VALUES (:dateHour, :idPatients);";

            $sth = $this->_connectPDO->prepare($sql);

            $sth->bindValue(":dateHour", $this->getDateHour(), PDO::PARAM_STR);
            $sth->bindValue(":idPatients", $this->getidPatient(), PDO::PARAM_INT);

            return $sth->execute();
            
            return true;
            
        } catch (PDOException $e) {
            return $e->getMessage();
        }

    }

    /**
     * affiche les patients de la bdd
     */
    public static function findAll() {
        
        try {
            //on récupére les données
            $sql = "SELECT * FROM `appointments` ORDER BY  `dateHour` DESC;";

            $connectPDOStatic = Database::connect();

            $sth = $connectPDOStatic->query($sql);

            $users = $sth->fetchAll();

            return $users;

        } catch (PDOException $e) {
            $e = 'Error !';
            return $e;
        }
    }

    public static function findRdvAndPatient() {
        
        try {
            //on récupére les données
            $sql = "SELECT * FROM `appointments` ORDER BY  `dateHour` DESC;";

            $connectPDOStatic = Database::connect();

            $sth = $connectPDOStatic->query($sql);

            $users = $sth->fetchAll();

            return $users;

        } catch (PDOException $e) {
            $e = 'Error !';
            return $e;
        }
    }

    /**
     * Mettre à jour un patient de la bdd
     */

    public function update($id) {
        try {
            $sql = "UPDATE `appointments` SET `dateHour` = :dateHour, `idPatients` = :idPatients WHERE `id` = :id";

            $sth = $this->_connectPDO->prepare($sql);
            
            $sth->bindValue(":id", $id, PDO::PARAM_INT);
            $sth->bindValue(":dateHour", $this->getDateHour(), PDO::PARAM_STR);
            $sth->bindValue(":idPatients", $this->getidPatient(), PDO::PARAM_STR);

            return $sth->execute();
            
        } catch (PDOException $e) {
            return  $e->getMessage();
        }
    }


    public static function find(int $id) {
        
        try {
            // $sql = "SELECT `lastname`, `firstname`, `mail`, DATE_FORMAT(`dateHour`, '%Y-%m-%dT%H:%i:%s') AS `dateHour`  FROM `patients` RIGHT JOIN `appointments` ON `patients`.id = `appointments`.idPatients;";

            $sql = "SELECT `idPatients`, DATE_FORMAT(`dateHour`, '%Y-%m-%dT%H:%i') AS `dateHour`, `id` FROM `appointments` WHERE `id` = :id";

            $connectPDOStatic = Database::connect();

            $sth = $connectPDOStatic->prepare($sql);

            $sth->bindValue(":id", $id, PDO::PARAM_INT);

            $sth->execute();
            //on récupere les données
            $rdvPatient = $sth->fetch();

            if (!$rdvPatient) {
                throw new PDOException(ERROR_NOT_FOUND);
            }

            return $rdvPatient;

        } catch (PDOException $e) {
            return $e;
        }
    }

// permet d'afficher les informations du patients à coté du rdv
    public static function joinPatientRdv($id = NULL) {
        
        try {

            $connectPDOStatic = Database::connect();

            if (is_null($id)) {
                $sql = "SELECT `appointments`.`id` AS `idAppointment`, `patients`.`lastname`, `patients`.`firstname`, `patients`.`mail`, DATE_FORMAT(`dateHour`, '%Y-%m-%dT%H:%i:%s') AS `dateHour`  FROM `patients` INNER JOIN `appointments` ON `patients`.`id` = `appointments`.`idPatients`;";
                $sth = $connectPDOStatic->prepare($sql);
            }else {        
                $sql = "SELECT `appointments`.`id` AS `idAppointment`, `patients`.`lastname`, `patients`.`firstname`, `patients`.`mail`, DATE_FORMAT(`dateHour`, '%Y-%m-%dT%H:%i:%s') AS `dateHour`  FROM `patients` INNER JOIN `appointments` ON `patients`.`id` = `appointments`.`idPatients` WHERE `appointments`.`idPatients` = :id;";
                $sth = $connectPDOStatic->prepare($sql);
                $sth->bindValue(":id", $id, PDO::PARAM_INT);
            }

            $sth->execute();
            //on récupere les données
            $rdvPatient = $sth->fetchAll();

            if (!$rdvPatient) {
                throw new PDOException(ERROR_NOT_FOUND);
            }

            return $rdvPatient;

        } catch (PDOException $e) {
            return $e;
        }
    }


        /**
     * Supprimer un rdv de la bdd
     */
    public static function delete($id) {
        
        try {
            //on récupére les données
            $sql = "DELETE FROM `appointments` WHERE `id` = :id;";

            $connectPDOStatic = Database::connect();

            $sth = $connectPDOStatic->prepare($sql);

            $sth->bindValue(":id", $id, PDO::PARAM_INT);

            return $sth->execute();


        } catch (PDOException $e) {
            return $e;
        }
    }



        /**
     *  fonction permettant de vérifier si un utilisateur existe déjà en verifiant si l'adresse mail est 
     *  déjà présente dans la base de données
     * @return bool
     */
    public function isRdvExists(): bool {
        $sql = ("SELECT `dateHour` FROM `appointments` WHERE `dateHour`= :dateHour;");
        $query = $this->_connectPDO->prepare($sql);
        $query->bindValue(":dateHour", $this->getdateHour(), PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetchColumn();
        if ($result === false){
            return false;
        }else{
            return true;
        }
        
    }

}