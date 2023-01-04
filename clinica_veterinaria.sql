-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 05-Jan-2023 às 00:39
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

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
  `descricao` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sit_consulta` enum('A Confirmar','Confirmado','Concluido','Cancelado','Negado') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A Confirmar',
  `tipo_consulta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `consulta`
--

INSERT INTO `consulta` (`idconsulta`, `data_consulta`, `horario_consulta`, `descricao`, `sit_consulta`, `tipo_consulta`) VALUES
(11, '2023-01-04', '12:00:00', ' SCD', 'A Confirmar', 21),
(12, '2023-01-05', '18:00:00', ' Fica latindo quando come, acho que ta doente', 'A Confirmar', 24);

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

CREATE TABLE `endereco` (
  `idendereco` int(11) NOT NULL,
  `cep` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rua` varchar(90) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero_residencial` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bairro` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cidade` varchar(90) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(90) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `endereco`
--

INSERT INTO `endereco` (`idendereco`, `cep`, `rua`, `numero_residencial`, `bairro`, `cidade`, `estado`) VALUES
(62, '123434', '123', '123', '', 'Foz do Iguaçu', 'Parana'),
(66, '123', 'rua barbosa', '4321324', '', 'Foz do Iguaçu', 'Parana'),
(72, '12345435', 'rua marmota', '268', '', 'Foz do Iguaçu', 'Parana'),
(73, '85857740', 'Avenida Paranaa', '123', '', 'Foz do Iguaçu', 'Parana'),
(75, '85861090', 'Rua Marmota Vila Residencial A', '123', 'Itaipu A', 'Foz do Iguaçu', 'PR'),
(76, '85861090', 'Rua Marmota Vila Residencial A', '544', 'Itaipu A', 'Foz do Iguaçu', 'PR'),
(77, '85861090', 'Rua Marmota Vila Residencial A', '262', 'Itaipu A', 'Foz do Iguaçu', 'PR'),
(78, '85861090', 'Rua Marmota Vila Residencial A', '260', 'Itaipu A', 'Foz do Iguaçu', 'PR');

-- --------------------------------------------------------

--
-- Estrutura da tabela `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(220) DEFAULT NULL,
  `color` varchar(10) DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `events`
--

INSERT INTO `events` (`id`, `title`, `color`, `start`, `end`) VALUES
(17, 'vacina2', '#8B4513', '2023-01-01 17:00:00', '2023-01-01 16:00:00'),
(9, 'Tutorial', '#228B22', '2023-01-01 12:00:00', '2023-01-01 13:00:00'),
(10, 'Tutorial 2', '#FF4500', '2019-09-13 15:10:10', '2019-09-13 17:15:15'),
(11, 'ReuniÃ£o 15', '#436EEE', '2019-10-09 15:30:00', '2019-10-09 17:00:00'),
(16, 'vacina', '#8B4513', '2022-12-31 15:00:00', '2022-12-31 16:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pet`
--

CREATE TABLE `pet` (
  `idpet` int(11) NOT NULL,
  `nome_pet` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idade_pet` int(11) NOT NULL,
  `sexo` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagem_pet` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imagem_carteira_pet` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idraca` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `consulta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `pet`
--

INSERT INTO `pet` (`idpet`, `nome_pet`, `idade_pet`, `sexo`, `imagem_pet`, `imagem_carteira_pet`, `idraca`, `usuario`, `consulta`) VALUES
(38, 'sofia', 5, 'feminino', NULL, NULL, 24, 90, NULL),
(39, 'Luna Alves', 2, 'feminino', '63b1e2333bfa5.png', NULL, 14, 99, NULL),
(40, 'Luna', 2, 'feminino', NULL, NULL, 14, 90, 12),
(41, 'sofia', 2, 'feminino', NULL, NULL, 24, 1, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `raca_pet`
--

CREATE TABLE `raca_pet` (
  `idraca_pet` int(11) NOT NULL,
  `raca` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_pet` enum('cachorro','gato','ave') COLLATE utf8mb4_unicode_ci NOT NULL
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
(34, 'srd (sem raça definida)', 'ave');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_consulta`
--

CREATE TABLE `tipo_consulta` (
  `idtipo_consulta` int(11) NOT NULL,
  `nome_consulta` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valor_consulta` float NOT NULL,
  `descricao_consulta` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempo_medio` time NOT NULL,
  `foto_servico` varchar(220) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `tipo_consulta`
--

INSERT INTO `tipo_consulta` (`idtipo_consulta`, `nome_consulta`, `valor_consulta`, `descricao_consulta`, `tempo_medio`, `foto_servico`) VALUES
(21, 'Consulta Dentária', 150, 'Exame como dentista veterinário             ', '01:30:00', '63add46fb3e08.png'),
(23, 'Exame De Sangue', 180, 'Exame sanguíneo do animal para verificar a saúde', '01:00:00', '63acb6b131bcd.png'),
(24, 'Consulta Médica', 200, 'Avaliação geral do animal por uma médico veterinário geral    ', '02:00:00', '63acde444571f.png'),
(27, 'Castração', 500, 'çaornoadfv', '02:00:00', '63b1e4393353d.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nome_usuario` varchar(90) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cpf` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rg` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_nascimento` date NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_usuario` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo_usuario` enum('mantenedor','cliente') COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha_usuario` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chave` varchar(220) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sit_usuario` enum('Ativo','Inativo','Confirmando') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Confirmando',
  `endereco` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nome_usuario`, `cpf`, `rg`, `data_nascimento`, `email`, `foto_usuario`, `tipo_usuario`, `senha_usuario`, `chave`, `sit_usuario`, `endereco`) VALUES
(1, 'maria', '123', '123', '2022-09-28', 'maria@maria.com', NULL, 'mantenedor', '$2y$10$Q6pkE2iA9fepKpF6EJqJeufYRIpjSQYxW5pmycYhfGiAbC7FCOQtS', NULL, 'Ativo', 62),
(90, 'João Pedro Sgobero', '07894971406', '28289054898', '2000-11-29', 'joao@joao.com', '63ab4fb2dfc08.jpg', 'cliente', '$2y$10$0KBkP2jOcze/XeQhXxHeG.n.PE4CNAxLVxv3Oyb8gE5R4v0XnWgMu', '$2y$10$AeyKCfce0ndyuFJk23eKZuaYWcbvLK6J5tU02DqOGbt1NVoa6GREC', 'Ativo', 77),
(97, 'mathes1', '22222', '33333', '2000-11-29', 'matheus1@gmail.com', NULL, 'cliente', '$2y$10$/NKXTJiu3kbIHfKpq34zHe9Cje6FFtrlDNW3bIz5NDXQOkaXBTFv6', '$2y$10$NadA97fX/1sKD2OUiH.6devWLcGdfCC6hKKTkc81hyr.NC1dXlVqa', 'Ativo', NULL),
(98, 'Marcos Barbosa Vieira', '32311285523', '12344537', '1963-07-25', 'marcos@marcos.com', NULL, 'cliente', '$2y$10$CxdAn1iPbrZ1YbTDGQHJjuUEDes/QmH9J7YcZYPkNJy1SPpfte.1S', '$2y$10$C1M1jEZA6U.sxfdKaaRS.eXJcrUMZvJiCKNQsoE5zvYJJhcow.m6.', 'Ativo', NULL),
(99, 'Iluska Maria', '08927345', '0789125364', '1975-11-12', 'iluska@iluska.com', NULL, 'cliente', '$2y$10$F2T009VRDk3w7lfbje76z.1RT3y5QCMNxz0FvkRMWJ3F/8G6hs/Iy', '$2y$10$LXkwDBOnuJMH7Uiimb5YNul/qXypQQIsC0FhSgZWhehgMTeaZofIK', 'Ativo', 78);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `consulta`
--
ALTER TABLE `consulta`
  ADD PRIMARY KEY (`idconsulta`),
  ADD KEY `tipo_consulta_idx` (`tipo_consulta`);

--
-- Índices para tabela `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`idendereco`);

--
-- Índices para tabela `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `pet`
--
ALTER TABLE `pet`
  ADD PRIMARY KEY (`idpet`),
  ADD KEY `raca_pet_idx` (`idraca`),
  ADD KEY `consulta_idx` (`consulta`),
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
  MODIFY `idconsulta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `endereco`
--
ALTER TABLE `endereco`
  MODIFY `idendereco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT de tabela `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `pet`
--
ALTER TABLE `pet`
  MODIFY `idpet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de tabela `raca_pet`
--
ALTER TABLE `raca_pet`
  MODIFY `idraca_pet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de tabela `tipo_consulta`
--
ALTER TABLE `tipo_consulta`
  MODIFY `idtipo_consulta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `consulta`
--
ALTER TABLE `consulta`
  ADD CONSTRAINT `tipo_consulta` FOREIGN KEY (`tipo_consulta`) REFERENCES `tipo_consulta` (`idtipo_consulta`);

--
-- Limitadores para a tabela `pet`
--
ALTER TABLE `pet`
  ADD CONSTRAINT `consulta` FOREIGN KEY (`consulta`) REFERENCES `consulta` (`idconsulta`),
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
