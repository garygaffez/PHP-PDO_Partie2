<?=$result ?? '';?>

<h1 class="title is-1 has-text-link has-text-centered m-5">Je modifie les informations de mon patient</h1>


<form action="/controllers/profil-patient-controller.php?id=<?=$patient->id;?>" method="POST" class="d-flex flex-column justify-content-center" id="suscribe" >

<div class="container is-max-desktop">
    <div class="columns is-flex is-justify-content-center">
        <div class="column is-6">
            <div class="field">
                <label class="label">Nom</label>
                <div class="control">
                    <input class="input" type="text" id="Name" pattern="<?=REG_STR_NO_NUMBER?>" value="<?=$patient->lastname;?>" name="lastname" placeholder="Tapez votre nom" required>
                </div>
                <div class="text-danger fst-italic mb-3">
                    <?=$errorCreatePatient['errorLastname'] ?? '';?>
                    <?=$errorCreatePatient['emptyInputLastname'] ?? ''?>
                </div>
            </div>
        </div>
    </div>

    <div class="columns is-flex is-justify-content-center">
        <div class="column is-6">
            <div class="field">
                <label class="label">Prénom</label>
                <div class="control">
                    <input class="input" type="text" id="firstName" pattern="<?=REG_STR_NO_NUMBER?>" value="<?=$patient->firstname;?>" name="firstname" placeholder="Tapez votre prénom" required>
                </div>
                <div class="text-danger fst-italic mb-3">
                    <?=$errorCreatePatient['errorFirstname'] ?? '';?>
                    <?=$errorCreatePatient['emptyInputFirstname'] ?? ''?>
                </div>
            </div>
        </div>
    </div>

    <div class="columns is-flex is-justify-content-center">
        <div class="column is-6">
            <div class="field">
                <label class="label">Téléphone</label>
                <div class="control">
                    <input class="input" type="tel" id="phoneNumber" name="phoneNumber"
                            value="<?=$patient->phone;?>" pattern="<?=REG_STR_PHONENUMBER?>" maxlength="10" placeholder="Téléphone">
                </div>
                <div class="text-danger fst-italic mb-3">
                    <?=$errorCreatePatient['errorPhoneNumber'] ?? '';?>
                </div>
            </div>
        </div>
    </div>

    <div class="columns is-flex is-justify-content-center">
        <div class="column is-6">
            <div class="field">
            <p class="control">
            <label class="label">Mail</label>
                <input class="input" type="email" id="email" name="email" value="<?=$patient->mail;?>"  placeholder="Email" required>
            </p>            
            </div>
            <div class="text-danger fst-italic mb-3">
                <?=$errorCreatePatient['errorMail'] ?? '';?>
                <?=$errorCreatePatient['emptyInputMail'] ?? '';?>
            </div>
        </div>
    </div>

    <div class="columns is-flex is-justify-content-center">
        <div class="column is-6">
            <div class="field">
            <p class="control">
            <label class="label">Date de naissance</label>
                <input class="input" type="date" name="birthdate" id="birthdate" placeholder="Date de naissance" value="<?=htmlentities($patient->birthdate)?>">
            </p>            
            </div>
            <div class="text-danger fst-italic mb-3">
            <?=htmlentities($errorCreatePatient["birthdate"] ?? '');?>

            </div>
        </div>
    </div>

    <div class="columns is-flex is-justify-content-center">
        <input type="submit" id="validInscription" class="button is-primary" value="Enregistrer les modifications"> 
    </div>

</div>

</form>
