#GRANT ALL PRIVILEGES ON *.* TO 'marco'@'%' IDENTIFIED BY '2214' WITH GRANT OPTION;


CREATE TABLE students
(
    id INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR (64) NOT NULL,
    email VARCHAR (64) NOT NULL,
    phoneNumber VARCHAR (16) NOT NULL,
    createdAt DATETIME NOT NULL,
    modifiedAt DATETIME NOT NULL,
    deletedAt DATETIME NULL,
    PRIMARY KEY (id)
);

CREATE TABLE exercises
(
    id INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR (128) NOT NULL,
    createdAt DATETIME NOT NULL,
    modifiedAt DATETIME NOT NULL,
    deletedAt DATETIME NULL,
    PRIMARY KEY (id)
);

CREATE TABLE trainings
(
    id INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR (128) NOT NULL,
    status ENUM('Waiting', 'Active', 'Canceled') DEFAULT 'Waiting',
    createdAt DATETIME NOT NULL,
    modifiedAt DATETIME NULL,
    deletedAt DATETIME NULL,
    PRIMARY KEY (id)
);

CREATE TABLE trainingExercises
(
    id INT(11) NOT NULL AUTO_INCREMENT,
    trainingId INT(11) NOT NULL,
    exerciseId INT(11) NOT NULL,
    numberOfSessions INT(11) NOT NULL,
    createdAt DATETIME NOT NULL,
    modifiedAt DATETIME NOT NULL,
    deletedAt DATETIME NULL,
    PRIMARY KEY (id)
);

ALTER TABLE trainingExercises ADD CONSTRAINT fk_te_trainingId FOREIGN KEY (trainingId) REFERENCES trainings(id);
ALTER TABLE trainingExercises ADD CONSTRAINT fk_te_exerciseId FOREIGN KEY (exerciseId) REFERENCES exercises(id);


CREATE TABLE studentTrainings
(
    id INT(11) NOT NULL AUTO_INCREMENT,
    studentId INT(11) NOT NULL,
    trainingId INT(11) NOT NULL,
    status ENUM('Active', 'Canceled', 'Finished') DEFAULT 'Active',
    createdAt DATETIME NOT NULL,
    modifiedAt DATETIME NOT NULL,
    deletedAt DATETIME NULL,
    PRIMARY KEY (id)
);

ALTER TABLE studentTrainings ADD CONSTRAINT fk_st_studentId FOREIGN KEY (studentId) REFERENCES students(id);
ALTER TABLE studentTrainings ADD CONSTRAINT fk_st_trainingId FOREIGN KEY (trainingId) REFERENCES trainings(id);


CREATE TABLE studentTrainingExercises
(
    id INT(11) NOT NULL AUTO_INCREMENT,
    studentTrainingId INT(11) NOT NULL,
    trainingExerciseId INT(11) NOT NULL,
    status ENUM('Pending', 'Finished', 'Skiped') DEFAULT 'Pending',
    createdAt DATETIME NOT NULL,
    modifiedAt DATETIME NOT NULL,
    deletedAt DATETIME NULL,
    PRIMARY KEY (id)
);

ALTER TABLE studentTrainingExercises ADD CONSTRAINT fk_ste_studentTrainingId FOREIGN KEY (studentTrainingId) REFERENCES studentTrainings(id);
ALTER TABLE studentTrainingExercises ADD CONSTRAINT fk_ste_trainingExerciseId FOREIGN KEY (trainingExerciseId) REFERENCES trainingExercises(id);



