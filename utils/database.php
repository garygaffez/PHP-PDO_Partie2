<?php

require_once (dirname(__FILE__)."/config.php");

class Database {
    private static $pdo;

    public static function connect() {
        try{
            if (is_null(self::$pdo)) {
                //on instancie PDO
                self::$pdo = new PDO(DSN, DBUSER, DBPASS);
                //on configure la recupération renvoi un objet avec le nom des colonnes
                self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                //permet de lever les exceptions
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // echo "on est connecté";               
            } 
            return self::$pdo;

        }catch(PDOException $e){
            return $e->getMessage();
        }
    }
}


