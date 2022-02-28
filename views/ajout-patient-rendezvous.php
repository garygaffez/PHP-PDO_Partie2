<h1 class="title is-1 has-text-link has-text-centered m-5">Je créer un patient et un rendez-vous</h1>

<h2><?=$errorCreatePatientRdv['errorRegister'] ?? '';?></h2>;

<form action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST" class="d-flex flex-column justify-content-center" id="suscribe" novalidate>

<div class="container is-max-desktop">
    <div class="columns is-flex is-justify-content-center">
        <div class="column is-6">
            <div class="field">
                <label class="label">Nom</label>
                <div class="control">
                    <input class="input" type="text" id="Name" pattern="<?=REG_STR_NO_NUMBER?>" value="<?=$lastname ?? ''?>" name="lastname" placeholder="Tapez votre nom" required>
                </div>
                <div class="text-danger fst-italic mb-3">
                    <?=$errorCreatePatientRdv['errorLastname'] ?? '';?>
                    <?=$errorCreatePatientRdv['emptyInputLastname'] ?? ''?>
                </div>
            </div>
        </div>
    </div>

    <div class="columns is-flex is-justify-content-center">
        <div class="column is-6">
            <div class="field">
                <label class="label">Prénom</label>
                <div class="control">
                    <input class="input" type="text" id="firstName" pattern="<?=REG_STR_NO_NUMBER?>" value="<?=$firstname ?? ''?>" name="firstname" placeholder="Tapez votre prénom" required>
                </div>
                <div class="text-danger fst-italic mb-3">
                    <?=$errorCreatePatientRdv['errorFirstname'] ?? '';?>
                    <?=$errorCreatePatientRdv['emptyInputFirstname'] ?? ''?>
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
                            value="<?=$phoneNumber ?? ''?>" pattern="<?=REG_STR_PHONENUMBER?>" maxlength="10" placeholder="Téléphone">
                </div>
                <div class="text-danger fst-italic mb-3">
                    <?=$errorCreatePatientRdv['errorPhoneNumber'] ?? '';?>
                </div>
            </div>
        </div>
    </div>

    <div class="columns is-flex is-justify-content-center">
        <div class="column is-6">
            <div class="field">
            <p class="control">
            <label class="label">Mail</label>
                <input class="input" type="email" id="email" name="email" value="<?=$email ?? ''?>"  placeholder="Email" required>
            </p>            
            </div>
            <div class="text-danger fst-italic mb-3">
                <?=$errorCreatePatientRdv['errorMail'] ?? '';?>
                <?=$errorCreatePatientRdv['emptyInputMail'] ?? '';?>
            </div>
        </div>
    </div>

    <div class="columns is-flex is-justify-content-center">
        <div class="column is-6">
            <div class="field">
            <p class="control">
            <label class="label">Date de naissance</label>
                <input class="input" type="date" name="birthdate" id="birthdate" placeholder="Date de naissance" value="<?=htmlentities($birthdate ?? '') ?>">
            </p>            
            </div>
            <div class="text-danger fst-italic mb-3">
            <?=htmlentities($errorCreatePatientRdv["birthdate"] ?? '');?>

            </div>
        </div>
    </div>


    <div class="columns is-flex is-justify-content-center">
        <div class="column is-6">
            <div class="field">
            <p class="control">
            <label for="dateHour" class="label">Date du rendez-vous</label>

                <input class="input" type="datetime-local" name="dateHour" id="dateHour" min="8:00" max="18:00" required placeholder="Date du rendez-vous" value="<?=htmlentities($dateTime ?? '') ?>">

            </p>                        
            </div>
            <div class="text-danger fst-italic mb-3">
                <?=htmlentities($errorCreatePatientRdv["errorDate"] ?? '');?>
            </div>
        </div>
    </div>

    <div class="columns is-flex is-justify-content-center">
        <input type="submit" id="validInscription" class="button is-primary" value="Enregistrer"> 
    </div>

</div>

</form>
