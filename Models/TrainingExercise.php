<?php

	class TrainingExercise
	{
		private $id;
		private $id_training;
		private $id_exercise;
		private $session;

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

		public function getSession() {
			return $this->session;
		}
		public function setSession($session) {
			if(isset($session) && !empty($session)) {
				$this->session = $session;
			} else {
				$this->session = null;
			}
		}

		public function toArray() {
			return [
				'id' => $this->id,
			];
		}

	}
?>