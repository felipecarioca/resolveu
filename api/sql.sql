CREATE TABLE cliente (
	id_cliente INT(12) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(32) NOT NULL,
	cpf VARCHAR(20) NOT NULL,
	email VARCHAR(64) NULL,
	cep VARCHAR(12) NOT NULL,
	fone VARCHAR(16) NULL,
	senha VARCHAR(16) NOT NULL
);

CREATE TABLE tipo_servico (
	id_tipo_servico INT(12) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	descricao VARCHAR(32)
);

CREATE TABLE prestador (
	id_prestador INT(12) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(32) NOT NULL,
	cpf VARCHAR(20) NOT NULL,
	email VARCHAR(64) NULL,
	cep VARCHAR(12) NOT NULL,
	fone VARCHAR(16) NULL,
	senha VARCHAR(16) NOT NULL,
	id_tipo_servico INT(5) NULL,
	FOREIGN KEY (id_tipo_servico) REFERENCES tipo_servico(id_tipo_servico)
);

CREATE TABLE status_servico (
	id_status_servico INT(12) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	descricao VARCHAR(32)
);

CREATE TABLE servico (
	id_servico INT(12) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	id_cliente INT(12) NOT NULL,
	id_prestador INT(12) NOT NULL,
	id_tipo_servico INT(12) NOT NULL,
	id_status_servico INT(12) NOT NULL,
	FOREIGN KEY (id_cliente) REFERENCES cliente(id_cliente),
	FOREIGN KEY (id_prestador) REFERENCES prestador(id_prestador),
	FOREIGN KEY (id_tipo_servico) REFERENCES tipo_servico(id_tipo_servico),
	FOREIGN KEY (id_status_servico) REFERENCES status_servico(id_status_servico)
);

CREATE TABLE orcamento (
	id_orcamento INT(12) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	descricao_cliente TEXT NULL,
	retorno_prestador TEXT NULL
);