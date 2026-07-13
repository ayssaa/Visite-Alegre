USE VisiteAlegre;

-- =========================
-- CIDADE
-- Foco no município de Alegre-ES (região Caparaó)
-- =========================
INSERT INTO Cidade (nome, UF) VALUES
('Alegre', 'ES'),
('São Paulo', 'SP');

-- =========================
-- ENDERECO
-- Endereços distribuídos pela sede e distritos de Alegre
-- (Centro, Rive, Celina, Anutiba, Sobreiro)
-- =========================
INSERT INTO Endereco (idCidade, logradouro, numero, bairro, CEP) VALUES
(1, 'Rua XV de Novembro', NULL, 'Centro', '29500000'),
(1, 'Avenida Presidente Vargas', NULL, 'Vila Rica', '29500010'),
(1, 'Rua Coronel Marcondes', 145, 'Centro', '29500020'),
(1, 'Estrada do Pombal', NULL, 'Rive', '29520000'),
(1, 'ES-484 - Cachoeira da Fumaça', NULL, 'Araraí', '29535000'),
(1, 'Estrada Santa Clara', NULL, 'Zona Rural', '29500040'),
(1, 'Praça Nossa Senhora da Penha', NULL, 'Centro', '29500050'),
(1, 'Rua da Estação', 30, 'Centro', '29500060'),
(1, 'Distrito de Rive', NULL, 'Rive', '29520010'),
(1, 'Estrada São João do Norte', NULL, 'Zona Rural', '29500070'),
(1, 'Rua do Comércio', 88, 'Centro', '29500080'),
(1, 'Rua Dr. Bley', 50, 'Centro', '29500090'),
(1, 'Rua Duque de Caxias', 22, 'Anutiba', '29510000'),
(1, 'Rua Principal', 10, 'Celina', '29505000'),
(1, 'Avenida Rive', 300, 'Rive', '29520020'),
(1, 'Estrada do Sobreiro', 5, 'Sobreiro', '29515000'),
(1, 'Rua Barão do Rio Branco', 88, 'Centro', '29500100'),
(1, 'Rua José Costa', 15, 'Vila Rica', '29500110'),
(1, 'Rua Getúlio Vargas', 200, 'Centro', '29500120'),
(1, 'Rodovia ES-165, s/n', NULL, 'Zona Rural', '29500130'),
(1, 'Rua do Teatro', 12, 'Centro', '29500140'),
(2, 'Avenida Paulista', 1578, 'Bela Vista', '01310200'),
(2, 'Rua Vergueiro', 1000, 'Liberdade', '01504000'),
(2, 'Rua da Consolação', 2300, 'Consolação', '01302000');

-- =========================
-- USUARIO
-- =========================
INSERT INTO Usuario (idEndereco, nome, CPF, telefone, email, senha) VALUES
(12, 'João Ferreira', '11122233344', '28988887777', 'joao.ferreira@email.com', 'senha123'),
(13, 'Maria Gonçalves', '22233344455', '28977776666', 'maria.goncalves@email.com', 'senha456'),
(14, 'Carlos Teixeira', '33344455566', '28966665555', 'carlos.teixeira@email.com', 'senha789'),
(15, 'Ana Paiva', '44455566677', '28955554444', 'ana.paiva@email.com', 'senha321'),
(16, 'Pedro Monteiro', '55566677788', '28944443333', 'pedro.monteiro@email.com', 'senha654'),
(17, 'Fernanda Alcure', '66677788899', '28933332222', 'fernanda.alcure@email.com', 'senha987'),
(24, 'Rafael Sangi', '77788899900', '28922221111', 'rafael.sangi@email.com', 'senha159'),
(22, 'Ratopeira Pelado Silva', '88899900011', '28911110000', 'ratopeira.silva@email.com', 'peladinhoRato');

-- =========================
-- PONTOTURISTICO
-- Atrativos reais de Alegre-ES
-- =========================
INSERT INTO PontoTuristico (idEndereco, nome, descricao, taxaEntrada, telefone, site, horarioFuncionamentoInicio, horarioFuncionamentoFim) VALUES
(1, 'Cruzeiro de Alegre', 'Mirante elevado com vista panorâmica da cidade, ideal para contemplação e fotos', 0.00, NULL, NULL, '06:00:00', '20:00:00'),
(2, 'Mirante do Tio Branco', 'Monumento em homenagem aos imigrantes, com vista para montanhas e vales', 0.00, NULL, NULL, '06:00:00', '20:00:00'),
(3, 'Castelinho', 'Construção peculiar erguida pelo imigrante libanês Felício Alcure, inspirada em castelos do Oriente Médio', 0.00, '2837551122', NULL, '08:00:00', '17:00:00'),
(4, 'Pico do Pombal', 'Formação rochosa no distrito de Rive, ponto de montanhismo e trilhas', 0.00, NULL, NULL, '07:00:00', '17:00:00'),
(5, 'Parque Estadual da Cachoeira da Fumaça', 'Unidade de conservação criada em 1984, famosa pela queda d''água de 140 metros', 20.00, '2837551133', 'www.iema.es.gov.br', '08:00:00', '16:00:00'),
(6, 'Sítio Santa Clara', 'Santuário agroecológico com trilhas, rapel e vista panorâmica', 25.00, '2837551144', NULL, '08:00:00', '17:00:00'),
(7, 'Paróquia Nossa Senhora da Penha', 'Igreja de 1851 em estilo barroco e gótico, com vitrais que retratam a vida de Cristo', 0.00, '2837551155', NULL, '07:00:00', '19:00:00'),
(8, 'Estação Ferroviária de Alegre', 'Antiga estação da Leopoldina Railway, hoje sede da Biblioteca Municipal', 0.00, '2837551166', NULL, '08:00:00', '17:00:00'),
(9, 'CCAE - Centro de Ciências Agrárias e Engenharias (UFES)', 'Campus universitário voltado à pesquisa agropecuária e ambiental', 0.00, '2837551177', 'www.ccae.ufes.br', '08:00:00', '18:00:00'),
(10, 'Represa São João do Norte', 'Área natural às margens do rio Braço Norte, usada para lazer e pesca', 0.00, NULL, NULL, '00:00:00', '23:59:00'),
(11, 'Feira Livre de Alegre', 'Feira tradicional de produtos coloniais, frutas, queijos e comidas típicas', 0.00, NULL, NULL, '05:00:00', '13:00:00'),
(20, 'Parque de Exposições Geraldo Santos', 'Espaço multifuncional para feiras agropecuárias, shows e eventos culturais', 0.00, '2837551188', NULL, '08:00:00', '22:00:00'),
(21, 'Teatro Municipal Virgínia Santos', 'Teatro com programação de peças, música e eventos culturais', 10.00, '2837551199', NULL, '09:00:00', '22:00:00');

