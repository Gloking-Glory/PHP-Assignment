<?php 
    session_start();
    if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
        header("location: index.php");
    }
    else {
?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

        <style>
            #dashboardContainer {
                height: 100vh;
            }
            .displayDetails {
                margin-top: 10%;
            }
            #btnContainer {
                display: inline-flex;
            }
        </style>
        <title>Dashboard</title>
    </head>
    <body>
        <div class="container-fluid bg-light" id="dashboardContainer">
            <div class="container">
                <div class="row">
                    <div class="col-5 bg-white text-center rounded shadow displayDetails">
                        <img src="./images/avatar.png" alt="avatar">
                        <?php echo "<h3 class='text-uppercase'>" . $_SESSION['firstName'] . " " . $_SESSION['lastName'] . "</h3> <p>" . $_SESSION['email'] . "</p>" ?>
                        
                        <div id="btnContainer">
                            <button class="btn btn-danger" data-toggle="modal" data-target="#deleteAccount">DELETE MY ACCOUNT</button>
    
                            <form action="updateInfo.php" method="POST" class="mx-3">
                                <button type="submit" name="logOut" class="btn btn-danger">LOG OUT</button>
                            </form>
                        </div>


                        <div class="modal fade" id="deleteAccount" tabindex="-1" role="dialog" aria-labelledby="deleteAccount" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">DELETE ACCOUNT</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h5 class="text-center"><?php echo $_SESSION['username']; ?>, you are about to delete your account, enter your password to continue:</h5>
                                        <form action="updateInfo.php" method="POST">
                                            <div class="form-group">
                                                <input type="password" placeholder="Password" class="form-control mt-3" name="password">
                                                <button type="submit" name="deleteAccount" class="btn btn-danger mt-3">DELETE</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-6 bg-white rounded shadow mx-3 displayDetails">
                        <input type="text" id="searchInput" oninput="search()" class="form-control">
                        <div id="searchResult"></div>
                        <div id="displayTime"></div>
                        <div class="p-3">
                            <h4 class="text-center">DETAILS</h4>
                            <?php include("message.php") ?>

                            <table class="table table-striped table-borderless">
                                <tbody>
                                    <tr>
                                        <td class="font-weight-bold">FIRST NAME</td>
                                        <td> <?php echo $_SESSION['firstName']; ?> </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">LAST NAME</td>
                                        <td> <?php echo $_SESSION['lastName']; ?> </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">EMAIL</td>
                                        <td> <?php echo $_SESSION['email']; ?> </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">USERNAME</td>
                                        <td> <?php echo $_SESSION['username']; ?> </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="text-center">
                                <button class="btn btn-success" data-toggle="modal" data-target="#updateForm">EDIT DETAILS</button>
                                <button class="btn btn-primary" data-toggle="modal" data-target="#updatePassword">CHANGE PASSWORD</button>
                            </div>
                                                        
                            <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="updateForm" aria-hidden="true" id="updateForm">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-center">UPDATE ACCOUNT DETAILS</h5>
                                            <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h5 class="text-center"><?php echo $_SESSION['username']; ?>, you are about to change your details, fill in the form to continue:</h5>
                                            <form action="updateInfo.php" method="POST">
                                                <div class="form-group">
                                                    <input type="text" placeholder="First Name" class="form-control mt-3" value="<?php echo $_SESSION['firstName']; ?>" name="firstName">
                                                    <input type="text" placeholder="Last Name" class="form-control mt-3" value="<?php echo $_SESSION['lastName']; ?>" name="lastName">
                                                    <input type="text" placeholder="Email" class="form-control mt-3" value="<?php echo $_SESSION['email']; ?>" name="email">
                                                    <input type="text" placeholder="Username" class="form-control mt-3" value="<?php echo $_SESSION['username']; ?>" name="username">
                                                    <div class="text-center">
                                                        <button type="submit" class="btn btn-success mt-3" name="updateDetails">SAVE CHANGES</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="updatePassword" aria-hidden="true" id="updatePassword">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-center">UPDATE PASSWORD</h5>
                                        <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h5 class="text-center"><?php echo $_SESSION['username']; ?>, you are about to change your account password, fill in the form to continue:</h5>
                                        <form action="updateInfo.php" method="POST">
                                            <div class="form-group">
                                                <input type="password" placeholder="Old Password" class="form-control mt-3" name="oldPassword">
                                                <input type="password" placeholder="New Password" class="form-control mt-3" name="newPassword">
                                                <input type="password" placeholder="Confirm New Password" class="form-control mt-3" name="confirmNewPassword">
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-success mt-3" name="updatePassword">SAVE CHANGES</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    </body>


    <script>
        const search =()=> {
            fetch(`http://localhost/updateAssignment/newFunc.php?sq=${searchInput.value}`)
            .then(res => res.json())
            .then(response => {
                searchResult.innerHTML = JSON.stringify(response);
            })
        }

        setInterval(() => {
            fetch(`http://localhost/updateAssignment/newFunc.php`)
            .then(res => res.json())
            .then(response => {
                displayTime.innerHTML = JSON.stringify(response)
            })
        }, 1000);
    </script>
</html>

<?php 
    }
?>