INSERT INTO students(name, email, phoneNumber, createdAt, modifiedAt) VALUES ('JOCIELLE NUNES DA COSTA', 'cielly.nunes85@hotmail.com', '(27) 9981 39608', NOW(), NOW());
INSERT INTO students(name, email, phoneNumber, createdAt, modifiedAt) VALUES ('SILMARA DE FATIMA DE LIMA AMARAL', 'sill.sla@hotmail.com', '(41) 9850 69011', NOW(), NOW());
INSERT INTO students(name, email, phoneNumber, createdAt, modifiedAt) VALUES ('ELMO AGOSTINHO CAVASSIN', 'elmocavassin@gmail.com', '(41) 9970 4339', NOW(), NOW());
INSERT INTO students(name, email, phoneNumber, createdAt, modifiedAt) VALUES ('MARIA DOMINGAS PEREIRA DE LARA', 'marialara@seed.pr.gov.br', '(41) 9768 9813', NOW(), NOW());
INSERT INTO students(name, email, phoneNumber, createdAt, modifiedAt) VALUES ('ADRIANA APARECIDA DE LARA CAVASSIN', 'drikalara16@yahoo.com.br', '(41) 9938 6178', NOW(), NOW());
INSERT INTO students(name, email, phoneNumber, createdAt, modifiedAt) VALUES ('THAINA SANTANA', 'thainasantana421@gmail.com', '(14) 9972 66938', NOW(), NOW());
INSERT INTO students(name, email, phoneNumber, createdAt, modifiedAt) VALUES ('MARIA MENDES DE OLIVEIRA SANTOS', 'mariamendesdeoliveirasantos@yahoo.com.br', '', NOW(), NOW());
INSERT INTO students(name, email, phoneNumber, createdAt, modifiedAt) VALUES ('LOREN TATIELLE COUTINHO MENDES', 'lorentatielle20@gmail.com', '(38) 9915 91442', NOW(), NOW());
INSERT INTO students(name, email, phoneNumber, createdAt, modifiedAt) VALUES ('ELIANA VITAL DE OLIVEIRA', 'elianavitaldeoliveira09ma@gmail.com', '(65) 9992 37596', NOW(), NOW());
INSERT INTO students(name, email, phoneNumber, createdAt, modifiedAt) VALUES ('EDNA MARIA DE SALLES', 'sallesedna459@gmail.com', '(11) 9448 40824', NOW(), NOW());
INSERT INTO students(name, email, phoneNumber, createdAt, modifiedAt) VALUES ('VALDEMIR APARECIDO DA SILVA', 'alexsilvaprodutor@hotmail.com', '(11) 9413 86627', NOW(), NOW());
INSERT INTO students(name, email, phoneNumber, createdAt, modifiedAt) VALUES ('RAYRA KACPERZAK TENORIO CAVALCANTE', 'rayraktc@hotmail.com', '(13) 9977 51025', NOW(), NOW());
INSERT INTO students(name, email, phoneNumber, createdAt, modifiedAt) VALUES ('FRANCISCO JANDRESON TAVARES', 'tavaresfranciscojandreson@gmail.com', '(69) 9993-81527', NOW(), NOW());
INSERT INTO students(name, email, phoneNumber, createdAt, modifiedAt) VALUES ('JANAINA FOGACA DE ALMEIDA MONTEIRO', 'janaemarlon@hotmail.com', '(11) 9988 44800', NOW(), NOW());
INSERT INTO students(name, email, phoneNumber, createdAt, modifiedAt) VALUES ('PATRICIA SILVA DE OLIVEIRA', 'patriciasilvadeoliveira186@gmail.com', '(11) 9547 70566', NOW(), NOW());
INSERT INTO students(name, email, phoneNumber, createdAt, modifiedAt) VALUES ('PAOLA GRAZIELE GONCALVES PRESTES', 'paolaprestes84@gmail.com', '(11) 9752 67260', NOW(), NOW());
INSERT INTO students(name, email, phoneNumber, createdAt, modifiedAt) VALUES ('MARCO AURELIO JESUS DOS SANTOS', 'marcoaurelio1974123@gmail.com', '', NOW(), NOW());
INSERT INTO students(name, email, phoneNumber, createdAt, modifiedAt) VALUES ('INGRID RODRIGUES DA SILVA', 'ingrid-rodrigues83@live.com', '(11) 96852 8118', NOW(), NOW());
INSERT INTO students(name, email, phoneNumber, createdAt, modifiedAt) VALUES ('GISLENE FERREIRA DE OLIVEIRA', 'giferreira.oliveiras2@gmail.com', '(11) 9915 19581', NOW(), NOW());
INSERT INTO students(name, email, phoneNumber, createdAt, modifiedAt) VALUES ('IZABELLE SALLES RODRIGUES', 'belesalles2014@gmail.com', '(11) 9719 34624', NOW(), NOW());
INSERT INTO students(name, email, phoneNumber, createdAt, modifiedAt) VALUES ('SONIA REGINA MARTINIANO', 'so.ninhaah@hotmail.com', '(11) 9577 59186', NOW(), NOW());
INSERT INTO students(name, email, phoneNumber, createdAt, modifiedAt) VALUES ('ZENILDE MARIA DE AZEVEDO FRANHAN', 'zenildemaria12@gmail.com', '(11) 9331 76359', NOW(), NOW());
INSERT INTO students(name, email, phoneNumber, createdAt, modifiedAt) VALUES ('DEBORA RODRIGUES DE FREITAS', 'freitasdebora149@gmail.com', '(21) 9860 32972', NOW(), NOW());
INSERT INTO students(name, email, phoneNumber, createdAt, modifiedAt) VALUES ('MARCIA APARECIDA BENTO DE OLIVEIRA', 'simonenogueira1943@gmail.com', '(43) 9845 95783', NOW(), NOW());
INSERT INTO students(name, email, phoneNumber, createdAt, modifiedAt) VALUES ('LARISSA MACHADO LEMES', 'larissalemesm@gmail.com', '(38) 9840 22296', NOW(), NOW());
INSERT INTO students(name, email, phoneNumber, createdAt, modifiedAt) VALUES ('ELIANI APARECIDA WINHAR KRUG', 'eliaani2016@gmail.com', '(42) 9980 07127', NOW(), NOW());
INSERT INTO students(name, email, phoneNumber, createdAt, modifiedAt) VALUES ('ROSEMERI DO CARMO', 'docarmo.rosemeri@gmail.com', '(49) 9990 28272', NOW(), NOW());
INSERT INTO students(name, email, phoneNumber, createdAt, modifiedAt) VALUES ('RAILDE RODRIGUES BORGES', 'rodriguesraildes48@gmail.com', '(63) 9920 70226', NOW(), NOW());
INSERT INTO students(name, email, phoneNumber, createdAt, modifiedAt) VALUES ('WILLIAN MENDES', 'willianmnds@hotmail.com', '(47) 9885 92461', NOW(), NOW());
INSERT INTO students(name, email, phoneNumber, createdAt, modifiedAt) VALUES ('SIMONE PEREIRA DE ARAUJO', 'simonemt4@gmail.com', '(65) 9964 32364', NOW(), NOW());
INSERT INTO students(name, email, phoneNumber, createdAt, modifiedAt) VALUES ('PATRICK RAPHAEL FAVALESSA FERNANDES', 'patrickraphael007@gmail.com', '(65) 99625 5044', NOW(), NOW());
INSERT INTO students(name, email, phoneNumber, createdAt, modifiedAt) VALUES ('MARCOS ANTONIO DA SILVA  JUNIOR', 'marcosjuniorbio@gmail.com', '(65) 9993 68057', NOW(), NOW());
INSERT INTO students(name, email, phoneNumber, createdAt, modifiedAt) VALUES ('LEVY BANDEIRA DA SILVA', 'lewynissi@hotmail.com', '(99) 9815 75928', NOW(), NOW());
INSERT INTO students(name, email, phoneNumber, createdAt, modifiedAt) VALUES ('ADRIELI APARECIDA FERRI VICENTIM', 'drikaferrivicentin@hotmail.com', '(44) 9984 30211', NOW(), NOW());
INSERT INTO students(name, email, phoneNumber, createdAt, modifiedAt) VALUES ('JOCELI APARECIDA ANTUNES', 'profejoceli@gmail.com', '(42) 9999 07008', NOW(), NOW());
INSERT INTO students(name, email, phoneNumber, createdAt, modifiedAt) VALUES ('JANAINA CORREA BORNHAUSEN', 'jana.beto.nicolas@hotmail.com', '(47) 99665 7739', NOW(), NOW());
INSERT INTO students(name, email, phoneNumber, createdAt, modifiedAt) VALUES ('ROZIANE DE FATIMA DE SOUZA', 'rozianedefatima@gmail.com', '(41) 9846 99137', NOW(), NOW());
INSERT INTO students(name, email, phoneNumber, createdAt, modifiedAt) VALUES ('IGOR VINICIUS MATOS', 'igorbatmatos@live.com', '(38) 9884 53483', NOW(), NOW());
INSERT INTO students(name, email, phoneNumber, createdAt, modifiedAt) VALUES ('TIAGO HEVERTONN JUNIOR BRAGA', 'tiagohevertonjr@gmail.com', '(38) 9842 10711', NOW(), NOW());
INSERT INTO students(name, email, phoneNumber, createdAt, modifiedAt) VALUES ('PAMELA APARECIDA NUNES GONCALVES', 'pamelanunes80@yahoo.com', '(38) 9984 76362', NOW(), NOW());
INSERT INTO students(name, email, phoneNumber, createdAt, modifiedAt) VALUES ('MARIA APARECIDA DE FREITAS', 'aparecidafreitas@seed.pr.gov.br', '(43) 99978 1896', NOW(), NOW());
INSERT INTO students(name, email, phoneNumber, createdAt, modifiedAt) VALUES ('GABRIELLA DE ANDRADE BARROSO', 'gabrielasam2008@gmail.com', '(38) 9996 08492', NOW(), NOW());
INSERT INTO students(name, email, phoneNumber, createdAt, modifiedAt) VALUES ('ALINE ARAUJO LAGARES', 'alinelagares31@gmail.com', '(38) 9841 13190', NOW(), NOW());
INSERT INTO students(name, email, phoneNumber, createdAt, modifiedAt) VALUES ('KEILA DE SOUZA SILVA', 'keiladesouzasilva345@gmail.com', '(18) 9811 41670', NOW(), NOW());
INSERT INTO students(name, email, phoneNumber, createdAt, modifiedAt) VALUES ('ANA CLAUDIA ASSIS DOS SANTOS', 'claudinha-santos21@hotmail.com', '(31) 9836 42214', NOW(), NOW());
INSERT INTO students(name, email, phoneNumber, createdAt, modifiedAt) VALUES ('SANDRA ORNIESKI', 'sandi.or@hotmail.com', '(42) 99926 2723', NOW(), NOW());
INSERT INTO students(name, email, phoneNumber, createdAt, modifiedAt) VALUES ('MATEUS WILLIAN FERREIRA', 'mateuswillian310@gmail.com', '(43) 9653 3174', NOW(), NOW());
INSERT INTO students(name, email, phoneNumber, createdAt, modifiedAt) VALUES ('CLEITON SKROCH DOS SANTOS', 'cleitonfessor@gmail.com', '(41) 99963 5911', NOW(), NOW());
INSERT INTO students(name, email, phoneNumber, createdAt, modifiedAt) VALUES ('ELIZANDRA BARCELO DA LUZ', 'elizandrabarcelo@gmail.com', '(41) 98526 2870', NOW(), NOW());
INSERT INTO students(name, email, phoneNumber, createdAt, modifiedAt) VALUES ('ANNA BEATRIZ DE MAGALHAES DOURADO', 'magalhaesannabeatriz39@gmail.com', '(62) 9432 6020', NOW(), NOW());




