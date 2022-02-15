<?php 

class RoomView extends Room {

  public function viewRoom($room_id) {
    $results = $this->roomView($room_id);
    return $results;
  }


  public function roomList() {
    $results = $this->listRoom();
    return $results;
  }

  public function viewRoomType() {
    $results = $this->roomTypeView();
    return $results;
  }

}