<?php

// this class that will communicate to database
class Schedule extends Connection {

  protected function checkSchedule($room_id, $schedule_status_id, $schedule_date) {
    $sql = "SELECT * FROM vschedule WHERE room_id = ? AND schedule_status_id = ? AND schedule_date = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$room_id, $schedule_status_id, $schedule_date]); // execute prepare statement

    $results = $stmt->fetchAll(); // get all data in database
    return $results; // this return contain array of data because of fetchAll() built in method
  }

  protected function listSchedule($profile_id, $user_type_id, $room_id) {
    if ($profile_id == '0' && $user_type_id == '0' && $room_id == '0') {
      $sql = "SELECT * FROM vschedule";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([$profile_id]); // execute prepare statement
    }
    else if (!empty($profile_id)) {
      $sql = "SELECT * FROM vschedule WHERE profile_id = ? ORDER BY schedule_date DESC";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([$profile_id]); // execute prepare statement
    }
    else if (!empty($room_id)) {
      $sql = "SELECT * FROM vschedule WHERE room_id = ? AND schedule_status_id <> 4";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([$room_id]); // execute prepare statement
    }
    else {
      $sql = "SELECT * FROM vschedule WHERE schedule_status_id = 1 OR schedule_status_id = 2 ORDER BY schedule_status_id DESC";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute(); // execute prepare statement
    }

    $results = $stmt->fetchAll(); // get all data in database
    return $results; // this return contain array of data because of fetchAll() built in method
  }

  protected function scheduleView() {
    $sql = "SELECT * FROM vschedule ORDER BY schedule_status_id DESC";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute(); // execute prepare statement

    $results = $stmt->fetchAll(); // get all data in database
    return $results; // this return contain array of data because of fetchAll() built in method
  }

  protected function scheduleSelect($room_id) {
    $sql = "SELECT * FROM vschedule WHERE room_id = ? ";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$room_id]); // execute prepare statement

    $results = $stmt->fetchAll(); // get all data in database
    return $results; // this return contain array of data because of fetchAll() built in method
  }

  protected function updateSchedule($schedule_status_id, $schedule_id) {
    $sql = "UPDATE tbl_schedule SET schedule_status_id = ? WHERE schedule_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$schedule_status_id, $schedule_id]); // execute prepare statement

    $results = $stmt->fetchAll(); // get all data in database
    return $results; // this return contain array of data because of fetchAll() built in method
  }

  protected function updateRoomSchedule($room_status_id, $room_id) {
    $sql = "UPDATE tbl_room SET room_status_id = ? WHERE room_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$room_status_id, $room_id]); // execute prepare statement

    $results = $stmt->fetchAll(); // get all data in database
    return $results; // this return contain array of data because of fetchAll() built in method
  }

  protected function dateCreate($schedule_date, $time_in, $time_out) {
    $sql = "INSERT INTO tbl_schedule_date(schedule_date, time_in, time_out) VALUES(?, ?, ?)";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$schedule_date, $time_in, $time_out]); // execute prepare statement

    $results = $stmt->fetchAll(); // get all data in database
    return $results; // this return contain array of data because of fetchAll() built in method
  }

  protected function descCreate($schedule_purpose) {
    if (!empty($schedule_purpose)) {
      $sql = "INSERT INTO tbl_schedule_desc(schedule_purpose) VALUES(?)";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([$schedule_purpose]); // execute prepare statement

      $results = $stmt->fetchAll(); // get all data in database
      return $results; // this return contain array of data because of fetchAll() built in method
    }
  }

  protected function scheduleCreate($subject_id, $room_id, $schedule_purpose) {
    if (empty($schedule_purpose)) {
      $desc = '1';
    }
    else {
      $desc = "(SELECT MAX(schedule_desc_id) FROM tbl_schedule_desc)";
    }

    $sql = "INSERT INTO tbl_schedule(schedule_date_id, schedule_desc_id, schedule_person_id, room_id) 
            VALUES((SELECT MAX(schedule_date_id) FROM tbl_schedule_date), 
            ".$desc.", 
            ?, ?)";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$subject_id, $room_id]); // execute prepare statement

    $results = $stmt->fetchAll(); // get all data in database
    return $results; // this return contain array of data because of fetchAll() built in method
  }
}