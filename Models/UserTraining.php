<?php

	class UserTraining
	{
		private $id;
		private $id_user;
		private $id_training;

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

		public function getIdUser() {
			return $this->id_user;
		}
		public function setIdUser($id_user) {
			if(isset($id_user) && !empty($id_user)) {
				$this->id_user = $id_user;
			} else {
				$this->id_user = null;
			}
		}

		public function getIdTraining() {
			return $this->id_training;
		}
		public function setIdTraining($id_training) {
			if(isset($id_training) && !empty($id_training)) {
				$this->id_training = $id_training;
			} else {
				$this->id_training = null;
			}
		}


		public function getd() {
			return $this->d;
		}
		public function setd($d) {
			if(isset($d) && !empty($d)) {
				$this->d = $d;
			} else {
				$this->d = null;
			}
		}

		public function toArray() {
			return [
				'id' => $this->id,
			];
		}

	}
?>