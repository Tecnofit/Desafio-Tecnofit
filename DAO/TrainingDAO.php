<?php
	require_once PATH_PROJECT . "DAO/DataBase.php";

	class TrainingDAO extends DataBase
	{

		// buscar a listagem de treinos
		public static function getTrainings() {
			try {
				$pdo = parent::connect();

				$query = $pdo->prepare("
					SELECT t.id, t.name,
						(SELECT COUNT(1) FROM training_exercise AS te WHERE te.id_training = t.id) AS total_exercise,
						(SELECT SUM(session) FROM training_exercise AS te WHERE te.id_training = t.id) AS total_session
					FROM training AS t
				");

				$query->execute();
				$result = $query->fetchAll();

				return $result;
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		// Buscar treino pelo id
		public static function getTrainingById($training) {
			try {
				$pdo = parent::connect();

				$query = $pdo->prepare("
					SELECT id, name
					FROM training
					WHERE id = :id
					LIMIT 1"
				);

				$id = $training->getId();
				$query->bindParam(':id', $id, PDO::PARAM_INT);

				$query->execute();
				$result = $query->fetch();

				if(empty($result)) {
					return false;
				} else {

					return $result;
				}
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		// Buscar exercícios vinculado pelo treino
		public static function getTrainingExerciseById($training) {
			try {
				$pdo = parent::connect();

				$query = $pdo->prepare("
					SELECT te.id, e.name, te.session
					FROM training AS t
					JOIN training_exercise AS te ON te.id_training = t.id
					JOIN exercise AS e ON e.id = te.id_exercise
					WHERE t.id = :id"
				);

				$id = $training->getId();
				$query->bindParam(':id', $id, PDO::PARAM_INT);

				$query->execute();
				$result = $query->fetchAll();

				if(empty($result)) {
					return false;
				} else {
					return $result;
				}
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		// buscar a listagem de exercicios que não foram vínculado ao treino
		public static function getExercisesAvaliableByTraining($training) {
			try {
				$pdo = parent::connect();

				$query = $pdo->prepare("
					SELECT *
					FROM exercise AS e
					WHERE e.id NOT IN (
						SELECT te.id_exercise
						FROM training_exercise AS te
						LEFT JOIN training t ON t.id = te.id_training
						WHERE t.id = :id
					)
				");

				$id = $training->getId();
				$query->bindParam(':id', $id, PDO::PARAM_INT);

				$query->execute();
				$result = $query->fetchAll();

				return $result;
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}


		// Salvar treino na base
		public static function insertTraining($training) {
			try {
				$pdo = parent::connect();
				$query = $pdo->prepare("
					INSERT INTO training (name)
					VALUES (:name)
				");

				$name = $training->getName();
				$query->bindParam(':name', $name, PDO::PARAM_STR);

				$result = $query->execute();

				return $result;
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		// Atualizar treino na base
		public static function updateTraining($training) {
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

				$name = $training->getName();
				$id = $training->getId();
				$query->bindParam(':name', $name, PDO::PARAM_STR);
				$query->bindParam(':id', $id, PDO::PARAM_STR);

				$result = $query->execute();

				return $result;
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		// Remove treino da base
		public static function deleteTraining($training) {
			try {
				$pdo = parent::connect();
				$query = $pdo->prepare("
					DELETE FROM
						training
					WHERE
						id = :id
				");

				$id = $training->getId();
				$query->bindParam(':id', $id, PDO::PARAM_STR);

				$result = $query->execute();

				return $result;
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}


	}
?>