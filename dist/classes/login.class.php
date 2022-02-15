<?php

class Login extends User {

	public function loginUser($username, $password) {		
		$results = $this->getLoginUser($username);

		if (!empty($results[0]['user_id'])) {
			$hash = password_verify($password, $results[0]['password']);
    	if($hash == true){
    		// session_start();
       	// echo $_SESSION['account'][0]['user_type_id'];
        // echo "successfully login";
        header("Location: ../index.php");
        return $_SESSION['account'] = $results;
    	}
      else{
    		return 2342;
  	 }
		}
		else {
			return 2342;
		}

	}

}