<?php

require_once(dirname(__FILE__).'/../utils/regex.php');

require_once (dirname(__FILE__).'/../models/Appointment.php');

require_once (dirname(__FILE__).'/../models/Patients.php');

$page = intval(filter_input(INPUT_GET,'page',FILTER_SANITIZE_NUMBER_INT));

$search = trim(filter_input(INPUT_GET, 'search', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? '');

$selectPatientNumber = intval(filter_input(INPUT_GET,'selectPatientNumber',FILTER_SANITIZE_NUMBER_INT) ?? 10);

$patientNumber = Patients::getNumber($search);

$nbPages = ceil($patientNumber / $selectPatientNumber);

if($page <= 0 || $page > $nbPages) {
    $page = 1;
}

$offset = ($page - 1) * $selectPatientNumber;


// NOUVELLE MÉTHODE A PARTIR DE PHP 8.1
// $search = htmlspecialchars(stripslashes(trim($_GET['search'])));

$patients = Patients::findAll($search, $selectPatientNumber, $offset);

// var_dump($patients);



include(dirname(__FILE__).'/../views/templates/head.php');

include(dirname(__FILE__).'/../views/templates/menu.php');

include(dirname(__FILE__).'/../views/liste-patients.php');

include(dirname(__FILE__).'/../views/templates/footer.php');