INSERT INTO exercises(name, createdAt, modifiedAt) values ('Supino declinado com halteres', NOW(), NOW());
INSERT INTO exercises(name, createdAt, modifiedAt) values ('Supino inclinado com halteres', NOW(), NOW());
INSERT INTO exercises(name, createdAt, modifiedAt) values ('Supino declinado com barra', NOW(), NOW());
INSERT INTO exercises(name, createdAt, modifiedAt) values ('Supino com halteres', NOW(), NOW());
INSERT INTO exercises(name, createdAt, modifiedAt) values ('Supino', NOW(), NOW());
INSERT INTO exercises(name, createdAt, modifiedAt) values ('Extensao de triceps em banco declinado com barra', NOW(), NOW());
INSERT INTO exercises(name, createdAt, modifiedAt) values ('Triceps na polia alta', NOW(), NOW());
INSERT INTO exercises(name, createdAt, modifiedAt) values ('Mergulho', NOW(), NOW());
INSERT INTO exercises(name, createdAt, modifiedAt) values ('Triceps unilateral na polia alta com pegada reversa', NOW(), NOW());
INSERT INTO exercises(name, createdAt, modifiedAt) values ('Extensao de triceps na corda', NOW(), NOW());
INSERT INTO exercises(name, createdAt, modifiedAt) values ('Extensao de triceps unilateral sentado com halteres (pegada neutra)', NOW(), NOW());
INSERT INTO exercises(name, createdAt, modifiedAt) values ('Remada curvada na barra', NOW(), NOW());
INSERT INTO exercises(name, createdAt, modifiedAt) values ('Remada unilateral com halteres', NOW(), NOW());
INSERT INTO exercises(name, createdAt, modifiedAt) values ('Barra fixa com pegada aberta', NOW(), NOW());
INSERT INTO exercises(name, createdAt, modifiedAt) values ('Remada cavalinho', NOW(), NOW());
INSERT INTO exercises(name, createdAt, modifiedAt) values ('Puxada alta pela frente', NOW(), NOW());
INSERT INTO exercises(name, createdAt, modifiedAt) values ('Remada na polia baixa', NOW(), NOW());
INSERT INTO exercises(name, createdAt, modifiedAt) values ('Panturrilha burrinho', NOW(), NOW());
INSERT INTO exercises(name, createdAt, modifiedAt) values ('Mesa flexora', NOW(), NOW());
INSERT INTO exercises(name, createdAt, modifiedAt) values ('Cadeira flexora', NOW(), NOW());
INSERT INTO exercises(name, createdAt, modifiedAt) values ('Stiff', NOW(), NOW());