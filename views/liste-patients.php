<h1 class="title is-1 has-text-link has-text-centered m-5">Liste des patients de la maison médicale</h1>

<div class="columns">
    <div class="column pt-5">
        <div class="is-flex is-justify-content-space-evenly">
            <button class="button is-link">
                <a href="/controllers/ajout-patient-controller.php" class="has-text-light">Je crée un patient !</a>
            </button>

            
        </div>
    </div>
</div>


    <div class="table-container is-flex is-justify-content-center pt-5">
        <table class="table is-bordered">                     
            <?php
            if (!empty ($errorMessage)) {?>
                <p class="text-center text-danger fs-3"><?=$errorMessage;?></p>
            <?php                
            }else { ?>
            <thead>
                <tr>

                    <th scope="col">lastname</th>
                    <th scope="col">firstname</th>
                    <th scope="col">birthdate</th>
                    <th scope="col">phone</th>
                    <th scope="col">mail</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($patients as $patient) {?>
                        <tr>
                            <td><?=$patient->lastname;?></td>
                            <td><?=$patient->firstname;?></td>
                            <td><?=$patient->birthdate;?></td>
                            <td><?=$patient->phone;?></td>
                            <td><?=$patient->mail;?></td>
                            <td>                                
                                <a href="/controllers/profil-patient-controller.php?id=<?=$patient->id;?>" class="has-text-link">Modifier</a>                                
                            </td>
                            <td>                                
                                <a href="/controllers/profil-patient-controller.php?id=<?=$patient->id;?>" class="has-text-link">Supprimer</a>                                
                            </td>
                        </tr>

                    <?php
                    }
                }                
                ?>

            </tbody>
        </table>
    </div>


