<?php
  include 'navbar.php';
  
  // -- Check if form if submited
  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    
    if (isset($_POST['submit-cancel'])) {
      $scheduleControl->scheduleUpdate('3', $_POST['hidden-schedule-id']);
      $count = $scheduleView->scheduleList('', '', '');
    } // -- End of the check for submit-schedule

  } // -- End of check submit POST

  $count = $scheduleView->scheduleList('', '', '');
  $countAll = $scheduleView->scheduleList('0', '0', '0');