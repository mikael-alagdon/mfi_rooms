<?php
  require('include/edituser.inc.php');
?>
    <div id="layoutSidenav_content">
      <main>
        <div class="container-fluid">
          <h1 class="mt-4">Manage Users</h1>
          <ol class="breadcrumb mb-4">
              <li class="breadcrumb-item active"><a href="index.php" style="text-decoration: none;">Home </a>/ Manage Users / <a href="viewusers.php" style="text-decoration: none;">View Users</a> / Edit user</li>
          </ol>
          <div class="card-body">
            <?php
              echo $msg;
              foreach ($edit as $val) {
            ?>
              <form action="<?php echo $_SERVER['PHP_SELF'].'?id='.$_GET['id']?>" method="post">
                <div class="form-group">
                  <label class="mb-1" for="registerUsername"><span class="text-danger">*</span>Username:</label>
                  <input class="<?php echo $invalidU?> form-control py-4" name="username" type="text" placeholder="Enter username" autocomplete="off" value="<?php echo $val['username'];?>" />
                  <div class="small text-danger">
                    <?php echo $errors["username"] ?? '' ?>
                  </div>
                </div>
                <div class="form-group">
                  <label class="mb-1" for="registerUsertype"><span class="text-danger">*</span>User Type:</label>
                  <select name='usertype' class="<?php echo $invalidUT?> custom-select mr-sm-6" id="inlineFormCustomSelect">
                    <?php
                    if (is_array($countType) || is_object($countType)) {
                      foreach ($countType as $value) {
                        $selected = "";
                        if ($val['user_type_id'] == $value['user_type_id']) {
                          $selected = "selected";
                        }
                    ?>
                    <option <?php echo $selected?> value=<?php echo $value['user_type_id']?>><?php echo $value['user_type']; ?></option>
                    <?php
                      }
                    }
                    ?>
                    </select>
                    <div class="small text-danger">
                      <?php echo $errors["usertype"] ?? '' ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-9 ml-auto text-right">
                        <input type="hidden" name="hidden-profile-id" value="<?php echo $val['profile_id']?>">
                        <a class="btn btn-outline-secondary" type="button" href="viewusers.php">Cancel</a>
                        <input type="submit" class="btn btn-primary" name="submit" value="Save Changes" />
                    </div>
                </div>
              </form>
            <?php
              }
            ?>
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
