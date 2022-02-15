<?php
  date_default_timezone_set('Asia/Manila');
  error_reporting(E_ALL & ~E_NOTICE);
  error_reporting(0);
  session_start();
  require('include/class-autoload.inc.php');
  $view = new UserView();
  $control = new UserContr();
  $roomView = new RoomView();
  $roomControl = new RoomContr();
  $courseView = new CourseView();
  $courseControl = new CourseContr();
  $scheduleView = new ScheduleView();
  $scheduleControl = new ScheduleContr();
  $moderator = $_SESSION['account'][0]['user_type_id'];
  
  include_once("../conn/connection.php");
  include'Manage/roommanage.php';
  $room = new rooms();
  $viewB = $room->ViewBuilding();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>MFI Rooms</title>
  <link href="css/styles.css" rel="stylesheet" />
  <link href="css/styles.css.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      setInterval(function(){
        $.ajax({
          type: "post",
          url: "handle-schedule-ajax.inc.php",
          success: function(data){
            $("#autload").html(data);
          }
        })
      },1000);
    });
  </script>
</head>
<body class="sb-nav-fixed">
  <div id="autload"></div>
  <!-- Navbar -->
  <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
    <a class="navbar-brand" href="index.php">MFI<span style="color:#ffc21e">ROOMS</span></a>

    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <div class="input-group">
          <!-- <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
          <div class="input-group-append">
              <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
          </div> -->
      </div>
    </form>

    <!-- Navbar-->
    <?php 
      if (isset($_SESSION["account"])) {
    ?>
      <ul class='navbar-nav ml-auto ml-md-0'>
        <li class='nav-item dropdown'>
            <a class='nav-link dropdown-toggle' id='userDropdown' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
              <i class='fas fa-user fa-fw'></i>
              <?php echo $_SESSION['profile'][0]['first_name']?>
            </a>
            <div class='dropdown-menu dropdown-menu-right' aria-labelledby='userDropdown'>
              <a class='dropdown-item' href='profile.php'>Profile</a>
              <!-- <a class='dropdown-item' href='#'>Activity Log</a> -->
              <a class='dropdown-item' href='setting-profile.php'>Settings</a>
              <div class='dropdown-divider'></div>
              <a class='dropdown-item' href='handleLogOut.php'>Logout</a>
            </div>
        </li>
      </ul>
    <?php
      }
      else{
    ?>
      <ul class='navbar-nav ml-auto ml-md-0'>
        <li class='nav-item dropdown'>
          <a class='nav-link ' id='userDropdown' href='login.php' role='button'>
          <i class='fas fa-user fa-fw'></i> Login </a>
        </li>
      </ul>
    <?php
      }
    ?>
  </nav>

  <!-- Sidenav -->
  <div id="layoutSidenav">
    <div id="layoutSidenav_nav">
      <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
          <div class="nav">
            <!-- Dashboard -->
            <div class="sb-sidenav-menu-heading">Home</div>
            <a class="nav-link" href="index.php"><div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>Dashboard</a>

            <!-- User Manager for admin only -->
            <div class='sb-sidenav-menu-heading'>Manage</div>
            <?php 
              if(isset($_SESSION['account'])){
                if ($moderator == 1 || $moderator == 2) {
            ?>
            <a class='nav-link collapsed' href='#' data-toggle='collapse' data-target='#collapseUsers' aria-expanded='false' aria-controls='collapsePages'>
              <div class='sb-nav-link-icon'><i class='fas fa-user-alt'></i></div>Users
              <div class='sb-sidenav-collapse-arrow'><i class='fas fa-angle-down'></i></div>
            </a>
            <div class="collapse" id="collapseUsers" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
              <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                <a class="nav-link" href="viewusers.php">View Users</a>
                <a class="nav-link" href="users.php">Create Users</a>
              </nav>
            </div>
            <?php
                }
                if ($moderator == 1 || $moderator == 5) {
            ?>
            <a class='nav-link collapsed' href='#' data-toggle='collapse' data-target='#collapseCourses' aria-expanded='false' aria-controls='collapsePages'>
              <div class='sb-nav-link-icon'><i class='fa fa-book'></i></div>Courses
              <div class='sb-sidenav-collapse-arrow'><i class='fas fa-angle-down'></i></div>
            </a>
            <div class="collapse" id="collapseCourses" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
              <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                <?php
                  if ($moderator == 5) {
                ?>
                <a class="nav-link" href="setting-subject.php">My subject list</a>
                <?php 
                  }
                ?>
                <a class="nav-link" href="viewCourses.php">View Courses</a>
                <a class="nav-link" href="courses.php">Create Courses</a>
              </nav>
            </div>
            <?php
                }
                if ($moderator == 1 || $moderator == 3) {
            ?>
            <a class='nav-link collapsed' href='#' data-toggle='collapse' data-target='#collapseRoom' aria-expanded='false' aria-controls='collapsePages'>
              <div class='sb-nav-link-icon'><i class='fa fa-building'></i></div>Room
              <div class='sb-sidenav-collapse-arrow'><i class='fas fa-angle-down'></i></div>
            </a>
            <div class="collapse" id="collapseRoom" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
              <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                <a class="nav-link" href="view-room.php">View Room</a>
              </nav>
            </div>
            <?php
                }
              }
            ?>

            <a class='nav-link collapsed' href='#' data-toggle='collapse' data-target='#collapseSchedule' aria-expanded='false' aria-controls='collapsePages'>
              <div class='sb-nav-link-icon'><i class='fa fa-clock'></i></div>Schedule
              <div class='sb-sidenav-collapse-arrow'><i class='fas fa-angle-down'></i></div>
            </a>
            <div class="collapse" id="collapseSchedule" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
              <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                <a class="nav-link" href="view-schedule.php">View Schedule</a>
              </nav>
            </div>

            <!-- Buildings -->
            <div class="sb-sidenav-menu-heading">MFI Buildings</div>

            <!-- =================php================ -->
            <?php
              foreach ($viewB as $arrayBuildingDetails) {
                $building_id = $arrayBuildingDetails["building_id"];
                $building_name = $arrayBuildingDetails["building_name"];
            ?>

              <a class='nav-link collapsed' href='#' data-toggle='collapse' data-target='#drop-<?php echo $building_id?>' aria-expanded='false' aria-controls='collapsePages'>
                <div class='sb-nav-link-icon'><i class='fa fa-building'></i></div><?php echo $building_name?> Building
                <div class='sb-sidenav-collapse-arrow'><i class='fas fa-angle-down'></i></div>
              </a>

            <?php
                $viewF = $room->ViewFloors($building_id);
                foreach ($viewF as $arrayFloors) {
                  $floor_id = $arrayFloors["floor_id"];
                  $level = $arrayFloors["level"];
                  $building_floor_id = $arrayFloors["building_id"];
            ?>

              <div class='collapse' id='drop-<?php echo $building_id?>' aria-labelledby='headingTwo' data-parent='#sidenavAccordion'>
                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                  <a class='nav-link' href='rooms.php?b_id=<?php echo $building_floor_id?>&f_id=<?php echo $floor_id?>'><?php echo $level?> floor</a>
                </nav>
              </div>

            <?php
                } // -- end of loop for floor
              } // -- end of loop for building
            ?>

          </div>
        </div>

        <div class="sb-sidenav-footer">
          <div class="small">
            <?php 
              if(isset($_SESSION['account'])){
                echo "Logged in as: <b>". $_SESSION['profile'][0]['user_type']."</b>";
              }
              else{
                echo "Welcome";
              }
            ?>
          </div>
        </div>
      </nav>
    </div>