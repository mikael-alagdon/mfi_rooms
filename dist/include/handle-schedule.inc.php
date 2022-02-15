<?php
  if(!empty($_SESSION["account"])) {echo "<script>location.href='login.php'</script>";} // -- if empty user then redirect to this page

  include 'navbar.php';
  $b_id = $_GET['b_id'];
  $f_id = $_GET['f_id'];
  $r_id = $_GET['r_id'];
  $defaultTimeIn = date('H:00', strtotime('+1 hour'));
  $defaultTimeOut = date('H:00', strtotime('+2 hour'));

  $room = $roomView->viewRoom($r_id);
  foreach ($room as $value) {
    $roomNumber = $value['room_number'];
    $floorLevel = $value['level'];
    $building = $value['building_name'];
  }

  $teacher = $courseView->selectTeacher($_SESSION["profile"][0]["profile_id"]);
  foreach ($teacher as $val) {
    $teacher_id = $val['teacher_id'];
  }
  $getsubject = $courseView->viewSubject($teacher_id);


  $room_id = $_POST['hidden-room-id'];
  $subject_id = $_POST['subject-id'];
  $time_in = $_POST['time-in'];
  $time_out = $_POST['time-out'];
  $schedule_date = $_POST['date-schedule'];
  $roomType = $_POST['room-type'];
  $schedule_purpose = $_POST['description'];
  $submit = $_POST['submit-schedule'];


  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($submit)) {
      $validation = new ValidateScheduleInput($_POST);
      $errors = $validation->validateForm();
      if (!empty($errors["subject-id"])){$invalidSI = "is-invalid";}
      if (!empty($errors["time-in"])){$invalidTI = "is-invalid";}
      if (!empty($errors["time-out"])){$invalidTO = "is-invalid";}
      if (!empty($errors["date-schedule"])){$invalidDS = "is-invalid";}
      if (!empty($errors["description"])){$invalidD = "is-invalid";}

      if (empty($errors["subject-id"]) 
      && empty($errors["time-in"]) 
      && empty($errors["time-out"]) 
      && empty($errors["date-schedule"]) 
      && empty($errors["description"])) {
        $scheduleControl->scheduleAdd($schedule_date, $time_in, $time_out, $schedule_purpose, $subject_id, $room_id);
        echo "<script>location.href='schedule.php?roid=$room_id&ronu=$roomNumber&buid=$b_id&flid=$f_id&suid=$subject_id&tiin=$time_in&tiou=$time_out&scda=$schedule_date'</script>";
      // echo "<script>alert('MUDA!')</script>";
      } // -- End of user input is not empty
    }
  } // -- End of check submit POST
?>