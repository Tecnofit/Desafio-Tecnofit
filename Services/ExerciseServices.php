<?php
	require_once PATH_PROJECT . "Models/Exercise.php";
	require_once PATH_PROJECT . "DAO/ExerciseDAO.php";

	class ExerciseServices
	{

		public static function getExercises() {
			try {
				return ExerciseDAO::getExercises();
			} catch (Exception $e) {

			}
		}

		public static function saveExercise($request) {
			try {
				if(!isset($request["name"]) || empty($request["name"])) {
					throw new Exception("exercise.name-empty");
				}

				$exercise = new Exercise();
				$exercise->setId($request["id"]);
				$exercise->setName($request["name"]);

				// verificação foi passado id para fazer update
				if(isset($request["id"]) && !empty($request["id"])) {
					return ExerciseDAO::updateExercise($exercise);
				} else {
					// treino novo, inserir
					return ExerciseDAO::insertExercise($exercise);
				}

			} catch (Exception $e) {
				return $e->getMessage();
			}
		}

		public static function getExerciseById($request) {
			try {
				$exercise = new Exercise();
				$exercise->setId($request["id"]);

				// buscar treino por id
				$result = ExerciseDAO::getExerciseById($exercise);
				if($result) {
					$exercise->setName($result["name"]);
					return $exercise;
				}

			} catch (Exception $e) {

			}
		}

		public static function deleteExercise($request) {
			try {

				$exercise = self::getExerciseById($request);
				if($exercise) {
					return ExerciseDAO::deleteExercise($exercise);
				}

			} catch (Exception $e) {
				return $e->getMessage();
			}
		}
	}
?>
