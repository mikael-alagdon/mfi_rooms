<?php

class ValidateCourseInput {

  private $data;
  private $errors = [];
  private static $fields = ['course-name', 'program-id', 'department-id']; // inside the [] is your input name
  private $errorTag;

  public function __construct($post_data) {
    $this->data = $post_data;
  }

  public function validateForm() {
    foreach (self::$fields as $field) {
      if (!array_key_exists($field, $this->data)) {
        // trigger_error("$field is not present in data");
        echo "<div class='border-danger alert alert-danger text-center' role='alert'>System <b>error:</b>. Please contact your system administrator.</div>";
        return;
      }
    }

    $this->validateCourseName();
    $this->validateProgramId();
    $this->validateDepartmentId();
    return $this->errors;
  }

  private function validateCourseName() {

    $val = trim($this->data['course-name']);

    if (empty($val)) {
      $this->addError('course-name', '<b>Error:</b> Cannot be empty');
    }
  }

  private function validateProgramId() {
    $val = trim($this->data['program-id']);

    if (empty($val)) {
      $this->addError('program-id', '<b>Error:</b> Cannot be empty');
    }
  }

  private function validateDepartmentId() {
    $val = trim($this->data['department-id']);

    if (empty($val)) {
      $this->addError('department-id', '<b>Error:</b> Cannot be empty');
    }
  }

  private function addError($key, $val) {
    $this->errors[$key] = $val;
  }

}