<?php session_start() ?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

        <style>
            body {
                background-color: #94bbe9;
            }
            #logContainer, #regImage {
                margin-top: 5%;
            }
        </style>
        <title>REGISTER</title>
    </head>
    <body>
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-6 shadow mx-auto" id="logContainer">
                        <div class="p-3">
                            <h4 class="text-center">REGISTRATION FORM</h4>
                            <form action="regFormProcess.php" method="post">
                                <?php include("message.php"); ?>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" placeholder="First Name" class="form-control mt-3" name="firstName">
                                        </div>
                                        <div class="col">
                                            <input type="text" placeholder="Last Name" class="form-control mt-3" name="lastName">
                                        </div>
                                    </div>
                                    <input type="text" placeholder="Email" class="form-control mt-3" name="email">
                                    <input type="text" placeholder="Username" class="form-control mt-3" name="username">
                                    <div class="row">
                                        <div class="col">
                                            <input type="password" placeholder="Password" class="form-control mt-3" name="password">
                                        </div>
                                        <div class="col">
                                            <input type="password" placeholder="Confirm Password" class="form-control mt-3" name="confirmPassword">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success mt-3 w-100" name="regSubmit">REGISTER</button>
                                </div>
                            </form>
                            <div class="text-center">
                                <form action="regFormProcess.php" method="POST">
                                    <button class="btn" name="gotoLogin">Already have an account? Log In</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mx-auto" id="regImage">
                        <img src="./images/regImage.png" alt="regImage" class="w-100 h-100">
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>