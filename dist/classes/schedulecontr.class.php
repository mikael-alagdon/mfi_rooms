<?php

class ScheduleContr extends Schedule {

  public function scheduleAdd($schedule_date, $time_in, $time_out, $schedule_purpose, $subject_id, $room_id) {
    $this->dateCreate($schedule_date, $time_in, $time_out);
    $this->descCreate($schedule_purpose);
    $this->scheduleCreate($subject_id, $room_id, $schedule_purpose);
  }

  public function scheduleUpdate($schedule_status_id, $schedule_id) {
    $this->updateSchedule($schedule_status_id, $schedule_id);
  }
  
  public function roomScheduleUpdate($schedule_status_id, $schedule_id) {
    $this->updateRoomSchedule($schedule_status_id, $schedule_id);
  }
}
