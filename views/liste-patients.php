<div class="columns">
    <div class="column has-text-centered">
        <ul class="is-size-1 is-italic mt-5 is-flex anim is-justify-content-center">
            <li>L</li>
            <li>i</li>
            <li>s</li>
            <li>t</li>
            <li class="mr-4">e</li>
            <li>d</li>
            <li>e</li>
            <li class="mr-4">s</li>
            <li>p</li>
            <li>a</li>
            <li>t</li>
            <li>i</li>
            <li>e</li>
            <li>n</li>
            <li>t</li>
            <li>s</li>
        </ul>
    </div>
</div>
<!-- 
<h1 class="title is-1 has-text-link has-text-centered m-5">Liste des patients de la maison médicale</h1> -->

<div class="columns">
    <div class="column pt-5">
        <div class="is-flex is-justify-content-space-evenly">
            <button class="button is-link">
                <a href="/controllers/ajout-patient-controller.php" class="has-text-light">Je crée un patient !</a>
            </button>
        </div>

        <div class="column mt-1">
            <div class="is-flex is-justify-content-space-evenly">
                <form action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method="GET" >
                <p class="has-text-link has-text-weight-bold mb-3">Je recherche un patient :</p>
                    <input type="search" class="input is-link is-small has-text-link" name="search" placeholder="rechercher un patient" pattern="<?=REG_STR_NO_NUMBER?>" value="<?=$search ?? ''?>" >
                    <button type="submit" class="button is-link is-small mt-1">Rechercher</button>
                    
                    <div class="text-is-center">
                        <?=$errorSearch['errorsearch'] ?? '';?>
                    </div>
                </form>

                <form method="get">
                    <p class="has-text-link has-text-weight-bold mb-3">Nombre de résultats par page</p>
                    <div class="select">
                        <select name="selectPatientNumber" class="">
                            <option value="5" <?=($selectPatientNumber === 5) ? 'selected' : '';?>>5</option>
                            <option value="10" <?=($selectPatientNumber === 10) ? 'selected' : '';?>>10</option>
                            <option value="15" <?=($selectPatientNumber === 15) ? 'selected' : '';?>>15</option>
                            <option value="20" <?=($selectPatientNumber === 20) ? 'selected' : '';?>>20</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="button is-link is-small">Filtrer</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="columns is-justify-content-center">
    <div class="column is-6">
        <nav class="pagination is-centered is-rounded m-2" role="navigation" aria-label="pagination">

            <?php
                if ($page > 1) {?>
                    <a href="?page=<?php echo $page - 1;?>&selectPatientNumber=<?=$selectPatientNumber;?>&search=<?=$search;?>" class="pagination-previous has-background-danger has-text-primary-light">Page précédente</a>
            <?php
            }
            ?>
        
        <ul class="pagination-list">

            <li>
                <?php
                    for ($i = $page - 2; $i <= $page - 1; $i++) {                    
                        if ($i > 0 && $i < $nbPages) {?>
                            <a href="?page=<?php echo $i;?>&selectPatientNumber=<?=$selectPatientNumber;?>&search=<?=$search;?>" class="pagination-link has-background-danger has-text-primary-light"><?php echo $i;?></a>
                        <?php
                        }
                    }
                ?>
            </li>
            
            <li>
                <a href="?page=<?php echo $page;?>&selectPatientNumber=<?=$selectPatientNumber;?>&search=<?=$search;?>" class="pagination-link has-background-light has-text-danger"><?php echo $page;?></a>
            </li>

            <li>
                <?php
                    for ($i = $page + 1; $i <= $page + 2; $i++) {
                        if ($i <= $nbPages) {?>
                            <a href="?page=<?php echo $i;?>&selectPatientNumber=<?=$selectPatientNumber;?>&search=<?=$search;?>" class="pagination-link has-background-danger has-text-primary-light"><?php echo $i;?></a>
                        <?php
                        }
                    }
                ?>
            </li>
        </ul>

            <?php
                if ($page < $nbPages) {?>
                    <a href="?page=<?php echo $page + 1;?>&selectPatientNumber=<?=$selectPatientNumber;?>&search=<?=$search;?>" class="pagination-next has-background-danger has-text-primary-light">Page suivante</a>
            <?php
            }
            ?>

        </nav>
    </div>
