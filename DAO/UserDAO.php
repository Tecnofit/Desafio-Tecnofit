<?php
	require_once PATH_PROJECT . "DAO/DataBase.php";

	class UserDAO extends DataBase
	{
		// Checagem se usuário existe na base
		public static function exists($user) {
			try {
				$pdo = parent::connect();

				$query = $pdo->prepare("
					SELECT id, login, name, profile
					FROM user
					WHERE login = :login
					AND pass = :pass
					LIMIT 1"
				);

				$login = $user->getLogin();
				$pass = $user->getPass();
				$query->bindParam(':login', $login, PDO::PARAM_STR);
				$query->bindParam(':pass', $pass, PDO::PARAM_STR);

				$query->execute();
				$result = $query->fetch();

				if(empty($result)) {
					throw new Exception("login.user-fail");
				} else {
					return $result;
				}
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		// Buscar usuário pelo Id
		public static function getUserById($user) {
			try {
				$pdo = parent::connect();

				$query = $pdo->prepare("
					SELECT id, login, name, profile
					FROM user
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

		// Checagem se usuário existe na base pelo login
		public static function getUserByLogin($user) {
			try {
				$pdo = parent::connect();

				$query = $pdo->prepare("
					SELECT id, login, name, profile
					FROM user
					WHERE login = :login
					LIMIT 1"
				);

				$login = $user->getLogin();
				$query->bindParam(':login', $login, PDO::PARAM_STR);

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

		// Salvar usuário na base
		public static function insertUser($user) {
			try {
				$pdo = parent::connect();
				$query = $pdo->prepare("
					INSERT INTO user (login, pass, name, profile)
					VALUES (:login, :pass, :name, :profile)
				");

				$login = $user->getLogin();
				$pass = $user->getPass();
				$name = $user->getName();
				$profile = $user->getProfile();
				$query->bindParam(':login', $login, PDO::PARAM_STR);
				$query->bindParam(':pass', $pass, PDO::PARAM_STR);
				$query->bindParam(':name', $name, PDO::PARAM_STR);
				$query->bindParam(':profile', $profile, PDO::PARAM_STR);

				$result = $query->execute();

				return $result;
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		// Atualizar usuário na base
		public static function updateUser($user) {
			try {
				$pdo = parent::connect();
				$query = $pdo->prepare("
					UPDATE
						user
					SET
						login = :login,
						name = :name,
						pass = :pass
					WHERE
						id = :id
				");

				$login = $user->getLogin();
				$name = $user->getName();
				$pass = $user->getPass();
				$id = $user->getId();
				$query->bindParam(':login', $login, PDO::PARAM_STR);
				$query->bindParam(':name', $name, PDO::PARAM_STR);
				$query->bindParam(':pass', $pass, PDO::PARAM_STR);
				$query->bindParam(':id', $id, PDO::PARAM_INT);

				$result = $query->execute();

				return $result;
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		// Remove usuário da base
		public static function deleteUser($user) {
			try {
				$pdo = parent::connect();
				$query = $pdo->prepare("
					DELETE FROM
						user
					WHERE
						id = :id
				");

				$id = $user->getId();
				$query->bindParam(':id', $id, PDO::PARAM_STR);

				$result = $query->execute();

				return $result;
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}


		// Busca os usuários de acordo o perfil
		public static function getUsersByProfile($profile) {
			try {
				$pdo = parent::connect();

				$query = $pdo->prepare("
					SELECT u.id, u.login, u.name, u.profile,
						(SELECT COUNT(1) FROM user_training AS ut WHERE ut.id_user = u.id) AS total_training,
						(SELECT t.name FROM user_training AS ut JOIN training AS t ON t.id = ut.id_training WHERE ut.id_user = u.id AND ut.active IS TRUE) AS current
					FROM user AS u
					WHERE profile = :profile
					"
				);

				$query->bindParam(':profile', $profile, PDO::PARAM_STR);

				$query->execute();
				$result = $query->fetchAll();

				return $result;
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

	}
?>