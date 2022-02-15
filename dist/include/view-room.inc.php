<?php
  include 'navbar.php';
  
  if (!$_SESSION["account"][0]['user_type_id'] == 1 || !$_SESSION["account"][0]['user_type_id'] == 3) {
    echo "<script>location.href='index.php'</script>";
  }

  $count = $roomView->roomList();
  $roomType = $roomView->viewRoomType();

  // -- check if form is submited
  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['submit-delete'])) {
      $roomControl->delete($_POST["hidden-room-id"]);
      $count = $roomView->roomList();
      echo "<script>alert('Successfully deleted room')</script>";
    } // -- End of the check for delete-submit

    if (isset($_POST['submit-edit'])) {
      $checkFloor = $_POST["hidden-floor-id"];
      if($_POST["hidden-building-id"] == 2){
        $checkFloor -= 3;
      }
      if (strlen($_POST['room-name']) == 3) {
        if (preg_match('/['.$checkFloor.'][0-9]{2}/', $_POST['room-name'])) {
          $roomControl->editRoom($_POST['room-name'], $_POST['room-type'], $_POST['hidden-room-id']);
          $count = $roomView->roomList();
          echo "<script>alert('Successfully change room')</script>";
        }
      }
    } // -- End of the check for delete-submit
    // 
  } // -- End of check submit POST