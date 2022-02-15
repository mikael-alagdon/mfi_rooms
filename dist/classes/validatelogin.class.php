<?php
	
	// create a user validator class to handle validation
	// constructor which takes in POST data from form
	// check required "fields to check" are present in the data
	// create methods to validate individual fields
	// -- a method to validate a username
	// -- a method to validate a password
	// return an error array once all check are done

class ValidateLogin {

	private $data;
	private $errors = [];
	private static $fields = ['loginUsername', 'loginPassword']; // inside the [] is your input name
	private $errorTag;

	public function __construct($post_data) {
		$this->data = $post_data;
	}

	public function validateForm() {
		foreach (self::$fields as $field) {
			if (!array_key_exists($field, $this->data)) {
				// trigger_error("$field is not present in data");
				echo "<div class='border-danger alert alert-danger text-center' role='alert'>System error. Please contact your system administrator.</div>";
				return;
			}
		}

		$this->validateUsername();
		$this->validatePassword();
		return $this->errors;
	}

	private function validateUsername() {

		$val = trim($this->data['loginUsername']);

		if (empty($val)) {
			$this->addError('loginUsername', '<b>Error:</b> Username cannot be empty.');
		}
		else {
			// if username input contain special character it will return error msg.
			if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $val)) { 
				$this->addError('loginUsername', '<b>Error:</b> Username must alphanumeric.');
			}
		}

	}

	private function validatePassword() {
		$val = trim($this->data['loginPassword']);

		if (empty($val)) {
			$this->addError('loginPassword', '<b>Error:</b> Password cannot be empty.');
		}
	}

	private function addError($key, $val) {
		$this->errors[$key] = $val;
	}

}