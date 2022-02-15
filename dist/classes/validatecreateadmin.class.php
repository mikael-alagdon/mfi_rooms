<?php

class ValidateCreateAdmin {

  private $data;
  private $errors = [];
  private static $fields = ['username', 'password', 'conPassword']; // inside the [] is your input name
  private $errorTag;

  public function __construct($post_data) {
    $this->data = $post_data;
  }

  public function validateForm() {
    foreach (self::$fields as $field) {
      if (!array_key_exists($field, $this->data)) {
        // trigger_error("$field is not present in data");
        echo "<div class='border-danger alert alert-danger text-center' role='alert'>System error. Please contact your system administrator.</div>";
        return;
      }
    }

    $this->validateUsername();
    $this->validatePassword();
    $this->validateConPassword();
    return $this->errors;
  }

  private function validateUsername() {
    $val = trim($this->data['username']);

    if (empty($val)) {
      $this->addError('username', '<b>Error:</b> Username cannot be empty');
    }
    else {
      // if username input contain special character it will return error msg.
      if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $val)) { 
        $this->addError('username', '<b>Error:</b> Username must alphanumeric');
      }
      else if (!preg_match('/^[a-zA-z0-9]{4,22}$/', $val)) {
        $this->addError('username', '<b>Error:</b> Username must be 4-22 chars');
      }
      else {

      }

    }

  }

  private function validatePassword() {
    $val = trim($this->data['password']);
    $val1 = trim($this->data['conPassword']);
    $val2 = trim($this->data['username']);

    if (empty($val)) {
      $this->addError('password', '<b>Error:</b> Password must contain at least one special character. Password must be 8-30 characters.');
    }
    else {
      if ($val != $val1) { 
        $this->addError('conPassword', '<b>Error:</b> Password and confirm password does not match.');
      }
      else if (!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $val)) { 
        $this->addError('password', '<b>Error:</b> Password must contain at least one special character.');
      }
      else if (!preg_match('/^[a-zA-z0-9\'^£$%&*()}{@#~?><>,|=_+¬-]{8,30}$/', $val)) {
        $this->addError('password', '<b>Error:</b> Password must be 8-30 characters.');      
      }
    }
  }

  private function validateConPassword() {
    $val = trim($this->data['password']);
    $val1 = trim($this->data['conPassword']);

    if (empty($val1)) {
      $this->addError('conPassword', '<b>Error:</b> Confirm password cannot be empty.');
    }
    else {
      if ($val != $val1) { 
        $this->addError('conPassword', '<b>Error:</b> Password and confirm password does not match.');
      }
    }
  }

  private function addError($key, $val) {
    $this->errors[$key] = $val;
  }

}