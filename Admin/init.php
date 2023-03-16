<?php
include 'includes/ConxionDB/connect.php'; // Conect With Database




// $sessionUser ='';
// if(isset($_SESSION['user'])){
//         $sessionUser = $_SESSION['user'];
// }

        // Routes

$tpl        = 'includes/templates/';       // Template Directory
$lang       = 'includes/languages/';       // Language Directory
$func       = 'includes/fonctions/';       // Functions Directory
$imgs       = 'includes/images/';          // Images Directory   
$css        = 'layout/css/';               // Css Directory
$js         = 'layout/js/';                // Js Directory


        // Include The Important Files
include $func . 'CRUD.php';
include $func . 'functions.php';
include $tpl . 'header.php';
