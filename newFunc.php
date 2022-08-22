<?php
    require "dbConnection.php";
    
    echo json_encode([date('H:i:sa')]);


    if (isset($_GET['sq'])) {
        $search = "%" . $_GET['sq'] . "%";
        $sql = "SELECT * FROM users WHERE email LIKE '$search'";
        $result = mysqli_query($connection, $sql);
        if (mysqli_num_rows($result) > 0) {
            echo json_encode(mysqli_fetch_assoc($result));
            return;
        }
        echo json_encode("User Not Found");
    }
?>