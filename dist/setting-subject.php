<?php
  require('include/setting-subject.inc.php');
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
                                    <a class="nav-link" href="setting-profile.php" aria-selected="false">Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="setting-account.php" aria-selected="false">Account</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" id="subject-tab" data-toggle="tab" href="#subject" role="tab" aria-controls="subject" aria-selected="true">Subject</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row my-2">
                    <div class="tab-content profile-tab col-md-8 " id="myTabContent">
                        <div class="tab-pane fade show active" id="subject" role="tabpanel" aria-labelledby="subject-tab">
                            <!-- edit form column -->
                            <div class="col-lg-12 order-lg-1 personal-info">
                              <form>
                                
                              </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card mb-4">
              <div class="card-header"><i class="fas fa-table mr-1"></i>My subject list</div>
              <div class="card-body table-dark">
                <div class="table-responsive-sm">
                  <table class="table table-bordered table-dark" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Subject</th>
                        <th>Option</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th></th>
                        <th><a data-toggle='modal' data-target='#addSubject' class="btn btn-primary" href='#'>Add Subject</a></th>
                      </tr>
                    </tfoot>
                    <tbody>
                      <?php
                      if (is_array($subject) || is_object($subject)) {   
                        foreach ($subject as $value) {
                      ?>
                      <tr>
                        <td><?php echo $value['subject_name'];?></td>
                        <td style="width: 12%;">
                          <a data-toggle='modal' data-target='#editCourse-<?php echo $value['subject_id']?>' class="btn btn-info" href='#' title="Edit"><i class="fa fa-edit"></i></a>
                          <a data-toggle='modal' data-target='#deleteSubject-<?php echo $value['subject_id']?>' class="btn btn-warning" href='#' title="Delete"><i class="fa fa-trash"></i></a>
                        </td>
                      </tr>

                      <!-- Modal edit course -->
                      <div class="modal fade" id="editCourse-<?php echo $value['subject_id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                          <div class="modal-content">
                            <div class="modal-header table-dark">
                              <h5 class="modal-title" id="exampleModalLongTitle">Edit Subject - ID: <?php echo $value['subject_id']?></h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                                <div class='form-row align-items-center'>

                                  <div class='col-sm-12 my-1'>
                                    <input type='text' min='1' class='form-control' name="subject-name" value='<?php echo $value['subject_name']?>' placeholder='Course' autocomplete="off">
                                  </div>

                                </div><br>

                                <div class="modal-footer">
                                  <input type="hidden" name="hidden-subject-id" value="<?php echo $value['subject_id'];?>">
                                  <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Canel</button>
                                  <button type="submit" class="btn btn-primary" name="submit-save">Save</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div> 

                      <!-- Modal delete course -->
                      <div class="modal fade" id="deleteSubject-<?php echo $value['subject_id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header table-dark">
                              <h5 class="modal-title " id="exampleModalLongTitle">Delete Subject - ID: <?php echo $value['subject_id']?></h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                                <div class="alert alert-warning" role="alert">
                                  Are you sure you want <a href="#" class="alert-link">delete</a> this subject?<br>
                                  <span class="small">You cannot undo this action.</span>
                                </div>
                                <div class="modal-footer">
                                  <input type="hidden" name="hidden-subject-id" value="<?php echo $value['subject_id'];?>">
                                  <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Canel</button>
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

        <!-- Modal add subject -->
        <div class="modal fade" id="addSubject" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header table-dark">
                <h5 class="modal-title" id="exampleModalLongTitle">Add subject</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                  <div class='form-row align-items-center'>
                    <div class='col-sm-12 my-1'>
                      <input type='text' min='1' class='form-control' name="subject-name" placeholder='Subject' autocomplete="off">
                    </div>
                  </div><br>

                  <div class="modal-footer">
                    <input type="hidden" name="hidden-teacher-id" value="<?php echo $teacher_id;?>">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Canel</button>
                    <button type="submit" class="btn btn-primary" name="submit-add">Add</button>
                  </div>
                </form>
              </div>
            </div>
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

  </body>
</html>