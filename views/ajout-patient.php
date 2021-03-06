<?=$result ?? '';?>

<h1 class="title is-1 has-text-link has-text-centered m-5">Je créer un patient</h1>

<form action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST" class="d-flex flex-column justify-content-center" id="suscribe" novalidate>

<div class="container is-max-desktop">
    <div class="columns is-flex is-justify-content-center">
        <div class="column is-6">
            <div class="field">
                <label class="label">Nom</label>
                <div class="control">
                    <input class="input" type="text" id="Name" pattern="<?=REG_STR_NO_NUMBER?>" value="<?=$lastname ?? ''?>" name="lastname" placeholder="Tapez votre nom" required>
                </div>
                <div class="has-text-danger is-italic mt-2 has-text-centered has-text-weight-bold">
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
                    <input class="input" type="text" id="firstName" pattern="<?=REG_STR_NO_NUMBER?>" value="<?=$firstname ?? ''?>" name="firstname" placeholder="Tapez votre prénom" required>
                </div>
                <div class="has-text-danger is-italic mt-2 has-text-centered has-text-weight-bold">
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
                            value="<?=$phoneNumber ?? ''?>" pattern="<?=REG_STR_PHONENUMBER?>" maxlength="10" placeholder="Téléphone">
                </div>
                <div class="has-text-danger is-italic mt-2 has-text-centered has-text-weight-bold">
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
                <input class="input" type="email" id="email" name="email" value="<?=$email ?? ''?>"  placeholder="Email" required>
            </p>            
            </div>
            <div class="has-text-danger is-italic mt-2 has-text-centered has-text-weight-bold">
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
                <input class="input" type="date" name="birthdate" id="birthdate" placeholder="Date de naissance" value="<?=htmlentities($birthdate ?? '') ?>" required>
            </p>            
            </div>
            <div class="has-text-danger is-italic mt-2 has-text-centered has-text-weight-bold">
                <?=htmlentities($errorCreatePatient["birthdate"] ?? '');?>
                <?=htmlentities($errorCreatePatient["birthdateTime"] ?? '');?>
                <?=htmlentities($errorCreatePatient["emptyInputBirthDate"] ?? '');?>
            </div>
        </div>
    </div>

    <div class="columns is-flex is-justify-content-center">
        <input type="submit" id="validInscription" class="button is-primary" value="Enregistrer"> 
    </div>

</div>

</form>
