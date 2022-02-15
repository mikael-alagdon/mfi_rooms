<?php
  require('include/class-autoload.inc.php');
  date_default_timezone_set('Asia/Manila');
  $scheduleView = new ScheduleView();
  $scheduleControl = new ScheduleContr();
  $countSched = $scheduleView->mfiSchedule();
  $current_time = date('H:i:00');
  $current_date = date("Y-m-d");

  foreach ($countSched as $value) {
    // if (empty($check = $scheduleView->scheduleCheck($value['room_id'], $value['schedule_status_id'], $current_date))) {
    //   $scheduleControl->roomScheduleUpdate('1', $value['room_id']);
    // }
    // else {
    //   $scheduleControl->roomScheduleUpdate('2', $value['room_id']);
    // }

    if ($value['schedule_status_id'] != 3) {
      // if the date sa current date now
      if ($current_date == $value['schedule_date']) {
        // if the current time is true then the status of sched 'Busy' = '2' & the room will be 'Occupied' = '2'
        if ($current_time >= $value['time_in'] && $current_time < $value['time_out']) {
          $scheduleControl->scheduleUpdate('1', $value['schedule_id']);
        }
        // if the time sched is at least later it will be 'Schedule' = '1'
        else if ($current_time <= $value['time_in']) {
          $scheduleControl->scheduleUpdate('2', $value['schedule_id']);
        }
        // -- if the ched is finish it will change to 'N/A' = '4'
        else {
          $scheduleControl->scheduleUpdate('4', $value['schedule_id']);

        }

        if ($value['schedule_status_id'] == 1) {
          $scheduleControl->roomScheduleUpdate('2', $value['room_id']);
        }
        else {
          $scheduleControl->roomScheduleUpdate('1', $value['room_id']);
        }

      }
      // -- if date is old the status of sched changet to 'N/A' = '4'
      else if ($current_date > $value['schedule_date']) { 
        $scheduleControl->scheduleUpdate('4', $value['schedule_id']);
      }
      // -- if the date is not current but in the near future status will be 'Schedule' = '1'
      else {
        $scheduleControl->scheduleUpdate('2', $value['schedule_id']);
      }

    }
  }
?>

