-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27-Jan-2020 às 00:10
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_ricardo_correa`
--
CREATE DATABASE IF NOT EXISTS `db_ricardo_correa` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `db_ricardo_correa`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_admin`
--
-- Criação: 24-Jan-2020 às 03:09
--

DROP TABLE IF EXISTS `tb_admin`;
CREATE TABLE IF NOT EXISTS `tb_admin` (
  `id_Admin` int(11) NOT NULL,
  `Login` varchar(5) NOT NULL,
  `Senha` varchar(4) NOT NULL,
  PRIMARY KEY (`id_Admin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONAMENTOS PARA TABELAS `tb_admin`:
--

--
-- Truncar tabela antes do insert `tb_admin`
--

TRUNCATE TABLE `tb_admin`;
--
-- Extraindo dados da tabela `tb_admin`
--

INSERT INTO `tb_admin` (`id_Admin`, `Login`, `Senha`) VALUES
(1, 'admin', '0000');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_aluno`
--
-- Criação: 26-Jan-2020 às 20:26
-- Última actualização: 26-Jan-2020 às 23:03
--

DROP TABLE IF EXISTS `tb_aluno`;
CREATE TABLE IF NOT EXISTS `tb_aluno` (
  `Nome` varchar(100) NOT NULL,
  `Senha` varchar(8) NOT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `id_Treino` int(11) DEFAULT NULL,
  `primeiro_acesso` tinyint(1) NOT NULL,
  `id_aluno` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_aluno`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8;

--
-- RELACIONAMENTOS PARA TABELAS `tb_aluno`:
--

--
-- Truncar tabela antes do insert `tb_aluno`
--

TRUNCATE TABLE `tb_aluno`;
--
-- Extraindo dados da tabela `tb_aluno`
--

INSERT INTO `tb_aluno` (`Nome`, `Senha`, `Email`, `id_Treino`, `primeiro_acesso`, `id_aluno`) VALUES
('Bruce Wayne', '1234', 'ceo@waynecorp.com', 19, 1, 78),
('Clark Kent', '1234', 'ckent@planetdiary.com', 18, 1, 79),
('Barry Allen', '1234', 'barry@starlabs.net', 19, 1, 80),
('Slade Wilson', '1234', 'deadstroke@yahoo.com', 18, 1, 81);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_exercicio`
--
-- Criação: 26-Jan-2020 às 02:08
-- Última actualização: 26-Jan-2020 às 22:58
--

DROP TABLE IF EXISTS `tb_exercicio`;
CREATE TABLE IF NOT EXISTS `tb_exercicio` (
  `Nome` varchar(200) NOT NULL,
  `Ativo` tinyint(1) NOT NULL,
  `id_exercicio` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_exercicio`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- RELACIONAMENTOS PARA TABELAS `tb_exercicio`:
--

--
-- Truncar tabela antes do insert `tb_exercicio`
--

TRUNCATE TABLE `tb_exercicio`;
--
-- Extraindo dados da tabela `tb_exercicio`
--

INSERT INTO `tb_exercicio` (`Nome`, `Ativo`, `id_exercicio`) VALUES
('Polichinelo', 1, 17),
('Scott', 1, 18),
('Pular corda (minutos)', 1, 19),
('Rosca direta', 1, 20);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_exercicios_executados`
--
-- Criação: 26-Jan-2020 às 18:58
-- Última actualização: 26-Jan-2020 às 23:06
--

DROP TABLE IF EXISTS `tb_exercicios_executados`;
CREATE TABLE IF NOT EXISTS `tb_exercicios_executados` (
  `id_Aluno` int(11) NOT NULL,
  `dt_DataHora` datetime NOT NULL,
  `id_Treino` int(11) NOT NULL,
  `id_Exercicio` int(11) NOT NULL,
  `Realizou` tinyint(1) NOT NULL,
  `id_Historico` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_Historico`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- RELACIONAMENTOS PARA TABELAS `tb_exercicios_executados`:
--

--
-- Truncar tabela antes do insert `tb_exercicios_executados`
--

TRUNCATE TABLE `tb_exercicios_executados`;
--
-- Extraindo dados da tabela `tb_exercicios_executados`
--

INSERT INTO `tb_exercicios_executados` (`id_Aluno`, `dt_DataHora`, `id_Treino`, `id_Exercicio`, `Realizou`, `id_Historico`) VALUES
(80, '2020-01-26 20:04:34', 19, 18, 1, 8),
(80, '2020-01-26 20:04:34', 19, 20, 1, 9),
(80, '2020-01-26 20:04:46', 19, 18, 1, 10),
(80, '2020-01-26 20:04:46', 19, 20, 0, 11),
(78, '2020-01-26 20:05:25', 19, 18, 0, 12),
(78, '2020-01-26 20:05:25', 19, 20, 1, 13),
(78, '2020-01-26 20:05:31', 19, 18, 0, 14),
(78, '2020-01-26 20:05:31', 19, 20, 1, 15),
(78, '2020-01-26 20:05:49', 19, 18, 0, 16),
(78, '2020-01-26 20:05:49', 19, 20, 1, 17),
(81, '2020-01-26 20:06:29', 18, 17, 1, 18),
(81, '2020-01-26 20:06:29', 18, 18, 0, 19);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_treino`
--
-- Criação: 26-Jan-2020 às 21:06
-- Última actualização: 26-Jan-2020 às 22:59
--

DROP TABLE IF EXISTS `tb_treino`;
CREATE TABLE IF NOT EXISTS `tb_treino` (
  `Nome` varchar(100) NOT NULL,
  `Ativo` tinyint(1) NOT NULL,
  `Series` int(11) NOT NULL,
  `id_treino` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_treino`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- RELACIONAMENTOS PARA TABELAS `tb_treino`:
--

--
-- Truncar tabela antes do insert `tb_treino`
--

TRUNCATE TABLE `tb_treino`;
--
-- Extraindo dados da tabela `tb_treino`
--

INSERT INTO `tb_treino` (`Nome`, `Ativo`, `Series`, `id_treino`) VALUES
('Emagrecimento', 0, 5, 18),
('Hipertrofia', 0, 7, 19);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_treino_exercicio`
--
-- Criação: 24-Jan-2020 às 03:09
-- Última actualização: 26-Jan-2020 às 23:00
--

DROP TABLE IF EXISTS `tb_treino_exercicio`;
CREATE TABLE IF NOT EXISTS `tb_treino_exercicio` (
  `id_Treino` int(11) NOT NULL,
  `id_Exercicio` int(11) NOT NULL,
  `NumRepeticoes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONAMENTOS PARA TABELAS `tb_treino_exercicio`:
--

--
-- Truncar tabela antes do insert `tb_treino_exercicio`
--

TRUNCATE TABLE `tb_treino_exercicio`;
--
-- Extraindo dados da tabela `tb_treino_exercicio`
--

INSERT INTO `tb_treino_exercicio` (`id_Treino`, `id_Exercicio`, `NumRepeticoes`) VALUES
(18, 17, 50),
(18, 18, 10),
(19, 18, 15),
(19, 20, 10);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
