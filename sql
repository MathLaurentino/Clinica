-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07-Dez-2022 às 21:01
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
  `horario_consulta` date NOT NULL,
  `descricao` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_consulta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(57, '85861070', 'rua marmotaa', '12334', '', 'Foz do Iguaçu', 'Parana'),
(58, '', '', '', '', '', ''),
(59, '', '', '', '', '', ''),
(60, '', '', '', '', '', ''),
(61, '123123', 'rua marmota', '543', '', 'Foz do Iguaçu', 'Parana'),
(62, '123', '123', '123', '', 'Foz do Iguaçu', 'Parana'),
(63, '123', 'rua marmota', '123', '', 'Foz do Iguaçu', 'Parana'),
(64, '', '', '', '', '', ''),
(65, '', '', '', '', '', ''),
(66, '123', 'rua barbosa', '4321324', '', 'Foz do Iguaçu', 'Parana'),
(67, '123123', 'rua marmota', '543', '', 'Foz do Iguaçu', 'Parana'),
(68, '', '', '', '', '', ''),
(69, '', '', '', '', '', ''),
(71, '123125', 'Avenida Brasil', '3567', '', 'Natal', 'Rio Grande Do Norte'),
(72, '12345435', 'rua marmota', '268', '', 'Foz do Iguaçu', 'Parana'),
(73, '85857740', 'Avenida Paranaa', '123', '', 'Foz do Iguaçu', 'Parana'),
(74, '85861090', 'Rua Marmota Vila Residencial A', '1234', 'Itaipu A', 'Foz do Iguaçu', 'PR'),
(75, '85861090', 'Rua Marmota Vila Residencial A', '123', 'Itaipu A', 'Foz do Iguaçu', 'PR');

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
(20, 'Luna', 2, 'feminino', NULL, NULL, 14, 61, NULL),
(21, 'leona', 4, 'feminino', NULL, NULL, 24, 61, NULL),
(22, 'sofia', 5, 'feminino', NULL, NULL, 24, 61, NULL),
(25, 'Luna', 2, 'feminino', NULL, NULL, 14, 69, NULL),
(26, 'passarinhozinho', 8, 'masculino', NULL, NULL, 29, 69, NULL),
(27, 'Luna', 5, 'feminino', NULL, NULL, 19, 69, NULL),
(29, 'Luna', 7, 'feminino', NULL, NULL, 14, 69, NULL),
(30, 'felipinho jr', 2, 'feminino', NULL, '6390c1252891a.jpg', 20, 70, NULL),
(31, 'sofia', 1, 'feminino', NULL, NULL, 24, 66, NULL);

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
  `descricao_consulta` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `tipo_consulta`
--

INSERT INTO `tipo_consulta` (`idtipo_consulta`, `nome_consulta`, `valor_consulta`, `descricao_consulta`) VALUES
(4, 'consulta', 300, ''),
(5, 'exame', 200, ''),
(18, 'vacina', 200, 'aplicação de vacina '),
(20, 'banho', 80, 'banho');

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
  `endereco` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nome_usuario`, `cpf`, `rg`, `data_nascimento`, `email`, `foto_usuario`, `tipo_usuario`, `senha_usuario`, `endereco`) VALUES
(1, 'maria', '123', '123', '2022-09-28', 'maria@maria.com', '', 'mantenedor', '$2y$10$Q6pkE2iA9fepKpF6EJqJeufYRIpjSQYxW5pmycYhfGiAbC7FCOQtS', 62),
(60, 'iluska', '4321', '4321', '2022-11-08', 'iluska@iluska.com', NULL, 'cliente', '$2y$10$MjsH5jxemFZWxIA5YySri.S6ApN9lk8UrU5tj.6cB862zHA.XDRGG', 65),
(61, 'gohan', '8729472052', '12348646295', '2022-11-23', 'goran@goran.com', NULL, 'cliente', '$2y$10$u8cAQIxi3Z6lTNT7NS7z/OCIjiqSRCnPwpoF5KkdLwQLOubrqtj4C', 66),
(62, 'goku', '1541123985', '524392637', '2022-11-29', 'goku@goku.com', NULL, 'cliente', '$2y$10$lqVZq2QxoIuH080/q6lXPetGlLlVi99roDHi2Su46CkJexr5AL/2m', 67),
(63, 'videl', '123453749576', '2651583675', '2022-11-08', 'videl@videl.com', NULL, 'cliente', '$2y$10$NnCmzXapmkgXJ3JdD1TKtuvbCopnlcgebOxfjUStQCteJNjJaZoFi', 68),
(64, 'vegeta', '1254336784253', '123457345612543', '2022-11-14', 'vegeta@vegeta.com', NULL, 'cliente', '$2y$10$4xMXO7zipkQpe6qTCCe3f.wwVM35npvPCshuYKtX2QLxh5zFkka/.', 69),
(66, 'felipe', '0698967', '098478', '2022-11-15', 'felipe@felipe.com', NULL, 'cliente', '$2y$10$O4yaRah0XzSCIRFSvq3x0.J/HewlyawMF.QMY7Wv.a3GR7saWsONO', 73),
(67, 'Joao', '241352756', '154256', '2022-11-16', 'joao@joao.com', NULL, 'cliente', '$2y$10$6NbGeS2YHUJpbexQS05y9ObGcKMpNAIyNA6Zl1amMJf8yq8Ee65M.', 71),
(69, 'Matheus Laurentino', '07894971405', '1234515', '2003-11-29', 'matheus.laurentino.ifpr@gmail.com', '6390ee3ef40fb.jpg', 'cliente', '$2y$10$gtFPrdb.10ozqRKcWq8WlO7TSKMEbn./WB37vZiSrEpZlgmOLwNQG', 72),
(70, 'Nicolas', '123123123', '123123123', '2022-11-19', 'nicolas@nicolas.com', NULL, 'cliente', '$2y$10$m25VFAo9W2TJj7lK7mKe4.Ocr1Q54b6GnBM57nOfJCaKEgNTPBp9u', 75),
(71, 'vitoria', '123321123321', '123321123321', '2000-11-29', 'vitoria@vitoria.com', NULL, 'cliente', '$2y$10$QsTaH8wVhwBkjOvszZb1leq5MjHF7xb6oyY7XTlYgu/2uNYCO2Ona', 74),
(78, 'matheus1', '123', '123', '0000-00-00', 'matheus1@matheus.com', NULL, 'cliente', '$2y$10$uCdvLzlu4NuJ/t.4DwO7xOVgMS6Go90TuFdp.xSCwZldqwIwGz88K', NULL);

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
  MODIFY `idconsulta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `endereco`
--
ALTER TABLE `endereco`
  MODIFY `idendereco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT de tabela `pet`
--
ALTER TABLE `pet`
  MODIFY `idpet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de tabela `raca_pet`
--
ALTER TABLE `raca_pet`
  MODIFY `idraca_pet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de tabela `tipo_consulta`
--
ALTER TABLE `tipo_consulta`
  MODIFY `idtipo_consulta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

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
