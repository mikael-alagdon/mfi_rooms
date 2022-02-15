
<?php
  require('include/users.inc.php');
?>
      <div id="layoutSidenav_content">
        <main>
          <div class="container-fluid">
            <h1 class="mt-4">Manage Users</h1>
            <ol class="breadcrumb mb-4">
              <li class="breadcrumb-item active"><a href="index.php" style="text-decoration: none;">Home </a>/ Manage Users / <a href="viewusers.php" style="text-decoration: none;">View Users </a>/ Create</li>
            </ol>
            <div class="card-body">
              <?php
                echo $msg; // -- Error message
              ?>
              <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                <div class="form-group">
                    <label class="medium mb-1" for="registerUsername"><span class="text-danger">*</span>Username:</label>
                    <input class="<?php echo $invalidU?> form-control py-4" name="username" type="text" placeholder="Enter username" autocomplete="off" value="<?php echo $intValue ?>" />
                    <div class="small text-danger">
                      <?php echo $errors["username"]?>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="medium mb-1" for="registerPassword"><span class="text-danger">*</span>Password:</label>
                    <input class="<?php echo $invalidP?> form-control py-4" name="password" type="password" placeholder="Enter password" />
                    <div class="small text-danger">
                      <?php echo $errors["password"]?>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="medium mb-1" for="registerUsertype"><span class="text-danger">*</span>User Type:</label>
                    <select class="<?php echo $invalidUT?> custom-select mr-sm-6" name='usertype' id="">
                      <option hidden="true" selected="" value="0">Select User Type</option>
                      <?php
                        foreach ($countType as $value) {
                      ?>
                        <option name='usertype' value=<?php echo $value['user_type_id']?>>
                          <?php echo $value['user_type']; ?>
                        </option>
                      <?php
                        }
                      ?>
                    </select>
                    <div class="small text-danger">
                      <?php echo $errors["usertype"]?>
                    </div>
                </div>
                
                <div class="form-group row">
                    <div class="col-lg-9 ml-auto text-right">
                        <a class="btn btn-outline-secondary" type="button" href="viewusers.php">Cancel</a>
                        <input type="submit" class="btn btn-primary" name="submit" value="Create User" />
                    </div>
                </div>

              </form>
            </div>
          </div>
        </main>
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

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/datatables-demo.js"></script>
  </body>
</html>