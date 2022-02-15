<?php
  include 'navbar.php';
  if (empty($_SESSION["account"])) {echo "<script>location.href='index.php'</script>";} // -- if not login then redirect to this page

  $r_id = $_GET['roid'];
  $f_id = $_GET['flid'];
  $b_id = $_GET['buid'];
  $subject_id = $_GET['suid'];
  $time_in = $_GET['tiin'];
  $time_out = $_GET['tiou'];
  $schedule_date = $_GET['scda'];

  $room = $roomView->viewRoom($r_id);
  foreach ($room as $value) {
    $roomNumber = $value['room_number'];
    $floorLevel = $value['level'];
    $building = $value['building_name'];
  }
?>

  <div id="layoutSidenav_content">
    <main>
      <div class="container-fluid">
        <h1 class="mt-4">Schedule Room <?php echo $roomNumber?></h1>
        <ol class="breadcrumb mb-4">
          <li class="breadcrumb-item active"><a href="index.php" style="text-decoration: none;">Home</a> / <?php echo $building?> Building / <a style="text-decoration: none;" href="rooms.php?b_id=<?php echo $b_id?>&f_id=<?php echo $f_id?>"><?php echo $floorLevel?> Floor</a> / Schedule</li>
        </ol>


        <div class="card-body">
          <div class="alert alert-success alert-dismissible">
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            Schedule successfuly.
          </div>
          <h3 class="font-weight-light mr-5">Schedule Information</h3><hr>
            <div class="container emp-profile">
                <div class="row">
                    <div class="col-md-12">
                        <div class="profile-head">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>User</label>
                                    </div>
                                    <div class="col-md-10">
                                        <b>
                                            <?php echo $_SESSION['profile'][0]['last_name'].', '.$_SESSION['profile'][0]['first_name'].' '.$_SESSION['profile'][0]['middle_name'].' '.$_SESSION['profile'][0]['suffix'];?>
                                        </b>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>Schedule date</label>
                                    </div>
                                    <div class="col-md-10">
                                        <p>
                                          <?php echo $schedule_date?>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>Time-in</label>
                                    </div>
                                    <div class="col-md-10">
                                        <p>
                                          <?php echo $time_in?>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>Time-out</label>
                                    </div>
                                    <div class="col-md-10">
                                        <p>
                                          <?php echo $time_out?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
            <div class="col-lg-9 ml-auto text-right">
                <a class="btn btn-outline-secondary" href="rooms.php?b_id=<?php echo $b_id?>&f_id=<?php echo $f_id?>">Close</a>
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