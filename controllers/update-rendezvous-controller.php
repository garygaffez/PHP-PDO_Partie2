<?php

require_once(dirname(__FILE__).'/../utils/regex.php');

require_once (dirname(__FILE__).'/../models/Appointment.php');

require_once (dirname(__FILE__).'/../models/Patients.php');

$patientObj = new Patients();
$arrayPatients = $patientObj->findAll();

$id = intval(filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT));

$errorCreateAppointment = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $idPatient = intval(filter_input(INPUT_POST, 'idPatient', FILTER_SANITIZE_NUMBER_INT));
    if($idPatient <= 0){
        $errorCreateAppointment["errorIdPatient"] = "Le champ est obligatoire";
    }


    $dateHour = trim(filter_input(INPUT_POST, 'dateHour', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? '');
    var_dump($dateHour);
    if(!empty($dateHour)){
        $resultDateHour = filter_var($dateHour, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/".REG_STR_DATETIMELOCAL."/")));
        if($resultDateHour === false){
            $errorCreateAppointment["errorDate"] = "La date entrée n'est pas valide!"; 
        }
    }else {
        $errorCreateAppointment["errorDate"] = "Le champ est obligatoire";
    }

var_dump($errorCreateAppointment);
    if (empty($errorCreateAppointment)) {
        
        $appointment = new Appointment($idPatient, $dateHour);

        $result = $appointment->update($id);

    }
}


$rdv = Appointment::find($id);


include(dirname(__FILE__).'/../views/templates/head.php');

include(dirname(__FILE__).'/../views/templates/menu.php');

if (($_SERVER["REQUEST_METHOD"] != "POST") || !empty($errorCreateAppointment)) { 
    include(dirname(__FILE__).'/../views/rendezvous.php');
} else { 
    include(dirname(__FILE__).'/../views/confirmAppointment.php');
}

include(dirname(__FILE__).'/../views/templates/footer.php');