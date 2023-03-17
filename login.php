<?php
session_start();
$pageTitle = "Login";


echo $_SESSION['existGood'] . " " . $_SESSION['email'] . " " . $_SESSION['role'];
if(isset($_SESSION['existGood']) && isset($_SESSION['email']) && isset($_SESSION['role'])){
    header('Location: index.php'); // redirect To index Page
}

$pageTitle = "login";
$noNav="";
include "includes/functions/functions.php";

$show =0;
// if he's comming from the form 
if($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['code'])){
    // get email the user
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $role = filter_var($_POST['role'], FILTER_SANITIZE_STRING);
    $matricule = filter_var($_POST['matricule'], FILTER_VALIDATE_INT);
    $formErrors = array();

    if(empty($email)){
        $formErrors[] = "You Must Enter <strong>Valid</strong> Email";
    }
    if($role != "Responsible" && $role != "Employe"){
        $formErrors[] = "You Must Choose <strong>Your Job</strong>";
    }
    if(empty($formErrors)){
        
        // $generateCode = generateRandomString(8);
        // $_SESSION['codegenerate'] = $generateCode;
        $_SESSION['email'] = $email;
        $_SESSION['role'] = $role;
        $_SESSION['matricule'] = $matricule;
        // sendEmail($email, $generateCode);
    
        $show=1;
    }
    foreach ($formErrors as $error) {
        echo '<div class="alert alert-danger">' . $error . '</div>';
    }

}elseif($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['code'])){
    // if($_SESSION['codegenerate'] == $_POST['code']){
    if(1 == $_POST['code']){

        $_SESSION['existGood']="";

        header('Location: index.php');
    }else{
        echo "Code is not Correct";
    }

}

?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>"  method="post">
    <table border="1" align="center">
        <tr>
            <td>Enter Your Email</td>
            <td><input type="text" name="email" value="<?php if(isset($_SESSION['email'])) echo $_SESSION['email'];?>"></td>
            <td>
                <select name="role" id="">
                    <option value="0">Choose your Role at The Formation</option>
                    <option value="Responsible">Responsible</option>
                    <option value="Employe">Employe</option>
                </select>
            </td>
        </tr>
        <tr colspan="3" align="center">
            <td><input type="number" name="matricule" placeholder="Enter Your Matricule"></td>
        </tr>
        <?php if($show == 1){
        ?>
        <tr>
            <td colspan="3" align="center"><input type="text" name="code" > </td>
        </tr>

        <?php
        } 
        ?>
        <tr>
            <td colspan="3" align="center"><input type="submit" name="submit" value="Send Email"> </td>
        </tr>
        
        <table>
</form>

<?php

