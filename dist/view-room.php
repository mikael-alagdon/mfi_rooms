<?php
  require('include/view-room.inc.php');
?>
      <div id="layoutSidenav_content">
        <main>
          <div class="container-fluid">
            <h1 class="mt-4">Manage Rooms</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"><a href="index.php" style="text-decoration: none;">Home </a>/ Manage Rooms / View Rooms</li>
            </ol>
            <div id="result"></div> 
            <?php echo $msg;?>
            <div class="card mb-4">
              <div class="card-header"><i class="fas fa-table mr-1"></i>Room List</div>
              <div class="card-body table-dark">
                <div class="table-responsive">
                  <table class="table table-bordered table-dark" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Building</th>
                        <th>Floor</th>
                        <th>Room</th>
                        <th>Room Type</th>
                        <th>Status</th>
                        <th>Option</th>
                      </tr>
                    </thead>
                    <tfoot>
                    </tfoot>
                    <tbody>
                      <?php
                      if (is_array($count) || is_object($count)) {
                        foreach ($count as $value) {
                          if ($value['room_status_id'] == 2) {
                            $class = 'alert alert-danger';
                          }
                          else {
                            $class = 'alert alert-success';
                          }
                      ?>
                      <tr>
                        <td class='<?php echo $class?>' ><?php echo $value['building_name'];?> Building</td>
                        <td class='<?php echo $class?>' ><?php echo $value['level'];?> Floor</td>
                        <td class='<?php echo $class?>' ><?php echo $value['room_number'];?></td>
                        <td class='<?php echo $class?>' ><?php echo $value['room_type'];?></td>
                        <td class='<?php echo $class?>' ><?php echo $value['room_status'];?></td>
                        <td class='<?php echo $class?>' style="width: 10%;">
                          <a data-toggle='modal' data-target='#edit-room-<?php echo $value['room_id'];?>' class="btn btn-info" href='#' title="Edit"><i class="fa fa-edit"></i></a>
                          <a data-toggle='modal' data-target='#delete-room-<?php echo $value['room_id'];?>' class="btn btn-warning" href='#' title="Delete"><i class="fa fa-trash"></i></a>
                        </td>
                      </tr>

                      <!-- Modal edit room -->
                      <div class="modal fade" id="edit-room-<?php echo $value['room_id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                  <div class='col-sm-6 my-6'>
                                    <input onkeypress='return event.charCode >= 48 && event.charCode <= 57' type='text' min='1' maxlength='3' class='form-control' name='room-name' placeholder='Room number' autocomplete="off" value='<?php echo $value['room_number']?>'>
                                  </div><br><br>

                                  <div class='col-sm-6 my-6'>
                                    <select name='room-type' class='custom-select mr-sm-6' id=''>
                                      <?php
                                        $room_type_id = $value['room_type_id'];
                                        foreach ($roomType as $key => $arrrayRoomType) {
                                          $roomTypeId = $arrrayRoomType['room_type_id'];
                                          $roomTypeName = $arrrayRoomType['room_type'];
                                          $select = "";

                                          // -- Check the room type
                                          if ($room_type_id == $roomTypeId) {
                                            $select = "selected";
                                          }
                                          echo "<option $select value='$roomTypeId'>$roomTypeName</option>";
                                        }
                                      ?>
                                    </select><br>
                                  </div>

                                </div>
                                <div class='modal-footer'>
                                  <input type='hidden' name='hidden-room-id' value='<?php echo $value['room_id']?>'>
                                  <input type='hidden' name='hidden-floor-id' value='<?php echo $value['floor_id']?>'>
                                  <input type='hidden' name='hidden-building-id' value='<?php echo $value['building_id']?>'>
                                  <button type='button' class="btn btn-outline-secondary" data-dismiss='modal'>Cancel</button>
                                  <button type='submit' class='btn btn-primary' name="submit-edit">Save changes</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div> 

                      <!-- Modal delete user -->
                      <div class="modal fade" id="delete-room-<?php echo $value['room_id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header table-dark">
                              <h5 class="modal-title" id="exampleModalLongTitle">Delete Room <?php echo $value['room_number']?></h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                                <div class="alert alert-warning" role="alert">
                                  Are you sure you want to <a href="#" class="alert-link">delete</a> this room?<br>
                                  <span class="small">You cannot undo this action.</span>
                                </div>
                                <div class="modal-footer">
                                  <input type="hidden" name="hidden-room-id" value="<?php echo $value['room_id'];?>">
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