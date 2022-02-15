<?php

class UserView extends User {
	
	public function myProfile($user_id) {
		$results = $this->selectProfile($user_id);
		$_SESSION['profile'] = $results;
    return $_SESSION['profile'] = $results;
	}

  public function viewUserList($user_type_id, $user_id) {
    $results = $this->userList($user_type_id, $user_id);
    return $results;
  }

  public function checkIfEmpty() {
    $results = $this->selectAll();
    if (empty($results)) {
      return "empty";
    }
    else {
      return $results;
    }
  }

  public function selectUser($user_id) {
    $results = $this->selectProfile($user_id);
    return $results;;
  }

  public function typeList() {
    $results = $this->listType();
    return $results;;
  }

  public function checkUser($username, $user_type_id, $user_id) {
    $resultsId = $this->uniqueUsernameId($username, $user_id);
    $results = $this->uniqueUsername($username);

    if (!empty($results)) { // -- User already taken
      if ($resultsId[0]['username'] == $username && $resultsId[0]['user_id'] == $user_id) { // -- No changes
        if ($results[0]['username'] == $username && $resultsId[0]['user_type_id'] != $user_type_id) {
          return 2432;
        }
        else {
          return;
        }
        // echo "<script>alert('no changes')</script>";
      }
      else {
        return 2342; // -- raturn error msg
      }
    }
    else {
      return 2432; // -- return successfully check unique username
    }

  }

  public function teacherSelect($user_id) {
  $results = $this->selectTeacher($user_id);
    return $results;
  }
}
