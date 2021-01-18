-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 18-Jan-2021 às 19:25
-- Versão do servidor: 10.4.17-MariaDB
-- versão do PHP: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `academia`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `estruturante`
--

CREATE TABLE `estruturante` (
  `estrut_id` int(11) NOT NULL,
  `estrut_descricao` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `estruturante`
--

INSERT INTO `estruturante` (`estrut_id`, `estrut_descricao`) VALUES
(1, 'Treino Ativo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `exercicios`
--

CREATE TABLE `exercicios` (
  `exerci_id` int(11) NOT NULL,
  `exerci_descricao` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `exercicios`
--

INSERT INTO `exercicios` (`exerci_id`, `exerci_descricao`) VALUES
(1, 'Pular Corda'),
(2, 'Jump'),
(3, 'Subir e descer escadas'),
(4, 'Caminhada ou corrida na esteira');

-- --------------------------------------------------------

--
-- Estrutura da tabela `treino_exercicio`
--

CREATE TABLE `treino_exercicio` (
  `treino_exercicio_id` int(11) NOT NULL,
  `treino_exercicio_treino_usuario_id` int(11) NOT NULL,
  `treino_exercicio_exerci_id` int(11) NOT NULL,
  `treino_exercicio_num_sessoes` int(11) NOT NULL,
  `treino_exercicio_status` enum('Finalizado','Pular','Não iniciado') COLLATE utf8_unicode_ci NOT NULL,
  `treino_usuario_id_sessao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `treino_exercicio`
--

INSERT INTO `treino_exercicio` (`treino_exercicio_id`, `treino_exercicio_treino_usuario_id`, `treino_exercicio_exerci_id`, `treino_exercicio_num_sessoes`, `treino_exercicio_status`, `treino_usuario_id_sessao`) VALUES
(1, 1, 6, 3, 'Não iniciado', 21),
(2, 1, 4, 6, 'Não iniciado', 21),
(3, 6, 4, 3, 'Não iniciado', 25),
(8, 8, 4, 2, 'Pular', 25),
(9, 8, 2, 3, 'Não iniciado', 25),
(10, 7, 1, 23, 'Não iniciado', 21);

-- --------------------------------------------------------

--
-- Estrutura da tabela `treino_usuario`
--

CREATE TABLE `treino_usuario` (
  `treino_usuario_id` int(11) NOT NULL,
  `treino_usuario_usuari_id` int(11) NOT NULL,
  `treino_usuario_status` enum('Ativo','Inativo') COLLATE utf8_unicode_ci NOT NULL,
  `treino_usuario_descricao` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `treino_usuario`
--

INSERT INTO `treino_usuario` (`treino_usuario_id`, `treino_usuario_usuari_id`, `treino_usuario_status`, `treino_usuario_descricao`) VALUES
(1, 21, 'Inativo', 'treino 1'),
(2, 21, 'Inativo', 'treino 2  fdsa fdsa fdsaf sda teste '),
(5, 21, 'Inativo', 'treino 3'),
(7, 21, 'Ativo', 'treino ativo'),
(8, 25, 'Ativo', 'treino dddd');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `usuari_id` int(11) NOT NULL,
  `usuari_nome` varchar(255) NOT NULL,
  `usuari_status` int(2) NOT NULL,
  `usuari_email` varchar(255) NOT NULL,
  `usuari_senha` varchar(32) NOT NULL,
  `usuari_tipo` enum('administrador','usuario') NOT NULL,
  `usuari_matricula` varchar(10) NOT NULL,
  `usuari_dt_nascimento` date DEFAULT NULL,
  `usuari_peso` double NOT NULL,
  `usuari_altura` double NOT NULL,
  `usuari_endereco` varchar(255) NOT NULL,
  `usuari_objetivo` enum('Emagrecer','Definição Muscular') NOT NULL,
  `usuari_observacoes` text NOT NULL,
  `usuari_tipo_documento` enum('CPF','RG','Motorista') NOT NULL,
  `usuari_documento` varchar(15) NOT NULL,
  `usuari_celular` varchar(15) NOT NULL,
  `usuari_dt_cadastro` date NOT NULL DEFAULT current_timestamp(),
  `usuari_turno` enum('Manhã','Tarde','Noite','Outros') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`usuari_id`, `usuari_nome`, `usuari_status`, `usuari_email`, `usuari_senha`, `usuari_tipo`, `usuari_matricula`, `usuari_dt_nascimento`, `usuari_peso`, `usuari_altura`, `usuari_endereco`, `usuari_objetivo`, `usuari_observacoes`, `usuari_tipo_documento`, `usuari_documento`, `usuari_celular`, `usuari_dt_cadastro`, `usuari_turno`) VALUES
(24, 'teste da silva', 1, 'teste@teste.com', '25f9e794323b453885f5181f1b624d0b', 'usuario', '123456789', '2020-11-10', 120.3, 1.6, 'Rua teste da silva, esquina com bla ble bli', 'Definição Muscular', 'Testando o observações', 'RG', '1123556', '22236-55550', '2021-01-17', 'Noite'),
(21, 'Cássio Vinícius Leguizamon Bueno', 0, 'fumuca@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'administrador', '235536', '1981-01-08', 92, 1.8, 'rua parnaiba, 232 são francisco curitiba paranásss', 'Definição Muscular', 'dddddddddddddddddddddddddddd\r\nd\r\nf\r\nds afdas fsdafdas fdsa\r\nf sad\r\nf \r\nsda\r\n fsda\r\n', 'CPF', '01234567890', '41999559293', '2021-01-17', 'Noite'),
(25, 'Cris bueno', 0, 'teste2@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'usuario', '1234589', '2021-01-13', 120.3, 200, 'macale do alem , 10 terra', 'Definição Muscular', 'fdasfdsa fdsa fdsa fd', 'CPF', '00692756965', '123', '2021-01-17', 'Tarde');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `estruturante`
--
ALTER TABLE `estruturante`
  ADD PRIMARY KEY (`estrut_id`);

--
-- Índices para tabela `exercicios`
--
ALTER TABLE `exercicios`
  ADD PRIMARY KEY (`exerci_id`);

--
-- Índices para tabela `treino_exercicio`
--
ALTER TABLE `treino_exercicio`
  ADD PRIMARY KEY (`treino_exercicio_id`);

--
-- Índices para tabela `treino_usuario`
--
ALTER TABLE `treino_usuario`
  ADD PRIMARY KEY (`treino_usuario_id`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuari_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `estruturante`
--
ALTER TABLE `estruturante`
  MODIFY `estrut_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `exercicios`
--
ALTER TABLE `exercicios`
  MODIFY `exerci_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `treino_exercicio`
--
ALTER TABLE `treino_exercicio`
  MODIFY `treino_exercicio_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `treino_usuario`
--
ALTER TABLE `treino_usuario`
  MODIFY `treino_usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuari_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
