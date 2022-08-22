<?php
    session_start();
    require "dbConnection.php";

    if (isset($_POST['gotoRegister'])) {
        header("location: index.php");
    }

    if (isset($_POST['logSubmit'])) {
        $userId = $_POST['userId'];
        $password = $_POST['password'];
        
        if (empty($userId) || empty($password)) {
            $_SESSION['message'] = "Fill the form to login";
            $_SESSION['class'] = "alert alert-danger text-center";
            header("location: login.php");
            return;
        }

        $findUserId = "SELECT * FROM users WHERE email = '$userId' OR username = '$userId' ";
        $foundUser = mysqli_query($connection, $findUserId);

        if (mysqli_num_rows($foundUser) > 0) {
            $userInfo = mysqli_fetch_array($foundUser);
            if (password_verify($password, $userInfo['password'])) {
                $_SESSION['firstName'] = $userInfo['firstName'];
                $_SESSION['lastName'] = $userInfo['lastName'];
                $_SESSION['email'] = $userInfo['email'];
                $_SESSION['username'] = $userInfo['username'];
                $_SESSION['id'] = $userInfo['id'];
                header("location: dashboard.php");
            } else {
                $_SESSION['message'] = "Incorrect Password";
                $_SESSION['class'] = "alert alert-danger text-center";
                header("location: login.php");
            }
        } else {
            $_SESSION['message'] = "Invalid User Data";
            $_SESSION['class'] = "alert alert-danger text-center";
            header("location: login.php");
        }
    }
?>