<?php

	class Training
	{
		private $id;
		private $name;

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

		public function toArray() {
			return [
				'id' => $this->id,
				'name' => $this->name
			];
		}

	}
?>