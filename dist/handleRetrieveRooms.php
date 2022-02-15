<?php
  // -- Ajax For Rooms
  include_once("../conn/connection.php");
  $building_id = $_POST["buildingId"];
  $floor_id = $_POST["floorId"];

  if($building_id <= 0){
    // -- echo "home/announcements";
    $hideAddButton = "none";
    $floor_id = 0;
  }
  else if($building_id <= 0){
    $building_id = 0;
  }
  else{
    // -- echo "will show rooms";
    $hideAddButton = "";

    $selectRooms = "SELECT * FROM tbl_room WHERE building_id = $building_id AND floor_id = $floor_id";
    $runSelectRooms = mysqli_query($con, $selectRooms);

    while ($arrayRooms = mysqli_fetch_assoc($runSelectRooms)) {
      $room_id = $arrayRooms["room_id"];
      $room_number = $arrayRooms["room_number"];
      $room_building = $arrayRooms["building_id"];
      $room_floor = $arrayRooms["floor_id"];
      $room_type = $arrayRooms["room_type_id"];
      $room_status = $arrayRooms["room_status_id"];

      if ($room_type == 1) {
        if ($room_status == 1){
          $room = "Unoccupied";
          $color = "primary";
        }
        else if ($room_status == 2){
          $room = "Occupied";
          $color = "success";
        }
        else{
          $room = "Unavailable";
          $color = "danger";
        }
      }
      else if ($room_type == 2) {
        $room = "Office";
        $color = "secondary";
      }
      else{
        $room = "Others";
        $color = "secondary";
      }


      echo "
        <div style='display: inline-block; cursor: pointer;' class='col-md-2 col-md-2'>
        <div data-toggle='modal' data-target='#info-room-id-$room_id' class='card bg-$color text-white mb-4'>
            <div  class='card-body'>$room</div>
            <div class='card-footer d-flex align-items-center justify-content-between'>
              Room $room_number
              <a class='small text-white stretched-link'></a>
              <div class='small text-white'><i class='fas fa-angle-right'></i></div>
            </div>
          </div>
        </div> 
      ";
            
    } // ------ end of while loop 
  } // ----end of if condition 


?>
