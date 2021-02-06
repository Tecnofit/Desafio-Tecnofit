
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
collate = latin1_general_ci;

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
collate = latin1_general_ci;

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
collate = latin1_general_ci;

/**
 * Perfil do usuário
 */
create table profile
(
  id          int unsigned auto_increment primary key,
  uuid        varchar(36)  null,
  name        varchar(50)  null,
  shortname   varchar(100) not null,
  description varchar(255) null,
  constraint profile_shortname_uindex
    unique (shortname),
  constraint profile_uuid_uindex
    unique (uuid)
)
collate = latin1_general_ci;

/**
 * Usuário
 */
create table user
(
  id          int unsigned auto_increment
    primary key,
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
  removed_at  datetime                                           null,
  modified_at datetime                                           null,
  constraint user_email_uindex
    unique (email),
  constraint user_uuid_uindex
    unique (uuid),
  constraint FK_user_profile_id
    foreign key (profile_id) references profile (id)
)
collate = latin1_general_ci;
