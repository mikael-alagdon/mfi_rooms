<?php

class CourseView extends Course {

  public function viewProgramTypeList($program_id) {
    $results = $this->userList($program_id);
    return $results;
  }

  public function programList() {
    $results = $this->listProgram();
    return $results;
  }
  
  public function courseList() {
    $results = $this->listCourse();
    return $results;
  }

  public function departmentList() {
    $results = $this->listDepartment();
    return $results;
  }
  
  public function selectTeacher($profile_id) {
    $results = $this->teacherSelect($profile_id);
    return $results;
  }

  public function viewTeacher($profile_id) {
    $results = $this->teacherView($profile_id);
    return $results;
  }

  public function viewSubject($teacher_id) {
    $results = $this->subjectView($teacher_id);
    return $results;
  }
}
