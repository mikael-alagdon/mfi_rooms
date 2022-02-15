<?php

  date_default_timezone_set('Asia/Manila');
  error_reporting(E_ALL & ~E_NOTICE);
  // error_reporting(0);
  require('include/class-autoload.inc.php');
  session_start();
  $view = new UserView();
  $control = new UserContr();

  // -- Check if no user to create admin
  $count = $view->checkIfEmpty();
  if($count != "empty"){ // ---- If no acount in database
    header('Location: login.php');
  } // -- End of check for empty account

  if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // -- class/method/function for validate entries
    $validation = new ValidateCreateAdmin($_POST);    
    $errors = $validation->validateForm();
    // -- Check if the error is not empty
    if (!empty($errors["username"])){$invalidU = "is-invalid";}
    if (!empty($errors["password"])){$invalidP = "is-invalid";}
    if (!empty($errors["conPassword"])){$invalidCP = "is-invalid";}


    // -- class/method/function for get data in database
    // -- check if user input is not empty
    if (empty($errors["username"]) && empty($errors["password"]) && empty($errors["conPassword"])) {
      $control->userAdd($_POST['username'], $_POST['password'], 1);
      header('Location: login.php');
    } // -- End of user input is not empty
  } // -- End of check submit POST