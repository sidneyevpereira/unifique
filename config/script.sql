CREATE DATABASE IF NOT EXISTS unifique_db;
USE unifique_db;

CREATE TABLE IF NOT EXISTS teste (  
  teste_nro INT(10),
  teste_descricao VARCHAR(255),  
  PRIMARY KEY (teste_nro)
);

DELETE FROM teste;

INSERT INTO teste VALUE(1,'TESTE - 1');
INSERT INTO teste VALUE(2,'TESTE - 2');
INSERT INTO teste VALUE(3,'TESTE - 3');
INSERT INTO teste VALUE(4,'TESTE - 4');
INSERT INTO teste VALUE(5,'TESTE - 5');
