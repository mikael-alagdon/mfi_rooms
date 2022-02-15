<?php
  require('include/view-schedule.inc.php');
?>
      <div id="layoutSidenav_content">
        <main>
          <div class="container-fluid">
            <h1 class="mt-4">Manage Schedule</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"><a href="index.php" style="text-decoration: none;">Home </a>/ Manage Schedule / View Schedule</li>
            </ol>
            <?php echo $msg;?>
            <div class="card mb-4">
              <div class="card-header"><i class="fas fa-table mr-1"></i>Schedule List</div>
              <div class="card-body table-dark">
                <div class="table-responsive">
                  <table class="table table-bordered table-dark" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Room</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Time-in</th>
                        <th>Time-out</th>
                        <th>Status</th>
                        <th>Option</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th><a href="view-schedule.php" type="submit" class="btn btn-secondary">Back</a></th>
                      </tr>
                    </tfoot>
                    <tbody>
                      <?php
                      if (is_array($countAll) || is_object($countAll)) {
                        foreach ($countAll as $value) {
                          $showTimeIn = date('h:i A', strtotime($value['time_in']));
                          $showTimeOut = date('h:i A', strtotime($value['time_out']));
                          $showDate = date('F, j-Y', strtotime($value['schedule_date']));
                      ?>
                      <tr>
                        <td class='<?php echo $class?>' ><?php echo $value['room_number'];?> </td>
                        <td class='<?php echo $class?>' ><?php echo $value['last_name'];?> <?php echo $value['first_name'];?></td>
                        <td class='<?php echo $class?>' ><?php echo $showDate;?></td>
                        <td class='<?php echo $class?>' ><?php echo $showTimeIn;?></td>
                        <td class='<?php echo $class?>' ><?php echo $showTimeOut;?></td>
                        <td class='<?php echo $class?>' ><?php echo $value['schedule_status'];?></td>
                        <td class='<?php echo $class?>' style="width: 10%;">
                          <a data-toggle='modal' data-target='#view-schedule-<?php echo $value['schedule_id'];?>' class="btn btn-secondary" href='#' title='View'><i class='fa fa-question'></i></a>
                          <?php 
                            if ($value['schedule_status_id'] == 2) {
                              echo "<a data-toggle='modal' data-target='#delete-room-".$value['room_id']."' class='btn btn-warning' href='#' title='Cancel'><i class='fa fa-times-circle'></i></a>";
                            }
                          ?>
                        </td>
                      </tr>
                      <!-- Modal viw schedule -->
                      <div class="modal fade" id="view-schedule-<?php echo $value['schedule_id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header table-dark">
                              <h5 class="modal-title" id="exampleModalLongTitle">Schedule Room <?php echo $value['room_number']?></h5>
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

                      <!-- Modal cancel schedule -->
                      <div class="modal fade" id="delete-room-<?php echo $value['room_id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header table-dark">
                              <h5 class="modal-title" id="exampleModalLongTitle">Cancel Schudule Room <?php echo $value['room_number']?></h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                                <div class="alert alert-warning" role="alert">
                                  Are you sure you want to <a href="#" class="alert-link">cancel</a> this schedule?<br>
                                  <span class="small">You cannot undo this action.</span>
                                </div>
                                <div class="modal-footer">
                                  <input type="hidden" name="hidden-schedule-id" value="<?php echo $value['schedule_id'];?>">
                                  <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-danger" name="submit-cancel">Cancel Schedule</button>
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
    <script src="js/jquery.js"></script>
  </body>  
</html>