<?php
  error_reporting(E_ALL & ~E_NOTICE);
  include_once("../conn/connection.php");
  $roomNumber = $_POST["rnumber"];
  $roomType = $_POST["rtype"];
  $buildingId = $_POST["bid"];
  $floorId = $_POST["fid"];
  $getFloorId = $_POST["f"];
  $fname = $_POST["fname"];
  $bname = $_POST["bname"];

  $checkFloor = $_POST["fid"];
  if($buildingId == 2){
    $checkFloor -= 3;
  }

  if(strlen($roomNumber) == 3){
    if(!preg_match('/['.$checkFloor.'][0-9]{2}/', $roomNumber)){
      echo "
        <div class='alert alert-warning alert-dismissible'>
          <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
          Invalid add a room, add only as same of the floor level.
          <strong>E.g.</strong> In first floor add only 100 to 199.
        </div>
      ";
    }
    else {
      $query = "INSERT INTO tbl_room(room_number, building_id, floor_id, room_type_id)  
                VALUES ($roomNumber, $buildingId, $floorId, $roomType)";
      $runInsert = mysqli_query($con, $query);

      if($runInsert){
        echo "
          <div class='alert alert-success alert-dismissible'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            Successfully added room <strong>$roomNumber</strong>
          </div>
        ";
      }
      else{
        echo "
          <div class='alert alert-warning alert-dismissible'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <b>Room type</b> is empty.
          </div>
        ";
      }
    }
  } 
  else{
    echo "
      <div class='alert alert-warning alert-dismissible'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        Invalid floor, please enter same floor number and atlest 3 digit number.
      </div>
    ";
  } 
?>
