<?php
  require('include/setting.inc.php');
?>
      <div id="layoutSidenav_content">
        <main>
          <div class="container-fluid">
            <h1 class="mt-4">Settings</h1>
            <ol class="breadcrumb mb-4">
              <li class="breadcrumb-item active"><a href="index.php" style="text-decoration: none;">Home </a>/ <a href="profile.php" style="text-decoration: none;">Profile </a>/ Settings</li>
            </ol>

            <div class="container py-2">

                <div class="row">
                    <div class="col-md-12">
                        <div class="profile-head">
                            <h5>
                                <?php echo $_SESSION['profile'][0]['last_name'].', '.$_SESSION['profile'][0]['first_name'].' '.$_SESSION['profile'][0]['middle_name'].' '.$_SESSION['profile'][0]['suffix'];?>
                            </h5>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="setting-account.php" aria-selected="false">Account</a>
                                </li>
                                <?php
                                  if ($_SESSION['profile'][0]['user_type_id'] == 5) {
                                ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="setting-subject.php" aria-selected="false">Subject</a>
                                </li>
                                <?php
                                  }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row my-2">

                    <div class="tab-content profile-tab col-md-12" id="myTabContent">
                        <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                            <!-- edit form column -->
                            <div class="col-lg-12 order-lg-1 personal-info">
                                <?php
                                  echo $msg;
                                ?>
                                <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Profession</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" name="profession" autocomplete="off" value="<?php echo $intValPro?>"/>
                                        </div>
                                    </div>
                                    <?php 
                                    if ($moderator == 5) {
                                    ?>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label"><span class="text-danger">*</span>Department</label>
                                        <div class="col-lg-9">
                                            <select class="<?php echo $invalidDI?> form-control" name='department-id' value="<?php echo $intValDI?>">
                                              <option hidden="true" value="">Select department</option>
                                              <?php
                                                foreach ($teacher as $valT) {
                                                  $asdas = $valT['department_id'];
                                                }                                               
                                                foreach ($countDep as $value) {
                                                  $select = "";
                                                  // -- Check the room type
                                                  if ($asdas == $value['department_id']) {
                                                    $select = "selected";
                                                  }
                                                  echo "<option $select value='".$value['department_id']."'>".$value['department_name']."</option>";
                                                }
                                              ?>
                                            </select>
                                            <div class="small text-danger">
                                              <?php echo $errors["department-id"]?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php 
                                    }
                                    else{
                                      echo "<input type='hidden' name='department-id' value='0'>";
                                    }
                                    ?>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label"><span class="text-danger">*</span>Username</label>
                                        <div class="col-lg-9">
                                            <input class="<?php echo $invalidU?> form-control" type="text" name="username" autocomplete="off" value="<?php echo $intValU?>"/>
                                            <div class="small text-danger">
                                              <?php echo $errors["username"]?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label"><span class="text-danger">*</span>First name</label>
                                        <div class="col-lg-9">
                                            <input class="<?php echo $invalidF?> form-control" type="text" name="firstname" value="<?php echo $intValFirst?>" autocomplete="off"/>
                                            <div class="small text-danger">
                                              <?php echo $errors["firstname"]?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label"><span class="text-danger">*</span>Last name</label>
                                        <div class="col-lg-9">
                                            <input class="<?php echo $invalidL?> form-control" type="text" name="lastname" value="<?php echo $intValLast ?>" autocomplete="off"/>
                                            <div class="small text-danger">
                                              <?php echo $errors["lastname"]?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Middle name & Suffix</label>
                                        <div class="col-lg-4">
                                            <input class="form-control" type="text" name="middlename" placeholder="Middle name" autocomplete="off" value="<?php echo $intValMiddle?>"/>
                                        </div>
                                        <div class="col-lg-5">
                                            <input class="form-control" type="text" name="suffix" placeholder="Suffix" autocomplete="off" value="<?php echo $intValSuf?>"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Phone</label>
                                        <div class="col-lg-9">
                                            <input class="<?php echo $invalidPh?> form-control" type="text" name="phone" autocomplete="off" value="<?php echo $intValPho?>"/>
                                            <div class="small text-danger">
                                              <?php echo $errors["phone"]?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label"><span class="text-danger">*</span>Email</label>
                                        <div class="col-lg-9">
                                            <input class="<?php echo $invalidE?> form-control" type="text" name="email" autocomplete="off" value="<?php echo $intValEm?>"/>
                                            <div class="small text-danger">
                                              <?php echo $errors["email"]?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Address</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" name="address" autocomplete="off" value="<?php echo $intValAdr?>"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-9 ml-auto text-right">
                                            <input type="hidden" name="hidden-type-id" value="<?php echo$_SESSION["profile"][0]["user_type_id"]?>">
                                            <a class="btn btn-outline-secondary" type="button" href="profile.php">Cancel</a>
                                            <input type="submit" class="btn btn-primary" name="submit-profile" value="Save Changes" />
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
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