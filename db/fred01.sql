-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 08-Fev-2021 às 18:12
-- Versão do servidor: 10.4.17-MariaDB
-- versão do PHP: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `fred01`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `ativo` int(1) NOT NULL DEFAULT 1,
  `dtCria` datetime NOT NULL DEFAULT current_timestamp(),
  `dtAcao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`id`, `nome`, `ativo`, `dtCria`, `dtAcao`) VALUES
(11, 'Fred Tamashiro', 1, '2021-02-07 14:22:03', '2021-02-08 13:32:17'),
(12, 'Gehard Berger', 1, '2021-02-07 17:01:41', '2021-02-08 13:12:19'),
(14, 'teste', 0, '2021-02-07 17:54:25', '2021-02-07 17:56:26'),
(15, 'Fulano', 0, '2021-02-07 18:48:51', '2021-02-07 18:49:23'),
(16, 'aaaaa', 0, '2021-02-07 18:53:26', '2021-02-07 19:01:31'),
(17, 'Jean Alesi', 1, '2021-02-08 13:08:40', '2021-02-08 13:26:17'),
(18, 'Nico Rosberg', 1, '2021-02-08 13:32:30', '2021-02-08 14:06:46');

-- --------------------------------------------------------

--
-- Estrutura da tabela `exercicio`
--

CREATE TABLE `exercicio` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `ativo` int(1) NOT NULL DEFAULT 1,
  `dtCria` datetime NOT NULL DEFAULT current_timestamp(),
  `dtAcao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `exercicio`
--

INSERT INTO `exercicio` (`id`, `nome`, `ativo`, `dtCria`, `dtAcao`) VALUES
(1, 'Abdominal', 1, '2021-02-06 12:22:01', '2021-02-06 15:40:27'),
(2, 'Bicicleta', 1, '2021-02-06 13:44:09', '2021-02-06 17:11:11'),
(3, 'Prancha', 1, '2021-02-06 13:46:47', '2021-02-06 17:05:51'),
(4, 'Triceps', 1, '2021-02-06 18:11:31', NULL),
(5, 'Esteira', 1, '2021-02-06 18:12:14', NULL),
(6, 'Bíceps', 1, '2021-02-06 18:12:48', NULL),
(7, 'Burpees', 1, '2021-02-06 18:14:07', NULL),
(8, 'Elevação Lateral', 1, '2021-02-06 18:14:49', NULL),
(9, 'Ondulação com corda naval', 1, '2021-02-06 18:15:50', NULL),
(10, 'Corda', 1, '2021-02-07 18:16:04', NULL),
(11, 'Corrida 10min', 0, '2021-02-08 14:07:51', '2021-02-08 14:08:16');

-- --------------------------------------------------------

--
-- Estrutura da tabela `treino`
--

CREATE TABLE `treino` (
  `id` int(11) NOT NULL,
  `idAluno` int(11) NOT NULL,
  `idExercicio` int(11) NOT NULL,
  `sessoes` int(2) NOT NULL DEFAULT 0,
  `finalizado` int(1) NOT NULL DEFAULT 0,
  `dtCria` datetime NOT NULL DEFAULT current_timestamp(),
  `dtAcao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `treino`
--

INSERT INTO `treino` (`id`, `idAluno`, `idExercicio`, `sessoes`, `finalizado`, `dtCria`, `dtAcao`) VALUES
(13, 11, 1, 4, 0, '2021-02-07 14:22:03', '2021-02-08 13:32:17'),
(14, 11, 5, 4, 2, '2021-02-07 14:22:03', '2021-02-07 18:44:09'),
(17, 12, 5, 3, 0, '2021-02-07 17:01:42', '2021-02-08 14:07:02'),
(18, 12, 4, 4, 0, '2021-02-07 17:37:41', '2021-02-08 13:12:19'),
(19, 12, 1, 2, 0, '2021-02-07 17:53:43', '2021-02-08 13:12:19'),
(20, 12, 6, 0, 1, '2021-02-07 17:53:43', '2021-02-08 12:01:42'),
(28, 11, 6, 1, 0, '2021-02-07 18:41:32', '2021-02-08 13:32:17'),
(29, 11, 2, 3, 0, '2021-02-07 18:44:09', '2021-02-08 13:32:18'),
(30, 15, 4, 1, 2, '2021-02-07 18:48:51', '2021-02-07 18:49:10'),
(31, 15, 3, 3, 0, '2021-02-07 18:49:10', NULL),
(32, 16, 3, 2, 0, '2021-02-07 18:53:27', NULL),
(33, 12, 6, 5, 2, '2021-02-08 12:22:05', '2021-02-08 12:22:41'),
(34, 17, 1, 2, 2, '2021-02-08 13:08:41', '2021-02-08 13:17:43'),
(35, 17, 5, 4, 2, '2021-02-08 13:08:41', '2021-02-08 13:18:11'),
(36, 17, 4, 4, 2, '2021-02-08 13:08:41', '2021-02-08 13:18:11'),
(37, 17, 7, 4, 0, '2021-02-08 13:17:42', '2021-02-08 13:26:28'),
(38, 17, 4, 9, 0, '2021-02-08 13:26:17', '2021-02-08 13:26:26');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `exercicio`
--
ALTER TABLE `exercicio`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `treino`
--
ALTER TABLE `treino`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idExercicio` (`idExercicio`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aluno`
--
ALTER TABLE `aluno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `exercicio`
--
ALTER TABLE `exercicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `treino`
--
ALTER TABLE `treino`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
