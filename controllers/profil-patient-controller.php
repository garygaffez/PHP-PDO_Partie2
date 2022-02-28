<?php

require_once(dirname(__FILE__).'/../utils/regex.php');

require_once (dirname(__FILE__).'/../models/Patients.php');

require_once (dirname(__FILE__).'/../models/Appointment.php');

$allAppointments = false;

$id = intval(filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT));


$errorCreatePatient = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $firstname = trim(filter_input(INPUT_POST,'firstname',FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? '');
    if (!empty($firstname)) {
        $resultFirstname = filter_var($firstname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/".REG_STR_NO_NUMBER."/")));
        if ($resultFirstname == false) {
            $errorCreatePatient['errorFirstname'] = 'le prénom n\'a pas le bon format !';
        }
    } else {
        $errorCreatePatient['emptyInputFirstname'] = 'le prénom est obligatoire !';
    }

    $lastname = trim(filter_input(INPUT_POST,'lastname',FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? '');
    if (!empty($lastname)) {
        $resultLastname = filter_var($lastname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/".REG_STR_NO_NUMBER."/")));
        if ($resultLastname == false) {
            $errorCreatePatient['errorLastname'] = 'le nom n\'a pas le bon format !';
        }
    }else {
        $errorCreatePatient['emptyInputLastname'] = 'le nom est obligatoire !';
    }

    $email = trim(filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL));
    if(!empty($email)) {
        $resultEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
        if ($resultEmail == false) {    
            $errorCreatePatient['errorMail'] = "$email n'est pas une adresse mail valide !";
        }
    }else{
        $errorCreatePatient['emptyInputMail'] = 'le mail est obligatoire !';  
    }

    $phoneNumber = trim(filter_input(INPUT_POST,'phoneNumber',FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? '');
    if(!empty($phoneNumber)) {
        $resultphoneNumber = filter_var($phoneNumber, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/".REG_STR_PHONENUMBER."/")));
        if ($resultphoneNumber == false) {    
            $errorCreatePatient['errorPhoneNumber'] = "le numéro de téléphone n'est pas valide";
        }
    }

    $birthdate = trim(filter_input(INPUT_POST, 'birthdate', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? '');
    if(!empty($birthdate)){
        $month = date('m', strtotime($birthdate));
        $day = date('d', strtotime($birthdate));
        $year = date('Y', strtotime($birthdate));
        $testDate = checkdate($month,$day,$year);
        if(!$testDate){
            $errorCreatePatient["birthdate"] = "La date entrée n'est pas valide!"; 
        }
    }else {
        $birthdate = NULL;
    }


    if (empty($errorCreatePatient)) {
        
        $updatePatient = new Patients($lastname, $firstname, $birthdate, $phoneNumber, $email);

        // $updatePatient->setLastname($lastname);
        // $updatePatient->setFirstname($firstname);
        // $updatePatient->setBirthdate($birthdate);
        // $updatePatient->setPhone($phoneNumber);
        // $updatePatient->setMail($email);

        $patient = Patients::find($id);

       var_dump($patient);
        $result = false;
        if (!$updatePatient->isMailExists() || $email === $patient->mail) {
            $result = $updatePatient->update($id);
        }else {
            $errorCreatePatient['errorMail'] = "L'e-mail existe déjà";
        }
        if ($result === true){
            $result = "Tout est OK !";
        }else {
            $result = "Ce n'est pas bon !!";
        }        
    }

    
}

$listRdvPatients = Appointment::joinPatientRdv($id);

$patient = Patients::find($id);
 


include(dirname(__FILE__).'/../views/templates/head.php');

include(dirname(__FILE__).'/../views/templates/menu.php');

if (($_SERVER["REQUEST_METHOD"] != "POST") || !empty($errorCreatePatient)) { 
    include(dirname(__FILE__).'/../views/profil-patient.php');
    include(dirname(__FILE__).'/../views/liste-rendezvous.php');
} else { 
    include(dirname(__FILE__).'/../views/confirmUpdate.php');
}


include(dirname(__FILE__).'/../views/templates/footer.php');