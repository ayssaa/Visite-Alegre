CREATE DATABASE VisiteAlegre;
USE VisiteAlegre;

CREATE TABLE Cidade
(
  idCidade INTEGER AUTO_INCREMENT NOT NULL,
  nome VARCHAR(45) NOT NULL,
  UF VARCHAR(2) NOT NULL,
  CONSTRAINT pkCidade PRIMARY KEY (idCidade)
);

CREATE TABLE Endereco
(
  idEndereco INTEGER AUTO_INCREMENT NOT NULL,
  idCidade INTEGER NOT NULL,
  logradouro VARCHAR(200) NOT NULL,
  numero INTEGER,
  bairro VARCHAR(45) NOT NULL,
  CEP VARCHAR(8) NOT NULL,
  CONSTRAINT pkEndereco PRIMARY KEY (idEndereco),
  CONSTRAINT fkEnderecoCidade FOREIGN KEY (idCidade) REFERENCES Cidade (idCidade)
);

CREATE TABLE Usuario
(
  idUsuario INTEGER AUTO_INCREMENT NOT NULL,
  idEndereco INTEGER NOT NULL,
  nome VARCHAR(200) NOT NULL,
  CPF VARCHAR(11) UNIQUE NOT NULL,
  telefone VARCHAR(11) NOT NULL,
  email VARCHAR(45) UNIQUE NOT NULL,
  senha VARCHAR(45) NOT NULL,
  CONSTRAINT pkUsuario PRIMARY KEY (idUsuario),
  CONSTRAINT fkUsuarioEndereco FOREIGN KEY (idEndereco) REFERENCES Endereco (idEndereco)
);

CREATE TABLE PontoTuristico
(
  idPontoTuristico INTEGER AUTO_INCREMENT NOT NULL,
  idEndereco INTEGER NOT NULL,
  nome VARCHAR(200) NOT NULL,
  descricao VARCHAR(200),
  taxaEntrada DECIMAL(5,2) DEFAULT 0 NOT NULL,
  telefone VARCHAR(11),
  site VARCHAR(200),
  horarioFuncionamentoInicio TIME NOT NULL,
  horarioFuncionamentoFim TIME NOT NULL,
  CONSTRAINT pkPontoTuristico PRIMARY KEY (idPontoTuristico),
  CONSTRAINT fkPontoTuristicoEndereco FOREIGN KEY (idEndereco) REFERENCES Endereco (idEndereco)
);

CREATE TABLE Turista
(
  idTurista INTEGER NOT NULL,
  CONSTRAINT pkTurista PRIMARY KEY (idTurista),
  CONSTRAINT fkTuristaUsuario FOREIGN KEY (idTurista) REFERENCES Usuario (idUsuario)
);

CREATE TABLE Avaliacao 
(
  idAvaliacao INTEGER AUTO_INCREMENT NOT NULL,
  idTurista INTEGER NOT NULL,
  idPontoTuristico INTEGER NOT NULL,
  comentario VARCHAR(200),
  nota INTEGER(1) NOT NULL,
  dataAvaliacao DATE NOT NULL,
  CONSTRAINT pkAvaliacao PRIMARY KEY (idAvaliacao),
  CONSTRAINT fkAvaliacaoTurista FOREIGN KEY (idTurista) REFERENCES Turista (idTurista),
  CONSTRAINT fkAvaliacaoPontoTuristico FOREIGN KEY (idPontoTuristico) REFERENCES PontoTuristico (idPontoTuristico)
);

CREATE TABLE Evento
(
  idEvento INTEGER AUTO_INCREMENT NOT NULL,
  idPontoTuristico INTEGER NOT NULL,
  dataEvento DATETIME NOT NULL,
  taxaEntrada DECIMAL(5,2) DEFAULT 0 NOT NULL,
  tipoEvento VARCHAR(45) NOT NULL,
  titulo VARCHAR(200) NOT NULL,
  CONSTRAINT pkEvento PRIMARY KEY (idEvento),
  CONSTRAINT fkEventoPontoTuristico FOREIGN KEY (idPontoTuristico) REFERENCES PontoTuristico (idPontoTuristico)
);


