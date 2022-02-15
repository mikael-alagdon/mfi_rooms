<?php
  $values = $courseView->selectTeacher($_SESSION['profile'][0]['profile_id']);
  
  if ($moderator == 5) {
    foreach ($values as $value) {
      if ($value['department_id'] == 1) {
        $form_fill_up = "<div class='alert alert-danger alert-dismissible' role='warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>There are forms that require your attention. Please complete this <a class='text-danger' href='setting-profile.php'><b>form</b></a>. </div>";
      }
      else {
        // $msg = "<div class='alert alert-danger alert-dismissible' role='warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>There are forms that require your attention. Please complete this <a class='text-danger' href='#'><b>form</b></a>. </div>";
      }

    }
  }