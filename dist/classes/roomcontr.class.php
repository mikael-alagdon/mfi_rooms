<?php

class RoomContr extends Room {

  public function delete($room_id) {
    $results = $this->deleteRoom($room_id);
  }

  public function editRoom($room_number, $room_type, $room_id) {
    $results = $this->updateRoom($room_number, $room_type, $room_id);
    if (!empty($results)) {
      return "success";
    }
    else {
      return "error";
    }
  }
}