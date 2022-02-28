<?php

require_once(dirname(__FILE__).'/../utils/regex.php');

require_once (dirname(__FILE__).'/../models/Appointment.php');

require_once (dirname(__FILE__).'/../models/Patients.php');

$arrayPatients = Patients::findAll();

$result = false;

$errorCreateAppointment = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $toto = intval(filter_input(INPUT_POST, 'idPatient', FILTER_SANITIZE_NUMBER_INT));
    if($toto <= 0){
        $errorCreateAppointment["errorIdPatient"] = "Le champ est obligatoire";
    }


    $dateHour = trim(filter_input(INPUT_POST, 'dateHour', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? '');
    if(!empty($dateHour)){
        $resultDateHour = filter_var($dateHour, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/".REG_STR_DATETIMELOCAL."/")));
        if($resultDateHour === false){
            $errorCreateAppointment["errorDate"] = "La date entrée n'est pas valide!"; 
        }
    }else {
        $errorCreateAppointment["errorDate"] = "Le champ est obligatoire";
    }


    if (empty($errorCreateAppointment)) {
        
        $appointment = new Appointment($toto, $dateHour);
        $result = $appointment->new(); 
    }
}




include(dirname(__FILE__).'/../views/templates/head.php');

include(dirname(__FILE__).'/../views/templates/menu.php');

if ($result === true) {
    include(dirname(__FILE__).'/../views/confirmAppointment.php');
} else { 
    include(dirname(__FILE__).'/../views/ajout-rendez-vous.php');
}

include(dirname(__FILE__).'/../views/templates/footer.php');