<?php

// this class that will communicate to database
class Room extends Connection {

  // View room --------------------------------------------------------------------------------------------

  protected function roomView($room_id) {
    $sql = "SELECT * FROM vroom WHERE room_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$room_id]); // execute prepare statement

    $results = $stmt->fetchAll(); // get all data in database
    return $results; // this return contain array of data because of fetchAll() built in method
  }

  protected function listRoom() {
    $sql = "SELECT * FROM vroom";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute(); // execute prepare statement

    $results = $stmt->fetchAll(); // get all data in database
    return $results; // this return contain array of data because of fetchAll() built in method
  }

  protected function roomTypeView() {
    $sql = "SELECT * FROM tbl_room_type";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute(); // execute prepare statement

    $results = $stmt->fetchAll(); // get all data in database
    return $results; // this return contain array of data because of fetchAll() built in method
  }

  // Update room ------------------------------------------------------------------------------------------

  protected function updateRoom($room_number, $room_type, $room_id) {
    $sql = "UPDATE tbl_room SET room_number = ?, room_type_id = ? WHERE room_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$room_number, $room_type, $room_id]); // execute prepare statement
    
    $results = $stmt->fetchAll(); // get all data in database
    return $results; // this return contain array of data because of fetchAll() built in method
  }

  // Delete room ------------------------------------------------------------------------------------------

  protected function deleteRoom($room_id) {
    $sql = "DELETE FROM tbl_room WHERE room_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$room_id]); // execute prepare statement
    
    $results = $stmt->fetchAll(); // get all data in database
    return $results; // this return contain array of data because of fetchAll() built in method
  }


} // -- End of the class
