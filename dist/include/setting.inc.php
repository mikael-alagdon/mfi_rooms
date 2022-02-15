<?php

include 'navbar.php';
if (empty($_SESSION["account"])) {echo "<script>location.href='index.php'</script>";}  // -- if not login then redirect to this page
$countDep = $courseView->departmentList();
$teacher = $courseView->selectTeacher($_SESSION["profile"][0]["profile_id"]);

$intValU = $_SESSION['profile'][0]['username'];
$intValPro = $_SESSION['profile'][0]['profession'];
$intValFirst = $_SESSION['profile'][0]['first_name'];
$intValMiddle = $_SESSION['profile'][0]['middle_name'];
$intValLast = $_SESSION['profile'][0]['last_name'];
$intValSuf = $_SESSION['profile'][0]['suffix'];
$intValAdr = $_SESSION['profile'][0]['address'];
$intValPho = $_SESSION['profile'][0]['phone'];
$intValEm = $_SESSION['profile'][0]['email'];


// -- check if form is submited
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  if (isset($_POST['submit-profile'])) {

    $intValU = htmlspecialchars($_POST['username']); // -- get previous input
    $intValPro = htmlspecialchars($_POST['profession']); // -- get previous input
    $intValFirst = htmlspecialchars($_POST['firstname']); // -- get previous input
    $intValMiddle = htmlspecialchars($_POST['middlename']); // -- get previous input
    $intValLast = htmlspecialchars($_POST['lastname']); // -- get previous input
    $intValSuf = htmlspecialchars($_POST['suffix']); // -- get previous input
    $intValAdr = htmlspecialchars($_POST['address']); // -- get previous input
    $intValPho = htmlspecialchars($_POST['phone']); // -- get previous input
    $intValEm = htmlspecialchars($_POST['email']); // -- get previous input

    // -- class/method/function for validate entries
    $validation = new ValidateSettingProfile($_POST);    
    $errors = $validation->validateForm();
    // -- Check if error is not empty
    if (!empty($errors["department-id"])){$invalidDI = "is-invalid";}
    if (!empty($errors["username"])){$invalidU = "is-invalid";}
    if (!empty($errors["firstname"])){$invalidF = "is-invalid";}
    if (!empty($errors["lastname"])){$invalidL = "is-invalid";}
    if (!empty($errors["phone"])){$invalidPh = "is-invalid";}
    if (!empty($errors["email"])){$invalidE = "is-invalid";}

    // -- class/method/function for get data in database
    // -- check if user input is not empty
    if (empty($errors["department-id"]) 
      && empty($errors["username"]) 
      && empty($errors["firstname"]) 
      && empty($errors["lastname"]) 
      && empty($errors["phone"]) 
      && empty($errors["email"])) {

      $unique = $view->checkUser($_POST["username"], $_POST['hidden-type-id'], $_SESSION["account"][0]["user_id"]);
      // -- Check if user is already used
      if ($unique == 2342) {
        $invalidU = "is-invalid";
        $errors["username"] = "Username already used.";
      }
      else {
        //  -- check if username and usertype is valid
        if ($control->userEdit($_POST['username'], $_POST['hidden-type-id'], $_SESSION["account"][0]["user_id"]) == 2342) {
          $invalidU = "is-invalid";
          $errors["username"] = "Invalid username.";
        }
        else if ($unique == 2342)  {
          $courseControl->teacherEdit($_POST['department-id'], $_SESSION["profile"][0]["profile_id"]);
          $control->userProfileEdit(
            ucfirst($_POST["firstname"]),
            ucfirst($_POST["middlename"]),
            ucfirst($_POST["lastname"]),
            ucfirst($_POST["suffix"]),
            ucfirst($_POST["address"]),
            $_POST["phone"],
            $_POST["email"],
            ucfirst($_POST["profession"]),
            $_SESSION["account"][0]["user_id"]
          );
          echo "<script>location.href='profile.php'</script>";
        }
        else {
          $courseControl->teacherEdit($_POST['department-id'], $_SESSION["profile"][0]["profile_id"]);
          $control->userProfileEdit(
            ucfirst($_POST["firstname"]),
            ucfirst($_POST["middlename"]),
            ucfirst($_POST["lastname"]),
            ucfirst($_POST["suffix"]),
            ucfirst($_POST["address"]),
            $_POST["phone"],
            $_POST["email"],
            ucfirst($_POST["profession"]),
            $_SESSION["account"][0]["user_id"]
          );
          echo "<script>location.href='profile.php'</script>";
        }
      }
    } // -- End of user input is not empty
  } // -- End of submitted post profile

  // for account -----------------------------------------------------------------------------------------------------------------

  if (isset($_POST['submit-account'])) {
    $validation = new ValidateSettingAccount($_POST);    
    $errors = $validation->validateForm();

    $hash = password_verify($_POST['cur-pass'], $_SESSION["account"][0]["password"]);
    if (empty($errors["cur-pass"])) {
      if($hash == true){
        if (empty($errors["cur-pass"]) && empty($errors["new-pass"])) {
          if ($_POST['con-pass'] != $_POST['new-pass']) {
            $errors["new-pass"] = '<b>Error: New</b> & <b>Confirm</b> password did not match.';
          } // -- End check of confirm & new password if match
          else {
            $control->editPass($_SESSION["account"][0]["username"], $_POST['con-pass'], $_SESSION["account"][0]["user_id"]);
            $msg = "<b>Change successfully.</b>";
          }
        } // -- End of check current pass
      } // -- End of user input is not empty
      else {
        $msg1 = "<b>Error:</b> Invalid password.";
        $errors["new-pass"] = "";
      }
    }
  } // -- End of submitted post account
  
} // -- End of check submit POST