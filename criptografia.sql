CREATE DATABASE criptografia;
USE criptografia;

CREATE TABLE login (
	id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
	usuario VARCHAR(100) NOT NULL,
    senha VARCHAR(100) NOT NULL,
    salt VARCHAR(100) NOT NULL
);

#DROP TABLE login;

CREATE TABLE produto (
	id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
	nomeProduto VARCHAR(100) NOT NULL,
    quantidade VARCHAR(100) NOT NULL,
    dataCadastro VARCHAR(100) NOT NULL
);
INSERT INTO produto (nomeProduto, quantidade, dataCadastro) VALUES ('teste', '2', '2021-09-16');
SELECT * FROM login;
SELECT * FROM produto;