<?php

// this class that will communicate to database
class User extends Connection {

	// Select to create a session, especially for user login ------------------------------------------------
  
	protected function getLoginUser($username) {
		$sql = "SELECT * FROM tbl_users WHERE username = ?";
		$stmt = $this->connect()->prepare($sql);
    $stmt->execute([$username]); // execute prepare statement

		$results = $stmt->fetchAll(); // get all data in database
		return $results; // this return contain array of data because of fetchAll() built in method
	}

	protected function selectProfile($user_id) {
		$sql = "SELECT * FROM vuserlist WHERE user_id = ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$user_id]); // execute prepare statement

		$results = $stmt->fetchAll(); // get all data in database
		return $results; // this return contain array of data because of fetchAll() built in method
	}

  // for viewing ------------------------------------------------------------------------------------------
  // view profile and user
  protected function userList($user_type_id, $user_id) {
    if ($user_type_id == 1) {
      $sql = "SELECT * FROM vuserlist WHERE user_id <> ?";
    }
    else {
      $sql = "SELECT * FROM vuserlist WHERE user_type_id <> 1 AND user_type_id <> 2 AND user_id <> ?";
    }

    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$user_id]); // execute prepare statement

    $results = $stmt->fetchAll(); // get all data in database
    return $results; // this return contain array of data because of fetchAll() built in method
  }

  // view users
  protected function selectAll() {
    $sql = "SELECT * FROM tbl_users";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute(); // execute prepare statement

    $results = $stmt->fetchAll(); // get all data in database
    return $results; // this return contain array of data because of fetchAll() built in method
  }

  // view user-type
  protected function listType() {
    $sql = "SELECT * FROM tbl_user_type";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute(); // execute prepare statement

    $results = $stmt->fetchAll(); // get all data in database
    return $results; // this return contain array of data because of fetchAll() built in method
  }

  // view teacher $ subject
  protected function selectTeacher($user_id) {
    $sql = "SELECT * FROM vteacher WHERE user_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$user_id]);

    $results = $stmt->fetchAll(); // get all data in database
    return $results; // this return contain array of data because of fetchAll() built in method
  }

  // Update user account ---------------------------------------------------------------------------------

  protected function userUpdate($username, $typeid, $user_id) {
    $sql = "UPDATE tbl_users SET username = ? ,user_type_id = ? WHERE user_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$username, $typeid, $user_id]); // execute prepare statement

    $results = $stmt->fetchAll(); // get all data in database
    return $results; // this return contain array of data because of fetchAll() built in method
  }

  protected function userProfleUpdate($first_name, $middle_name, $last_name, $suffix, $address, $phone, $email, $profession, $user_id) {
    $sql = "UPDATE tbl_userprofile SET first_name = ?, middle_name = ?, last_name = ?, suffix = ?, address = ?, phone = ?, email = ?, profession = ? WHERE user_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$first_name, $middle_name, $last_name, $suffix, $address, $phone, $email, $profession, $user_id]); // execute prepare statement

    $results = $stmt->fetchAll(); // get all data in database
    return $results; // this return contain array of data because of fetchAll() built in method
  }

  protected function passUpdate($password, $user_id) {
    $sql = "UPDATE tbl_users SET password = ? WHERE user_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $hashPass = password_hash($password, PASSWORD_DEFAULT);
    $stmt->execute([$hashPass, $user_id]); // execute prepare statement

    $results = $stmt->fetchAll(); // get all data in database
    return $results; // this return contain array of data because of fetchAll() built in method
  }

  // Insert user account ---------------------------------------------------------------------------------

  protected function userCreate($username, $password, $typeid) {
    $sql = "INSERT INTO tbl_users(username,password,user_type_id) values(?, ?, ?)";
    $stmt = $this->connect()->prepare($sql);
    $hashPass = password_hash($password, PASSWORD_DEFAULT);
    $stmt->execute([$username, $hashPass, $typeid]); // execute prepare statement

    $sql1 = "INSERT INTO tbl_userprofile(user_id,first_name)
            values((SELECT MAX(user_id) FROM tbl_users),?)";
    $stmt1 = $this->connect()->prepare($sql1);
    $stmt1->execute([ucfirst($username)]);

    if ($typeid == 1) {
      $sql2 = "INSERT INTO tbl_teacher(profile_id)
              values((SELECT MAX(profile_id) FROM tbl_userprofile))";
      $stmt2 = $this->connect()->prepare($sql2);
      $stmt2->execute([$profile_id]);

      $sql3 = "INSERT INTO tbl_subject(teacher_id, subject_name)
              values((SELECT MAX(teacher_id) FROM tbl_teacher), 'Admin')";
      $stmt3 = $this->connect()->prepare($sql3);
      $stmt3->execute();
    }
    if ($typeid == 5) {
      $sql2 = "INSERT INTO tbl_teacher(profile_id)
              values((SELECT MAX(profile_id) FROM tbl_userprofile))";
      $stmt2 = $this->connect()->prepare($sql2);
      $stmt2->execute([$profile_id]);
    }

    $results = $stmt->fetchAll(); // get all data in database
    return $results; // this return contain array of data because of fetchAll() built in method
  }

  protected function userTeacher($profile_id) {
    $sql = "INSERT INTO tbl_teacher(profile_id)
            values(?)";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$profile_id]);

    $results = $stmt->fetchAll(); // get all data in database
    return $results; // this return contain array of data because of fetchAll() built in method
  }

  // Delete user account ---------------------------------------------------------------------------------

  protected function userDelete($user_id) {
    $sql = "DELETE FROM tbl_userprofile WHERE user_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$user_id]); // execute prepare statement

    $sql1 = "DELETE FROM tbl_users WHERE user_id = ? ";
    $stmt1 = $this->connect()->prepare($sql1);
    $stmt1->execute([$user_id]);

    $results = $stmt->fetchAll(); // get all data in database
    return $results; // this return contain array of data because of fetchAll() built in method
  }

  protected function teacherDelete($profile_id, $typeid) {
    $sql = "DELETE FROM tbl_teacher WHERE profile_id = ? ";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$profile_id]);

    $results = $stmt->fetchAll(); // get all data in database
    return $results; // this return contain array of data because of fetchAll() built in method
  } 

  protected function subjectDelete($teacher_id) {
    $sql = "DELETE FROM tbl_subject WHERE teacher_id = ? ";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$teacher_id]);

    $results = $stmt->fetchAll(); // get all data in database
    return $results; // this return contain array of data because of fetchAll() built in method
  } 
  // --------------------------------------------------------------------------------------------------------

  protected function uniqueUsernameId($username, $user_id) {
    $sql = "SELECT * FROM tbl_users WHERE username = ? AND user_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$username, $user_id]); // execute prepare statement

    $results = $stmt->fetchAll(); // get all data in database
    return $results; // this return contain array of data because of fetchAll() built in method
  }

  protected function uniqueUsername($username) {
    $sql = "SELECT * FROM tbl_users WHERE username = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$username]); // execute prepare statement

    $results = $stmt->fetchAll(); // get all data in database
    return $results; // this return contain array of data because of fetchAll() built in method
  }
}