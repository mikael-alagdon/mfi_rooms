<?php
  include 'navbar.php';
  $countType = $courseView->programList();
  $countDep = $courseView->departmentList();
  $intValue = htmlspecialchars($_POST['course-name']) ?? ''; // -- get previous input

  if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $validation = new ValidateCourseInput($_POST);
    $errors = $validation->validateForm();
    if (!empty($errors["course-name"])){$invalidCN = "is-invalid";}
    if (!empty($errors["program-id"])){$invalidPI = "is-invalid";}
    if (!empty($errors["department-id"])){$invalidDI = "is-invalid";}

    if (empty($errors["course-name"]) && empty($errors["program-id"]) && empty($errors["department-id"])) {
      $msg = $courseControl->courseAdd(ucfirst($_POST['course-name']), $_POST['program-id'], $_POST['department-id']);
      $intValue = "";
    } // -- End of user input is not empty
  } // -- End of check submit POST