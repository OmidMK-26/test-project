<?php

    $conn = mysqli_connect('localhost', 'Omid', 'php123456', 'myjob');

    if (!$conn){
        echo 'Connection faild' . mysqli_connect_error();
    }
 
?>
