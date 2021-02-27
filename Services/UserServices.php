<?php
	require_once PATH_PROJECT . "Models/User.php";
	require_once PATH_PROJECT . "Models/UserTraining.php";
	require_once PATH_PROJECT . "Models/UserTrainingExercise.php";
	require_once PATH_PROJECT . "DAO/UserDAO.php";
	require_once PATH_PROJECT . "DAO/UserTrainingDAO.php";
	require_once PATH_PROJECT . "DAO/UserTrainingExerciseDAO.php";

	class UserServices
	{

		public static function checkLogin($request) {
			try {
				if(!isset($request["login"]) || empty($request["login"])) {
					throw new Exception("login.login-empty");
				}
				if(!isset($request["pass"]) || empty($request["pass"])) {
					throw new Exception("login.user-empty");
				}

				$user = new User();
				$user->setLogin($request["login"]);
				$user->setPass($request["pass"]);

				$isValid = UserDAO::exists($user);
				if($isValid) {
					$user->setPass("");
					$user->setId($isValid["id"]);
					$user->setName($isValid["name"]);
					$user->setProfile($isValid["profile"]);

					$_SESSION['user'] = $user->toArray();
					return true;
				}

			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		public static function getUsersByProfile($profile) {
			try {
				return UserDAO::getUsersByProfile($profile);
			} catch (Exception $e) {

			}
		}

		public static function getTrainingsByUser($request) {
			try {
				$user = new User();
				$user->setId($request["id"]);

				// buscar treino pelo usuário
				return UserTrainingDAO::getTrainingsByUser($user);
			} catch (Exception $e) {

			}
		}

		public static function getTrainingsAvaliableByUser($request) {
			try {
				$user = new User();
				$user->setId($request["id"]);

				// buscar treino pelo usuário
				return UserTrainingDAO::getTrainingsAvaliableByUser($user);
			} catch (Exception $e) {

			}
		}

		public static function saveUserTraining($request) {
			try {

				$userTraining = new UserTraining();
				$userTraining->setId($request["id"]);
				$userTraining->setIdUser($request["id_user"]);
				$userTraining->setIdTraining($request["id_training"]);

				// verificação foi passado id para fazer update
				if(isset($request["id"]) && !empty($request["id"])) {
					return UserTrainingDAO::insertUserTraining($userTraining);
				} else {
					// treino novo, inserir
					return UserTrainingDAO::insertUserTraining($userTraining);
				}

			} catch (Exception $e) {
				return $e->getMessage();
			}
		}

		public static function deleteUserTraining($request) {
			try {

				$userTraining = new UserTraining();
				$userTraining->setId($request["id"]);
				$userTraining->setIdUser($request["id_user"]);

				if(isset($request["id"]) && !empty($request["id"])) {
					return UserTrainingDAO::deleteUserTraining($userTraining);
				}
				return false;

			} catch (Exception $e) {
				return $e->getMessage();
			}
		}

		// ativar treino do atleta
		public static function playUserTraining($request) {
			try {

				$userTraining = new UserTraining();
				$userTraining->setId($request["id"]);
				$userTraining->setIdUser($request["id_user"]);

				if(isset($request["id"]) && !empty($request["id"])) {
					UserTrainingDAO::disableAllUserTraining($userTraining);
					return UserTrainingDAO::playUserTraining($userTraining);
				}
				return false;

			} catch (Exception $e) {
				return $e->getMessage();
			}
		}

		public static function getUserTrainingActive($request) {
			try {

				$userTraining = new UserTraining();
				$userTraining->setIdUser($request["id_user"]);

				if(isset($request["id_user"]) && !empty($request["id_user"])) {
					return UserTrainingDAO::getUserTrainingActive($userTraining);
				}
				return false;

			} catch (Exception $e) {
				return $e->getMessage();
			}
		}


		public static function getUserTrainingExercise($request) {
			try {

				$userTrainingExercise = new UserTrainingExercise();
				$userTrainingExercise->setIdUser($request["id_user"]);
				$userTrainingExercise->setIdTraining($request["id_training"]);

				if(isset($request["id_user"]) && !empty($request["id_user"])) {
					return UserTrainingExerciseDAO::getUserTrainingExercise($userTrainingExercise);
				}
				return false;

			} catch (Exception $e) {
				return $e->getMessage();
			}
		}

		public static function finishSession($request) {
			try {

				$userTrainingExercise = new UserTrainingExercise();
				$userTrainingExercise->setIdUser($request["id_user"]);
				$userTrainingExercise->setIdTraining($request["id_training"]);
				$userTrainingExercise->setIdExercise($request["id_exercise"]);

				// verificar dados da sessão do exercicio
				$session = UserTrainingExerciseDAO::getSessionByUserTraining($userTrainingExercise);
				if(!empty($session)) {

					$userTrainingExercise->setExecutedSession(!empty($session["executed_session"]) ? $session["executed_session"] + 1 : 1);
					$userTrainingExercise->setStatus($userTrainingExercise->getExecutedSession() >= $session["session"] ? "COMPLETED" : "INPROGRESS");

					if(empty($session["id"])) {
						// inserir sessão do exercício para o usuário, treino e exercício
						return UserTrainingExerciseDAO::insertSessionByUserTraining($userTrainingExercise);
					} else {
						// inserir sessão do exercício para o usuário, treino e exercício
						return UserTrainingExerciseDAO::updateSessionByUserTraining($userTrainingExercise);
					}
				}

			} catch (Exception $e) {
				return $e->getMessage();
			}
		}

		public static function finishExercise($request) {
			try {

				$userTrainingExercise = new UserTrainingExercise();
				$userTrainingExercise->setIdUser($request["id_user"]);
				$userTrainingExercise->setIdTraining($request["id_training"]);
				$userTrainingExercise->setIdExercise($request["id_exercise"]);

				// verificar dados da sessão do exercicio
				$session = UserTrainingExerciseDAO::getSessionByUserTraining($userTrainingExercise);
				if(!empty($session)) {
					$userTrainingExercise->setExecutedSession($session["session"]);
					$userTrainingExercise->setStatus("COMPLETED");

					if(empty($session["id"])) {
						// inserir sessão do exercício para o usuário, treino e exercício
						return UserTrainingExerciseDAO::insertSessionByUserTraining($userTrainingExercise);
					} else {
						// inserir sessão do exercício para o usuário, treino e exercício
						return UserTrainingExerciseDAO::updateSessionByUserTraining($userTrainingExercise);
					}
				}

			} catch (Exception $e) {
				return $e->getMessage();
			}
		}

		public static function skipExercise($request) {
			try {

				$userTrainingExercise = new UserTrainingExercise();
				$userTrainingExercise->setIdUser($request["id_user"]);
				$userTrainingExercise->setIdTraining($request["id_training"]);
				$userTrainingExercise->setIdExercise($request["id_exercise"]);

				// verificar dados da sessão do exercicio
				$session = UserTrainingExerciseDAO::getSessionByUserTraining($userTrainingExercise);
				if(!empty($session)) {
					$userTrainingExercise->setExecutedSession(!empty($session["executed_session"]) ? $session["executed_session"] : 1);
					$userTrainingExercise->setStatus("SKIPPED");

					if(empty($session["id"])) {
						// inserir sessão do exercício para o usuário, treino e exercício
						return UserTrainingExerciseDAO::insertSessionByUserTraining($userTrainingExercise);
					} else {
						// inserir sessão do exercício para o usuário, treino e exercício
						return UserTrainingExerciseDAO::updateSessionByUserTraining($userTrainingExercise);
					}
				}

			} catch (Exception $e) {
				return $e->getMessage();
			}
		}

		public static function getUserById($request) {
			try {
				$user = new User();
				$user->setId($request["id"]);

				// buscar user por id
				$result = UserDAO::getUserById($user);
				if($result) {
					$user->setLogin($result["login"]);
					$user->setName($result["name"]);
					$user->setProfile($result["profile"]);
					return $user;
				}

			} catch (Exception $e) {

			}
		}

		public static function saveUser($request) {
			try {
				if(!isset($request["login"]) || empty($request["login"])) {
					throw new Exception("login.login-empty");
				}
				if(!isset($request["pass"]) || empty($request["pass"])) {
					throw new Exception("login.pass-empty");
				}
				if(!isset($request["name"]) || empty($request["name"])) {
					throw new Exception("login.name-empty");
				}

				$user = new User();
				$user->setId($request["id"]);
				$user->setLogin($request["login"]);
				$user->setPass($request["pass"]);
				$user->setName($request["name"]);
				$user->setProfile("ATHLETE");

				$exist = UserDAO::getUserByLogin($user);

				// verificação foi passado id para fazer update e se o login novo já não está em uso
				if(isset($request["id"]) && !empty($request["id"]) && ($exist == false || $exist["id"] == $user->getId())) {
					$user->setName($request["name"]);
					return UserDAO::updateUser($user);
				} else if($exist) {
					throw new Exception("Já existe um atleta com este login.");
				} else {
					// usuario novo, inserir
					return UserDAO::insertUser($user);
				}

			} catch (Exception $e) {
				return $e->getMessage();
			}
		}

		public static function deleteUser($request) {
			try {

				$user = self::getUserById($request);
				if($user) {
					return UserDAO::deleteUser($user);
				}

			} catch (Exception $e) {
				return $e->getMessage();
			}
		}
	}
?>
