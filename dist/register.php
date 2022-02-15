<?php
  require('include/register.inc.php');
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
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Create an admin</h3></div>
                                    <div class="card-body">
                                      <div class='border border-danger alert alert-danger text-center' role='alert' id='test' hidden='true'>Incorrect username or password.</div>
                                        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                                            <div class="form-group">
                                              <label class="small mb-1" for="username"><span class="text-danger">*</span>Username:</label>
                                              <input class="<?php echo $invalidU?> form-control py-4" name="username" type="text" placeholder="Enter username" autocomplete="off" value="<?php echo htmlspecialchars($_POST['username'])?>">
                                              <div class="small text-danger">
                                                <?php echo $errors["username"]?>
                                              </div>
                                            </div>
                                            <div class="form-group">
                                              <label class="small mb-1" for="password"><span class="text-danger">*</span>Password:</label>
                                              <input class="<?php echo $invalidP?> form-control py-4" name="password" type="password" placeholder="Enter password" />
                                              <div class="small text-danger">
                                                <?php echo $errors["password"]?>
                                              </div>
                                            </div>
                                            <div class="form-group">
                                              <label class="small mb-1" for="conPassword"><span class="text-danger">*</span>Confirm Password:</label>
                                              <input class="<?php echo $invalidCP?> form-control py-4" name="conPassword" type="password" placeholder="Confirm password" />
                                              <div class="small text-danger">
                                                <?php echo $errors["conPassword"]?>
                                              </div>
                                            </div>
                                            <div class="form-group">
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                              <input class="btn btn-primary" type="submit" name="submit" value="Register">
                                            </div>
                                        </form>
                                    </div>
                                    
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