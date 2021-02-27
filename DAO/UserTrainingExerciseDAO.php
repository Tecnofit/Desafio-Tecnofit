<?php
	require_once PATH_PROJECT . "DAO/DataBase.php";

	class UserTrainingExerciseDAO extends DataBase
	{

		// buscar os exercicios referentes ao treino do usuário
		public static function getUserTrainingExercise($userTrainingExercise) {
			try {
				$pdo = parent::connect();
				$query = $pdo->prepare("
					SELECT
						e.id AS id_exercise, e.name, te.`session`, ute.executed_session, ute.status
					FROM exercise e
					JOIN training_exercise te ON te.id_exercise = e.id
					JOIN user_training ut ON ut.id_training = te.id_training
					LEFT JOIN user_training_exercise ute ON ute.id_user = ut.id_user AND ute.id_training = ut.id_training AND ute.id_exercise = te.id_exercise
					WHERE ut.id_user = :id_user
					AND ut.id_training = :id_training
				");

				$id_user = $userTrainingExercise->getIdUser();
				$id_training = $userTrainingExercise->getIdTraining();
				$query->bindParam(':id_user', $id_user, PDO::PARAM_INT);
				$query->bindParam(':id_training', $id_training, PDO::PARAM_INT);

				$query->execute();
				$result = $query->fetchAll();

				return $result;
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		// buscar os dados da sessão de treino do usuario
		public static function getSessionByUserTraining($userTrainingExercise) {
			try {
				$pdo = parent::connect();
				$query = $pdo->prepare("
					SELECT
						e.id AS id_exercise, e.name, te.session, ute.id, ute.executed_session
					FROM exercise e
					JOIN training_exercise te ON te.id_exercise = e.id
					JOIN user_training ut ON ut.id_training = te.id_training
					LEFT JOIN user_training_exercise ute ON ute.id_user = ut.id_user AND ute.id_training = ut.id_training AND ute.id_exercise = te.id_exercise
					WHERE ut.id_user = :id_user
					AND ut.id_training = :id_training
					AND te.id_exercise = :id_exercise
					;
				");

				$id_user = $userTrainingExercise->getIdUser();
				$id_training = $userTrainingExercise->getIdTraining();
				$id_exercise = $userTrainingExercise->getIdExercise();
				$query->bindParam(':id_user', $id_user, PDO::PARAM_INT);
				$query->bindParam(':id_training', $id_training, PDO::PARAM_INT);
				$query->bindParam(':id_exercise', $id_exercise, PDO::PARAM_INT);

				$query->execute();
				$result = $query->fetch();

				return $result;
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		// salvar uma sessão de treino do usuário
		public static function insertSessionByUserTraining($userTrainingExercise) {
			try {
				$pdo = parent::connect();
				$query = $pdo->prepare("
					INSERT INTO user_training_exercise (id_user, id_training, id_exercise, executed_session, status)
					VALUES (:id_user, :id_training, :id_exercise, :executed_session, :status)
				");

				$id_user = $userTrainingExercise->getIdUser();
				$id_training = $userTrainingExercise->getIdTraining();
				$id_exercise = $userTrainingExercise->getIdExercise();
				$executed_session = $userTrainingExercise->getExecutedSession();
				$status = $userTrainingExercise->getStatus();

				$query->bindParam(':id_user', $id_user, PDO::PARAM_INT);
				$query->bindParam(':id_training', $id_training, PDO::PARAM_INT);
				$query->bindParam(':id_exercise', $id_exercise, PDO::PARAM_INT);
				$query->bindParam(':executed_session', $executed_session, PDO::PARAM_INT);
				$query->bindParam(':status', $status, PDO::PARAM_STR);

				$result = $query->execute();

				return $result;
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		// atualizar uma sessão de treino do usuário
		public static function updateSessionByUserTraining($userTrainingExercise) {
			try {
				$pdo = parent::connect();
				$query = $pdo->prepare("
					UPDATE user_training_exercise
					SET executed_session = :executed_session,
						status = :status
					WHERE id_user = :id_user
						AND id_training = :id_training
						AND id_exercise = :id_exercise
				");

				$id_user = $userTrainingExercise->getIdUser();
				$id_training = $userTrainingExercise->getIdTraining();
				$id_exercise = $userTrainingExercise->getIdExercise();
				$executed_session = $userTrainingExercise->getExecutedSession();
				$status = $userTrainingExercise->getStatus();

				$query->bindParam(':id_user', $id_user, PDO::PARAM_INT);
				$query->bindParam(':id_training', $id_training, PDO::PARAM_INT);
				$query->bindParam(':id_exercise', $id_exercise, PDO::PARAM_INT);
				$query->bindParam(':executed_session', $executed_session, PDO::PARAM_INT);
				$query->bindParam(':status', $status, PDO::PARAM_STR);

				$result = $query->execute();

				return $result;
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

	}
?>