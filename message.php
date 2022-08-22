<?php 
    if (isset($_SESSION['message'])) {
        echo "<div class='" . $_SESSION['class'] . "'> <strong>" . $_SESSION['message'] ."</strong> </div>";
        unset($_SESSION['message']);
        unset($_SESSION['class']);
    }
?>