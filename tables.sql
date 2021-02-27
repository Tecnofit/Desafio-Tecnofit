CREATE TABLE tecnofit.`user` (
	id INTEGER auto_increment NOT NULL PRIMARY KEY,
	login VARCHAR(100) NOT NULL,
	pass VARCHAR(255) NOT NULL,
	name VARCHAR(150) NOT NULL,
	profile ENUM('ADMIN', 'ATHLETE') NOT NULL
)


CREATE TABLE tecnofit.`training` (
	id INTEGER auto_increment NOT NULL PRIMARY KEY,
	name VARCHAR(150) NOT NULL
)

CREATE TABLE tecnofit.`exercise` (
	id INTEGER auto_increment NOT NULL PRIMARY KEY,
	name VARCHAR(150) NOT NULL
)


CREATE TABLE tecnofit.`training_exercise` (
	id INTEGER auto_increment NOT NULL PRIMARY KEY,
	id_training INTEGER NOT NULL,
	id_exercise INTEGER NOT NULL,
	session INTEGER NOT NULL,

	FOREIGN KEY (id_training) REFERENCES training(id) ON DELETE CASCADE,
	FOREIGN KEY (id_exercise) REFERENCES exercise(id) ON DELETE CASCADE
)

CREATE TABLE tecnofit.`user_training` (
	id INTEGER auto_increment NOT NULL PRIMARY KEY,
	id_user INTEGER NOT NULL,
	id_training INTEGER NOT NULL,
	active BOOLEAN NOT NULL DEFAULT false,

	FOREIGN KEY (id_user) REFERENCES user(id) ON DELETE CASCADE,
	FOREIGN KEY (id_training) REFERENCES training(id) ON DELETE CASCADE
)