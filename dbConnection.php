<?php
    $server = "localhost";
    $user = "root";
    $password = "";
    $dbName = "updateassignment";

    $connection = mysqli_connect($server, $user, $password, $dbName);

    if (!$connection) {
        echo "Something went wrong";
    }
?>