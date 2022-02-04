<?php

// constantes d'environnement
define("DSN", 'mysql:host=127.0.0.1;dbname=hospitale2n;charset=utf8');
define("DBUSER", "Docteur");
define("DBPASS", "DOC80@70f");

function connect(){
    //connexion à la base
    try{
        //on instancie PDO
        $pdo = new PDO(DSN, DBUSER, DBPASS);
        //on configure la recupération renvoi un objet avec le nom des colonnes
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        //permet de lever les exceptions
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "on est connecté";

    return $pdo;

    }catch(PDOException $e){
        echo ("Non connecté !".$e->getMessage());
    }
}


