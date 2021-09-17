CREATE DATABASE criptografia;
USE criptografia;

CREATE TABLE login (
	id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
	usuario VARCHAR(100) NOT NULL,
    senha VARCHAR(100) NOT NULL,
    salt VARCHAR(100) NOT NULL
);
INSERT INTO login (usuario, senha, salt) VALUES ('teste', '02c07e9bfcdf24750f85b7a1b5e8b0965ae5c05506a5a35362dbb4bd736d6c2e', 'c735674592d384fb8a6b1928ac341a707a2efbbd');
#DROP TABLE login;

CREATE TABLE produto (
	id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
	nomeProduto VARCHAR(100) NOT NULL,
    quantidade VARCHAR(100) NOT NULL,
    dataCadastro VARCHAR(100) NOT NULL
);
INSERT INTO produto (nomeProduto, quantidade, dataCadastro) VALUES ('Notebook', '2', '2021-09-16');
INSERT INTO produto (nomeProduto, quantidade, dataCadastro) VALUES ('Smartphone', '13', '2021-09-16');
INSERT INTO produto (nomeProduto, quantidade, dataCadastro) VALUES ('Smart TV', '4', '2021-09-16');
INSERT INTO produto (nomeProduto, quantidade, dataCadastro) VALUES ('Samsung note', '9', '2021-09-16');
INSERT INTO produto (nomeProduto, quantidade, dataCadastro) VALUES ('mouse', '16', '2021-09-16');
SELECT * FROM login;
SELECT * FROM produto;