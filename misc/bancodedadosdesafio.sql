drop database if exists bancodedadosdesafio;
create database bancodedadosdesafio;

use bancodedadosdesafio;

create table usuarios (
	id int auto_increment primary key not null,
    nome varchar(100) not null,
    email varchar(50) not null,
    senha varchar(100) not null
);

create table produtos (
	id int auto_increment primary key not null,
    nome varchar(50) not null,
    descricao varchar(500),
    preco decimal(7,2),
    photo varchar(50) not null
);