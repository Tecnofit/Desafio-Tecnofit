-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.6-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando estrutura para tabela dbacademia.tb_aluno
CREATE TABLE IF NOT EXISTS `tb_aluno` (
  `id_aluno` int(11) NOT NULL AUTO_INCREMENT,
  `nome_aluno` varchar(45) NOT NULL,
  `idade` int(11) DEFAULT NULL,
  `email_contato` varchar(45) NOT NULL,
  `senha` varchar(200) NOT NULL,
  PRIMARY KEY (`id_aluno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela dbacademia.tb_aluno: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `tb_aluno` DISABLE KEYS */;
INSERT INTO `tb_aluno` (`id_aluno`, `nome_aluno`, `idade`, `email_contato`, `senha`) VALUES
	(1, 'felipe macedo', 33, 'felipe.macedo12@gmail.com', '698dc19d489c4e4db73e28a713eab07b'),
	(37, 'teste', 15, 'teste@teste', '698dc19d489c4e4db73e28a713eab07b');
/*!40000 ALTER TABLE `tb_aluno` ENABLE KEYS */;

-- Copiando estrutura para tabela dbacademia.tb_aluno_exercicio
CREATE TABLE IF NOT EXISTS `tb_aluno_exercicio` (
  `tb_aluno_id_aluno` int(11) NOT NULL,
  `exercicio_id_exercicio` int(11) NOT NULL,
  PRIMARY KEY (`tb_aluno_id_aluno`,`exercicio_id_exercicio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela dbacademia.tb_aluno_exercicio: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `tb_aluno_exercicio` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_aluno_exercicio` ENABLE KEYS */;

-- Copiando estrutura para tabela dbacademia.tb_aluno_treino
CREATE TABLE IF NOT EXISTS `tb_aluno_treino` (
  `tb_aluno_id_aluno` int(11) NOT NULL,
  `treino_id_treino` int(11) NOT NULL,
  PRIMARY KEY (`tb_aluno_id_aluno`,`treino_id_treino`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela dbacademia.tb_aluno_treino: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `tb_aluno_treino` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_aluno_treino` ENABLE KEYS */;

-- Copiando estrutura para tabela dbacademia.tb_exercicio
CREATE TABLE IF NOT EXISTS `tb_exercicio` (
  `id_exercicio` int(11) NOT NULL AUTO_INCREMENT,
  `cod_exercicio` char(4) DEFAULT NULL,
  `nome_exercicio` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_exercicio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela dbacademia.tb_exercicio: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `tb_exercicio` DISABLE KEYS */;
INSERT INTO `tb_exercicio` (`id_exercicio`, `cod_exercicio`, `nome_exercicio`) VALUES
	(1, 'B101', 'ELEVAÇÃO LATERAL'),
	(2, 'C201', 'ELEVAÇÃO FRONTAL'),
	(3, 'D876', 'SALTO FRONTAL'),
	(5, 'D357', 'BURPEE');
/*!40000 ALTER TABLE `tb_exercicio` ENABLE KEYS */;

-- Copiando estrutura para tabela dbacademia.tb_exercicio_tb_treino
CREATE TABLE IF NOT EXISTS `tb_exercicio_tb_treino` (
  `tb_exercicio_id_exercicio` int(11) NOT NULL,
  `tb_treino_id_treino` int(11) NOT NULL,
  PRIMARY KEY (`tb_exercicio_id_exercicio`,`tb_treino_id_treino`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela dbacademia.tb_exercicio_tb_treino: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `tb_exercicio_tb_treino` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_exercicio_tb_treino` ENABLE KEYS */;

-- Copiando estrutura para tabela dbacademia.tb_treino
CREATE TABLE IF NOT EXISTS `tb_treino` (
  `id_treino` int(11) NOT NULL AUTO_INCREMENT,
  `cod_treino` char(5) NOT NULL DEFAULT '0',
  `nome_treino` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_treino`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela dbacademia.tb_treino: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `tb_treino` DISABLE KEYS */;
INSERT INTO `tb_treino` (`id_treino`, `cod_treino`, `nome_treino`) VALUES
	(1, 'A101', 'COSTA'),
	(2, 'A201', 'PERNA'),
	(3, 'A301', 'OMBRO'),
	(5, 'A401', 'BRAÇO'),
	(9, 'A501', 'ABDOMINAL');
/*!40000 ALTER TABLE `tb_treino` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
