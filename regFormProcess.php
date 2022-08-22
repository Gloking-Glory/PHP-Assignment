<?php
    session_start();
    require "dbConnection.php";
    $classFail = "alert alert-danger text-center";
    $classPass = "alert alert-success text-center";

    if (isset($_POST['gotoLogin'])) {
        header("location: login.php");
    }

    if (isset($_POST['regSubmit'])) {
        if (empty($_POST['firstName']) || empty($_POST['lastName']) || empty($_POST['email']) || empty($_POST['username']) || empty($_POST['password']) || empty($_POST['confirmPassword']) ) {
            $_SESSION['message'] = "Fill out the form to continue";
            $_SESSION['class'] = $classFail;
            header("location: index.php");
            return;
        }

        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['message'] = "Enter a valid email address";
            $_SESSION['class'] = $classFail;
            header("location: index.php");
            return;
        }

        if ($password !== $confirmPassword) {
            $_SESSION['message'] = "Password does not match";
            $_SESSION['class'] = $classFail;
            header("location: index.php");
            return;
        }

        $findEmail = "SELECT email FROM users WHERE email = '$email' ";
        $findUsername = "SELECT username FROM users where username - '$username' ";
        $foundEmail = mysqli_query($connection, $findEmail);
        $foundUsername = mysqli_query($connection, $findUsername);

        if (mysqli_num_rows($foundEmail) > 0) {
            $_SESSION['message'] = "Email already exist";
            $_SESSION['class'] = $classFail;
            header("location: index.php");
            return;
        }

        if (mysqli_num_rows($foundUsername) > 0) {
            $_SESSION['message'] = "Username already exist";
            $_SESSION['class'] = $classFail;
            header("locaation: index.php");
            return;
        }

        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        $regForm = "INSERT INTO users(firstName, lastName, email, username, password) VALUES('$firstName', '$lastName', '$email', '$username', '$hashPassword')";
        $saveForm = mysqli_query($connection, $regForm);

        if ($saveForm) {
            $_SESSION['message'] = "Registration successful, continue to login from here";
            $_SESSION['class'] = $classPass;
            header("location: login.php");
        } else {
            $_SESSION['message'] = "Registration Failed, Try again";
            $_SESSION['class'] = $classFail;
            header("location: index.php");
        }
    }
?>