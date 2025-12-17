-- Inserir organização
INSERT INTO organizacao (nome, contato) VALUES ('IF Eventos', 'contato@ifEventos.com');

-- Inserir local
INSERT INTO local (endereco, capacidade_total) VALUES ('Campus do IF', 5000);

-- Inserir evento
INSERT INTO evento (organizacao_id, local_id, nome, descricao, status, data_inicio, data_fim) 
VALUES (1, 1, 'TechFest 2025', 'Festival de Tecnologia', 'publicado', '2025-05-01 09:00:00', '2025-05-03 18:00:00');

-- Inserir setores
INSERT INTO setor (evento_id, nome, capacidade) VALUES 
(1, 'Pista', 2000),
(1, 'Arquibancada A', 1500),
(1, 'Arquibancada B', 1000),
(1, 'Camarote', 500);

-- Inserir lotes
INSERT INTO lote (setor_id, preco, periodo_vigencia_ini, periodo_vigencia_fim, limite, status) VALUES 
(1, 150.00, '2025-01-01 00:00:00', '2025-02-15 23:59:59', 100, 'ativo'),
(1, 180.00, '2025-02-16 00:00:00', '2025-03-31 23:59:59', 200, 'ativo'),
(2, 120.00, '2025-01-01 00:00:00', '2025-02-15 23:59:59', 150, 'ativo'),
(2, 140.00, '2025-02-16 00:00:00', '2025-03-31 23:59:59', 300, 'ativo'),
(3, 80.00, '2025-01-01 00:00:00', '2025-02-15 23:59:59', 100, 'ativo'),
(3, 100.00, '2025-02-16 00:00:00', '2025-03-31 23:59:59', 200, 'ativo'),
(4, 300.00, '2025-01-01 00:00:00', '2025-02-15 23:59:59', 50, 'ativo'),
(4, 350.00, '2025-02-16 00:00:00', '2025-03-31 23:59:59', 100, 'ativo');
