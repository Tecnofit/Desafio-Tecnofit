create table aluno
(
	cod int auto_increment
		primary key,
	nome varchar(255) null
);

create table treino
(
	cod int auto_increment
		primary key,
	nome varchar(50) null
);

create table exercicio
(
	cod int auto_increment
		primary key,
	nome varchar(50) null,
	codTreino int null,
	repeticoes int null,
	estado varchar(10) default 'criado' null,
	constraint exercicio_treino_cod_fk
		foreign key (codTreino) references treino (cod)
);

create table treinamento
(
	cod int auto_increment
		primary key,
	codAluno int null,
	codExercicio int null,
	estado varchar(15) default 'disponivel' null,
	constraint treinamento_aluno_cod_fk
		foreign key (codAluno) references aluno (cod),
	constraint treinamento_exercicio_cod_fk
		foreign key (codExercicio) references exercicio (cod)
);

