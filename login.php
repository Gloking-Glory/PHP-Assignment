<?php session_start(); ?>
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
            #logContainer {
                margin-top: 5%;
            }
        </style>
        <title>REGISTER</title>
    </head>
    <body>
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 shadow mx-auto" id="logContainer">
                        <div class="p-3">
                            <h4 class="text-center">LOGIN</h4>
                            <form action="logFormProcess.php" method="post">
                                <?php include("message.php"); ?>

                                <div class="form-group">
                                        <input type="text" placeholder="Email / Username" class="form-control mt-3" name="userId">
                                        <input type="password" placeholder="Password" class="form-control mt-3" name="password">
                                    </div>
                                    <button type="submit" class="btn btn-success mt-3 w-100" name="logSubmit">LOGIN</button>
                                </div>
                            </form>
                            <div class="text-center">
                                <form action="logFormProcess.php" method="post">
                                    <button class="btn" name="gotoRegister">Dont have an account? Register here</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </body>
</html>