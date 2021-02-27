<?php
	require_once PATH_PROJECT . "DAO/DataBase.php";

	class UserTrainingDAO extends DataBase
	{
		// Buscar treinos vinculado ao usuário
		public static function getTrainingsByUser($user) {
			try {
				$pdo = parent::connect();

				$query = $pdo->prepare("
					SELECT t.id, t.name, ut.active
					FROM training AS t
					JOIN user_training AS ut ON ut.id_training = t.id
					WHERE ut.id_user = :id"
				);

				$id = $user->getId();
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

		// Buscar treinos disponiveis para vincular ao usuário
		public static function getTrainingsAvaliableByUser($user) {
			try {
				$pdo = parent::connect();

				$query = $pdo->prepare("
					SELECT *
					FROM training AS t
					WHERE t.id NOT IN (
						SELECT ut.id_training
						FROM user_training AS ut
						LEFT JOIN user AS u ON u.id = ut.id_user
						WHERE u.id = :id
					)
				");

				$id = $user->getId();
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

		// vincular treino ao usuário
		public static function insertUserTraining($userTraining) {
			try {
				$pdo = parent::connect();
				$query = $pdo->prepare("
					INSERT INTO user_training (id_user, id_training)
					VALUES (:id_user, :id_training)
				");

				$idUser = $userTraining->getIdUser();
				$idTraining = $userTraining->getIdTraining();
				$query->bindParam(':id_user', $idUser, PDO::PARAM_INT);
				$query->bindParam(':id_training', $idTraining, PDO::PARAM_INT);

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