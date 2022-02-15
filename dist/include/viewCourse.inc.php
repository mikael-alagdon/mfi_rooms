<?php
  include 'navbar.php';

  $count = $courseView->courseList();
  $countType = $courseView->programList();
  $countDep = $courseView->departmentList();

  // -- check if form is submited
  if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (!empty($_POST['hidden-course-id']) && empty($_POST['course-name']) && empty($_POST['department-id'])) {
      if (isset($_POST['submit-delete'])) {
        if (!empty($_POST['hidden-course-id'])) {
          $courseControl->courseDelete($_POST['hidden-course-id']);
          $count = $courseView->courseList();
          $msg = "<div id='successmessage' class='border-success alert alert-success text-center' role='success'>Successfully Deleted.</div>";
        }
      }
    }
    else {
      $validation = new ValidateCourseInput($_POST);
      $errors = $validation->validateForm();
      if (!empty($errors["course-name"])){$invalidCN = "is-invalid";}
      if (!empty($errors["program-id"])){$invalidPI = "is-invalid";}
      if (!empty($errors["department-id"])){$invalidDI = "is-invalid";}

      if (empty($errors["course-name"]) && empty($errors["program-id"])) {
        if (isset($_POST['submit-save'])) {
          if (!empty($_POST['hidden-course-id']) && !empty($_POST['course-name']) && !empty($_POST['department-id'])) {
            $courseControl->courseEdit(ucfirst($_POST['course-name']), $_POST['program-id'], $_POST['department-id'], $_POST['hidden-course-id']);
            $count = $courseView->courseList();
            $msg = "<div id='successmessage' class='border-success alert alert-success text-center' role='success'>Successfully Edited.</div>";
          }
        }
      }
      else {}
    }
  } // -- End of check submit POST