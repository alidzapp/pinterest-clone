<?php

class Validate {
	private $_passed = false, $_errors = array(), $_db = null;

	public function __construct() {
		$this->_db = DB::getInstance();
	}

	public function check($source) {
		if (empty($source)) {
			return false;
		}
		foreach($source as $field => $input) {
			$input = trim($input);
			switch ($field) {
				case "firstname":
					$this->checkFirstName($input);
					break;
				case "lastname":
					$this->checkLastName($input);
					break;
				case "username":
					$this->checkUsername($input);
					break;
				case "email":
					$this->checkEmail($input);
					break;
				case "password":
					$this->checkPassword($input, $source["passwordconfirm"]);
					break;
				case "passwordconfirm":
					$this->checkPassword($input, $source["passwordconfirm"]);
					break;
				case "pinname":
					$this->checkPinName($input);
					break;
				case "pinurl":
					$this->checkImg($input);
					break;
				case "comment":
					$this->checkComment($input);
					break;
			}
		}

		if (!count($this->_errors)) {
			$this->_passed = true;
		}
	}

	private function addError($field, $error) {
		$this->_errors[$field] = $error;
	}

	private function isImg($url) {
		$url_headers = get_headers($url, 1);

		if (isset($url_headers["Content-Type"])){

			$type = strtolower($url_headers["Content-Type"]);

			$valid_image_type = array();
			$valid_image_type["image/png"] = "";
			$valid_image_type["image/jpg"] = "";
			$valid_image_type["image/jpeg"] = "";
			$valid_image_type["image/jpe"] = "";
			$valid_image_type["image/gif"] = "";
			$valid_image_type["image/tif"] = "";
			$valid_image_type["image/tiff"] = "";
			$valid_image_type["image/svg"] = "";
			$valid_image_type["image/ico"] = "";
			$valid_image_type["image/icon"] = "";
			$valid_image_type["image/x-icon"] = "";

			if (isset($valid_image_type[$type])){
				return true;
			}
		}

		return false;
	}

	private function alphanumeric($str) {
		return preg_match("/^[A-Za-z0-9]+$/", $str);
	}

	private function checkFirstName($name) {
		$length = mb_strlen($name);
		if ($length > 50) {
			$this->addError("firstname", "First name can't be longer than 50 characters.");
		}
	}

	private function checkLastName($name) {
		$length = mb_strlen($name);
		if ($length > 50) {
			$this->addError("lastname", "Last name can't be longer than 50 characters.");
		}
	}

	private function checkUsername($username) {
		$length = mb_strlen($username);

		if (!$this->alphanumeric($username)) {
			$this->addError("username", "Only alphanumeric characters allowed.");
		} elseif (!($length >= 3 && $length <= 20)) {
			$this->addError("username", "Username must be between 3 and 20 characters.");
		} elseif ($this->_db->query("SELECT id FROM users WHERE username=?", array($username))->count()) {
			$this->addError("username", "This username is taken.");
		}
	}

	private function checkEmail($email) {
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$this->addError("email", "Invalid email.");
		} elseif ($this->_db->query("SELECT id FROM users WHERE email=?", array($email))->count()) {
			$this->addError("email", "This email is taken.");
		} elseif (mb_strlen($email) > 150) {
			$this->addError("email", "Email can't be longer than 150 characters.");
		}
	}

	private function checkPassword($pass1, $pass2) {
		$length1 = mb_strlen($pass1);
		$length2 = mb_strlen($pass2);

		if ($length1 < 3 || $length2 < 3) {
			$this->addError("pass", "Password must be at least 3 characters.");
		} elseif ($pass1 !== $pass2) {
			$this->addError("pass", "Passwords do not match.");
		}
	}

	private function checkPinName($name) {
		$length = mb_strlen($name);
		if ($length > 100) {
			$this->addError("pinname", "Maximum length is 100 characters.");
		} elseif (!$length) {
			$this->addError("pinname", "Name is required.");
		}
	}

	private function checkComment($comment) {
		$length = mb_strlen($comment);
		if (!$length) {
			$this->addError("comment", "Comment cannot be empty.");
		}
	}

	private function checkImg($img) {
		if (!filter_var($img, FILTER_VALIDATE_URL) || !$this->isImg($img)) {
			$this->addError("pinurl", "Doesn't look like an image.");
		}
	}

	public function passed() {
		return $this->_passed;
	}

	public function errors() {
		return $this->_errors;
	}

	public function error($field) {
		if (isset($this->_errors[$field])) {
			return sprintf('<span class="help-block">%s</span>', $this->_errors[$field]);
		}
		return '';
	}
}