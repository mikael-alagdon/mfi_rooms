<?php
  include'include/handle-schedule.inc.php'; // -- Update & Delete function
  include 'include/check-subject.inc.php';
  $count = $scheduleView->scheduleList('', '', $r_id);
?>
      <div id="layoutSidenav_content">
        <main>
          <div class="container-fluid">
            <h1 class="mt-4">Schedule Room <?php echo $roomNumber?></h1>
            <ol class="breadcrumb mb-4">
              <li class="breadcrumb-item active"><a href="index.php" style="text-decoration: none;">Home</a> / <?php echo $building?> Building / <a style="text-decoration: none;" href="rooms.php?b_id=<?php echo $b_id?>&f_id=<?php echo $f_id?>"><?php echo $floorLevel?> Floor</a> / Schedule</li>
            </ol>

            <div class="container py-2">
                <div class="row my-2">
                    <!-- edit form column -->
                    <div class="col-lg-4">
                        <h2 class="text-center font-weight-light">
                          <?php
                            echo $current_date = date("F, j-Y");
                            echo " <b>|</b> ";
                            echo $current_time = date('g:i A');
                          ?>
                        </h2>
                    </div>
                    <div class="col-lg-8">
                        <?php 
                          echo $form_fill_up; // -- Error message for teacher
                        ?>
                    </div>
                    <div class="col-lg-8 order-lg-1 personal-info">
                        <form role="form" action="<?php echo $_SERVER['PHP_SELF']."?b_id=".$_GET['b_id']."&f_id=".$_GET['f_id']."&r_id=".$_GET['r_id']?>" method="post">
                            <div class="form-group row">
                              <?php
                                if ($moderator == 1) {
                              ?>
                                <label class="col-lg-3 col-form-label form-control-label"><span class="text-danger">*</span>Person in charge</label>
                                <div class="col-lg-9">
                                    <?php  
                                      foreach ($getsubject as $key => $value) {
                                        echo "<input type='text' class='form-control' value='".$value['subject_name']."' disabled='true'>";
                                      }
                                    ?>
                                    <input type="hidden" name="subject-id" value="<?php echo $value['subject_id']?>">
                                </div>
                              <?php
                                }
                                else {
                              ?>
                                <label class="col-lg-3 col-form-label form-control-label"><span class="text-danger">*</span>Subject</label>
                                <div class="col-lg-9">
                                    <select class="<?php echo $invalidSI?> custom-select mr-sm-6" name='subject-id'>
                                      <option hidden="true" selected="" value="0">Subject</option>
                                      <?php  
                                        foreach ($getsubject as $key => $value) {
                                          echo "<option name='subject-id' value='".$value['subject_id']."'>".$value['subject_name']."</option>";
                                        }
                                      ?>
                                    </select>
                                    <div class="small text-danger">
                                      <?php echo $errors["subject-id"]?>
                                    </div>
                                </div>
                              <?php
                                }
                              ?>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"><span class="text-danger">*</span>Time-in & Time-out</label>
                                <div class="col-lg-4">
                                    <input type="time" id="inputTimeIn" class="<?php echo $invalidTI?> form-control" name="time-in" value="<?php echo $defaultTimeIn?>">
                                    <div class="small text-danger">
                                      <?php echo $errors["time-in"]?>
                                    </div>
                                </div>
                                <label class="col-lg-1 col-form-label form-control-label">To:</label>
                                <div class="col-lg-4">
                                    <input type="time" id="inputTimeOut" class="<?php echo $invalidTO?> form-control" name="time-out" value="<?php echo $defaultTimeOut?>">
                                    <div class="small text-danger">
                                      <?php echo $errors["time-out"]?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"><span class="text-danger">*</span>Date</label>
                                <div class="col-lg-9">
                                    <input type="date" id="date-picker" class="<?php echo $invalidDS?> form-control datepicker" name="date-schedule">
                                    <div class="small text-danger">
                                      <?php echo $errors["date-schedule"]?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Purpose</label>
                                <div class="col-lg-9">
                                    <textarea style='resize: none;' maxlength='285' class='<?php echo $invalidD?> form-control' name="description" placeholder='Purpose...' rows='5' cols='100%'></textarea>
                                    <div class="small text-danger">
                                      <?php echo $errors["description"]?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-9 ml-auto text-right">
                                    <a class="btn btn-outline-secondary" href="rooms.php?b_id=<?php echo $b_id?>&f_id=<?php echo $f_id?>">Cancel</a>
                                    <input type="hidden" name="hidden-room-id" value="<?php echo $r_id?>">
                                    <button type='submit' class='btn btn-primary' name="submit-schedule"> Schedule</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-lg-4 order-lg-0">
                        <div class="alert alert-info p-3">
                          <b>Note:</b>
                          <br>Booking in any event there is at least a 1 hour plan in.
                          <br><b>e.g.</b><br> 1:00 PM to 2:00 PM is <b>valid</b>
                          <br> 1:00 PM to 1:30 PM is <b>invalid</b>
                          <hr>Time of no shedule <b>11:00 PM</b> to <b>4:00 AM</b>
                        </div>
                       <a a data-toggle='modal' data-target='#show-schedule' href='#'><b>| !</b> View here schedule of room <?php echo $roomNumber?></a>
                        <!-- <img src="//api.adorable.io/avatars/120/trickst3r.png" class="mx-auto img-fluid rounded-circle" alt="avatar" />
                        <h6 class="my-4">Upload a new photo</h6>
                        <div class="input-group px-xl-4">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="inputGroupFile02">
                                <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <button class="btn btn-secondary"><i class="fa fa-upload"></i></button>
                            </div>
                        </div> -->
                    </div>

                </div>
            </div>
          </div>
        </main>

                <div class='modal fade' id='show-schedule' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle'>
                  <div class='modal-dialog modal-xl modal-dialog-centered' role='document'>

                    <!-- Start of reserve modal -->
                    <div class='modal-content reserve'>
                      <div class='modal-header table-dark'>
                        <h5 class='modal-title' id=''>Schedule of room <?php echo $roomNumber?></h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                          <span aria-hidden='true'>&times;</span>
                        </button>
                      </div>
                      <div class='modal-body'>

                          <div class='form-row align-items-center'>
                              <div class="container-fluid">
                                <hr>
                                <div class="card mb-4">
                                  <div class="card-header"><i class="fas fa-table mr-1"></i>Schedule List</div>
                                  <div class="card-body table-dark">
                                    <div class="table-responsive">
                                      <table class="table table-bordered table-dark" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                          <tr>
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
                                            <td class='<?php echo $class?>' ><?php echo $value['last_name'];?> <?php echo $value['first_name'];?></td>
                                            <td class='<?php echo $class?>' ><?php echo $showDate;?></td>
                                            <td class='<?php echo $class?>' ><?php echo $showTimeIn;?></td>
                                            <td class='<?php echo $class?>' ><?php echo $showTimeOut;?></td>
                                            <td class='<?php echo $class?>' ><?php echo $value['schedule_status'];?></td>
                                            <td class='<?php echo $class?>' style="width: 5%;">
                                              <a data-toggle='modal' data-target='#view-schedule-<?php echo $value['schedule_id'];?>' class="btn btn-secondary" href='#' title='View'><i class='fa fa-question'></i></a>
                                            </td>
                                          </tr>
                                          <!-- Modal view schedule -->
                                          <div class="modal fade" id="view-schedule-<?php echo $value['schedule_id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                              <div class="modal-content">
                                                <div class="modal-header table-dark">
                                                  <h5 class="modal-title" id="exampleModalLongTitle">View Schedule Room <?php echo $value['room_number']?></h5>
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
                          <div class='modal-footer'>
                            <button type='button' class="btn btn-outline-secondary" data-dismiss='modal'>Sclose</button>
                          </div>
                          
                      </div>
                    </div>
                    <!-- End of reserve modal -->
                  </div>
                </div>

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
    <script type="text/javascript">

      // -- This javascript function for current date
      $(document).ready(function(){
        document.getElementById('date-picker').valueAsDate = new Date();
      });

    </script>
  </body>
</html>