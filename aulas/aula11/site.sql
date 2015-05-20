
CREATE SEQUENCE noticia_noti_codigo_seq;

CREATE TABLE noticia (
                noti_codigo INTEGER NOT NULL DEFAULT nextval('noticia_noti_codigo_seq'),
                noti_titulo VARCHAR(240) NOT NULL,
                noti_conteudo TEXT NOT NULL,
                noti_habilitado BOOLEAN DEFAULT true NOT NULL,
                noti_data_criacao TIMESTAMP NOT NULL,
                noti_data_publicacao TIMESTAMP NOT NULL,
                CONSTRAINT noticia_pk PRIMARY KEY (noti_codigo)
);


ALTER SEQUENCE noticia_noti_codigo_seq OWNED BY noticia.noti_codigo;

CREATE SEQUENCE servico_serv_codigo_seq;

CREATE TABLE servico (
                serv_codigo INTEGER NOT NULL DEFAULT nextval('servico_serv_codigo_seq'),
                serv_nome VARCHAR(240) NOT NULL,
                serv_descricao TEXT NOT NULL,
                serv_habilitado BOOLEAN DEFAULT true NOT NULL,
                CONSTRAINT servico_pk PRIMARY KEY (serv_codigo)
);


ALTER SEQUENCE servico_serv_codigo_seq OWNED BY servico.serv_codigo;

CREATE SEQUENCE perguntas_respostas_pere_codigo_seq;

CREATE TABLE perguntas_respostas (
                pere_codigo INTEGER NOT NULL DEFAULT nextval('perguntas_respostas_pere_codigo_seq'),
                pere_pergunta TEXT NOT NULL,
                pere_resposta TEXT NOT NULL,
                CONSTRAINT perguntas_respostas_pk PRIMARY KEY (pere_codigo)
);


ALTER SEQUENCE perguntas_respostas_pere_codigo_seq OWNED BY perguntas_respostas.pere_codigo;
