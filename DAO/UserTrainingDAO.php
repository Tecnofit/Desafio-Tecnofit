<?php
	require_once PATH_PROJECT . "DAO/DataBase.php";

	class UserTrainingDAO extends DataBase
	{
		// Buscar treinos vinculado ao usuário
		public static function getTrainingsByUser($user) {
			try {
				$pdo = parent::connect();

				$query = $pdo->prepare("
					SELECT
						ut.id, t.name, ut.active, t.id AS id_training,
						(SELECT COUNT(1) FROM training_exercise AS te WHERE te.id_training = t.id) AS total_exercise,
						(SELECT SUM(session) FROM training_exercise AS te WHERE te.id_training = t.id) AS total_session
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

		// Remove treino do usuário
		public static function deleteUserTraining($userTraining) {
			try {
				$pdo = parent::connect();
				$query = $pdo->prepare("
					DELETE FROM
						user_training
					WHERE
						id = :id
				");

				$id = $userTraining->getId();
				$query->bindParam(':id', $id, PDO::PARAM_INT);

				$result = $query->execute();

				return $result;
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		// Desativar treinos do usuário
		public static function disableAllUserTraining($userTraining) {
			try {
				$pdo = parent::connect();
				$query = $pdo->prepare("
					UPDATE
						user_training
					SET
						active = false
					WHERE id_user = :id_user
				");

				$id_user = $userTraining->getIdUser();
				$query->bindParam(':id_user', $id_user, PDO::PARAM_INT);

				$result = $query->execute();

				return $result;
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		// Ativar treino do usuário
		public static function playUserTraining($userTraining) {
			try {
				$pdo = parent::connect();
				$query = $pdo->prepare("
					UPDATE
						user_training
					SET
						active = true
					WHERE
						id = :id
						AND id_user = :id_user
				");

				$id = $userTraining->getId();
				$id_user = $userTraining->getIdUser();
				$query->bindParam(':id', $id, PDO::PARAM_INT);
				$query->bindParam(':id_user', $id_user, PDO::PARAM_INT);

				$result = $query->execute();

				return $result;
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		// buscar treino ativo do usuário
		public static function getUserTrainingActive($userTraining) {
			try {
				$pdo = parent::connect();
				$query = $pdo->prepare("
					SELECT
						ut.id, ut.id_user, t.name, ut.active, t.id AS id_training,
						(SELECT COUNT(1) FROM training_exercise AS te WHERE te.id_training = t.id) AS total_exercise,
						(SELECT SUM(session) FROM training_exercise AS te WHERE te.id_training = t.id) AS total_session
					FROM training AS t
					JOIN user_training AS ut ON ut.id_training = t.id
					WHERE ut.id_user = :id_user
					AND active IS TRUE
				");

				$id_user = $userTraining->getIdUser();
				$query->bindParam(':id_user', $id_user, PDO::PARAM_INT);

				$query->execute();
				$result = $query->fetch();

				return $result;
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

	}
?>