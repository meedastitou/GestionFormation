<?php

include 'init.php';

// function generateRandomString($length = 8)
// {
//     $characters = '0123456789abcdefghijklmnopqrs092u3tuvwxyzaskdhfhf9882323ABCDEFGHIJKLMNksadf9044OPQRSTUVWXYZ';
//     $charactersLength = strlen($characters);
//     $randomString = '';
//     for ($i = 0; $i < $length; $i++) {
//         $randomString .= $characters[rand(0, $charactersLength - 1)];
//     }
//     return $randomString;
// }
// for($i=0;$i<20;$i++){
// $a=generateRandomString();
// echo $a . "</br>";
// $b=generateRandomString();
// echo $b;
// $stmt = $con->prepare("INSERT INTO `employe` (`Matricule`, `Nom`, `Prenom`, `sexe`) VALUES (NULL, :za , :zb , 'Homme')");
// $stmt->execute(array(
//     ':za' =>$a,
//     ':zb' =>$b
// ));
// }
$myregex = "~^(19|20)\d\d[- /.](0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])$~";

print filter_var("bad 01/02/2012 bad",FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=> $myregex)));