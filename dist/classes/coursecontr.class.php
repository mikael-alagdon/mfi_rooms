<?php

class CourseContr extends Course {

  // -- Add courses
  public function courseAdd($coursename, $program_id, $department_id) {
    $results = $this->courseCreate($coursename, $program_id, $department_id);
    $msg = "<div class='border-success alert alert-success text-center alert-dismissible' role='success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Course successfully added.</div>";
    return $msg;
  }

  // -- Edit Course
  public function courseEdit($coursename, $program_id, $department_id, $course_id) {
    $results = $this->courseUpdate($coursename, $program_id, $department_id, $course_id);
    $msg = "<div class='border-success alert alert-success text-center alert-dismissible' role='success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Course successfully added.</div>";
    return $msg;
  }

  // -- Delete
  public function courseDelete($course_id) {
    $this->deleteCourse($course_id);
    $msg = "<div class='border-success alert alert-success text-center alert-dismissible' role='success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Course successfully added.</div>";
    return $msg;
  }

  // -- Edit Course
  public function teacherEdit($department_id, $profile_id) {
    $results = $this->teacherUpdate($department_id, $profile_id);
    $msg = "<div class='border-success alert alert-success text-center alert-dismissible' role='success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Course successfully added.</div>";
    return $msg;
  }

  // -- Add subject
  public function subjectAdd($teacher_id, $subject_name) {
    $results = $this->subjectCreate($teacher_id, $subject_name);
  }

  // -- Delete subject
  public function subjectDelete($subject_id) {
    $this->deleteSubject($subject_id);
  }

  // -- Delete subject
  public function allSubjectDelete($teacher_id) {
    $this->deleteAllSubject($teacher_id);
  }

  // -- edit subject
  public function subjectEdit($subject_id, $subject_name) {
    $this->subjectUpdate($subject_id, $subject_name);
  }
}