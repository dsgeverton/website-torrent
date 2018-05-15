CREATE DATABASE IF NOT EXISTS dbtorrent;
USE dbtorrent;

CREATE TABLE IF NOT EXISTS usuario(
  id INT NOT NULL AUTO_INCREMENT,
  nome VARCHAR(50) NOT NULL,
  login VARCHAR(20) NOT NULL,
  senha VARCHAR(255) NOT NULL,
  email VARCHAR(50) NOT NULL,
  data_cadastro DATE DEFAULT NULL,
  PRIMARY KEY(id)
)ENGINE InnoDB CHARSET=utf8;

CREATE TABLE IF NOT EXISTS categoria(
	id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(30) NOT NULL,
    descricao VARCHAR(255) NOT NULL,
    PRIMARY KEY(id)
)ENGINE InnoDB CHARSET=utf8;

CREATE TABLE IF NOT EXISTS torrent(
  id INT NOT NULL AUTO_INCREMENT,
  id_categoria INT DEFAULT NULL,
  nome VARCHAR(30) NOT NULL,
  descricao VARCHAR(255) NOT NULL,
  link_server VARCHAR(255) NOT NULL,
  link_img VARCHAR(255) DEFAULT NULL,
  data_cadastro DATE DEFAULT NULL,
  PRIMARY KEY(id),
  KEY(id_categoria),
  CONSTRAINT ifk_idCategoria FOREIGN KEY (id_categoria) REFERENCES categoria(id) ON DELETE SET NULL
)ENGINE InnoDB CHARSET=utf8;

DELIMITER //
CREATE TRIGGER add_data before INSERT ON usuario
FOR EACH ROW
BEGIN
	set new.data_cadastro = date(now());
END //

CREATE TRIGGER add_data_cadastro before INSERT ON torrent
FOR EACH ROW
BEGIN
	set new.data_cadastro = date(now());
END //
DELIMITER ;

insert into categoria(nome, descricao) values ('Filmes','Categoria: Filmes');
insert into categoria(nome, descricao) values ('Livros','Categoria: Livros');
insert into categoria(nome, descricao) values ('Programas','Categoria: Programas');
insert into torrent (id_categoria, nome, descricao, link_server, link_img) values (2,'Casa do Tinhoso', 'Apostila de livros casa do código 2018 teyteyteytey', 'https://www.google.com', 'http://www.inf.poa.ifrs.edu.br/semanaacademica/wp-content/uploads/2016/05/lg_casadocodigo.png');
