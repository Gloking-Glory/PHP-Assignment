<?php
    session_start();
    require "dbConnection.php";

    $classFail = "alert alert-danger text-center";
    $classPass = "alert alert-success text-center";

    // json_encode(['users'=>mysqli_fetch_array($s)]);
    

    if (isset($_POST['updateDetails'])) {
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $id = $_SESSION['id'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['message'] = "Enter a valid email address";
            $_SESSION['class'] = $classFail;
            header("location: dashboard.php");
            return;
        }

        $updateInfo = "UPDATE users SET firstName = '$firstName', lastName = '$lastName', email = '$email', username = '$username' WHERE id = '$id'";
        $update = mysqli_query($connection, $updateInfo);
        if ($update) {
            $_SESSION['firstName'] = $firstName;
            $_SESSION['lastName'] = $lastName;
            $_SESSION['email'] = $email;
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $id;
            $_SESSION['message'] = "Information update successful";
            $_SESSION['class'] = $classPass;
            header("location: dashboard.php");
        }
    }

    if (isset($_POST['updatePassword'])) {
        $oldPassword = $_POST['oldPassword'];
        $newPassword = $_POST['newPassword'];
        $confirmNewPassword = $_POST['confirmNewPassword'];
        $id = $_SESSION['id'];

        if ($newPassword !== $confirmNewPassword) {
            $_SESSION['message'] = "New Password does not match";
            $_SESSION['class'] = $classFail;
            header("location: dashboard.php");
            return;
        }

        $findPassword = "SELECT password FROM users WHERE id = '$id'";
        $foundPassword = mysqli_query($connection, $findPassword);

        if (mysqli_num_rows($foundPassword) > 0) {   
            $password = mysqli_fetch_array($foundPassword);
            if (password_verify($oldPassword, $password['password'])) {
                $updatePassword = "UPDATE users SET password = '$newPassword' WHERE id = '$id'";
                $update = mysqli_query($connection, $updatePassword);
                if ($update) {
                    $_SESSION['message'] = "Password updated successfully";
                    $_SESSION['class'] = $classPass;
                    header("location: dashboard.php");
                } else {
                    $_SESSION['message'] = "Password updated failed, try again";
                    $_SESSION['class'] = $clasFail;
                    header("location: dashboard.php");
                }
            } else {
                $_SESSION['message'] = "Incorrect Old Password";
                $_SESSION['class'] = $classFail;
                header("location: dashboard.php");
            }
        }
    }

    if (isset($_POST['deleteAccount'])) {
        $password = $_POST['password'];
        $id = $_SESSION['id'];

        $findPassword = "SELECT password FROM users WHERE id = '$id'";
        $foundPassword = mysqli_query($connection, $findPassword);

        if (mysqli_num_rows($foundPassword) > 0) {
            $userPassword = mysqli_fetch_array($foundPassword);
            
            if (password_verify($password, $userPassword['password'])) {
                $delete = "DELETE FROM users WHERE id = '$id'";
                $deleteAccount = mysqli_query($connection, $delete);
                if ($deleteAccount) {
                    unset($_SESSION['firstName']);
                    unset($_SESSION['lastName']);
                    unset($_SESSION['email']);
                    unset($_SESSION['username']);
                    unset($_SESSION['id']);
                    header("location: index.php");
                } else {
                    $_SESSION['message'] = "Account deleting error, try again";
                    $_SESSION['class'] = $classFail;
                    header("location: dashboard.php");
                }
            } else {
                $_SESSION['message'] = "Incorrect password entered";
                $_SESSION['class'] = $classFail;
                header("location: dashboard.php");
            }
        }
    }

    if (isset($_POST['logOut'])) {
        unset($_SESSION['firstName']);
        unset($_SESSION['lastName']);
        unset($_SESSION['email']);
        unset($_SESSION['username']);
        unset($_SESSION['id']);
        header("location: login.php");
    }
?>