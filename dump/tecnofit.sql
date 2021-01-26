ALTER DATABASE `tecnofit` CHARSET = utf8 COLLATE = utf8_unicode_ci;

CREATE TABLE `alunos` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB CHARACTER SET=utf8 COLLATE utf8_unicode_ci;;

INSERT INTO `alunos` (`id`, `nome`, `email`) VALUES
(1, 'Bruno','bruno@email.com'),
(2, 'Ronaldo','ronaldo@email.com'),
(3, 'Cristiano','cristiano@email.com');


CREATE TABLE `exercicios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB CHARACTER SET=utf8 COLLATE utf8_unicode_ci;;

INSERT INTO `exercicios` (`id`, `nome`) VALUES
(1, 'Supino declinado com Halteres'),
(2, 'Apoio no solo'),
(3, 'One Arm Row com Halteres'),
(4, 'Agachamentos com Barra'),
(5, 'Agachamentos Livre');


CREATE TABLE `treinos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aluno_id` int (11) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `ativo` TINYINT (1) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB CHARACTER SET=utf8 COLLATE utf8_unicode_ci;

alter table treinos add foreign key(aluno_id) references alunos(id) ON DELETE CASCADE  ON UPDATE CASCADE;


INSERT INTO `treinos` (`id`, `aluno_id`,`descricao`, `ativo`) VALUES
(1, 1, 'Treino Superior 1', 1),
(2, 2, 'Treino Superior 2', 1),
(3, 1, 'Treino Inferior 1', 0),
(4, 3, 'Treino Completo 1 Dia',1);


CREATE TABLE `treino_detalhes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `treino_id` int(11) NOT NULL,
  `exercicio_id` int(11) NOT NULL,
  `series` int(2) NOT NULL,
  `repeticoes` int(4) NOT NULL,
  `status` int(1) DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)

) ENGINE=InnoDB CHARACTER SET=utf8 COLLATE utf8_unicode_ci;;

alter table treino_detalhes add foreign key(treino_id) references treinos(id) ON DELETE CASCADE ON UPDATE CASCADE;
alter table treino_detalhes add foreign key(exercicio_id) references exercicios(id) ON DELETE CASCADE ON UPDATE CASCADE;

INSERT INTO `treino_detalhes` (`id`, `treino_id`, `exercicio_id`, `series`, `repeticoes`) VALUES
(1, 1, 1, 3, 10),
(2, 1, 2, 3, 10),
(3, 1, 3, 3, 10),
(4, 2, 1, 4, 10),
(5, 2, 2, 4, 10),
(6, 2, 3, 4, 15),
(7, 3, 5, 4, 15);

