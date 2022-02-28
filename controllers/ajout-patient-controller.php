<?php

require_once(dirname(__FILE__).'/../utils/regex.php');

require_once (dirname(__FILE__).'/../models/Patients.php');

$result = false;

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
        $dateActuel = strtotime(date('Y-m-d'));
        $dateCompare = strtotime($birthdate);
        if(!$testDate){
            $errorCreatePatient["birthdate"] = "La date entrée n'est pas valide!"; 
        }
        if ($dateCompare > $dateActuel){
            $errorCreatePatient["birthdateTime"] = "c'est impossible !";
        }
    }else {
        $errorCreatePatient['emptyInputBirthDate'] = 'le date de naissance est obligatoire !';
        // $birthdate = NULL;
    }

// var_dump($errorCreatePatient);
    if (empty($errorCreatePatient)) {
        
        $patient = new Patients($lastname, $firstname, $birthdate, $phoneNumber, $email);
        
        $verifMail = $patient->isMailExists();
        if (!$verifMail){
            $result = $patient->new();
        }else {
            $errorCreatePatient['errorMail'] = "l'adresse mail est déjà existante !";
        }   
    }

}


include(dirname(__FILE__).'/../views/templates/head.php');

include(dirname(__FILE__).'/../views/templates/menu.php');
// var_dump($result);
if ($result !== false) { 
    include(dirname(__FILE__).'/../views/confirmInscription.php');
} else { 
    include(dirname(__FILE__).'/../views/ajout-patient.php');  
}

include(dirname(__FILE__).'/../views/templates/footer.php');