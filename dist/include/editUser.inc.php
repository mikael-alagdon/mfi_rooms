<?php

  include 'navbar.php';
  $countType = $view->typeList();

  if (empty($_GET['id'])) {
    echo "<script>location.href='index.php'</script>";
  }
  else {
    // -- check for user moderator
    if ($_SESSION["account"][0]['user_type_id'] == 1 || $_SESSION["account"][0]['user_type_id'] == 2) {
      $edit = $view->selectUser($_GET['id']);
    }
    else {
      echo "<script>location.href='index.php'</script>";
    }
  } // -- End of check if empty id in url

  // -- check if form is submited
  if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // -- class/method/function for validate entries
    $validation = new ValidateUserEdit($_POST);
    $errors = $validation->validateForm();
    if (!empty($errors["username"])){$invalidU = "is-invalid";}
    if (!empty($errors["usertype"])){$invalidUT = "is-invalid";}

    // -- check if user input is not empty
    if (empty($errors["username"]) && empty($errors["usertype"])) {
      $unique = $view->checkUser($_POST["username"], $_POST['usertype'], $_GET['id']);
      // -- Check if user is already used
      if ($unique == 2342) {
        $msg = "<div class='alert alert-danger' role='alert'><b>Error:</b> Username already used.</div>";
      }
      else if ($unique == 2432) {
        if ($_POST['usertype'] == 1 || $_POST['usertype'] == 5) {
          // -- delete teacher in teacher table
          $countView = $courseView->selectTeacher($_POST['hidden-profile-id']);
          foreach ($countView as $val) {
            $teacher_id = $val['teacher_id'];
          }
          $courseControl->allSubjectDelete($teacher_id);

          if ($_POST['usertype'] == 1) {
            // -- add admin in teacher table & add subject for subject table
            $control->addTeacher($_POST['hidden-profile-id']);
            $countView = $courseView->selectTeacher($_POST['hidden-profile-id']);
            foreach ($countView as $val) {
              $teacher_id = $val['teacher_id'];
            }
            $courseControl->subjectAdd($teacher_id, 'Admin');
          }
          else {
            // -- add teacher in teacher table
           $control->addTeacher($_POST['hidden-profile-id']);
          }
        }
        else {
          // -- delete teacher in teacher table
          $countView = $courseView->selectTeacher($_POST['hidden-profile-id']);
          foreach ($countView as $val) {
            $teacher_id = $val['teacher_id'];
          }
          $courseControl->allSubjectDelete($teacher_id);
          $control->deleteTeacher($_POST['hidden-profile-id'], $_POST['usertype']);
        }

        //  -- check if username and usertype is valid
        if ($control->userEdit($_POST['username'], $_POST['usertype'], $_GET['id']) == 2342) {
          $msg = "<div class='alert alert-danger' role='alert'><b>Error:</b> Invalid username.</div>";
        }
        else {
          echo "<script>location.href='viewusers.php'</script>";
        }
      }
      else {
      } // -- End of unique user
    } // -- End of user input is not empty
  } // -- End of check submit POST
