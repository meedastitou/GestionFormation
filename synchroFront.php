<?php
session_start();
// echo $_SESSION['username']; // exist 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    extract($_POST);
    include 'Admin/includes/ConxionDB/connect.php'; // Conect With Database
    include 'includes/functions/CRUD.php';
    if (isset($_POST['synchronisation'])) {
        if (isset($_POST['do'])) {

            if ($_POST['do'] == 'AddGroup') {
?>
                <select id="mySelect" name="participants[]" class="select2 form-control input-shadow" multiple required>
                    <?php
                    $query = "SELECT *
                                            FROM employe
                                            WHERE Matricule NOT IN (SELECT Matricule FROM partisipe WHERE ( id_formation = ". $_POST['id_formation'] ." ) OR (date = '" . $_POST['date'] . "' AND timeStart < '". $_POST['timeFin'] ."' AND timeFin > '". $_POST['timeStart']."' ))";

                    $stmt = $con->prepare($query);
                    $stmt->execute();
                    $result = $stmt->fetchAll();
                    foreach ($result as $row) {
                        echo '<option value="' . $row["Matricule"] . '">' . $row["Matricule"] . '. ' . $row["Nom"] . ' ' . $row['Prenom'] . '</option>';
                        // print_r($row);
                    }
                    ?>
                </select>
<?php
            }
        }
        exit();
    }
}
