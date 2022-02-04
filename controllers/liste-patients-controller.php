<?php


require_once (dirname(__FILE__).'/../models/Patients.php');


$listPatients = new Patients();

$patients = $listPatients->findAll();

if (!is_array($patients)){
    $errorMessage = $patients;
}


include(dirname(__FILE__).'/../views/templates/head.php');

include(dirname(__FILE__).'/../views/templates/menu.php');

include(dirname(__FILE__).'/../views/liste-patients.php');

include(dirname(__FILE__).'/../views/templates/footer.php');