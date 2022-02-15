<?php
  // echo "<script>alert('Hello world ".$room_id."')</script>";
  date_default_timezone_set('Asia/Manila');

  $roomControl = new RoomContr();

  $hidden_room_id = $_POST["hidden-room-id"];
  $hidden_room_name = $_POST["hidden-room-name"];
  $room_name = $_POST["room-name"];
  $room_type = $_POST["room-type"];
  $delete = $_POST["submit-delete"];
  $edit = $_POST["submit-edit"];

  $buildingId = $_POST["hidden-building-id"];
  $checkFloor = $_POST["hidden-floor-id"];
  if($buildingId == 2){
    $checkFloor -= 3;
  }

  // -- Check if form if submited
  if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // -- DELETE room
    if (isset($delete)) {
      $roomControl->delete($hidden_room_id);
      echo "
        <div class='alert alert-success alert-dismissible'>
          <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
          Successfully <strong>deleted</strong> room <strong>$hidden_room_name</strong>
        </div>
      ";
    } // -- End of the check for delete-submit

    // -- UPDATE room
    if (isset($edit)) {
    // -- Check for room input lenght
      if (strlen($room_name) == 3) {
        if(!preg_match('/['.$checkFloor.'][0-9]{2}/', $room_name)){
           echo "
             <div class='alert alert-warning alert-dismissible'>
              <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
              Invalid add a room, add only as same of the floor level.
              <strong>E.g.</strong> In first floor add only 100 to 199.
             </div>
           ";
        }
        else {
          if ($roomControl->editRoom($room_name, $room_type, $hidden_room_id) == "error") {
            echo "
              <div class='alert alert-success alert-dismissible'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                Successfully <strong>edited</strong> room <strong>$hidden_room_name</strong>
              </div>
            ";
          }
          else {
            echo "
              <div class='alert alert-warning alert-dismissible'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                Room <strong>$room_name</strong> alreay exist on <strong>".strtolower($levelf)."</strong> floor <strong>$name</strong> building.
              </div>
            ";
          }
        } // -- End of checking preg_match()
      }
      else {
        echo "
          <div class='alert alert-warning alert-dismissible'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            Invalid floor, please enter same floor number and atlest 3 digit number.
          </div>
        ";
      }// -- End of check room input length
    } // -- End of the check for update-submit
  } // -- End of check submit POST
?>