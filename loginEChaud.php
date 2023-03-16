
<?php
    session_start();
    include 'init.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['Matricule']) && isset($_POST['Code'])){
            $id_formation = exist_Mat_Code($_POST['Matricule'], $_POST['Code']);
            if($id_formation != 0){
                $_SESSION['Matricule'] = $_POST['Matricule'];
                $_SESSION['Code'] = $_POST['Code'];
                $_SESSION['id_formation'] = $id_formation;
                header("Location: EvaluationChaud.php");
            }else{
                echo "Matricule ou Code est pas correct";
            }
        }
    }
?>

<form action="EvaluationChaud.php"  method="post">
    <input type="number" name="Matricule" required placeholder="Entre votre Matricule" >
    <input type="text" name="Code" required placeholder="Entre votre code pour cette formation">
    <input type="submit" value="send">
</form>

<?php

