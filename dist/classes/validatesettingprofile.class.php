<?php
  // create a user validator class to handle validation
  // constructor which takes in POST data from form
  // check required "fields to check" are present in the data
  // create methods to validate individual fields
  // -- a method to validate a username
  // -- a method to validate a usertype
  // return an error array once all check are done

class ValidateSettingProfile {

  private $data;
  private $errors = [];
  private static $fields = ['department-id', 'username', 'firstname', 'lastname', 'phone', 'email']; // inside the [] is your input name
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

    $this->validateDepartmentId();
    $this->validateUsername();
    $this->validateFirstname();
    $this->validateLastname();
    $this->validateEmail();
    $this->validatePhone();
    return $this->errors;
  }

  private function validateDepartmentId() {
    $val = trim($this->data['department-id']);

    if ($val != '0') {
      if (empty($val)) {
        $this->addError('department-id', '<b>Error:</b> Cannot be empty');
      }
    }
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

  private function validateFirstname() {

    $val = trim($this->data['firstname']);

    if (empty($val)) {
      $this->addError('firstname', '<b>Error:</b> First name cannot be empty.');
    }
    else {
      if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $val)) { 
        $this->addError('firstname', '<b>Error:</b> First name must alphanumeric.');
      }
    }
  }

  private function validateLastname() {
    $val = trim($this->data['lastname']);

    if (empty($val)) {
      $this->addError('lastname', '<b>Error:</b> Last name cannot be empty.');
    }
    else {
      if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $val)) { 
        $this->addError('lastname', '<b>Error:</b> Last name must alphanumeric.');
      }
    }
  }

  private function validateEmail() {
    $val = trim($this->data['email']);

    if (empty($val)) {
      $this->addError('email', '<b>Error:</b> Email cannot be empty.');
    }
    else {
      if (!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i', $val)) { 
        $this->addError('email', '<b>Error:</b> Invalid email.');
      }
    }
  
  }

  private function validatePhone() {
    $val = trim($this->data['phone']);

    if (!preg_match('/^[0-9]{0,15}$/', $val)) {
      $this->addError('phone', '<b>Error:</b> Phone number must be number.');
    }
  }

  private function addError($key, $val) {
    $this->errors[$key] = $val;
  }

}