
CREATE TABLE setor (
                codigo INT AUTO_INCREMENT NOT NULL,
                nome VARCHAR(60) NOT NULL,
                PRIMARY KEY (codigo)
);


CREATE TABLE usuario (
                codigo INT AUTO_INCREMENT NOT NULL,
                nome VARCHAR(60) NOT NULL,
                email VARCHAR(40) NOT NULL,
                senha VARCHAR(200) NOT NULL,
                PRIMARY KEY (codigo)
);
