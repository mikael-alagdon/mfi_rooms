<?php
  // create a user validator class to handle validation
  // constructor which takes in POST data from form
  // check required "fields to check" are present in the data
  // create methods to validate individual fields
  // -- a method to validate a username
  // -- a method to validate a usertype
  // return an error array once all check are done

class ValidateSettingAccount {

  private $data;
  private $errors = [];
  private static $fields = ['cur-pass', 'new-pass', 'con-pass']; // inside the [] is your input name
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

    $this->validatePass();
    $this->validateNew();
    return $this->errors;
  }

  private function validatePass() {
    $val = trim($this->data['cur-pass']);

    if (empty($val)) {
      $this->addError('cur-pass', '<b>Error:</b> Invalid input cannot be empty.');
    }
  }

  private function validateNew() {
    $val0 = trim($this->data['cur-pass']);
    $val = trim($this->data['new-pass']);
    if (!empty($val0) && !preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $val)) { 
      $this->addError('new-pass', '<b>Error:</b> New password must be 8-30 characters, and at least contain at least one special character.');
    }
    else if (!empty($val0) && !preg_match('/^[a-zA-z0-9\'^£$%&*()}{@#~?><>,|=_+¬-]{8,30}$/', $val)) {
      $this->addError('new-pass', '<b>Error:</b> New password must be 8-30 characters,  and at least contain at least one special character.');      
    }
    else {

    }
    
  }

  private function addError($key, $val) {
    $this->errors[$key] = $val;
  }

}