-- =========================
-- TURISTA (subtipo de Usuario)
-- =========================
INSERT INTO Turista (idTurista) VALUES
(1), (2), (3), (4), (6), (7);

-- =========================
-- AVALIACAO
-- =========================
INSERT INTO Avaliacao (idTurista, idPontoTuristico, comentario, nota, dataAvaliacao) VALUES
(1, 5, 'Cachoeira linda, trilha bem sinalizada', 5, '2026-03-10'),
(2, 3, 'Arquitetura impressionante, vale a visita', 4, '2026-04-15'),
(3, 7, 'Igreja muito bonita, vitrais lindos', 5, '2026-02-20'),
(4, 6, 'Rapel excelente, equipe muito atenciosa', 5, '2026-05-01'),
(1, 11, 'Feira com produtos frescos e preço justo', 4, '2026-06-11'),
(7, 4, 'Trilha exigente mas vista compensa', 4, '2026-01-25'),
(2, 1, 'Melhor lugar para ver o pôr do sol', 5, '2026-06-20');

-- =========================
-- EVENTO
-- =========================
INSERT INTO Evento (idPontoTuristico, dataEvento, taxaEntrada, tipoEvento, titulo) VALUES
(7, '2026-08-15 09:00:00', 0.00, 'Religioso', 'Festa de Nossa Senhora da Penha'),
(12, '2026-09-05 08:00:00', 0.00, 'Feira', 'Festa Agropecuária de Alegre'),
(13, '2026-10-12 19:30:00', 15.00, 'Cultural', 'Mostra de Teatro do Caparaó'),
(11, '2026-07-20 06:00:00', 0.00, 'Gastronômico', 'Feira de Produtos Coloniais');

-- =========================
-- LOCALHISTORICO (subtipo de PontoTuristico)
-- =========================
INSERT INTO LocalHistorico (idLocalHistorico, dataConstrucao, estiloArquitetonico) VALUES
(3, '1920-06-10', 'Inspirado em castelos do Oriente Médio'),
(7, '1851-01-01', 'Barroco e Gótico'),
(8, '1920-01-01', 'Ferroviário / Eclético');

-- =========================
-- GASTRONOMIA (subtipo de PontoTuristico)
-- =========================
INSERT INTO Gastronomia (idGastronomia, especialidade) VALUES
(11, 'Massas');

-- =========================
-- TRILHA (subtipo de PontoTuristico)
-- =========================
INSERT INTO Trilha (idTrilha, nivelDificuldade, distanciaKm, tempoEstimado) VALUES
(4, 4, 6, '04:00:00'),
(6, 3, 3, '02:30:00');

-- =========================
-- PARQUE (subtipo de PontoTuristico)
-- =========================
INSERT INTO Parque (idParque, areaTotal) VALUES
(5, 850000);

-- =========================
-- LOCALCIENTIFICO (subtipo de PontoTuristico)
-- =========================
INSERT INTO LocalCientifico (idLocalCientifico, areaPesquisa, instituicaoResponsavel) VALUES
(9, 'Agropecuária e Ciências Ambientais', 'UFES - Centro de Ciências Agrárias e Engenharias');

-- =========================
-- GUIA (subtipo de Usuario)
-- =========================
INSERT INTO Guia (idGuia, anoExperiencia) VALUES
(5, 4),
(8, 32);

-- =========================
-- ROTEIRO
-- =========================
INSERT INTO Roteiro (idGuia, dataRoteiro, localEncontro, capacidadeMaxima) VALUES
(5, '2026-07-15', 'Praça Nossa Senhora da Penha', 15),
(8, '2026-07-20', 'Entrada do Pico do Pombal', 10),
(5, '2026-08-01', 'Portaria do Sítio Santa Clara', 12);

-- =========================
-- AGENDAMENTO
-- =========================
INSERT INTO Agendamento (idTurista, idRoteiro) VALUES
(1, 1),
(2, 1),
(3, 2),
(4, 3),
(7, 3),
(1, 2);

-- =========================
-- ROTEIRO_PONTOTURISTICO
-- =========================
INSERT INTO Roteiro_PontoTuristico (idRoteiro, idPontoTuristico, tempoInicio, tempoFim) VALUES
(1, 7, '09:00:00', '10:00:00'),
(1, 8, '10:30:00', '11:30:00'),
(1, 1, '17:00:00', '18:00:00'),
(2, 4, '07:30:00', '12:00:00'),
(2, 2, '12:30:00', '13:30:00'),
(3, 6, '08:30:00', '13:00:00'),
(3, 5, '13:30:00', '16:00:00');