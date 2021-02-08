CREATE DATABASE IF NOT EXISTS gym;

ALTER DATABASE `gym` CHARSET = UTF8 COLLATE = utf8_general_ci;

/**
 * Criação da tabela de treinos
 */
create table training
(
  id int unsigned auto_increment primary key,
  uuid   varchar(36)          not null,
  status tinyint(1) default 1 null,
  name   varchar(255)         not null,
  constraint UNIQUE_training_name
    unique (name),
  constraint UNIQUE_training_uuid
    unique (uuid)
)
CHARSET = UTF8 COLLATE = utf8_general_ci;

/**
 * Criação da tabela de exercícios
 */
create table activity
(
  id int unsigned auto_increment primary key,
  uuid   varchar(36)          not null,
  name   varchar(255)         not null,
  constraint UNIQUE_activity_name
    unique (name),
  constraint UNIQUE_activity_uuid
    unique (uuid)
)
CHARSET = UTF8 COLLATE = utf8_general_ci;

/**
 * Associar exercício ao treino
 */
create table activity_training
(
  activity_id int unsigned  not null,
  training_id int unsigned  not null,
  sections    int default 0 null,
  primary key (activity_id, training_id)
)
CHARSET = UTF8 COLLATE = utf8_general_ci;

/**
 * Perfil do usuário
 */
create table profile
(
  id          int unsigned auto_increment primary key,
  uuid        varchar(36)  null,
  name        varchar(50)  null,
  slug        varchar(100) not null,
  description varchar(255) null,
  constraint profile_slug_uindex
    unique (slug),
  constraint profile_uuid_uindex
    unique (uuid)
)
CHARSET = UTF8 COLLATE = utf8_general_ci;

/**
 * Usuário
 */
create table user
(
  id          int unsigned auto_increment primary key,
  uuid        varchar(36)                                        not null,
  profile_id  int unsigned                                       null,
  password    varchar(255)                                       null,
  status      enum ('ENABLED', 'DISABLED', 'DELETED', 'OVERDUE') not null,
  email       varchar(100)                                       not null,
  first_name  varchar(255)                                       not null,
  middle_name varchar(255)                                       null,
  last_name   varchar(255)                                       not null,
  weight      double unsigned                                    null,
  height      double unsigned                                    null,
  photo       varchar(255)                                       null,
  birth_date  date                                               null,
  created_at  datetime                                           not null,
  updated_at datetime                                           null,
  deleted_at  datetime                                           null,

  constraint user_email_uindex
    unique (email),
  constraint user_uuid_uindex
    unique (uuid),
  constraint FK_user_profile_id
    foreign key (profile_id) references profile (id)
)
CHARSET = UTF8 COLLATE = utf8_general_ci;

/**
 * Vínculo de treinos para o estudante
 */
create table student_training
(
  id          int unsigned auto_increment
    primary key,
  uuid        varchar(36)                                     not null,
  user_id     int unsigned                                    not null,
  training_id int unsigned                                    not null,
  status      enum ('ENABLED', 'DISABLED') default 'DISABLED' not null,
  constraint UNIQUE_student_training_user_trainnig_id
    unique (user_id, training_id),
  constraint UNIQUE_student_training_uuid
    unique (uuid),
  constraint FK_student_training_training_id
    foreign key (training_id) references training (id),
  constraint FK_student_training_user_id
    foreign key (user_id) references user (id)
)
CHARSET = UTF8 COLLATE = utf8_general_ci;

/**
 * Vínculo de atividades do treino
 */
create table student_training_progress
(
  student_training_id int unsigned                                                not null,
  activity_id         int unsigned                                                not null,
  status              enum ('NOT_STARTED', 'COMPLETED', 'IN_PROGRESS', 'SKIPPED') not null,
  primary key (student_training_id, activity_id),
  constraint FK_student_training_progress_activity_id
    foreign key (activity_id) references activity (id),
  constraint FK_student_training_progress_student_training_id
    foreign key (student_training_id) references student_training (id)
)
CHARSET = UTF8 COLLATE = utf8_general_ci;


INSERT INTO profile (id, uuid, name, slug, description) VALUES (1, 'd758b7f4-3e81-49b2-a334-3d8b3698384f', 'Administrador', 'admin', 'Administrador geral');
INSERT INTO profile (id, uuid, name, slug, description) VALUES (2, '6a513f05-bf33-4cd1-a5b0-8ae43f9389e5', 'Convidado', 'guest', 'Convidado');

