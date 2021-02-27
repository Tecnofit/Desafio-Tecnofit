<?php

	class Configs
	{
		private static $configs;

		// mapeamento das configuraçãoes de acordo com o arquivo .config, da raiz do projeto
		public static function mapConfigs() {
			self::$configs = array();

			$configFile = fopen(".config", "r");

			while(!feof($configFile)) {
				$config = explode("=", fgets($configFile));
				self::$configs[trim($config[0])] = trim($config[1]);
			}
			fclose($configFile);
		}

		public static function getConfig($configTag) {
			return self::$configs[$configTag];
		}
	}
?>