<?php
  include 'navbar.php';
  include 'include/check-subject.inc.php';
  if (empty($_SESSION["account"])) {echo "<script>location.href='index.php'</script>";} // -- if not login then redirect to this page
  $count = $scheduleView->scheduleList($_SESSION['profile'][0]['profile_id'], '', '');
?>

  <div id="layoutSidenav_content">
    <main>
      <div class="container-fluid">
        <h1 class="mt-4">Profile</h1>

        <ol class="breadcrumb mb-4">
          <li class="breadcrumb-item active"><a href="index.php" style="text-decoration: none;">Home </a>/ Profile</li>
        </ol>

        <div class="card-body">
          <?php echo $form_fill_up;?>
          <h3 class="font-weight-light mr-5">Individual Information</h3><hr>
            <div class="container emp-profile">
                <div class="row">
                    <div class="col-md-10">
                        <div class="profile-head">
                            <h5>
                                <?php echo $_SESSION['profile'][0]['last_name'].', '.$_SESSION['profile'][0]['first_name'].' '.$_SESSION['profile'][0]['middle_name'].' '.$_SESSION['profile'][0]['suffix'];?>
                            </h5>
                            <h6>
                                <?php echo $_SESSION['profile'][0]['profession']?>
                            </h6>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                </li>
                                <?php
                                if ($moderator == 1 || $moderator == 5) {
                                ?>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Schedule Time line</a>
                                </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <a href="setting-profile.php"><input class="btn btn-primary" type="submit" value="Settings"></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>User Id</label>
                                    </div>
                                    <div class="col-md-10">
                                        <p>
                                          <?php echo $_SESSION['profile'][0]['user_id']?>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>Name</label>
                                    </div>
                                    <div class="col-md-10">
                                        <p>
                                          <?php echo $_SESSION['profile'][0]['first_name'].' '.$_SESSION['profile'][0]['last_name'].' '.$_SESSION['profile'][0]['middle_name'];?>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>Email</label>
                                    </div>
                                    <div class="col-md-10">
                                        <p>
                                          <?php echo $_SESSION['profile'][0]['email']?>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>Phone</label>
                                    </div>
                                    <div class="col-md-10">
                                        <p>
                                          <?php echo $_SESSION['profile'][0]['phone']?>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>Address</label>
                                    </div>
                                    <div class="col-md-10">
                                        <p>
                                          <?php echo $_SESSION['profile'][0]['address']?>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>Profession</label>
                                    </div>
                                    <div class="col-md-10">
                                        <p>
                                          <?php echo $_SESSION['profile'][0]['profession']?>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="container-fluid">
                                  <h1 class="mt-4">My Schedule List</h1>
                                  <div class="card mb-4">
                                    <div class="card-header"><i class="fas fa-table mr-1"></i>Schedule List</div>
                                    <div class="card-body table-dark">
                                      <div class="table-responsive">
                                        <table class="table table-bordered table-dark" id="dataTable" width="100%" cellspacing="0">
                                          <thead>
                                            <tr>
                                              <th>Room</th>
                                              <th>Date</th>
                                              <th>Time-in</th>
                                              <th>Time-out</th>
                                              <th>Status</th>
                                              <th>Option</th>
                                            </tr>
                                          </thead>
                                          <tfoot>
                                            <tr>
                                            </tr>
                                          </tfoot>
                                          <tbody>
                                            <?php
                                            if (is_array($count) || is_object($count)) {
                                              foreach ($count as $value) {
                                                $showTimeIn = date('h:i A', strtotime($value['time_in']));
                                                $showTimeOut = date('h:i A', strtotime($value['time_out']));
                                                $showDate = date('F, j-Y', strtotime($value['schedule_date']));
                                            ?>
                                            <tr>
                                              <td class='<?php echo $class?>' ><?php echo $value['room_number'];?> </td>
                                              <td class='<?php echo $class?>' ><?php echo $showDate;?></td>
                                              <td class='<?php echo $class?>' ><?php echo $showTimeIn;?></td>
                                              <td class='<?php echo $class?>' ><?php echo $showTimeOut;?></td>
                                              <td class='<?php echo $class?>' ><?php echo $value['schedule_status'];?></td>
                                              <td class='<?php echo $class?>' style="width: 10%;">
                                                <a data-toggle='modal' data-target='#view-schedule-<?php echo $value['schedule_id'];?>' class="btn btn-secondary" href='#' title='View'><i class='fa fa-question'></i></a>
                                              </td>
                                            </tr>
                                            <!-- Modal view schedule -->
                                            <div class="modal fade" id="view-schedule-<?php echo $value['schedule_id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                              <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                  <div class="modal-header table-dark">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Room <?php echo $value['room_number']?></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                    </button>
                                                  </div>
                                                  <div class="modal-body">
                                                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                                                      <div class='form-row align-items-center'>

                                                          <div class="col-md-12" style="color:black">
                                                              <div class="row">
                                                                  <div class="col-md-6">
                                                                      <label>Full name</label>
                                                                  </div>
                                                                  <div class="col-md-6">
                                                                      <p>
                                                                        <?php echo $value['last_name'].' '.$value['first_name']?>
                                                                      </p>
                                                                  </div>
                                                              </div>
                                                              <div class="row">
                                                                  <div class="col-md-6">
                                                                      <label>Schedule date</label>
                                                                  </div>
                                                                  <div class="col-md-6">
                                                                      <p>
                                                                        <?php echo $showDate?>
                                                                      </p>
                                                                  </div>
                                                              </div>
                                                              <div class="row">
                                                                  <div class="col-md-6">
                                                                      <label>Time-in</label>
                                                                  </div>
                                                                  <div class="col-md-6">
                                                                      <p>
                                                                        <?php echo $showTimeIn?>
                                                                      </p>
                                                                  </div>
                                                              </div>
                                                              <div class="row">
                                                                  <div class="col-md-6">
                                                                      <label>Time-out</label>
                                                                  </div>
                                                                  <div class="col-md-6">
                                                                      <p>
                                                                        <?php echo $showTimeOut?>
                                                                      </p>
                                                                  </div>
                                                              </div>
                                                              <div class="row">
                                                                  <div class="col-md-6">
                                                                      <label>Building</label>
                                                                  </div>
                                                                  <div class="col-md-6">
                                                                      <p>
                                                                        <?php echo $value['building_name'].' Building'?>
                                                                      </p>
                                                                  </div>
                                                              </div>
                                                              <div class="row">
                                                                  <div class="col-md-6">
                                                                      <label>Level</label>
                                                                  </div>
                                                                  <div class="col-md-6">
                                                                      <p>
                                                                        <?php echo $value['level'].' floor'?>
                                                                      </p>
                                                                  </div>
                                                              </div>
                                                              <div class="row">
                                                                  <div class="col-md-6">
                                                                      <label>Status</label>
                                                                  </div>
                                                                  <div class="col-md-6">
                                                                      <p>
                                                                        <?php echo $value['schedule_status']?>
                                                                      </p>
                                                                  </div>
                                                              </div>
                                                              <div class="row">
                                                                  <div class="col-md-6">
                                                                      <label>Schedule Created</label>
                                                                  </div>
                                                                  <div class="col-md-6">
                                                                      <hr>
                                                                  </div>
                                                              </div>
                                                              <div class="row">
                                                                  <div class="col-md-6">
                                                                      <label>Date</label>
                                                                  </div>
                                                                  <div class="col-md-6">
                                                                      <p>
                                                                        <?php echo date('F, j-Y', strtotime($value['schedule_created']));?>
                                                                      </p>
                                                                  </div>
                                                              </div>
                                                              <div class="row">
                                                                  <div class="col-md-6">
                                                                      <label>Time</label>
                                                                  </div>
                                                                  <div class="col-md-6">
                                                                      <p>
                                                                        <?php echo date('h:i A', strtotime($value['schedule_created']))?>
                                                                      </p>
                                                                  </div>
                                                              </div>
                                                          </div>

                                                      </div>
                                                      <div class='modal-footer'>
                                                        <button type='button' class="btn btn-outline-secondary" data-dismiss='modal'>Close</button>
                                                      </div>
                                                    </form>
                                                  </div>
                                                </div>
                                              </div>
                                            </div> 
                                            <?php
                                              }
                                            }
                                            ?>
                                          </tbody>
                                        </table>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
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
</body>
</html>