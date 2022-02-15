<?php
  include 'navbar.php';
  include_once("../conn/connection.php");

  $getFloorId = $_GET["f_id"];
  $getBuildingId = $_GET["b_id"];
  $getB = $room->getBuilding($getBuildingId);
  $getF = $room->getFloor($getFloorId);
  $ViewT = $room->ViewRoomType();
  $ViewR = $room->ViewRooms($getBuildingId,$getFloorId);
  $ViewR1 = $room->ViewRooms($getBuildingId,$getFloorId);
  foreach ($getB as $key => $value) {
    $name = $value['building_name'];
  }
  foreach ($getF as $key => $value) {
    $levelf = $value['level'];
  }

  include 'include/check-subject.inc.php';
?>

<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid">
        <h1 class="mt-4"><?php echo $name;?> Building</h1>
        <ol class="breadcrumb mb-4">
          <li class="breadcrumb-item active"><a href="index.php" style="text-decoration: none;">Home </a><?php echo " / ".$name." / ".$levelf;?> Floor</li>
        </ol>

        <div class="row">
          <?php
            // -- Add/Create room for admin and staff only
            $roomModerator = "";
            $subjectLabel = "Select subject";
            if($moderator == 1 or $moderator == 3){
              $roomModerator = "disabled";
              $subjectLabel = "Admin";
          ?>
            <div style='display:<?php echo $hideAddButton?>' class='col-xl-12 col-xl-3'>
              <div data-toggle='modal' data-target='#add-room' class='card bg-secondary text-white mb-4'>
                <div class='card-body'>Add</div>
                <div class='card-footer d-flex align-items-center justify-content-between'>
                  <a class='small text-white stretched-link' href='#'>Click to add a room</a>
                </div>
              </div>
            </div>
          <?php
            }
          ?>
        </div><hr>
        <div id="result">
          <?php
            include'include/handle-room.inc.php'; // -- Update & Delete function

            echo $form_fill_up; // -- Error message for teacher
          ?>
        </div>   <!-- for notifications -->

        <!-- Modal -->
        <div class="modal fade" id="add-room" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header table-dark">
                <h5 class="modal-title" id="exampleModalLongTitle">Add room / <?php echo$levelf;?> floor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="">
                  <!-- Add room midal -->
                  <div class="form-row align-items-center">
                    <div class="col-sm-6 my-6">
                      <input onkeypress='return event.charCode >= 48 && event.charCode <= 57' type="text" min="1" maxlength="3" class="form-control" id="inputRoomNumber" autocomplete="off" placeholder="Room number">
                    </div><br><br>
                    <div class="col-sm-6 my-6">
                    <select name="roomType" class="custom-select mr-sm-6" id="roomType">
                      <option value="" disabled selected>Room type</option>
                      <?php
                        foreach ($ViewT as $key => $arrrayRoomType) {
                          $roomTypeId = $arrrayRoomType["room_type_id"];
                          $roomTypeName = $arrrayRoomType["room_type"];
                          echo "<option value='$roomTypeId'>$roomTypeName</option>";
                        }
                      ?>
                    </select><br>
                    </div>
                    <div class="col-auto my-1"></div>
                  </div>    
                  <div class="modal-footer">
                    <button type='button' class="btn btn-outline-secondary" data-dismiss='modal'>Cancel</button>
                    <button id="submit-add-room"class="btn btn-primary" data-dismiss="modal">Save changes</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div> 

        <?php
          // -- Get all room in selected building and floor
          if ($getFloorId <= 0) {
            echo "<script>location.href='index.php'</script>";
            echo "home/announcements";
            $hideAddButton = "none";
            $getFloorId = 0;
          }
          else if ($getBuildingId <= 0) {
            $getBuildingId = 0;
          }
          else { 
            foreach ($ViewR as $arrayRooms) {
              $room_id = $arrayRooms["room_id"];
              $rid = $arrayRooms["room_id"];
              $room_name = $arrayRooms["room_number"];
              $room_building = $arrayRooms["building_id"];
              $room_floor = $arrayRooms["floor_id"];
              $room_type_id = $arrayRooms["room_type_id"];

          ?>

                <div class='modal fade' id='info-room-id-<?php echo $room_id?>' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle'>
                  <div class='modal-dialog modal-dialog-centered' role='document'>

                    <!-- Start of reserve modal -->
                    <div class='modal-content reserve'>
                      <div class='modal-header table-dark'>
                        <h5 class='modal-title' id=''><?php echo $name?> Building / <?php echo $levelf?> Floor / Room: <?php echo $room_name." - ID: ".$room_id?></h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                          <span aria-hidden='true'>&times;</span>
                        </button>
                      </div>
                      <div class='modal-body'>

                          <div class='form-row align-items-center'>
                            <!-- Schedule List HERE! -->
                          </div>    
                          <div class='modal-footer'>
                            <button type='button' class="btn btn-outline-secondary" data-dismiss='modal'>Cancel</button>
                            <?php
                              if ($moderator == 1 || $moderator == 3) {
                            ?>
                            <button type='button' class='btn btn-info' onclick='edit()'>Edit</button>
                            <?php
                              } 
                            ?>
                            <input type="hidden" name="hidden-room-id" value="<?php echo $room_id?>">
                            
                            <?php
                              if (($moderator == 1 || $moderator == 5) && $room_type_id == 1) {
                            ?>
                            <a class="btn btn-primary" type="button" href="schedule-room.php?b_id=<?php echo $getBuildingId?>&f_id=<?php echo $getFloorId?>&r_id=<?php echo $room_id?>">Schedule</a>
                            <?php
                              } 
                            ?>
                          </div>
                          
                      </div>
                    </div>
                    <!-- End of reserve modal -->

                    <!-- Start of edit modal -->
                    <div class='modal-content edit-room'> 
                      <div class='modal-header table-dark'>
                        <h5 class='modal-title' id=''>Configure room: <?php echo $room_name." - ".$room_id?></h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                          <span aria-hidden='true'>&times;</span>
                        </button>
                      </div>
                      <div class='modal-body'>
                        <form action="<?php echo $_SERVER['PHP_SELF']."?b_id=".$getBuildingId."&f_id=".$getFloorId?>" method="POST">
                          <div class='form-row align-items-center'>
                            <div class='col-sm-6 my-6'>
                              <input onkeypress='return event.charCode >= 48 && event.charCode <= 57' type='text' min='1' maxlength='3' class='form-control' name='room-name' placeholder='Room number' autocomplete="off" value='<?php echo $room_name?>'>
                            </div><br><br>

                            <div class='col-sm-6 my-6'>
                              <select name='room-type' class='custom-select mr-sm-6' id=''>
                                <?php
                                  foreach ($ViewT as $key => $arrrayRoomType) {
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
                            <input type='hidden' name='hidden-room-id' value='<?php echo $room_id?>'>
                            <input type='hidden' name='hidden-room-name' value='<?php echo $room_name?>'>
                            <input type='hidden' name='hidden-floor-id' value='<?php echo $getFloorId?>'>
                            <input type='hidden' name='hidden-building-id' value='<?php echo $getBuildingId?>'>
                            <button type='button' class="btn btn-outline-secondary" data-dismiss='modal'>Cancel</button>
                            <button type='button' class='btn btn-info' onclick='reserve()'>Reserve</button>
                            <a href="#" class='btn btn-warning' data-toggle='modal' data-target='#delete-room'>Delete</a>
                            <button type='submit' class='btn btn-primary' name="submit-edit">Save changes</button>
                          </div>
                        </form>
                      </div>
                    </div> 
                    <!-- End of reserve modal -->

                    <!-- Modal delete user -->
                    <div class="modal fade" id="delete-room" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header table-dark">
                            <h5 class="modal-title" id="exampleModalLongTitle">Delete Room <?php echo $value['room_number']?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form action="<?php echo $_SERVER['PHP_SELF']."?b_id=".$getBuildingId."&f_id=".$getFloorId?>" method="POST">
                              <div class="alert alert-warning" role="alert">
                                Are you sure you want to <a href="#" class="alert-link">delete</a> this room?<br>
                                <span class="small">You cannot undo this action.</span>
                              </div>
                              <div class="modal-footer">
                                <input type='hidden' name='hidden-room-id' value='<?php echo $room_id?>'>
                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                                <button type='submit' class='btn btn-warning' name="submit-delete">Delete</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div> 

                  </div>
                </div>
        <?php

            } // -- End of the loop
          } // -- End of the if condition
        ?>          

        <div class="row" id="retrieve"></div>
        <center><img id="wait" src="../src/gif/spinner.gif"></center>

  </main>
  <footer class="py-4 bg-light mt-auto">
    <div class="container-fluid">
      <div class="d-flex align-items-center justify-content-between small">
        <div class="text-muted">Resuta Company &copy; Your Website 2020</div>
        <div>
          <a href="#">Privacy Policy</a> &middot; <a href="#">Terms &amp; Conditions</a>
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


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">

// Extend the default picker options for all instances.

  // -- Ajax Script ------------------------------------------------------------

  // -- AYAW GUMANA NETO BWISET
  // $(document).ready(function(){
  //   $(".submit-delete").click(function(){
  //   var id = $("#hidden-room-id").val();
  //   alert("Hello - " + id);
  //   // if(message !=""){
  //     $.ajax({
  //       type: "POST",
  //       data: {rid: id,},
  //       url : 'handleDeleteRoom.php',
  //       success: function(data){
  //         $("#result").html(data);
  //       }
  //     });

  //   // }

  //   });
  // });

  // ---------------------------------------------------------------------------

  // -- Hide and show modal for room
  $(document).ready(function(){
    $(".edit-room").hide();
  });

  function edit(){
    $(".reserve").hide();
    $(".edit-room").show();
  };

  function reserve(){
    $(".reserve").show();
    $(".edit-room").hide();
  }

  // ---------------------------------------------------------------------------

  $(document).ajaxComplete(function(){
     $("#wait").css("display", "none");
  });

  // ---------------------------------------------------------------------------

  // $('#room_modal').click(function() {
  //   //alert('called');
  //   // we want to copy the 'id' from the button to the modal
  //   var href = $(this).data('target');
  //   var id = $(this).data('id');

  // ---------------------------------------------------------------------------

  //   // -- since the value of href is what we want, so I just did it like so
  //   alert(href);
  //   // -- used it as the selector for the modal
  //   alert(id);
  //   $(href).data('id', id);
  // });

  // ---------------------------------------------------------------------------

  // $('#savebutton').click(function() {
  //     // now we grab it from the modal
  //     var id = $('#myModal').data('id');
  //      //var id=document.getElementById('myModal').getAttribute("data-id");
  //     alert(id);
  // });

  // ---------------------------------------------------------------------------

  $(document).ready(function(){
    setInterval(function(){
      $.ajax({
        type: "post",
        data:{buildingId: "<?php echo $getBuildingId; ?>",
              floorId: "<?php echo $getFloorId; ?>"},
        url: "handleRetrieveRooms.php",
        success: function(data){
          $("#retrieve").html(data);
        }
      })
    },1000);

    // ---------------------------------------------------------------------------

    $("#submit-add-room").click(function(){
    var roomNumber =  $("#inputRoomNumber").val();
    var roomType = $("#roomType").val();
    // if(message !=""){
    $.ajax({
      type: "post",
      data:   {
        rnumber: roomNumber,
        rtype: roomType,
        f: "<?php echo $getFloorId; ?>",
        bid: "<?php echo $getBuildingId; ?>",
        fid: "<?php echo $getFloorId; ?>",
        fname: "<?php echo $levelf; ?>",
        bname: "<?php echo $name; ?>",
          },
      url : "handleAddRooms.php",
      success: function(data){
        $("#result").html(data);
        $("#inputRoomNumber").val("");
        $("#roomType").val("");
      }
    });

    // }

    });
  });

  // ---------------------------------------------------------------------------

</script>
</body>
</html>