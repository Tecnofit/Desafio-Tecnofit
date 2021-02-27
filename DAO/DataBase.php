<?php

	class DataBase extends PDO
	{

		public static function connect() {
			try {
				$pdo = new PDO("mysql:host=".Configs::getConfig("MYSQL_HOST").";dbname=".Configs::getConfig("MYSQL_DATABASE"), Configs::getConfig("MYSQL_USER"), Configs::getConfig("MYSQL_PASS"));
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
				return $pdo;
			} catch (Exception $e) {
				// falha ao conectar na base
				die($e->getMessage());
			}
		}
	}
?>