INSERT INTO user (id, uuid, profile_id, password, status, email, first_name, middle_name, last_name, weight, height, photo, birth_date, created_at, updated_at, deleted_at) VALUES (1, 'd758b7f4-3e81-49b2-a334-3d8b3698384f', 1, '81dc9bdb52d04dc20036dbd8313ed055', 'ENABLED', 'admin@yofit.com.br', 'Admin', 'Root', 'General', null, null, null, null, '2021-02-06 14:25:35', null, null);
INSERT INTO user (id, uuid, profile_id, password, status, email, first_name, middle_name, last_name, weight, height, photo, birth_date, created_at, updated_at, deleted_at) VALUES (2, '9cc2b708-68ce-4086-a754-6337a8e68932', 2, '81dc9bdb52d04dc20036dbd8313ed055', 'ENABLED', 'guest@yofit.com.br', 'Guest', null, 'User', null, null, null, null, '2021-02-06 13:42:50', null, null);

INSERT INTO training (id, uuid, status, name) VALUES (1, 'f8eadab1-1e0d-411e-99e9-28c28f889691', 1, 'Peito, Ombro, Biceps');
INSERT INTO training (id, uuid, status, name) VALUES (2, 'e0ea22f2-6977-11eb-95a2-0242ac130002', 1, 'Costas, Trapezio, Biceps');
INSERT INTO training (id, uuid, status, name) VALUES (3, '09cff2a2-6978-11eb-95a2-0242ac130002', 1, 'Perna');

INSERT INTO activity (id, uuid, name) VALUES (1, '4b754ba2-6978-11eb-95a2-0242ac130002', 'Supino Reto');
INSERT INTO activity (id, uuid, name) VALUES (2, '67fd052e-6978-11eb-95a2-0242ac130002', 'Supino Inclinado');
INSERT INTO activity (id, uuid, name) VALUES (3, '713618c7-6978-11eb-95a2-0242ac130002', 'Peck Peito\\Voador');
INSERT INTO activity (id, uuid, name) VALUES (4, '8189f4d4-6978-11eb-95a2-0242ac130002', 'Pullover\\Crucifixo');
INSERT INTO activity (id, uuid, name) VALUES (5, '8860434f-6978-11eb-95a2-0242ac130002', 'Desenvolvimento\\Barra');
INSERT INTO activity (id, uuid, name) VALUES (6, '8ec292c5-6978-11eb-95a2-0242ac130002', 'Elevacao lateral');
INSERT INTO activity (id, uuid, name) VALUES (7, '94260707-6978-11eb-95a2-0242ac130002', 'Triceps\\Testa');
INSERT INTO activity (id, uuid, name) VALUES (8, '99f1e8e2-6978-11eb-95a2-0242ac130002', 'Triceps pulley');
INSERT INTO activity (id, uuid, name) VALUES (9, 'a090c90e-6978-11eb-95a2-0242ac130002', 'Triceps francês');
INSERT INTO activity (id, uuid, name) VALUES (10, '0e5ea61a-6979-11eb-95a2-0242ac130002', 'Aquecimento barra fixa');
INSERT INTO activity (id, uuid, name) VALUES (11, '13315ed7-6979-11eb-95a2-0242ac130002', 'Puxador costas');
INSERT INTO activity (id, uuid, name) VALUES (12, '15bf2b56-6979-11eb-95a2-0242ac130002', 'Puxador frente');
INSERT INTO activity (id, uuid, name) VALUES (13, '1dd40a5f-6979-11eb-95a2-0242ac130002', 'Remada unilateral com apoio');
INSERT INTO activity (id, uuid, name) VALUES (14, '23f6c6fc-6979-11eb-95a2-0242ac130002', 'Encolhimento ombro');
INSERT INTO activity (id, uuid, name) VALUES (15, '28927d89-6979-11eb-95a2-0242ac130002', 'Remada alta');
INSERT INTO activity (id, uuid, name) VALUES (16, '312bff4c-6979-11eb-95a2-0242ac130002', 'Remada atrás das costas');
INSERT INTO activity (id, uuid, name) VALUES (17, '3cf4fb46-6979-11eb-95a2-0242ac130002', 'Rosca direta');
INSERT INTO activity (id, uuid, name) VALUES (18, '410950c5-6979-11eb-95a2-0242ac130002', 'Rosca concentrada');
INSERT INTO activity (id, uuid, name) VALUES (19, '445c0490-6979-11eb-95a2-0242ac130002', 'Rosca alternada');
INSERT INTO activity (id, uuid, name) VALUES (20, '4945be2e-6979-11eb-95a2-0242ac130002', 'Schott');
INSERT INTO activity (id, uuid, name) VALUES (21, 'a643bc9e-6979-11eb-95a2-0242ac130002', 'Aquecimento na bike');
INSERT INTO activity (id, uuid, name) VALUES (22, 'ab3c32b8-6979-11eb-95a2-0242ac130002', 'Cadeira extensora');
INSERT INTO activity (id, uuid, name) VALUES (23, 'b1f0d473-6979-11eb-95a2-0242ac130002', 'Agachamento\\Hack');
INSERT INTO activity (id, uuid, name) VALUES (24, 'b8dcece8-6979-11eb-95a2-0242ac130002', 'Stiff\\Avanco');
INSERT INTO activity (id, uuid, name) VALUES (25, 'bf476c11-6979-11eb-95a2-0242ac130002', 'Cama flexora');
INSERT INTO activity (id, uuid, name) VALUES (26, 'c23f388b-6979-11eb-95a2-0242ac130002', 'Leg 45');
INSERT INTO activity (id, uuid, name) VALUES (27, 'c73f5ec5-6979-11eb-95a2-0242ac130002', 'Gêmeos plantar');
INSERT INTO activity (id, uuid, name) VALUES (28, 'cce299bb-6979-11eb-95a2-0242ac130002', 'Gêmeos sentado');

