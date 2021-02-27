<?php

	class UserTrainingExercise
	{
		private $id;
		private $id_user;
		private $id_training;
		private $id_exercise;
		private $executed_session;
		private $status;

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

		public function getIdExercise() {
			return $this->id_exercise;
		}
		public function setIdExercise($id_exercise) {
			if(isset($id_exercise) && !empty($id_exercise)) {
				$this->id_exercise = $id_exercise;
			} else {
				$this->id_exercise = null;
			}
		}

		public function getExecutedSession() {
			return $this->executed_session;
		}
		public function setExecutedSession($executed_session) {
			if(isset($executed_session) && !empty($executed_session)) {
				$this->executed_session = $executed_session;
			} else {
				$this->executed_session = null;
			}
		}

		public function getStatus() {
			return $this->status;
		}
		public function setStatus($status) {
			if(isset($status) && !empty($status)) {
				$this->status = $status;
			} else {
				$this->status = null;
			}
		}

		public function toArray() {
			return [
				'id' => $this->id,
			];
		}

	}
?>