<?php

// this class that will communicate to database
class Course extends Connection {

	// Select to create a session, especially for user login ------------------------------------------------

  // -- insert course
  protected function courseCreate($coursename, $programid, $department_id) {
    $sql = "INSERT INTO tbl_course(course_name, program_id, department_id) VALUES(?, ?, ?)";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$coursename, $programid, $department_id]); // execute prepare statement

    $results = $stmt->fetchAll(); // get all data in database
    return $results; // this return contain array of data because of fetchAll() built in method
  }

  // -- view programs (shs, dts)
  protected function listProgram() {
    $sql = "SELECT * FROM tbl_program";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute(); // execute prepare statement

    $results = $stmt->fetchAll(); // get all data in database
    return $results; // this return contain array of data because of fetchAll() built in method
  }

  // -- view course table
  protected function listCourse() {
    $sql = "SELECT * FROM vcourse";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute(); // execute prepare statement

    $results = $stmt->fetchAll(); // get all data in database
    return $results; // this return contain array of data because of fetchAll() built in method
  } 

  // edit curse -------------------------------------------------------------------------------------------

  protected function courseUpdate($coursename, $programid, $department_id, $course_id) {
    $sql = "UPDATE tbl_course SET course_name = ?, program_id = ?, department_id = ? WHERE course_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$coursename, $programid, $department_id, $course_id]); // execute prepare statement

    $results = $stmt->fetchAll(); // get all data in database
    return $results; // this return contain array of data because of fetchAll() built in method
  } 

  // delete course ----------------------------------------------------------------------------------------


  protected function deleteCourse($course_id) {
    $sql = "DELETE FROM tbl_course WHERE course_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$course_id]); // execute prepare statement

    $results = $stmt->fetchAll(); // get all data in database
    return $results; // this return contain array of data because of fetchAll() built in method
  } 

  // teacher side -------------------------------------------------------------------------------------------

  // -- view department
  protected function listDepartment() {
    $sql = "SELECT * FROM tbl_department WHERE department_id <> 1";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute(); // execute prepare statement

    $results = $stmt->fetchAll(); // get all data in database
    return $results; // this return contain array of data because of fetchAll() built in method
  } 

  // -- view teacher
  protected function teacherSelect($profile_id) {
    $sql = "SELECT * FROM tbl_teacher WHERE profile_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$profile_id]); // execute prepare statement

    $results = $stmt->fetchAll(); // get all data in database
    return $results; // this return contain array of data because of fetchAll() built in method
  }
  
  // -- view viewteacher
  protected function teacherView($profile_id) {
    $sql = "SELECT * FROM vteacher WHERE profile_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$profile_id]); // execute prepare statement

    $results = $stmt->fetchAll(); // get all data in database
    return $results; // this return contain array of data because of fetchAll() built in method
  }
  

  // -- update teacher
  protected function teacherUpdate($department_id, $profile_id) {
    $sql = "UPDATE tbl_teacher SET department_id = ? WHERE profile_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$department_id, $profile_id]); // execute prepare statement

    $results = $stmt->fetchAll(); // get all data in database
    return $results; // this return contain array of data because of fetchAll() built in method
  }

  // -- insert teacher subject
  protected function subjectCreate($teacher_id, $subject_name) {
    $sql = "INSERT INTO tbl_subject(teacher_id, subject_name) values(?, ?)";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$teacher_id, $subject_name]); // execute prepare statement

    $results = $stmt->fetchAll(); // get all data in database
    return $results; // this return contain array of data because of fetchAll() built in method
  }

  // -- view subject
  protected function subjectView($teacher_id) {
    $sql = "SELECT * FROM tbl_subject WHERE teacher_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$teacher_id]); // execute prepare statement

    $results = $stmt->fetchAll(); // get all data in database
    return $results; // this return contain array of data because of fetchAll() built in method
  }

  protected function deleteSubject($subject_id) {
    $sql = "DELETE FROM tbl_subject WHERE subject_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$subject_id]); // execute prepare statement

    $results = $stmt->fetchAll(); // get all data in database
    return $results; // this return contain array of data because of fetchAll() built in method
  }

  protected function deleteAllSubject($teacher_id) {
    $sql = "DELETE FROM tbl_subject WHERE teacher_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$teacher_id]); // execute prepare statement

    $results = $stmt->fetchAll(); // get all data in database
    return $results; // this return contain array of data because of fetchAll() built in method
  }


  protected function subjectUpdate($subject_id, $subject_name) {
    $sql = "UPDATE tbl_subject SET subject_name = ? WHERE subject_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$subject_name, $subject_id]); // execute prepare statement

    $results = $stmt->fetchAll(); // get all data in database
    return $results; // this return contain array of data because of fetchAll() built in method
  }
}