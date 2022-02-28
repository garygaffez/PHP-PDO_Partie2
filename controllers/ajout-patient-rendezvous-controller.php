<?php

require_once(dirname(__FILE__).'/../utils/regex.php');

require_once (dirname(__FILE__).'/../models/Patients.php');

require_once (dirname(__FILE__).'/../models/Appointment.php');

require_once (dirname(__FILE__).'/../utils/database.php');

$result = false;

$errorCreatePatientRdv = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $firstname = trim(filter_input(INPUT_POST,'firstname',FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? '');
    if (!empty($firstname)) {
        $resultFirstname = filter_var($firstname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/".REG_STR_NO_NUMBER."/")));
        if ($resultFirstname == false) {
            $errorCreatePatientRdv['errorFirstname'] = 'le prénom n\'a pas le bon format !';
        }
    } else {
        $errorCreatePatientRdv['emptyInputFirstname'] = 'le prénom est obligatoire !';
    }

    $lastname = trim(filter_input(INPUT_POST,'lastname',FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? '');
    if (!empty($lastname)) {
        $resultLastname = filter_var($lastname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/".REG_STR_NO_NUMBER."/")));
        if ($resultLastname == false) {
            $errorCreatePatientRdv['errorLastname'] = 'le nom n\'a pas le bon format !';
        }
    }else {
        $errorCreatePatientRdv['emptyInputLastname'] = 'le nom est obligatoire !';
    }

    $email = trim(filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL));
    if(!empty($email)) {
        $resultEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
        if ($resultEmail == false) {    
            $errorCreatePatientRdv['errorMail'] = "$email n'est pas une adresse mail valide !";
        }
    }else{
        $errorCreatePatientRdv['emptyInputMail'] = 'le mail est obligatoire !';  
    }

    $phoneNumber = trim(filter_input(INPUT_POST,'phoneNumber',FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? '');
    if(!empty($phoneNumber)) {
        $resultphoneNumber = filter_var($phoneNumber, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/".REG_STR_PHONENUMBER."/")));
        if ($resultphoneNumber == false) {    
            $errorCreatePatientRdv['errorPhoneNumber'] = "le numéro de téléphone n'est pas valide";
        }
    }

    $birthdate = trim(filter_input(INPUT_POST, 'birthdate', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? '');
    if(!empty($birthdate)){
        $month = date('m', strtotime($birthdate));
        $day = date('d', strtotime($birthdate));
        $year = date('Y', strtotime($birthdate));
        $testDate = checkdate($month,$day,$year);
        if(!$testDate){
            $errorCreatePatientRdv["birthdate"] = "La date entrée n'est pas valide!"; 
        }
    }else {
        $birthdate = NULL;
    }


    $dateHour = trim(filter_input(INPUT_POST, 'dateHour', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? '');
    if(!empty($dateHour)){
        $resultDateHour = filter_var($dateHour, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/".REG_STR_DATETIMELOCAL."/")));
        if($resultDateHour === false){
            $errorCreatePatientRdv["errorDate"] = "La date entrée n'est pas valide!"; 
        }
    }else {
        $errorCreatePatientRdv["errorDate"] = "Le champ est obligatoire";
    }


    try {
        $pdo = Database::connect();
        $pdo->beginTransaction();

        if (empty($errorCreatePatientRdv)) {
                
            $patient = new Patients($lastname, $firstname, $birthdate, $phoneNumber, $email);

            $verifMail = $patient->isMailExists();
            if (!$verifMail){
                $result = $patient->new();
                $idPatient = $pdo->lastInsertId();
                $appointment = new Appointment($idPatient, $dateHour);
                $resultAppointment = $appointment->new(); 

            }else {
                $errorCreatePatientRdv['errorMail'] = "l'adresse mail est déjà existante !";
            } 
            
            if ($result === true && $resultAppointment === true) {
                $pdo->commit();  
            } else{
                $pdo->rollback();
                $errorCreatePatientRdv ['errorRegister'] = 'Une erreur est survenu lors de l\'enregistrement !';
            }
        }

    } catch (PDOException $e) {  
        return $e->getMessage();
    }

}

include(dirname(__FILE__).'/../views/templates/head.php');

include(dirname(__FILE__).'/../views/templates/menu.php');

if (($_SERVER["REQUEST_METHOD"] != "POST") || !empty($errorCreatePatientRdv)) { 
    include(dirname(__FILE__).'/../views/ajout-patient-rendezvous.php');
} else { 
    include(dirname(__FILE__).'/../views/confirmInscription.php');
}

include(dirname(__FILE__).'/../views/templates/footer.php');