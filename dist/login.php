<?php
  require('include/login.inc.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg my-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                                            <?php echo $error  ?>
                                            <div class="form-group">
                                              <label class="small mb-1" for="loginUsername">Username</label>
                                              <input class="<?php echo $invalidU?> form-control py-4" name="loginUsername" type="text" autocomplete="off" placeholder="Enter username" value="<?php echo htmlspecialchars($_POST['loginUsername']) ?>"/>
                                              <div class="small text-danger">
                                                <?php echo $errors["loginUsername"] ?>
                                              </div>
                                            </div>
                                            <div class="form-group">
                                              <label class="small mb-1" for="loginPassword">Password</label>
                                              <input class="<?php echo $invalidP?> form-control py-4" name="loginPassword" type="password" placeholder="Enter password" />
                                              <div class="small text-danger">
                                                <?php echo $errors["loginPassword"] ?>
                                              </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-9 ml-auto text-right">
                                                    <a class="btn btn-outline-secondary" type="button" href="index.php">Cancel</a>
                                                    <input class="btn btn-primary" type="submit" name="loginSubmit" value="Submit">
                                                </div>
                                            </div>
                                            <!-- <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                  <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox"/>
                                                  <label class="custom-control-label" for="rememberPasswordCheck">Remember password</label>
                                                </div>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                              <a class="small" href="password.php">Forgot Password?</a>
                                              <input class="btn btn-primary" type="submit" name="loginSubmit" value="Submit">
                                            </div> -->
                                        </form>
                                    </div>
                                    <!-- <div class="card-footer text-center">
                                        <div class="small"><a href="register.php">Need an account? Sign up!</a></div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Resuta Company &copy; Your Website 2020</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>        
    </body>
</html>