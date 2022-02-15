<?php
  // create a user validator class to handle validation
  // constructor which takes in POST data from form
  // check required "fields to check" are present in the data
  // create methods to validate individual fields
  // -- a method to validate a username
  // -- a method to validate a usertype
  // return an error array once all check are done

class ValidateUserEdit {

  private $data;
  private $errors = [];
  private static $fields = ['username', 'usertype']; // inside the [] is your input name
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
    $this->validateUserType();
    return $this->errors;
  }

  private function validateUsername() {

    $val = trim($this->data['username']);

    if (empty($val)) {
      $this->addError('username', '<b>Error:</b> Username cannot be empty.');
    }
    else {
      // if username input contain special character it will return error msg.
      if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $val)) { 
        $this->addError('username', '<b>Error:</b> Username must alphanumeric.');
      }
      else if (!preg_match('/^[a-zA-z0-9]{4,22}$/', $val)) {
       $this->addError('username', '<b>Error:</b> Username must be 4-22 chars.');
      }
      else {

      }

    }

  }

  private function validateUserType() {
    $val = trim($this->data['usertype']);
    // $val = trim($this->data['username']);

    if (empty($val)) {
      $this->addError('usertype', '<b>Error:</b> User-type cannot be empty.');
    }
  }

  private function addError($key, $val) {
    $this->errors[$key] = $val;
  }

}