
/**
 * Criação da tabela de treinos
 */
create table training
(
  id int auto_increment primary key,
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
  id int auto_increment primary key,
  uuid   varchar(36)          not null,
  name   varchar(255)         not null,
  constraint UNIQUE_activity_name
    unique (name),
  constraint UNIQUE_activity_uuid
    unique (uuid)
)
collate = latin1_general_ci;
