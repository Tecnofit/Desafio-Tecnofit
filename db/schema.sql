#GRANT ALL PRIVILEGES ON *.* TO 'marco'@'%' IDENTIFIED BY '2214' WITH GRANT OPTION;

CREATE TABLE students
(
    id INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR (64) NOT NULL,
    email VARCHAR (32) NOT NULL,
    phoneNumber VARCHAR (16) NOT NULL,
    createdAt DATETIME NOT NULL,
    modifiedAt DATETIME NOT NULL,
    deletedAt DATETIME NULL,
    PRIMARY KEY (id)
);

CREATE TABLE exercises
(
    id INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR (64) NOT NULL,
    createdAt DATETIME NOT NULL,
    modifiedAt DATETIME NOT NULL,
    deletedAt DATETIME NULL,
    PRIMARY KEY (id)
);

CREATE TABLE trainings
(
    id INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR (64) NOT NULL,
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
    status ENUM('Active', 'Finished', 'Skiped') DEFAULT 'Active',
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

