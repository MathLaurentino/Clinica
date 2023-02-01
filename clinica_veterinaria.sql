-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01-Fev-2023 às 03:39
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `clinica_veterinaria`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `consulta`
--

CREATE TABLE `consulta` (
  `idconsulta` int(11) NOT NULL,
  `data_consulta` date NOT NULL,
  `horario_consulta` time NOT NULL,
  `descricao` varchar(500) NOT NULL,
  `sit_consulta` enum('A Confirmar','Confirmado','Concluido','Cancelado','Negado','Indeferido','A Cancelar') NOT NULL DEFAULT 'A Confirmar',
  `tipo_consulta` int(11) NOT NULL,
  `pet` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `consulta`
--

INSERT INTO `consulta` (`idconsulta`, `data_consulta`, `horario_consulta`, `descricao`, `sit_consulta`, `tipo_consulta`, `pet`) VALUES
(30, '2023-02-07', '15:00:00', 'Aparenta estar com dor nos dentes!', 'Confirmado', 21, 59),
(31, '2023-02-01', '16:00:00', '', 'Negado', 27, 58),
(32, '2023-02-03', '17:00:00', 'Apenas uma verificação anual!', 'A Cancelar', 23, 54),
(33, '2023-02-02', '17:00:00', 'Está com mau hálito', 'A Confirmar', 21, 56),
(34, '2023-02-07', '18:00:00', 'Está muito agitado. Precisa ser castrado para relaxar!', 'A Confirmar', 27, 53),
(35, '2023-02-09', '14:00:00', '', 'Cancelado', 21, 52),
(36, '2023-02-01', '18:00:00', 'Apenas um check up.', 'Confirmado', 24, 57),
(37, '2023-02-10', '15:00:00', 'Apenas um check up', 'A Cancelar', 23, 57);

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

CREATE TABLE `endereco` (
  `idendereco` int(11) NOT NULL,
  `cep` varchar(45) NOT NULL,
  `rua` varchar(90) NOT NULL,
  `numero_residencial` varchar(9) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `cidade` varchar(90) DEFAULT NULL,
  `estado` varchar(90) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `endereco`
--

INSERT INTO `endereco` (`idendereco`, `cep`, `rua`, `numero_residencial`, `bairro`, `cidade`, `estado`) VALUES
(62, '123434', '123', '123', '', 'Foz do Iguaçu', 'Parana'),
(79, '85861090', 'Rua Marmota Vila Residencial A', '260', 'Itaipu A', 'Foz do Iguaçu', 'PR'),
(80, '85863767', 'PR', '89', 'Foz do Iguaçu', 'Polo Centro', 'Rua Manoel Alves dos Santos Alto São Francisco'),
(82, '85861090', 'Rua Marmota', '260', 'Itaipu A', 'Foz do Iguaçu', 'PR'),
(87, '85861500', 'Rua Ourinhos Jardim Ana Cristina', '432', 'Lancaster', 'Foz do Iguaçu', 'PR');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pet`
--

CREATE TABLE `pet` (
  `idpet` int(11) NOT NULL,
  `nome_pet` varchar(45) NOT NULL,
  `data_nascimento_pet` date NOT NULL,
  `sexo` enum('Macho','Fêmea') NOT NULL,
  `imagem_pet` varchar(100) DEFAULT NULL,
  `imagem_carteira_pet` varchar(100) DEFAULT NULL,
  `idraca` int(11) NOT NULL,
  `usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `pet`
--

INSERT INTO `pet` (`idpet`, `nome_pet`, `data_nascimento_pet`, `sexo`, `imagem_pet`, `imagem_carteira_pet`, `idraca`, `usuario`) VALUES
(52, 'Luna', '2022-01-01', 'Fêmea', '63d9a14f8244e.jpg', NULL, 14, 90),
(53, 'Dumbo', '2022-01-01', 'Macho', '63d9a1709132f.jpg', NULL, 14, 90),
(54, 'Luna', '2020-01-01', 'Fêmea', '63d9a1a6900d5.jpg', NULL, 14, 100),
(55, 'Leona', '2017-01-01', 'Fêmea', '63d9a1c672719.jpg', NULL, 24, 100),
(56, 'Sofia', '2017-01-01', 'Fêmea', '63d9a1e81cd1e.jpg', NULL, 24, 100),
(57, 'Luna', '2018-01-01', 'Fêmea', '63d9a232b2853.jpg', NULL, 14, 104),
(58, 'Branquinha', '2018-10-01', 'Fêmea', '63d9a360e7af7.jpg', NULL, 14, 112),
(59, 'Mel', '2017-10-01', 'Fêmea', '63d9a37a0648d.jpg', NULL, 14, 112);

-- --------------------------------------------------------

--
-- Estrutura da tabela `raca_pet`
--

CREATE TABLE `raca_pet` (
  `idraca_pet` int(11) NOT NULL,
  `raca` varchar(45) NOT NULL,
  `tipo_pet` enum('cachorro','gato','ave') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `raca_pet`
--

INSERT INTO `raca_pet` (`idraca_pet`, `raca`, `tipo_pet`) VALUES
(5, 'pomerânia', 'cachorro'),
(6, 'bulldog francês', 'cachorro'),
(7, 'shih tzu', 'cachorro'),
(8, 'rottweiler', 'cachorro'),
(9, 'pug', 'cachorro'),
(10, 'golden retriever', 'cachorro'),
(11, 'pastor alemão', 'cachorro'),
(12, 'yorkshire terrier', 'cachorro'),
(13, 'bolder collie', 'cachorro'),
(14, 'srd (sem raça definida)', 'cachorro'),
(15, 'persa', 'gato'),
(16, 'siamês', 'gato'),
(17, 'maine coon', 'gato'),
(18, 'angorá', 'gato'),
(19, 'sphynx', 'gato'),
(20, 'ragdoll', 'gato'),
(21, 'ashera', 'gato'),
(22, 'american shorthair', 'gato'),
(23, 'exótico', 'gato'),
(24, 'srd (sem raça definida)', 'gato'),
(25, 'canário', 'ave'),
(26, 'calopsita', 'ave'),
(27, 'diamante de gould', 'ave'),
(28, 'diamante mandarim', 'ave'),
(29, 'manon', 'ave'),
(30, 'periquito', 'ave'),
(31, 'galinha', 'ave'),
(32, 'papagaio', 'ave'),
(33, 'cacatua', 'ave'),
(34, 'srd (sem raça definida)', 'ave'),
(35, 'outra', 'cachorro'),
(36, 'outra', 'gato'),
(37, 'outra', 'ave');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_consulta`
--

CREATE TABLE `tipo_consulta` (
  `idtipo_consulta` int(11) NOT NULL,
  `nome_consulta` varchar(45) NOT NULL,
  `valor_consulta` float NOT NULL,
  `descricao_consulta` varchar(220) NOT NULL,
  `sit_tipo_consulta` enum('Ativo','Inativo') NOT NULL DEFAULT 'Inativo',
  `tempo_medio` time NOT NULL,
  `foto_servico` varchar(220) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `tipo_consulta`
--

INSERT INTO `tipo_consulta` (`idtipo_consulta`, `nome_consulta`, `valor_consulta`, `descricao_consulta`, `sit_tipo_consulta`, `tempo_medio`, `foto_servico`) VALUES
(21, 'Consulta Dentária', 150, 'Exame como dentista veterinário                   ', 'Ativo', '01:00:00', '63c9a565bc521.png'),
(23, 'Exame De Sangue', 180, 'Exame sanguíneo do animal para verificar a saúde', 'Ativo', '01:00:00', '63acb6b131bcd.png'),
(24, 'Consulta Médica', 200, 'Avaliação geral do animal por uma médico veterinário geral    ', 'Ativo', '02:00:00', '63acde444571f.png'),
(27, 'Castração', 500, 'cirurgia de castração', 'Ativo', '02:00:00', '63b1e4393353d.png'),
(31, 'Teste1', 150, 'teste1', 'Inativo', '02:00:00', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nome_usuario` varchar(90) NOT NULL,
  `cpf` varchar(15) NOT NULL,
  `rg` varchar(15) NOT NULL,
  `data_nascimento` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `tipo_usuario` enum('mantenedor','cliente') NOT NULL,
  `sit_usuario` enum('Ativo','Inativo','Confirmando') NOT NULL DEFAULT 'Confirmando',
  `endereco` int(11) DEFAULT NULL,
  `foto_usuario` varchar(100) DEFAULT NULL,
  `senha_usuario` varchar(300) NOT NULL,
  `chave` varchar(220) DEFAULT NULL,
  `recuperar_senha` varchar(220) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nome_usuario`, `cpf`, `rg`, `data_nascimento`, `email`, `tipo_usuario`, `sit_usuario`, `endereco`, `foto_usuario`, `senha_usuario`, `chave`, `recuperar_senha`) VALUES
(1, 'maria', '123', '123', '2022-09-28', 'maria@clinica.com', 'mantenedor', 'Ativo', 62, NULL, '$2y$10$Q6pkE2iA9fepKpF6EJqJeufYRIpjSQYxW5pmycYhfGiAbC7FCOQtS', NULL, NULL),
(90, 'João Pedro Sgobero', '07894971406', '28289054898', '2000-11-29', 'joao@clinica.com', 'cliente', 'Ativo', 80, '63d9a12daaf26.jpg', '$2y$10$plYrgyWpu8TS.EEIQud7ZO4dP6/1m2/nnmr/9sGvRtrgcbAIhpKX6', NULL, '$2y$10$bk8puB4NlYTf86Y7uOuCj.dD11y4C3JAEeza08/dihsbt8Akqo2yy'),
(100, 'Matheus Laurentino', '07894971405', '6749209475', '2003-11-29', 'matheus@clinica.com', 'cliente', 'Ativo', 79, '63d9a18a44987.jpg', '$2y$10$qPn34zTeSm3jlurOPONB8OVbBYNDCEvvoJHTqnYcQq0knQU7QNGr6', NULL, NULL),
(104, 'Nicolas Herculano', '07894971423', '12345564543', '2001-02-02', 'nicolas@clinica.com', 'cliente', 'Ativo', 82, '63d9a20d4c5c4.jpg', '$2y$10$sUC4H/Iq1ejtbZMQiDvytubR33xtpPIiUxp/POou/iAPt2.JgvIji', NULL, NULL),
(112, 'Lara Alanis', '03012402055', '679243578', '2004-07-21', 'lara@clinica.com', 'cliente', 'Ativo', 87, '63d9af2078284.jpg', '$2y$10$ZMDUKOoRVyMdCLWnCHoL0O6dZnZGLqHiJL/8meCcxKLdgHM1xomHS', NULL, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `consulta`
--
ALTER TABLE `consulta`
  ADD PRIMARY KEY (`idconsulta`),
  ADD KEY `tipo_consulta_idx` (`tipo_consulta`),
  ADD KEY `pet` (`pet`);

--
-- Índices para tabela `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`idendereco`);

--
-- Índices para tabela `pet`
--
ALTER TABLE `pet`
  ADD PRIMARY KEY (`idpet`),
  ADD KEY `raca_pet_idx` (`idraca`),
  ADD KEY `usuario_idx` (`usuario`);

--
-- Índices para tabela `raca_pet`
--
ALTER TABLE `raca_pet`
  ADD PRIMARY KEY (`idraca_pet`);

--
-- Índices para tabela `tipo_consulta`
--
ALTER TABLE `tipo_consulta`
  ADD PRIMARY KEY (`idtipo_consulta`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `idEndereco_idx` (`endereco`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `consulta`
--
ALTER TABLE `consulta`
  MODIFY `idconsulta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de tabela `endereco`
--
ALTER TABLE `endereco`
  MODIFY `idendereco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT de tabela `pet`
--
ALTER TABLE `pet`
  MODIFY `idpet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT de tabela `raca_pet`
--
ALTER TABLE `raca_pet`
  MODIFY `idraca_pet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de tabela `tipo_consulta`
--
ALTER TABLE `tipo_consulta`
  MODIFY `idtipo_consulta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `consulta`
--
ALTER TABLE `consulta`
  ADD CONSTRAINT `pet` FOREIGN KEY (`pet`) REFERENCES `pet` (`idpet`),
  ADD CONSTRAINT `tipo_consulta` FOREIGN KEY (`tipo_consulta`) REFERENCES `tipo_consulta` (`idtipo_consulta`);

--
-- Limitadores para a tabela `pet`
--
ALTER TABLE `pet`
  ADD CONSTRAINT `raca_pet` FOREIGN KEY (`idraca`) REFERENCES `raca_pet` (`idraca_pet`),
  ADD CONSTRAINT `usuario` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`idusuario`);

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `idEndereco` FOREIGN KEY (`endereco`) REFERENCES `endereco` (`idendereco`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
