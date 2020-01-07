CREATE DATABASE tecnofit;

USE tecnofit;

CREATE TABLE exercicio(
	id INTEGER AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(30)
);

CREATE TABLE treino(
	id INTEGER AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(30)
);

CREATE TABLE usuario(
	id INTEGER AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(30),
	login VARCHAR(30),
	senha VARCHAR(32),
	usuario_treino INTEGER,
	admin boolean,
	FOREIGN KEY(usuario_treino) REFERENCES treino(id)
);

CREATE TABLE treino_exercicio(
	id INTEGER AUTO_INCREMENT PRIMARY KEY,
	id_exercicio INTEGER,
	id_treino INTEGER,
	sessoes INTEGER,
	FOREIGN KEY(id_exercicio) REFERENCES exercicio(id),
	FOREIGN KEY(id_treino) REFERENCES treino(id)
);

CREATE TABLE treino_usuario(
	id INTEGER AUTO_INCREMENT PRIMARY KEY,
	usuario_id INTEGER,
	status INTEGER,
	id_treino_exercicio INTEGER,
	FOREIGN KEY(usuario_id) REFERENCES usuario(id),
	FOREIGN KEY(id_treino_exercicio) REFERENCES treino_exercicio(id)
);

CREATE TABLE status_nome(
	id INTEGER AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(30)
);

INSERT INTO usuario(nome, login, senha, admin) VALUES ('admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', true);

INSERT INTO usuario(nome, login, senha, admin) VALUES ('Nome Sobrenome 1', 'login1', '21232f297a57a5a743894a0e4a801fc3', false);
INSERT INTO usuario(nome, login, senha, admin) VALUES ('Nome Sobrenome 2', 'login2', '21232f297a57a5a743894a0e4a801fc3', false);
INSERT INTO usuario(nome, login, senha, admin) VALUES ('Nome Sobrenome 3', 'login3', '21232f297a57a5a743894a0e4a801fc3', false);


INSERT INTO exercicio(nome) VALUES ('Supino Reto');
INSERT INTO exercicio(nome) VALUES ('Elevação Frontal');
INSERT INTO exercicio(nome) VALUES ('Cadeira Extensora');
INSERT INTO exercicio(nome) VALUES ('Leg Press Inclinado');

INSERT INTO treino(nome) VALUES ('Treino A');
INSERT INTO treino(nome) VALUES ('Treino B');

INSERT INTO status_nome(id, nome) VALUES (1, 'Pendente');
INSERT INTO status_nome(id, nome) VALUES (2, 'Ativo');
INSERT INTO status_nome(id, nome) VALUES (3, 'Finalizado');
INSERT INTO status_nome(id, nome) VALUES (4, 'Pulou');