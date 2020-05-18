
create table Clientes(
id_cliente serial primary key not null,
nome varchar(100) not null,
cpf integer not null unique,
telefone bigint not null,
email varchar(100) not null unique,
senha varchar(25) not null,
cep varchar(12),
login varchar(100)
)

create table Prestadores(
id_funcionario serial primary key not null,
nome varchar(100) not null,
cpf integer not null unique,
email varchar(120) not null unique,
senha varchar(25) not null,
cep varchar(12),
login varchar(100)
)

create table Contratos(
id_historico serial primary key not null,
id_cliente integer not null,
id_carro integer not null,
id_funcionario integer not null,
data_inicio date not null,
data_devolucao date not null,
valor_total decimal(7,2)
)
ALTER TABLE Contratos 
ADD CONSTRAINT id_cliente FOREIGN KEY (id_cliente) 
REFERENCES Clientes (id_cliente)

ALTER TABLE Contratos 
ADD CONSTRAINT id_carro FOREIGN KEY (id_carro) 
REFERENCES Carros (id_carro)

ALTER TABLE Contratos 
ADD CONSTRAINT id_funcionario FOREIGN KEY (id_funcionario) 
REFERENCES Funcionarios (id_funcionario)



create table Clientes(
id_cliente serial primary key not null,
nome varchar(100) not null,
email varchar(100) not null unique,
senha varchar(25) not null,
cep varchar(12),
login varchar(100),
cpf integer not null unique,
telefone bigint not null,
)



insert into clientes(nome,cpf,telefone,email,senha,cep,login)
values('Felipe', 144444444, 45613213, 'fddddddddddddfs', 'fdddddddsf', 'fdddddddd', 'ffddddsafasasffsfassfa'),
('Guilherme', 1222222312, 123213213, 'fasfsaffasafdds', 'dfasfassfaasf', 'f1231231d32', 'fdfasfasafasasffsfassfa');


select * from clientes