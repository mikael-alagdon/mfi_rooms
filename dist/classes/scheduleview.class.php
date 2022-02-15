<?php

class ScheduleView extends Schedule {

  public function mfiSchedule() {
    $results = $this->scheduleView();
    return $results;
  }

  public function selectSchedule($room_id) {
    $results = $this->scheduleSelect($room_id);
    return $results;
  }

  public function scheduleList($profile_id, $user_type_id, $room_id) {
    $results = $this->listSchedule($profile_id, $user_type_id, $room_id);
    return $results;
  }

  public function scheduleCheck($room_id, $schedule_status_id, $schedule_date) {
    $results = $this->checkSchedule($room_id, $schedule_status_id, $schedule_date);
    return $results;
  }

}
