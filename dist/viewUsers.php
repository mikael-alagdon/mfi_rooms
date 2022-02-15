<?php
  require('include/viewusers.inc.php');
?>
      <div id="layoutSidenav_content">
        <main>
          <div class="container-fluid">
            <h1 class="mt-4">Manage Users</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"><a href="index.php" style="text-decoration: none;">Home </a>/ Manage Users / View Users</li>
            </ol>
            <?php echo $msg;?>
            <div class="card mb-4">
              <div class="card-header"><i class="fas fa-table mr-1"></i>Users List</div>
              <div class="card-body table-dark">
                <div class="table-responsive">
                  <table class="table table-bordered table-dark" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>User Type</th>
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
                        <th><a href="users.php" type="submit" class="btn btn-primary">Add User</a></th>
                      </tr>
                    </tfoot>
                    <tbody>
                    	<?php
                      if (is_array($count) || is_object($count)) {
                    	  foreach ($count as $value) {
                    	?>
                      <tr>  
                        <td><?php echo $value['user_id'];?></td>
                        <td><?php echo $value['username'];?></td>
                        <td><?php echo $value['first_name'];?></td>
                        <td><?php echo $value['last_name'];?></td>
                        <td><?php echo $value['user_type'];?></td>
                        <td style="width: 15%;">
                          <a data-toggle='modal' data-target='#view-user-<?php echo $value['user_id'];?>' class="btn btn-secondary" href='#' title="View"><i class="fa fa-id-card"></i></a>
                          <a class="btn btn-info" href='edituser.php?id=<?php echo $value['user_id'];?>' title="Edit"><i class="fa fa-edit"></i></a>
                          <a data-toggle='modal' data-target='#deleteUser<?php echo $value['user_id'];?>' class="btn btn-warning" href='#' title="Delete"><i class="fa fa-trash"></i></a>
                      	</td>
                      </tr>
                      <!-- Modal delete user -->
                      <div class="modal fade" id="deleteUser<?php echo $value['user_id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header table-dark">
                              <h5 class="modal-title" id="exampleModalLongTitle">Delete User <?php echo $value['user_id']?></h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                                <div class="alert alert-warning" role="alert">
                                  Are you sure you want to <a href="#" class="alert-link">delete</a> this user?<br>
                                  <span class="small">You cannot undo this action.</span>
                                </div>
                                <div class="modal-footer">
                                  <input type="hidden" name="hidden-user-id" value="<?php echo $value['user_id'];?>">
                                  <input type="hidden" name="hidden-profile-id" value="<?php echo $value['profile_id'];?>">
                                  <input type="hidden" name="hidden-type-id" value="<?php echo $value['user_type_id'];?>">
                                  <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Canel</button>
                                  <button type="submit" class="btn btn-danger" name="submit-delete">Delete</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div> 



                      <div class="modal fade" id="view-user-<?php echo $value['user_id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header table-dark">
                              <h5 class="modal-title" id="exampleModalLongTitle">User ID: <?php echo $value['user_id'];?></h5>
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
                                                <label>Profession</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>
                                                  <?php echo $value['profession']?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>
                                                  <?php echo $value['email']?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Phone</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>
                                                  <?php echo $value['phone']?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Address</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>
                                                  <?php echo $value['address']?>
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