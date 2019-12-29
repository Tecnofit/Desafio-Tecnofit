create user 'tecno'@'localhost' identified by 'tecno1234';
create database tecno;
grant all privileges on tecno.* to 'tecno'@'localhost';
use tecno;

create table student_profile (
	id int not null auto_increment,
    profile_desc tinytext not null,
    constraint pk_student_profile primary key (id)
);

insert into student_profile (id, profile_desc) values (1, 'Student'), (2, 'Runner');

create table training_level (
	id int not null auto_increment,
    level_desc tinytext not null,
    constraint pk_training_level primary key (id)
);

insert into training_level (id, level_desc) values (1, 'Beginner'), (2, 'Intermediate'), (3, 'Advanced');

create table training (
	id int not null auto_increment,
    training_name varchar(60) not null,
    fk_level int not null,
    training_desc tinytext not null,
    session_quantity int not null,
    resting_interval time not null,
    created_at datetime not null default current_timestamp,
    updated_at datetime null,
    training_active tinyint(1) not null default 1,
    fk_profile_sugestion int null,
    constraint pk_training primary key (id),
    constraint training_fk_level foreign key (fk_level) references training_level (id),
    constraint exercies_training_fk_profile_sugestion foreign key (fk_profile_sugestion) references student_profile (id)
);

create table student (
	id int not null auto_increment,
    student_name varchar(60) not null,
    birth_date date not null,
    weight float(4,2) not null,
    height float(4,2) not null,
    email varchar(80) null,
    fk_student_profile int not null default 1,
    fk_active_training int null,
	student_active tinyint(1) default 1,
    created_at datetime not null default current_timestamp,
    updated_at datetime null,
    constraint pk_student primary key (id),
    constraint student_fk_profile foreign key (fk_student_profile) references student_profile (id),
    constraint student_fk_training foreign key (fk_active_training) references training (id)
);

create table exercise (
	id int not null auto_increment,
    exercise_name varchar(60),
    exercise_desc tinytext not null,
    exercise_active tinyint(1) not null default 1,
    created_at datetime not null default current_timestamp,
    update_at datetime null,
    constraint pk_exercise primary key (id)
);

create table exercises_training (
	id int not null auto_increment,
    fk_training int not null,
    fk_exercise int not null,
    series int not null,
    repetition varchar(80) not null,
    constraint pk_exercises_training primary key (id),
    constraint exercises_training_fk_training foreign key (fk_training) references training (id),
    constraint exercies_training_fk_exercise foreign key (fk_exercise) references exercise (id)
);

create table student_training (
	id int not null auto_increment,
    fk_student int not null,
    fk_exercise_training int not null,
    exercise_finished tinyint(1) not null,
    session_number int not null,
    created_at datetime not null default current_timestamp,
    constraint pk_student_training primary key (id),
    constraint student_training_fk_student foreign key (fk_student) references student (id),
    constraint student_training_fk_exercise_training foreign key (fk_exercise_training) references exercises_training (id)
);