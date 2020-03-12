-- TABELA USUÁRIO
CREATE TABLE usuario (
    id_usuario INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL,
    senha VARCHAR(50) NOT NULL,
    status INT NOT NULL,
    perfil VARCHAR(150) DEFAULT "avatar-nulo.png",
    data_cadastro TIMESTAMP,
    PRIMARY KEY (id_usuario)
);

INSERT INTO `usuario` ( `nome`, `email`, `senha`, `data_cadastro`)
VALUES ('Edilson Pereira Mendonça', 'edilson@desigual.com.br', '202cb962ac59075b964b07152d234b70', CURRENT_TIMESTAMP);

INSERT INTO `usuario` ( `nome`, `email`, `senha`, `data_cadastro`)
VALUES ('Leonardo', 'leo@desigual.com.br', '202cb962ac59075b964b07152d234b70', CURRENT_TIMESTAMP);

INSERT INTO `usuario` ( `nome`, `email`, `senha`, `data_cadastro`)
VALUES ('Igor', 'igor@desigual.com.br', '202cb962ac59075b964b07152d234b70', CURRENT_TIMESTAMP);


-- TABELA CLIENTE
CREATE TABLE cliente (
    id_cliente INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(150) NOT NULL,
    data_cadastro TIMESTAMP,
    PRIMARY KEY (id_cliente)
);

INSERT INTO `cliente` ( `nome`, `data_cadastro`)
VALUES ('World Colors', CURRENT_TIMESTAMP);

-- TABELA FUNCIONARIO
CREATE TABLE funcionario (
    id_funcionario INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(150) NOT NULL,
    cargo VARCHAR(100) NOT NULL,
    status INT NOT NULL,
    perfil VARCHAR(150) DEFAULT "avatar-nulo.png",
    data_cadastro TIMESTAMP,
    PRIMARY KEY (id_funcionario)
);

INSERT INTO `funcionario` ( `nome`, `cargo`, `data_cadastro`)
VALUES ('Jamal', 'Video Maker', CURRENT_TIMESTAMP);

-- TABELA CATEGORIA
CREATE TABLE categoria(
    id_categoria INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(150) NOT NULL,
    data_cadastro TIMESTAMP,
    PRIMARY KEY (id_categoria)
);

INSERT INTO `categoria` ( `nome`, `data_cadastro`)
VALUES ('Som', CURRENT_TIMESTAMP);

INSERT INTO `categoria` ( `nome`, `data_cadastro`)
VALUES ('Câmera', CURRENT_TIMESTAMP);

INSERT INTO `categoria` ( `nome`, `data_cadastro`)
VALUES ('Movimento', CURRENT_TIMESTAMP);

INSERT INTO `categoria` ( `nome`, `data_cadastro`)
VALUES ('Acessório', CURRENT_TIMESTAMP);

INSERT INTO `categoria` ( `nome`, `data_cadastro`)
VALUES ('Bateria', CURRENT_TIMESTAMP);

INSERT INTO `categoria` ( `nome`, `data_cadastro`)
VALUES ('Carregador', CURRENT_TIMESTAMP);

INSERT INTO `categoria` ( `nome`, `data_cadastro`)
VALUES ('Monitor', CURRENT_TIMESTAMP);

INSERT INTO `categoria` ( `nome`, `data_cadastro`)
VALUES ('Tripé', CURRENT_TIMESTAMP);

-- TABELA EQUIPAMENTO
CREATE TABLE equipamento(
    id_equipamento INT NOT NULL AUTO_INCREMENT,
    id_categoria INT NOT NULL,
    nome VARCHAR(150) NOT NULL,
    quantidade INT,
    imagem VARCHAR(150) DEFAULT "equipamento-nulo.png",
    data_cadastro TIMESTAMP,
    PRIMARY KEY (id_equipamento),
    FOREIGN KEY (id_categoria) REFERENCES categoria (id_categoria)
);

-- TABELA PROJETO
CREATE TABLE projeto(
    id_projeto INT NOT NULL AUTO_INCREMENT,
    id_cliente INT NOT NULL,
    id_usuario INT NOT NULL,
    nome VARCHAR(150) NOT NULL,
    local TEXT,
    horario TIME,
    observacoes TEXT,
    data_ida DATE,
    data_volta DATE,
    data_cadastro TIMESTAMP,
    status INT NOT NULL,
    PRIMARY KEY (id_projeto),
    FOREIGN KEY (id_cliente) REFERENCES cliente (id_cliente),
    FOREIGN KEY (id_usuario) REFERENCES usuario (id_usuario)
);

-- TABELA PROJETO FUNCIONARIO NxN
CREATE TABLE projeto_funcionario(
    id_projeto_funcionario INT NOT NULL AUTO_INCREMENT,
    id_projeto INT NOT NULL,
    id_funcionario INT NOT NULL,
    funcao VARCHAR(150) NOT NULL,
    PRIMARY KEY (id_projeto_funcionario),
    FOREIGN KEY (id_projeto) REFERENCES projeto (id_projeto),
    FOREIGN KEY (id_funcionario) REFERENCES funcionario (id_funcionario)
);

-- TABELA PROJETO EQUIPAMENTO NxN
CREATE TABLE projeto_equipamento(
    id_projeto_equipamento INT NOT NULL AUTO_INCREMENT,
    id_projeto INT NOT NULL,
    id_equipamento INT NOT NULL,
    quantidade INT NULL,
    PRIMARY KEY (id_projeto_equipamento),
    FOREIGN KEY (id_projeto) REFERENCES projeto (id_projeto),
    FOREIGN KEY (id_equipamento) REFERENCES equipamento (id_equipamento)
);