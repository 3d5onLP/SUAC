-- Criação do banco de dados
CREATE DATABASE IF NOT EXISTS suac_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE suac_db;

-- Tabela de usuários
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    matricula VARCHAR(20) UNIQUE NOT NULL,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    tipo ENUM('professor', 'aluno') NOT NULL,
    departamento VARCHAR(100),
    curso VARCHAR(100),
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ultimo_acesso TIMESTAMP NULL,
    ativo BOOLEAN DEFAULT TRUE
);

-- Tabela de áreas temáticas
CREATE TABLE areas_tematicas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT
);

-- Tabela de projetos
CREATE TABLE projetos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(200) NOT NULL,
    descricao TEXT NOT NULL,
    professor_id INT NOT NULL,
    area_tematica_id INT NOT NULL,
    data_inicio DATE NOT NULL,
    data_fim DATE,
    carga_horaria INT,
    vagas_disponiveis INT DEFAULT 1,
    status ENUM('aberto', 'em_andamento', 'concluido', 'cancelado') DEFAULT 'aberto',
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    data_atualizacao TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (professor_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (area_tematica_id) REFERENCES areas_tematicas(id)
);

-- Tabela de inscrições
CREATE TABLE inscricoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    aluno_id INT NOT NULL,
    projeto_id INT NOT NULL,
    data_inscricao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('pendente', 'aprovada', 'rejeitada') DEFAULT 'pendente',
    observacoes TEXT,
    FOREIGN KEY (aluno_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (projeto_id) REFERENCES projetos(id) ON DELETE CASCADE,
    UNIQUE KEY (aluno_id, projeto_id)
);

-- Tabela de mensagens
CREATE TABLE mensagens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    remetente_id INT NOT NULL,
    destinatario_id INT NOT NULL,
    projeto_id INT,
    assunto VARCHAR(200) NOT NULL,
    conteudo TEXT NOT NULL,
    data_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    lida BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (remetente_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (destinatario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (projeto_id) REFERENCES projetos(id) ON DELETE SET NULL
);

-- Tabela de documentos do projeto
CREATE TABLE documentos_projeto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    projeto_id INT NOT NULL,
    nome VARCHAR(200) NOT NULL,
    tipo VARCHAR(50) NOT NULL,
    caminho VARCHAR(255) NOT NULL,
    data_upload TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (projeto_id) REFERENCES projetos(id) ON DELETE CASCADE
);

-- Tabela de atividades do projeto
CREATE TABLE atividades_projeto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    projeto_id INT NOT NULL,
    titulo VARCHAR(200) NOT NULL,
    descricao TEXT,
    data_inicio DATE,
    data_fim DATE,
    status ENUM('pendente', 'em_andamento', 'concluida') DEFAULT 'pendente',
    FOREIGN KEY (projeto_id) REFERENCES projetos(id) ON DELETE CASCADE
);

-- Tabela de participantes do projeto (aprovados)
CREATE TABLE participantes_projeto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    projeto_id INT NOT NULL,
    aluno_id INT NOT NULL,
    data_inicio DATE NOT NULL,
    data_fim DATE,
    status ENUM('ativo', 'concluido', 'desistente') DEFAULT 'ativo',
    FOREIGN KEY (projeto_id) REFERENCES projetos(id) ON DELETE CASCADE,
    FOREIGN KEY (aluno_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    UNIQUE KEY (projeto_id, aluno_id)
);

-- Adicionar índices para melhorar a performance de consultas comuns
CREATE INDEX idx_projetos_area ON projetos(area_tematica_id);
CREATE INDEX idx_projetos_professor ON projetos(professor_id);
CREATE INDEX idx_projetos_status ON projetos(status);
CREATE INDEX idx_inscricoes_status ON inscricoes(status);
CREATE INDEX idx_mensagens_destinatario ON mensagens(destinatario_id, lida);

-- Inserir algumas áreas temáticas para testes
INSERT INTO areas_tematicas (nome, descricao) VALUES 
('Ciência da Computação', 'Projetos relacionados à computação, programação e sistemas'),
('Engenharia Elétrica', 'Projetos relacionados à eletricidade, eletrônica e automação'),
('Biologia', 'Projetos relacionados às ciências biológicas'),
('Química', 'Projetos relacionados às ciências químicas'),
('Física', 'Projetos relacionados às ciências físicas'),
('Matemática', 'Projetos relacionados à matemática e estatística'),
('Ciências Humanas', 'Projetos relacionados à filosofia, sociologia, história');

-- Inserir usuários de teste (senha: 123456)
INSERT INTO usuarios (matricula, nome, email, senha, tipo, departamento, curso) VALUES
('PROF001', 'João Silva', 'joao.silva@exemplo.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'professor', 'Departamento de Tecnologia', NULL),
('PROF002', 'Maria Santos', 'maria.santos@exemplo.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'professor', 'Departamento de Ciências', NULL),
('ALU001', 'Pedro Oliveira', 'pedro.oliveira@exemplo.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'aluno', NULL, 'Ciência da Computação'),
('ALU002', 'Ana Souza', 'ana.souza@exemplo.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'aluno', NULL, 'Engenharia Elétrica'),
('202322170010', 'Igor Gabriel', 'igor@exemplo.com', '123456', 'aluno', NULL, 'ADS'),
('202322170007', 'Edson Lopes', 'Edson@exemplo.com', '123456', 'aluno', NULL, 'ADS'),
('202322170011', 'Iago Bezerra', 'Iago@exemplo.com', '123456', 'aluno', NULL, 'ADS'),
('202322170025', 'Vitor Marques', 'Vitor@exemplo.com', '123456', 'aluno', NULL, 'ADS');

