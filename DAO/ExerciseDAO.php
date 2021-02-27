<?php
	require_once PATH_PROJECT . "DAO/DataBase.php";

	class ExerciseDAO extends DataBase
	{

		// buscar a listagem de exercicios
		public static function getExercises() {
			try {
				$pdo = parent::connect();

				$query = $pdo->prepare("
					SELECT id, name,
						(SELECT COUNT(1) FROM training_exercise AS te WHERE te.id_exercise = e.id) AS total_training
					FROM exercise AS e
					"
				);

				$query->execute();
				$result = $query->fetchAll();

				return $result;
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		// Buscar exercicio pelo id
		public static function getExerciseById($user) {
			try {
				$pdo = parent::connect();

				$query = $pdo->prepare("
					SELECT id, name
					FROM exercise
					WHERE id = :id
					LIMIT 1"
				);

				$id = $user->getId();
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

		// Buscar exercicio pelo id em algum treino ativo
		public static function existExerciseTrainingActive($user) {
			try {
				$pdo = parent::connect();

				$query = $pdo->prepare("
					SELECT count(1) AS exist
					FROM exercise e
					JOIN training_exercise te on te.id_exercise = e.id
					JOIN user_training ut ON ut.id_training = te.id_training
					WHERE e.id = :id
					AND active IS TRUE
				");

				$id = $user->getId();
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

		// Salvar exercicio na base
		public static function insertExercise($exercise) {
			try {
				$pdo = parent::connect();
				$query = $pdo->prepare("
					INSERT INTO exercise (name)
					VALUES (:name)
				");

				$name = $exercise->getName();
				$query->bindParam(':name', $name, PDO::PARAM_STR);

				$result = $query->execute();

				return $result;
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		// Atualizar exercicio na base
		public static function updateExercise($exercise) {
			try {
				$pdo = parent::connect();
				$query = $pdo->prepare("
					UPDATE
						exercise
					SET
						name = :name
					WHERE
						id = :id
				");

				$name = $exercise->getName();
				$id = $exercise->getId();
				$query->bindParam(':name', $name, PDO::PARAM_STR);
				$query->bindParam(':id', $id, PDO::PARAM_STR);

				$result = $query->execute();

				return $result;
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		// Remove exercicio da base
		public static function deleteExercise($exercise) {
			try {
				$pdo = parent::connect();
				$query = $pdo->prepare("
					DELETE FROM
						exercise
					WHERE
						id = :id
				");

				$id = $exercise->getId();
				$query->bindParam(':id', $id, PDO::PARAM_STR);

				$result = $query->execute();

				return $result;
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}


	}
?>