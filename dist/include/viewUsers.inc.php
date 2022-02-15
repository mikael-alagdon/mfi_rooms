<?php
  include 'navbar.php';
  
  if (!$_SESSION["account"][0]['user_type_id'] == 1 || !$_SESSION["account"][0]['user_type_id'] == 2) {
    echo "<script>location.href='index.php'</script>";
  }

  $count = $view->viewUserList($_SESSION['account'][0]['user_type_id'], $_SESSION['account'][0]['user_id']);

  // -- check if form is submited
  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['submit-delete'])) {
      if (!empty($_POST['hidden-user-id']) && !empty($_POST['hidden-profile-id']) && !empty($_POST['hidden-type-id'])) {
        // -- Check if teacher
        // -- this function to delete all subject for teacher so it can delete the user foreign key problem
        if ($_POST['hidden-type-id'] == 1 || $_POST['hidden-type-id'] == 5) {
          $teacher = $view->teacherSelect($_POST['hidden-user-id']);
          foreach ($teacher as $value) {
            $control->deleteSubject($value['teacher_id']);
          }
        }
        $control->delete($_POST['hidden-user-id'], $_POST['hidden-profile-id'], $_POST['hidden-type-id']);
        $count = $view->viewUserList($_SESSION['account'][0]['user_type_id'], $_SESSION['account'][0]['user_id']);
        $msg = "<div id='successmessage' class='alert alert-success' role='success'>Successfully delete user.</div>";
      }
    }
  }