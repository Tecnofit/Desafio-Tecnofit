<?php
	require_once PATH_PROJECT . "Models/Training.php";
	require_once PATH_PROJECT . "Models/TrainingExercise.php";
	require_once PATH_PROJECT . "DAO/TrainingDAO.php";
	require_once PATH_PROJECT . "DAO/TrainingExerciseDAO.php";

	class TrainingServices
	{

		public static function getTrainings() {
			try {
				return TrainingDAO::getTrainings();
			} catch (Exception $e) {

			}
		}

		public static function saveTraining($request) {
			try {
				if(!isset($request["name"]) || empty($request["name"])) {
					throw new Exception("training.name-empty");
				}

				$training = new Training();
				$training->setId($request["id"]);
				$training->setName($request["name"]);

				// verificação foi passado id para fazer update
				if(isset($request["id"]) && !empty($request["id"])) {
					return TrainingDAO::updateTraining($training);
				} else {
					// treino novo, inserir
					return TrainingDAO::insertTraining($training);
				}

			} catch (Exception $e) {
				return $e->getMessage();
			}
		}

		public static function saveTrainingExercise($request) {
			try {

				$trainingExercise = new TrainingExercise();
				$trainingExercise->setId($request["id"]);
				$trainingExercise->setIdTraining($request["id_training"]);
				$trainingExercise->setIdExercise($request["id_exercise"]);
				$trainingExercise->setSession($request["session"]);

				// verificação foi passado id para fazer update
				if(isset($request["id"]) && !empty($request["id"])) {
					return TrainingExerciseDAO::insertTrainingExercise($trainingExercise);
				} else {
					// treino novo, inserir
					return TrainingExerciseDAO::insertTrainingExercise($trainingExercise);
				}

			} catch (Exception $e) {
				return $e->getMessage();
			}
		}

		public static function deleteTrainingExercise($request) {
			try {

				$trainingExercise = new TrainingExercise();
				$trainingExercise->setId($request["id"]);

				if(isset($request["id"]) && !empty($request["id"])) {
					return TrainingExerciseDAO::deleteTrainingExercise($trainingExercise);
				}
				return false;

			} catch (Exception $e) {
				return $e->getMessage();
			}
		}

		public static function getTrainingById($request) {
			try {
				$training = new Training();
				$training->setId($request["id"]);

				// buscar treino por id
				$result = TrainingDAO::getTrainingById($training);
				if($result) {
					$training->setName($result["name"]);
					return $training;
				}

			} catch (Exception $e) {

			}
		}

		public static function getTrainingExerciseById($request) {
			try {
				$training = new Training();
				$training->setId($request["id"]);

				// buscar treino por id
				return TrainingDAO::getTrainingExerciseById($training);


			} catch (Exception $e) {

			}
		}

		public static function getExercisesAvaliableByTraining($request) {
			try {
				$training = new Training();
				$training->setId($request["id"]);

				return TrainingDAO::getExercisesAvaliableByTraining($training);
			} catch (Exception $e) {

			}
		}


		public static function deleteTraining($request) {
			try {

				$training = self::getTrainingById($request);
				if($training) {
					return TrainingDAO::deleteTraining($training);
				}

			} catch (Exception $e) {
				return $e->getMessage();
			}
		}
	}
?>
