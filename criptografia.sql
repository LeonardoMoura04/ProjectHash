CREATE DATABASE criptografia;
USE criptografia;

CREATE TABLE login (
	usuario VARCHAR(100) NOT NULL,
    senha VARCHAR(100) NOT NULL,
    salt VARCHAR(100) NOT NULL
);