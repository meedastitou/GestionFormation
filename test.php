<?php
$ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:8080/GestionFormation/login.php');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    $post = array(
        'data1' => 'value1',
        'data2' => 'value2'
    );
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
    
    //do what you want with the responce
    var_dump($result);
exit();
    ?>