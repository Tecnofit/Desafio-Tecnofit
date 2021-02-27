<?php

	class User
	{
		private $id;
		private $login;
		private $pass;
		private $name;
		private $profile;

		public function __construct() {
		}

		public function getId() {
			return $this->id;
		}
		public function setId($id) {
			if(isset($id) && !empty($id)) {
				$this->id = $id;
			} else {
				$this->id = null;
			}
		}

		public function getLogin() {
			return $this->login;
		}
		public function setLogin($login) {
			if(isset($login) && !empty($login)) {
				$this->login = $login;
			} else {
				$this->login = null;
			}
		}

		public function getPass() {
			return $this->pass;
		}
		public function setPass($pass) {
			if(isset($pass) && !empty($pass)) {
				$this->pass = $pass;
			} else {
				$this->pass = null;
			}
		}

		public function getName() {
			return $this->name;
		}
		public function setName($name) {
			if(isset($name) && !empty($name)) {
				$this->name = $name;
			} else {
				$this->name = null;
			}
		}

		public function getProfile() {
			return $this->profile;
		}
		public function setProfile($profile) {
			if(isset($profile) && !empty($profile)) {
				$this->profile = $profile;
			} else {
				$this->profile = null;
			}
		}

		public function toArray() {
			return [
				'id' => $this->id,
				'login' => $this->login,
				'name' => $this->name,
				'profile' => $this->profile
			];
		}

	}
?>