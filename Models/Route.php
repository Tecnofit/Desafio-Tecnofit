<?php

	class Route
	{
		private $type;
		private $controller;
		private $action;
		private $name;
		private $profile;

		public function __construct($type, $controller, $action, $name, $profile = []) {

			$this->type = $type;
			$this->controller = $controller;
			$this->action = $action;
			$this->name = $name;
			$this->profile = $profile;

			return $this;
		}

		public function getType() {
			return $this->type;
		}
		public function getController() {
			return $this->controller;
		}
		public function getAction() {
			return $this->action;
		}
		public function getName() {
			return $this->name;
		}
		public function getProfile() {
			return $this->profile;
		}
	}
?>