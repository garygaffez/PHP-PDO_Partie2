<h1 class="title is-1 has-text-link has-text-centered m-5">
    <?php 
    if ($allAppointments === true) {
        echo 'Liste de tous les rendez-vous';
    } else {
        echo 'rendez-vous du patient';
    }
?>
</h1>
<div class="columns">
    <div class="column pt-5">
        <div class="is-flex is-justify-content-space-evenly">
            <?php
            if ($allAppointments === true) {  ?>
                <button class="button is-link"><a href="/controllers/ajout-rendezvous-controller.php" class="has-text-light">Je crée un rendez-vous !</a> </button>
            <?php
            }
            ?>
        </div>
    </div>
</div>


<div class="table-container is-flex is-justify-content-center pt-5">
    <table class="table is-bordered">                     
        <?php
        if ($listRdvPatients instanceof PDOException){
            echo $listRdvPatients->getMessage();               
        }else { ?>
        <thead>
            <tr>  
                <th scope="col" class="is-center text-danger fs-3">Patient</th>                  
                <th scope="col">date de rendez-vous</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($listRdvPatients as $listRdvPatient) {?>                    
                    <tr>
                        <td>
                            <?=$listRdvPatient->lastname;?> <?=$listRdvPatient->firstname;?> - <?=$listRdvPatient->mail;?>
                        </td>

                        <td>
                            <?php
                                $date = $listRdvPatient->dateHour;
                                echo datefmt_format(DATEFORMAT, strtotime($date));                                
                            ?>                               
                        </td>

                        <td>
                            <a href="/controllers/update-rendezvous-controller.php?id=<?=$listRdvPatient->idAppointment;?>">Modifier</a>                               
                        </td>

                        <td>
                            <a href="/controllers/delete-rendezvous-controller.php?id=<?=$listRdvPatient->idAppointment;?>">Supprimer</a>                               
                        </td>
                    </tr>
                <?php
                }                        
            }               
            ?>
        </tbody>
    </table>
</div>