CREATE TABLE LocalHistorico(
  idLocalHistorico INTEGER NOT NULL,
  dataConstrucao DATE NOT NULL,
  estiloArquitetonico VARCHAR(45) NOT NULL,
  CONSTRAINT pkLocalHistorico PRIMARY KEY (idLocalHistorico),
  CONSTRAINT fkLocalHistoricoPontoTuristico FOREIGN KEY (idLocalHistorico) REFERENCES PontoTuristico (idPontoTuristico)
);

CREATE TABLE Gastronomia (
  idGastronomia INTEGER NOT NULL,
  especialidade VARCHAR(45),
  CONSTRAINT pkGastronomia PRIMARY KEY (idGastronomia),
  CONSTRAINT fkGastronomiaPontoTuristico FOREIGN KEY (idGastronomia) REFERENCES PontoTuristico (idPontoTuristico)
);

CREATE TABLE Trilha
(
  idTrilha INTEGER NOT NULL,
  nivelDificuldade INTEGER(1) NOT NULL,
  distanciaKm INTEGER,
  tempoEstimado TIME NOT NULL,
  CONSTRAINT pkTrilha PRIMARY KEY (idTrilha),
  CONSTRAINT fkTrilhaPontoTuristico FOREIGN KEY (idTrilha) REFERENCES PontoTuristico (idPontoTuristico)
);

CREATE TABLE Parque
(
  idParque INTEGER NOT NULL,
  areaTotal INTEGER NOT NULL,
  CONSTRAINT pkParque PRIMARY KEY (idParque),
  CONSTRAINT fkParquePontoTuristico FOREIGN KEY (idParque) REFERENCES PontoTuristico (idPontoTuristico)
);

CREATE TABLE LocalCientifico
(
  idLocalCientifico INTEGER NOT NULL,
  areaPesquisa VARCHAR(45),
  instituicaoResponsavel VARCHAR(200),
  CONSTRAINT pkLocalCientifico PRIMARY KEY (idLocalCientifico),
  CONSTRAINT fkLocalCientificoPontoTuristico FOREIGN KEY (idLocalCientifico) REFERENCES PontoTuristico (idPontoTuristico)
);

CREATE TABLE Guia
(
  idGuia INTEGER NOT NULL,
  anoExperiencia INTEGER NOT NULL,
  CONSTRAINT pkGuia PRIMARY KEY (idGuia),
  CONSTRAINT fkGuiaUsuario FOREIGN KEY (idGuia) REFERENCES Usuario (idUsuario)
);

CREATE TABLE Roteiro
(
  idRoteiro INTEGER AUTO_INCREMENT NOT NULL,
  idGuia INTEGER NOT NULL,
  dataRoteiro DATE NOT NULL,
  localEncontro VARCHAR(200) NOT NULL,
  capacidadeMaxima INTEGER NOT NULL,
  CONSTRAINT pkRoteiro PRIMARY KEY (idRoteiro),
  CONSTRAINT fkRoteiroGuia FOREIGN KEY (idGuia) REFERENCES Guia (idGuia)
);

CREATE TABLE Agendamento
(
  idTurista INTEGER NOT NULL,
  idRoteiro INTEGER NOT NULL,
  CONSTRAINT pkAgendamento PRIMARY KEY (idRoteiro, idTurista),
  CONSTRAINT fkAgendamentoTurista FOREIGN KEY (idTurista) REFERENCES Turista (idTurista),
  CONSTRAINT fkAgendamentoRoteiro FOREIGN KEY (idRoteiro) REFERENCES Roteiro (idRoteiro)
);

CREATE TABLE Roteiro_PontoTuristico 
(
  idRoteiro INTEGER NOT NULL,
  idPontoTuristico INTEGER NOT NULL,
  tempoInicio TIME NOT NULL,
  tempoFim TIME NOT NULL,
  CONSTRAINT pkRoteiro_PontoTuristico PRIMARY KEY (idRoteiro, idPontoTuristico),
  CONSTRAINT fkRoteiro_PontoTuristicoRoteiro FOREIGN KEY (idRoteiro) REFERENCES Roteiro (idRoteiro),
  CONSTRAINT fkRoteiro_PontoTuristicoPontoTuristico FOREIGN KEY (idPontoTuristico) REFERENCES PontoTuristico (idPontoTuristico)
);