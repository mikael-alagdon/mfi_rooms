<?php
  date_default_timezone_set('Asia/Manila');
  error_reporting(E_ALL & ~E_NOTICE);
  // error_reporting(0);
  require('include/class-autoload.inc.php');
  session_start();
  if (!empty($_SESSION["account"])) {echo "<script>location.href='profile.php'</script>";} // -- if login then redirect to this page

  // -- Check if no user to create admin
  $user = new UserView();
  $count = $user->checkIfEmpty();
  if($count == "empty"){ // ---- If no acount in database
    header('Location: register.php');
  } // -- End of check for empty account

  // -- check if form is submited
  if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // -- class/method/function for validate entries
    $validation = new ValidateLogin($_POST);    
    $errors = $validation->validateForm();
    // -- Check if error is not empty
    if (!empty($errors["loginUsername"])){$invalidU = "is-invalid";}
    if (!empty($errors["loginPassword"])){$invalidP = "is-invalid";}

    // -- class/method/function for get data in database
    // -- check if user input is not empty
    if (empty($errors["loginPassword"]) && empty($errors["loginUsername"])) {
      $userLogin = new Login();
      // -- check if error is triggered so it will return error msg
      if ($userLogin->loginUser($_POST["loginUsername"], $_POST["loginPassword"]) == 2342) {
        $error = "<div class='alert alert-danger' role='alert'><b>Error:</b> Invalid username or password</div>";
      }
      else {
        $insert = new UserView();
        $insert->myProfile($_SESSION['account'][0]['user_id']);
        // echo $_SESSION['account'][0]['user_id'];
      }
    } // -- End of user input is not empty
  } // -- End of check submit POST
