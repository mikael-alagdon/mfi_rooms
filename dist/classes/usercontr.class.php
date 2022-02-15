<?php

class UserContr extends User {

  // -- Add user
  public function userAdd($username, $password, $user_type_id) {
    $results = $this->uniqueUsername($username);

    if (!empty($results)) { // -- User already taken
      return 2342; // -- raturn error msg
    }
    else { // -- return successfully check unique username
      $this->userCreate($username, $password, $user_type_id);
      return 2432;
    }

  }

  // -- Add teacher
  public function addTeacher($profile_id) {
    $this->userTeacher($profile_id);
  }

  // -- Add subject for admin
  public function addSubject($profile_id) {
    $this->userTeacher($profile_id);
  }


  // -- Edit user
  public function userEdit($username, $user_type_id, $user_id) {
    if ($user_type_id == 5) {
      # code...
    }

    if (empty($username) && empty($user_type_id) && empty($user_id)) {
      return 2342; // return error message
    }
    else {
      $results = $this->userUpdate($username, $user_type_id, $user_id);
      return $results; // return successful message
    }
  }

  // -- Edit user profile
  public function userProfileEdit($first_name, $middle_name, $last_name, $suffix, $address, $phone, $email, $profession, $user_id) {
    $this->userProfleUpdate($first_name, $middle_name, $last_name, $suffix, $address, $phone, $email, $profession, $user_id);
    $results = $this->selectProfile($user_id);
    $_SESSION['profile'] = $results;
    return $_SESSION['profile'] = $results;
  }

  // -- Edit user password
  public function editPass($username, $password, $user_id) {
    $this->passUpdate($password, $user_id);
    $results = $this->getLoginUser($username);
    return $_SESSION['account'] = $results;
  }

  // -- Delete user
  public function delete($user_id, $profile_id, $type_id) {
    if ($type_id == 1 || $type_id == 5) {
      $this->teacherDelete($profile_id, $type_id);
    }
    $this->userDelete($user_id);
  }

  public function deleteTeacher($profile_id, $type_id) {
    $this->teacherDelete($profile_id, $type_id);
  }

  public function deleteSubject($teacher_id) {
    $this->subjectDelete($teacher_id);
  }
}