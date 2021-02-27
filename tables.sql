CREATE TABLE `user` (
	id INTEGER auto_increment NOT NULL PRIMARY KEY,
	login VARCHAR(100) NOT NULL,
	pass VARCHAR(255) NOT NULL,
	name VARCHAR(150) NOT NULL,
	profile ENUM('ADMIN', 'ATHLETE') NOT NULL
);

INSERT INTO `user` (login, pass, name, profile)
VALUES ('admin', md5('pass'), 'Administrador', 'ADMIN');


CREATE TABLE `training` (
	id INTEGER auto_increment NOT NULL PRIMARY KEY,
	name VARCHAR(150) NOT NULL
);

CREATE TABLE `exercise` (
	id INTEGER auto_increment NOT NULL PRIMARY KEY,
	name VARCHAR(150) NOT NULL
);


CREATE TABLE `training_exercise` (
	id INTEGER auto_increment NOT NULL PRIMARY KEY,
	id_training INTEGER NOT NULL,
	id_exercise INTEGER NOT NULL,
	session INTEGER NOT NULL,

	FOREIGN KEY (id_training) REFERENCES training(id) ON DELETE CASCADE,
	FOREIGN KEY (id_exercise) REFERENCES exercise(id) ON DELETE CASCADE
);

CREATE TABLE `user_training` (
	id INTEGER auto_increment NOT NULL PRIMARY KEY,
	id_user INTEGER NOT NULL,
	id_training INTEGER NOT NULL,
	active BOOLEAN NOT NULL DEFAULT false,

	FOREIGN KEY (id_user) REFERENCES user(id) ON DELETE CASCADE,
	FOREIGN KEY (id_training) REFERENCES training(id) ON DELETE CASCADE
);


-- CREATE TABLE `user_training_exercise` (
-- 	id INTEGER auto_increment NOT NULL PRIMARY KEY,
-- 	id_user INTEGER NOT NULL,
-- 	id_training_exercise INTEGER NOT NULL,
-- 	executed_session INTEGER NOT NULL DEFAULT 0,
-- 	status ENUM('COMPLETED', 'SKIPPED') NOT NULL,

-- 	FOREIGN KEY (id_user) REFERENCES user(id) ON DELETE CASCADE,
-- 	FOREIGN KEY (id_training_exercise) REFERENCES training_exercise(id) ON DELETE CASCADE
-- );



-- CREATE TABLE `user_training_exercise` (
-- 	id INTEGER auto_increment NOT NULL PRIMARY KEY,
-- 	id_user INTEGER NOT NULL,
-- 	id_training INTEGER NOT NULL,
-- 	id_exercise INTEGER NOT NULL,
-- 	status ENUM('COMPLETED', 'SKIPPED') NOT NULL,

-- 	FOREIGN KEY (id_user) REFERENCES user(id) ON DELETE CASCADE,
-- 	FOREIGN KEY (id_training) REFERENCES training(id) ON DELETE CASCADE,
-- 	FOREIGN KEY (id_exercise) REFERENCES exercise(id) ON DELETE CASCADE
-- );


CREATE TABLE `user_training_exercise` (
	id INTEGER auto_increment NOT NULL PRIMARY KEY,
	id_user INTEGER NOT NULL,
	id_training INTEGER NOT NULL,
	id_exercise INTEGER NOT NULL,
	executed_session INTEGER NOT NULL,
	status ENUM('INPROGRESS', 'COMPLETED', 'SKIPPED') NOT NULL,

	FOREIGN KEY (id_user) REFERENCES user(id) ON DELETE CASCADE,
	FOREIGN KEY (id_training) REFERENCES training(id) ON DELETE CASCADE,
	FOREIGN KEY (id_exercise) REFERENCES exercise(id) ON DELETE CASCADE
);