</div>
<!-- <div class="columns is-justify-content-center">
    <div class="column is-8">
        <nav class="pagination is-centered is-rounded m-2" role="navigation" aria-label="pagination">
            <?php
                if ($page > 1) {?>            
                    <a href="?page=<?php echo $page - 1;?>&selectPatientNumber=<?=$selectPatientNumber;?>" class="pagination-previous has-background-danger has-text-primary-light">Page précédente</a>        
            <?php
            }
            ?>

            <ul class="pagination-list">
                <li><a class="pagination-link" aria-label="Goto page 1" href="?page=1&selectPatientNumber=<?=$selectPatientNumber;?>">1</a></li>
                <li><span class="pagination-ellipsis">&hellip;</span></li>
                <li><a class="pagination-link" aria-label="Goto page 45" href="?page=<?=($page -1) < 1 ? 1 : $page - 1;?>&selectPatientNumber=<?=$selectPatientNumber;?>">
                    <?=($page -1) < 1 ? '' : $page - 1;?>
                </a></li>


                <li><a class="pagination-link is-current" aria-label="Page 46" aria-current="page"><?php echo $page;?></a></li>


                <li><a class="pagination-link" aria-label="Goto page 47" href="?page=<?=($page + 1) > $nbPages ? $nbPages : $page + 1;?>&selectPatientNumber=<?=$selectPatientNumber;?>">
                    <?=($page + 1) > $nbPages ? '' : $page + 1;?>
                </a></li>

                <li><span class="pagination-ellipsis">&hellip;</span></li>

                <li><a class="pagination-link" aria-label="Goto page 86" href="?page=<?php echo $nbPages;?>&selectPatientNumber=<?=$selectPatientNumber;?>"><?=$nbPages;?></a></li>
            </ul>

            <?php
                if ($page < $nbPages) {?>
                    <a href="?page=<?php echo $page + 1;?>&selectPatientNumber=<?=$selectPatientNumber;?>" class="pagination-next has-background-danger has-text-primary-light">Page suivante</a>
            <?php
            }
            ?>

        </nav>
    </div>
</div>
 -->


    <div class="table-container is-flex is-justify-content-center pt-2">
        <table class="table is-bordered">                     
            <?php
            if ($patients instanceof PDOException) {?>
                <p class=""><?=$patients->getMessage();?></p>
            <?php                
            }else { ?>
            <thead>
                <tr>

                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Date de naissance</th>
                    <th scope="col">Téléphone</th>
                    <th scope="col">mail</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($patients as $patient) {?>
                        <tr>

                            <td><a href="/controllers/profil-patient-controller.php?id=<?=$patient->id;?>"><?=$patient->lastname;?></a></td>
                            <td><a href="/controllers/profil-patient-controller.php?id=<?=$patient->id;?>"><?=$patient->firstname;?></a></td>
                            <td><?=$patient->birthdate;?></td>
                            <td><?=$patient->phone;?></td>
                            <td><a href="mailto:gary.gaffez@gmail.com"><?=$patient->mail;?></a></td>

                            <!-- <td>                                
                                <a href="/controllers/profil-patient-controller.php?id=<?=$patient->id;?>" class="has-text-link">Modifier le patient</a>                                
                            </td> -->
                            <td>                                
                                <a href="/controllers/delete-patient-controller.php?id=<?=$patient->id;?>" class="has-text-link"><img src="/assets/img/delete-1-icon.png" class="image is-24x24" alt=""></a>                                
                            </td>
                            
                        </tr>

                    <?php
                    }

            }             
                ?>

            </tbody>
        </table>
    </div>

    


