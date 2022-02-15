<?php
  require('include/viewCourse.inc.php');
?>
      <div id="layoutSidenav_content">
        <main>
          <div class="container-fluid">
            <h1 class="mt-4">Manage Course</h1>
            <ol class="breadcrumb mb-4">
              <li class="breadcrumb-item active"><a href="index.php" style="text-decoration: none;">Home </a>/ Create Course / View Courses</li>
            </ol>
            <?php echo $msg;?>
            <div class="card mb-4">
              <div class="card-header"><i class="fas fa-table mr-1"></i>Course List</div>
              <div class="card-body table-dark">
                <div class="table-responsive">
                  <table class="table table-bordered table-dark" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Course</th>
                        <th>Program</th>
                        <th>Department</th>
                        <th>Option</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th><a href="courses.php" type="submit" class="btn btn-primary">Add Course</a></th>
                      </tr>
                    </tfoot>
                    <tbody>
                    	<?php
                      if (is_array($count) || is_object($count)) {   
                    	  foreach ($count as $value) {
                    	?>
                      <tr>  
                        <td><?php echo $value['course_name'];?></td>
                        <td><?php echo $value['program_name'];?></td>
                        <td><?php echo $value['department_name'];?></td>
                        <td style="width: 12%;">
                          <a data-toggle='modal' data-target='#editCourse<?php echo $value['course_id'];?>' class="btn btn-info" href='#' title="Edit"><i class="fa fa-edit"></i></a>
                          <a data-toggle='modal' data-target='#deleteCourse<?php echo $value['course_id'];?>' class="btn btn-warning" href='#' title="Delete"><i class="fa fa-trash"></i></a>
                      </tr>

                      <!-- Modal edit course -->
                      <div class="modal fade" id="editCourse<?php echo $value['course_id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header table-dark">
                              <h5 class="modal-title" id="exampleModalLongTitle">Edit Course - ID: <?php echo $value['course_id']?></h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                                <div class='form-row align-items-center'>

                                  <div class='col-sm-12 my-1'>
                                    <input type='text' min='1' class='form-control' name="course-name" value='<?php echo $value['course_name']?>' placeholder='Course' autocomplete="off">
                                  </div>

                                  <div class='col-sm-12 my-1'>
                                    <select class="custom-select mr-sm-6" name='program-id' id="">
                                      <?php
                                        if (is_array($countType) || is_object($countType)) {
                                          foreach ($countType as $cValue) {
                                            $selected = "";
                                            if ($value['program_id'] == $cValue['program_id']) {
                                              $selected = "selected";
                                            }
                                      ?>
                                        <option <?php echo $selected?> value=<?php echo $cValue['program_id']?>><?php echo $cValue['program_name']; ?></option>
                                      <?php
                                          }
                                        }
                                      ?>
                                    </select>
                                  </div>

                                  <div class='col-sm-12 my-1'>
                                    <select class="custom-select mr-sm-6" name='department-id' id="">
                                      <?php
                                        if (is_array($countDep) || is_object($countDep)) {
                                          foreach ($countDep as $cValue) {
                                            $selected = "";
                                            if ($value['department_id'] == $cValue['department_id']) {
                                              $selected = "selected";
                                            }
                                      ?>
                                        <option <?php echo $selected?> value=<?php echo $cValue['department_id']?>><?php echo $cValue['department_name']; ?></option>
                                      <?php
                                          }
                                        }
                                      ?>
                                    </select>
                                  </div>
                                </div><br>

                                <div class="modal-footer">
                                  <input type="hidden" name="hidden-course-id" value="<?php echo $value['course_id'];?>">
                                  <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                                  <button type="submit" class="btn btn-primary" name="submit-save">Save</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div> 

                      <!-- Modal delete course -->
                      <div class="modal fade" id="deleteCourse<?php echo $value['course_id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header table-dark">
                              <h5 class="modal-title" id="exampleModalLongTitle">Delete Course - ID: <?php echo $value['course_id']?></h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                                <div class="alert alert-warning" role="alert">
                                  Are you sure you want to <a href="#" class="alert-link">delete</a> this course?<br>
                                  <span class="small">You cannot undo this action.</span>
                                </div>
                                <div class="modal-footer">
                                  <input type="hidden" name="hidden-course-id" value="<?php echo $value['course_id'];?>">
                                  <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                                  <button type="submit" class="btn btn-danger" name="submit-delete">Delete</button>
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