<?php
session_start();
// echo $_SESSION['username']; // exist 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    extract($_POST);
    include 'includes/ConxionDB/connect.php'; // Conect With Database
    include 'includes/fonctions/CRUD.php';
    include 'includes/fonctions/functions.php';
    
    if (isset($_POST['synchronisation'])) {
        if (isset($_POST['do'])) {
    
            if ($_POST['do'] == 'Delete' && isset($_POST['id_formation'])) {

                Delete($_POST['id_formation']);

            } elseif ($_POST['do'] == 'selectBetween' && isset($_POST['start']) && isset($_POST['fin'])) {

                $formations = selectBetween($_POST['start'], $_POST['fin']);
                foreach ($formations as $formation) {
                    echo "<tr class='align-middle'>";
                    echo '<th scope="row" class="id_formation" >' . $formation['id_formation'] . '</th>';
                    echo '<td class="name_formation">' . $formation['nom_formation'] . '</td>';
                    echo '<td class="propose_formation">' . $formation['service_propose'] . '</td>';
                    echo '<td class="ex_in_formation">' . $formation['formation_EX_IN'] . '</td>';
                    echo '<th class="date_start">' . $formation['date_debut'] . '</th>';
                    echo '<th class="duree_formation text-center">' . $formation['hours_formation'] . '</th>';
                    echo '<th class="contoll d-flex justify-content-around">';
                    echo '<button type="button" data-bs-toggle="modal" data-bs-target="#editFormation" class="btn btn-primary" onclick="showFormationEdit(' . $formation['id_formation'] . ')" >Edit</button>';
                    echo '<butoon href="" class="btn btn-danger" onclick="conf(' . $formation['id_formation'] . ')">Delete</butoon>';
                    echo '<button data-bs-toggle="modal" data-bs-target="#detailsFormation" onclick="showFormationDetails(' . $formation['id_formation'] . ')" class="btn btn-success">Details</button>';
                    echo '</th>';
                    echo '</tr>';
                }
                
            } elseif ($_POST['do'] == 'getById' && isset($_POST['id_formation'])) {

                $formation = getByIdWithEmp($_POST['id_formation']);
                echo json_encode($formation);

            } elseif ($_POST['do'] == 'Update' && isset($_POST['id_formaiton'])) {
                $formErrors = validation($_POST['formationName'], $_POST['formationCat'],$_POST['objectif'],  $_POST['proposedBy'], 
                                        $_POST['numberHoures'], $_POST['trainerName'],  $_POST['traininigSite'], 
                                        $_POST['nbParticepants'], $_POST['dateStart'], $_POST['dateFin'], $_POST['responsable']);
                if(empty($formErrors)){
                    
                    $c = Update($_POST['id_formaiton'],
                            $_POST['formationName'],
                            $_POST['formationCat'],
                            $_POST['proposedBy'],
                            $_POST['numberHoures'],
                            $_POST['trainerName'], 
                            $_POST['trainerNumber'],
                            $_POST['trainerEmail'],
                            $_POST['traininigSite'],
                            $_POST['nbParticepants'],
                            $_POST['dateStart'],
                            $_POST['dateFin'],
                            $_POST['formationEI'],
                            $_POST['responsable'],
                            $_POST['objectif']);

                    echo $c;
                }else{
                    echo "error";
                }
                

            } elseif($_POST['do'] == 'getByFilter'){
                $formations = getByFilter($_POST['date_debut'], $_POST['date_fin'], '','');
                ?>
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="id_formation">id</th>
                            <th class="name_formation">name</th>
                            <th class="ex_in_formation">Ex/In</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($formations as $formation) {
                            echo "<tr class='align-middle'>";
                            echo '<th scope="row" class="id_formation" >' . $formation['id_formation'] . '</th>';
                            echo '<td class="name_formation">' . $formation['nom_formation'] . '</td>';
                            echo '<td class="ex_in_formation">' . $formation['formation_EX_IN'] . '</td>';
                            echo '</tr>';
                        }

                        ?>
                    </tbody>
                </table>
                <?php
            }
        }
        exit();
    }
    
}


?>