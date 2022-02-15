<?php
  session_start();
  // unset($_SESSION['account']);
  // unset($_SESSION['profile']);
  header("Location:login.php");
  session_destroy();
?>