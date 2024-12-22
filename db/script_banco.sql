CREATE TABLE tipo_usuario (
	id_tipousuario SERIAL,
	nome_tipo VARCHAR(50) NOT NULL,

	CONSTRAINT pk_tipousuario PRIMARY KEY(id_tipousuario)
)

CREATE TABLE usuarios (
	id_usuario SERIAL NOT NULL,
	id_tipousuario INT NOT NULL,
	nome_usuario VARCHAR(60) NOT NULL,
	email_usuario VARCHAR(100) NOT NULL,
	senha_usuario VARCHAR(8) NOT NULL,

	CONSTRAINT pk_usuarios PRIMARY KEY (id_usuario),
	CONSTRAINT fk_tipousuario FOREIGN KEY (id_tipousuario)
	REFERENCES tipo_usuario (id_tipousuario)
)

CREATE TABLE perfil_usuario (
	id_perfil SERIAL NOT NULL,
	id_usuario INT NOT NULL,
	nome_completo VARCHAR(100) NOT NULL,
	telefone_usuario VARCHAR(14) NOT NULL,
	bio_usuario VARCHAR(150),

	CONSTRAINT pk_perfil_usuario PRIMARY KEY(id_perfil),
	CONSTRAINT fk_usuario FOREIGN KEY (id_usuario)
	REFERENCES usuarios (id_usuario)
)

CREATE TABLE categoria (
	id_categoria SERIAL NOT NULL,
	cd_categoria INT NOT NULL,
	nome_categoria VARCHAR(60) NOT NULL,
	descricao_categoria VARCHAR(150),

	CONSTRAINT pk_categoria PRIMARY KEY(id_categoria)
)

CREATE TABLE situacao (
	id_situacao SERIAL NOT NULL,
	nm_situacao VARCHAR NOT NULL,
	
	CONSTRAINT pk_situacao PRIMARY KEY(id_situacao)
)

CREATE TABLE tarefas (
	id_tarefa SERIAL NOT NULL,
	cd_tarefa INT NOT NULL,
	id_usuario INT NOT NULL,
	id_categoria INT NOT NULL,
	id_situacao INT NOT NULL,
	descricao_tarefa VARCHAR(80) NOT NULL,

	CONSTRAINT pk_tarefas PRIMARY KEY (id_tarefa),

	CONSTRAINT fk_tarefas_usuario FOREIGN KEY (id_usuario)
	REFERENCES usuarios (id_usuario),

	CONSTRAINT fk_tarefas_categoria FOREIGN KEY (id_categoria)
	REFERENCES categoria (id_categoria),

	CONSTRAINT fk_tarefas_situacao FOREIGN KEY (id_situacao)
	REFERENCES situacao (id_situacao)
)

CREATE TABLE tipo_horario (
	id_tipohorario SERIAL NOT NULL,
	nm_tipohorario VARCHAR NOT NULL,
	
	CONSTRAINT pk_horario PRIMARY KEY(id_tipohorario)
)

CREATE TABLE horario_tarefa (
	id_horario SERIAL NOT NULL,
	id_tarefa INT NOT NULL,
	id_tipohorario INT NOT NULL,
	datahora_tarefa TIMESTAMP NOT NULL,

	CONSTRAINT pk_horario_tarefa PRIMARY KEY (id_horario),

	CONSTRAINT fk_horario_tarefa_tarefa FOREIGN KEY (id_tarefa)
	REFERENCES tarefas (id_tarefa),

	CONSTRAINT fk_horario_tarefa_tipo FOREIGN KEY (id_tipohorario)
	REFERENCES tipo_horario (id_tipohorario)
)
