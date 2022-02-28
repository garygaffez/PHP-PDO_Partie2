<?=$result ?? '';?>

<h1 class="title is-1 has-text-link has-text-centered m-5">Je modifie un rendez-vous</h1>


<?php
if ($rdv instanceof PDOException){
    echo $rdv->getMessage();
}else{?>
<form action="/controllers/update-rendezvous-controller.php?id=<?=$id;?>" method="POST" class="d-flex flex-column justify-content-center" id="suscribe">

<div class="container is-max-desktop">
    <div class="columns is-flex is-justify-content-center">
        <div class="column is-6">
            <div class="field">
            <p class="control">
            <label for="idPatient" class="label">Patient</label>

            <select name="idPatient" id="idPatient">
                    <option value=""></option>
                <?php
                    foreach ($arrayPatients as $patient) {
                                            
                        $isSelected = ($patient->id == $rdv->idPatients) ? 'selected' : '';
                        echo "<option $isSelected value=\"$patient->id\">
                                $patient->lastname $patient->mail                                
                            </option>";
                        ?>
                    <?php
                    }                               
                ?>
                </select>
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
            <label for="dateHour" class="label">Date du nouveau rendez-vous</label>

                <input class="input" type="datetime-local" name="dateHour" id="dateHour" value="<?=$rdv->dateHour;?>" required placeholder="Date du rendez-vous">

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

<?php
}
?>
