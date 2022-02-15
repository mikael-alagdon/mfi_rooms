<?php 

  include 'navbar.php';
  $countType = $view->typeList();
  $edit = $view->selectUser($_GET['id']);
  $intValue = htmlspecialchars($_POST['username']) ?? ''; // -- get previous input
  if (empty($_SESSION["account"])) {echo "<script>location.href='index.php'</script>";}  

  if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // -- class/method/function for validate entries
    $validation = new ValidateUserAdd($_POST);    
    $errors = $validation->validateForm();
    // -- Check if error is not empty
    if (!empty($errors["username"])){$invalidU = "is-invalid";}
    if (!empty($errors["password"])){$invalidP = "is-invalid";}
    if (!empty($errors["usertype"])){$invalidUT = "is-invalid";}

    if (empty($errors["username"]) && empty($errors["password"]) && empty($errors["usertype"])) {
      $unique = $control->userAdd($_POST['username'], $_POST['password'], $_POST['usertype']);
      if ($unique == 2432) {
        $msg = "<div class='alert alert-success alert-dismissible' role='success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Successfully add user.</div>";
        $intValue = "";
      }
      else if ($unique == 2342) {
        $msg = "<div class='alert alert-danger' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Error:</b> Username already used.</div>";
      }
      else {
        
      } // -- End of unique user
    } // -- End of user input is not empty
  } // -- End of check submit POST