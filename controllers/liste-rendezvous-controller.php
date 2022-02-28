<?php


require_once (dirname(__FILE__).'/../models/Appointment.php');

require_once (dirname(__FILE__).'/../models/Patients.php');

$allAppointments = true;

$id = intval(filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT));

$appointments = Appointment::findAll();

$listRdvPatients = Appointment::joinPatientRdv();

//Méthode similaire à une jointure

// $listRdvPatients = [];

// foreach ($list as $key => $rdv){
//     $patient = Patients::find($rdv->idPatients);
//     $list[$key]->lastname = $patient->lastname;
//     $list[$key]->firstname = $patient->firstname;
// }

if (!is_array($appointments)){
    $errorMessage = $appointments;
}

$rdv = Appointment::find($id);

include(dirname(__FILE__).'/../views/templates/head.php');

include(dirname(__FILE__).'/../views/templates/menu.php');

include(dirname(__FILE__).'/../views/liste-rendezvous.php');

include(dirname(__FILE__).'/../views/templates/footer.php');