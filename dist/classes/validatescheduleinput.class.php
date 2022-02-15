<?php

class ValidateScheduleInput extends ScheduleView {

  private $data;
  private $errors = [];
  private static $fields = ['subject-id', 'time-in', 'time-out', 'date-schedule', 'description', 'hidden-room-id']; // inside the [] is your input name
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

    $this->validateSubjectId();
    $this->validateTimeIn();
    $this->validateTimeOut();
    $this->validateDate();
    $this->validateDesc();
    return $this->errors;
  }

  private function validateSubjectId() {
    $val = trim($this->data['subject-id']);

    if (empty($val)) {
      $this->addError('subject-id', '<b>Error:</b> Cannot be empty. Click <a href="setting-subject.php">here</a> to add subject');
    }
  }

  private function validateTimeIn() {
    $val = trim($this->data['time-in']);
    $valDate = trim($this->data['date-schedule']);
    $valRoomId = trim($this->data['hidden-room-id']);

    $countSched = $this->selectSchedule($valRoomId);

    $checkTime = date('H:i:s', strtotime($val));
    $showTime = date('h:i A', strtotime($val));
    $current_time = date('H:i:s');
    $current_date = date("Y-m-d");
    
    if (empty($checkTime)) {
      $this->addError('time-in', '<b>Error:</b> Cannot be empty.');
    }
    else {
      if ($valDate == $current_date) {
        if ($checkTime < $current_time) {
          $this->addError('time-in', '<b>Error:</b> Invalid Time-in.');
        }
      }
      foreach ($countSched as $value) {
        if ($valRoomId == $value["room_id"]) {
          if ($current_date == $valDate){
            if ($checkTime >= $value['time_in'] && $checkTime < $value['time_out']) {
              $this->addError('time-in', '<b>Error:</b> Invalid '.$showTime.' time-in, someone already schedule.');
            }
          }
          else if ($valDate == $value['schedule_date']) {
            if ($checkTime >= $value['time_in'] && $checkTime < $value['time_out']) {
              $this->addError('time-in', '<b>Error:</b> Invalid '.$showTime.' time-in, someone already schedule.');
            }
          }
        }

      }

    }
  }

  private function validateTimeOut() {
    $val = trim($this->data['time-out']);
    $valin = trim($this->data['time-in']);
    $valDate = trim($this->data['date-schedule']);
    $valRoomId = trim($this->data['hidden-room-id']);

    $countSched = $this->selectSchedule($valRoomId);

    $valout = strtotime($val) - 3600;
    $valTimeOut = date("H:i:s", $valout);

    $checkTime = date('H:i:s', strtotime($val));
    $showTime = date('h:i A', strtotime($val));
    $current_time = date('H:i:s');
    $current_date = date("Y-m-d");

    if (empty($val)) {
      $this->addError('time-out', '<b>Error:</b> Cannot be empty.');
    }
    else {
      if (!($valin <= $valTimeOut)) {
        $this->addError('time-out', '<b>Error:</b> Invalid Time-out.');
      }
      
      foreach ($countSched as $value) {
        if ($valRoomId == $value["room_id"]) {
          if ($current_date == $valDate){
            if ($checkTime > $value['time_in'] && $checkTime <= $value['time_out']) {
              $this->addError('time-out', '<b>Error:</b> Invalid '.$showTime.' time-out, someone already schedule.');
            }
          }
          else if ($valDate == $value['schedule_date']) {
            if ($checkTime > $value['time_in'] && $checkTime <= $value['time_out']) {
              $this->addError('time-out', '<b>Error:</b> Invalid '.$showTime.' time-out, someone already schedule.');
            }
          }
        }

      }

    }
  }

  private function validateDate() {
    $val = trim($this->data['date-schedule']);
    $current_date = date("Y-m-d");

    if (empty($val)) {
      $this->addError('date-schedule', '<b>Error:</b> Cannot be empty.');
    }
    else {
        if ($val < $current_date) {
          $this->addError('date-schedule', '<b>Error:</b> Invalid date.');
        }
    }
  }

  private function validateDesc() {
    $val = trim($this->data['description']);

    if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $val)) { 
      $this->addError('description', '<b>Error:</b> Invalid input speacial character is not allowed.');
    }
    
  }

  private function addError($key, $val) {
    $this->errors[$key] = $val;
  }

}