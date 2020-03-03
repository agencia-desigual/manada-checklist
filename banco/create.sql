-- TABELA USUÁRIO
CREATE TABLE usuario (
    id_usuario INT NOT NULL,
    nome VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL,
    senha VARCHAR(50) NOT NULL,
    perfil VARCHAR(150),
    data_cadastro TIMESTAMP,
    PRIMARY KEY (id_usuario)
);

-- TABELA CLIENTE
CREATE TABLE cliente (
    id_cliente INT NOT NULL,
    nome VARCHAR(150) NOT NULL,
    data_cadastro TIMESTAMP,
    PRIMARY KEY (id_cliente)
);

-- TABELA FUNCIONARIO
CREATE TABLE funcionario (
    id_funcionario INT NOT NULL,
    nome VARCHAR(150) NOT NULL,
    cargo VARCHAR(100) NOT NULL,
    perfil VARCHAR(100) NOT NULL,
    data_cadastro TIMESTAMP,
    PRIMARY KEY (id_funcionario)
);

-- TABELA CATEGORIA
CREATE TABLE categoria(
    id_categoria INT NOT NULL,
    nome VARCHAR(150) NOT NULL,
    data_cadastro TIMESTAMP,
    PRIMARY KEY (id_categoria)
);

-- TABELA EQUIPAMENTO
CREATE TABLE equipamento(
    id_equipamento INT NOT NULL,
    id_categoria INT NOT NULL,
    nome VARCHAR(150) NOT NULL,
    quantidade INT,
    categoria VARCHAR (100),
    data_cadastro TIMESTAMP,
    PRIMARY KEY (id_equipamento),
    FOREIGN KEY (id_categoria) REFERENCES categoria (id_categoria)
);

-- TABELA PROJETO
CREATE TABLE projeto(
    id_projeto INT NOT NULL,
    id_cliente INT NOT NULL,
    id_usuario INT NOT NULL,
    nome VARCHAR(150) NOT NULL,
    local TEXT,
    horario TIME,
    observacoes TEXT,
    data_ida DATE,
    data_volta DATE,
    data_cadastro TIMESTAMP,
    PRIMARY KEY (id_projeto),
    FOREIGN KEY (id_cliente) REFERENCES cliente (id_cliente),
    FOREIGN KEY (id_usuario) REFERENCES usuario (id_usuario)
);

-- TABELA PROJETO FUNCIONARIO NxN
CREATE TABLE projeto_funcionario(
    id_projeto_funcionario INT NOT NULL,
    id_projeto INT NOT NULL,
    id_funcionario INT NOT NULL,
    PRIMARY KEY (id_projeto_funcionario),
    FOREIGN KEY (id_projeto) REFERENCES projeto (id_projeto),
    FOREIGN KEY (id_funcionario) REFERENCES funcionario (id_funcionario)
);

-- TABELA PROJETO EQUIPAMENTO NxN
CREATE TABLE projeto_equipamento(
    id_projeto_equipamento INT NOT NULL,
    id_projeto INT NOT NULL,
    id_equipamento INT NOT NULL,
    PRIMARY KEY (id_projeto_equipamento),
    FOREIGN KEY (id_projeto) REFERENCES projeto (id_projeto),
    FOREIGN KEY (id_equipamento) REFERENCES equipamento (id_equipamento)
);