INSERT INTO activity_training (activity_id, training_id, sections) VALUES (1, 1, 3);
INSERT INTO activity_training (activity_id, training_id, sections) VALUES (2, 1, 3);
INSERT INTO activity_training (activity_id, training_id, sections) VALUES (3, 1, 3);
INSERT INTO activity_training (activity_id, training_id, sections) VALUES (4, 1, 3);
INSERT INTO activity_training (activity_id, training_id, sections) VALUES (5, 1, 3);
INSERT INTO activity_training (activity_id, training_id, sections) VALUES (6, 1, 3);
INSERT INTO activity_training (activity_id, training_id, sections) VALUES (7, 1, 3);
INSERT INTO activity_training (activity_id, training_id, sections) VALUES (8, 1, 3);
INSERT INTO activity_training (activity_id, training_id, sections) VALUES (9, 1, 3);
INSERT INTO activity_training (activity_id, training_id, sections) VALUES (10, 2, 2);
INSERT INTO activity_training (activity_id, training_id, sections) VALUES (11, 2, 3);
INSERT INTO activity_training (activity_id, training_id, sections) VALUES (12, 2, 3);
INSERT INTO activity_training (activity_id, training_id, sections) VALUES (13, 2, 3);
INSERT INTO activity_training (activity_id, training_id, sections) VALUES (14, 2, 3);
INSERT INTO activity_training (activity_id, training_id, sections) VALUES (15, 2, 3);
INSERT INTO activity_training (activity_id, training_id, sections) VALUES (16, 2, 3);
INSERT INTO activity_training (activity_id, training_id, sections) VALUES (17, 2, 3);
INSERT INTO activity_training (activity_id, training_id, sections) VALUES (18, 2, 3);
INSERT INTO activity_training (activity_id, training_id, sections) VALUES (19, 2, 3);
INSERT INTO activity_training (activity_id, training_id, sections) VALUES (20, 2, 3);
INSERT INTO activity_training (activity_id, training_id, sections) VALUES (20, 3, 3);
INSERT INTO activity_training (activity_id, training_id, sections) VALUES (21, 3, 3);
INSERT INTO activity_training (activity_id, training_id, sections) VALUES (22, 3, 3);
INSERT INTO activity_training (activity_id, training_id, sections) VALUES (23, 3, 3);
INSERT INTO activity_training (activity_id, training_id, sections) VALUES (24, 3, 3);
INSERT INTO activity_training (activity_id, training_id, sections) VALUES (25, 3, 3);
INSERT INTO activity_training (activity_id, training_id, sections) VALUES (26, 3, 3);
INSERT INTO activity_training (activity_id, training_id, sections) VALUES (27, 3, 3);
INSERT INTO activity_training (activity_id, training_id, sections) VALUES (28, 3, 3);