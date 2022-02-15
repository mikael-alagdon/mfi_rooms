<?php 
  include 'navbar.php';
  $teacher = $courseView->selectTeacher($_SESSION["profile"][0]["profile_id"]);
  foreach ($teacher as $val) {
    $teacher_id = $val['teacher_id'];
  }
  $subject = $courseView->viewSubject($teacher_id);

  // -- check if form is submited
  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (!empty($_POST['subject-name'])) {
      if (isset($_POST['submit-add'])) {
        $courseControl->subjectAdd(
        $_POST['hidden-teacher-id'],
        $_POST['subject-name']
        );
        $subject = $courseView->viewSubject($teacher_id);
      } // -- End of submitted post add subject

      if (isset($_POST['submit-save'])) {
        $courseControl->subjectEdit($_POST['hidden-subject-id'], $_POST['subject-name']);
        $subject = $courseView->viewSubject($teacher_id);
      } // -- End of submitted post edit subject
    }
    
    if (isset($_POST['submit-delete'])) {
      $courseControl->subjectDelete($_POST['hidden-subject-id']);
      $subject = $courseView->viewSubject($teacher_id);
    } // -- End of submitted post delete subject
  } // -- End of check submit POST