<?php
	require_once PATH_PROJECT . "DAO/DataBase.php";

	class TrainingExerciseDAO extends DataBase
	{

		// Salvar treino na base
		public static function insertTrainingExercise($trainingExercise) {
			try {
				$pdo = parent::connect();
				$query = $pdo->prepare("
					INSERT INTO training_exercise (id_training, id_exercise, session)
					VALUES (:id_training, :id_exercise, :session)
				");

				$idTraining = $trainingExercise->getIdTraining();
				$idExercise = $trainingExercise->getIdExercise();
				$session = $trainingExercise->getSession();
				$query->bindParam(':id_training', $idTraining, PDO::PARAM_INT);
				$query->bindParam(':id_exercise', $idExercise, PDO::PARAM_INT);
				$query->bindParam(':session', $session, PDO::PARAM_INT);

				$result = $query->execute();

				return $result;
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		// Atualizar treino na base
		public static function updateTrainingExercise($trainingExercise) {
			try {
				$pdo = parent::connect();
				$query = $pdo->prepare("
					UPDATE
						training
					SET
						name = :name
					WHERE
						id = :id
				");

				$name = $trainingExercise->getName();
				$id = $trainingExercise->getId();
				$query->bindParam(':name', $name, PDO::PARAM_INT);
				$query->bindParam(':id', $id, PDO::PARAM_INT);

				$result = $query->execute();

				return $result;
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		// Remove treino da base
		public static function deleteTrainingExercise($trainingExercise) {
			try {
				$pdo = parent::connect();
				$query = $pdo->prepare("
					DELETE FROM
						training
					WHERE
						id = :id
				");

				$id = $trainingExercise->getId();
				$query->bindParam(':id', $id, PDO::PARAM_INT);

				$result = $query->execute();

				return $result;
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}


	}
?>