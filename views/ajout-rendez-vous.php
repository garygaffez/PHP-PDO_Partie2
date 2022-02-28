<?=$result ?? '';?>

<h1 class="title is-1 has-text-link has-text-centered m-5">Je prends un rendez-vous</h1>

<form action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST" class="d-flex flex-column justify-content-center" id="suscribe">

<div class="container is-max-desktop">
    <div class="columns is-flex is-justify-content-center">
        <div class="column is-6">
            <div class="field">
                <p class="control">            
                <label for="idPatient" class="label">Choisissez un patient</label>
                <div class="select">
                    <select name="idPatient" id="idPatient">
                        <option value=""></option>
                    <?php
                        foreach ($arrayPatients as $patient) {?>
                            <option value="<?=$patient->id;?>">
                                <?=$patient->lastname;?>
                                <?=$patient->firstname;?>
                            </option>
                        <?php
                        }                               
                    ?>
                    </select>
                </div>
            </p> 
            <div class="text-danger fst-italic mb-3">
                <?=$errorCreateAppointment['errorIdPatient'] ?? '';?>
            </div>
            </div>
        </div>
    </div>


    <div class="columns is-flex is-justify-content-center">
        <div class="column is-6">
            <div class="field">
            <p class="control">
            <label for="dateHour" class="label">Date du rendez-vous</label>

                <input class="input" type="datetime-local" name="dateHour" id="appointment" required placeholder="Date du rendez-vous" value="<?=htmlentities($dateTime ?? '') ?>">

            </p>                        
            </div>
            <div class="text-danger fst-italic mb-3">
                <?=htmlentities($errorCreateAppointment["errorDate"] ?? '');?>
            </div>
        </div>
    </div>

    

    <div class="columns is-flex is-justify-content-center">
        <input type="submit" id="validInscription" class="button is-primary" value="Enregistrer"> 
    </div>

</div>

</form>
