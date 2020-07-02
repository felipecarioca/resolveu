-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 02-Jul-2020 às 02:16
-- Versão do servidor: 10.1.39-MariaDB
-- versão do PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `resolveu`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(12) NOT NULL,
  `nome` varchar(32) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `email` varchar(64) DEFAULT NULL,
  `cep` varchar(12) NOT NULL,
  `fone` varchar(16) DEFAULT NULL,
  `senha` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nome`, `cpf`, `email`, `cep`, `fone`, `senha`) VALUES
(1, 'Felipe Pereira', '03377821058', 'felipe.lfpm@gmail.com', '90620-110', '(51) 99620-3669', '1234'),
(2, 'Guilherme', '03377821058', 'guilherme@gmail.com', '90620-110', '(51) 99620-3669', '1234');

-- --------------------------------------------------------

--
-- Estrutura da tabela `orcamento`
--

CREATE TABLE `orcamento` (
  `id_orcamento` int(12) NOT NULL,
  `descricao` text,
  `id_cliente` int(11) NOT NULL,
  `cep` varchar(12) NOT NULL,
  `id_tipo_servico` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `orcamento`
--

INSERT INTO `orcamento` (`id_orcamento`, `descricao`, `id_cliente`, `cep`, `id_tipo_servico`) VALUES
(1, 'Olá! Quero fazer um orçamento', 2, '90620110', 1),
(2, 'Olá! Quero fazer um orçamento', 2, '90620110', 1),
(3, 'Olá! Quero fazer um orçamento!!! Meu tenis estragou', 2, '90620110', 1),
(4, 'Olá! Quero fazer um orçamento!!! Meu tenis estragou', 2, '90620110', 1),
(5, 'Olá! Quero fazer um orçamento!!! Meu tenis estragou', 2, '90620110', 1),
(6, 'Olá! Quero fazer um orçamento!!! Meu tenis estragou', 2, '90620110', 1),
(7, 'Olá! Quero fazer um orçamento!!! Meu tenis estragou', 2, '90620110', 1),
(8, 'Olá! Quero fazer um orçamento!!! Meu tenis estragou', 2, '90620110', 1),
(9, 'Olá! Quero fazer um orçamento!!! Meu tenis estragou', 2, '90620110', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `prestador`
--

CREATE TABLE `prestador` (
  `id_prestador` int(12) NOT NULL,
  `nome` varchar(32) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `email` varchar(64) DEFAULT NULL,
  `cep` varchar(12) NOT NULL,
  `fone` varchar(16) DEFAULT NULL,
  `senha` varchar(256) NOT NULL,
  `id_tipo_servico` int(5) DEFAULT NULL,
  `endereco` varchar(256) DEFAULT NULL,
  `empresa` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `prestador`
--

INSERT INTO `prestador` (`id_prestador`, `nome`, `cpf`, `email`, `cep`, `fone`, `senha`, `id_tipo_servico`, `endereco`, `empresa`) VALUES
(1, 'Jorge', '03377821058', 'jorge@gmail.com', '90620-110', '(51) 99620-3669', '1234', 1, 'Avenida Bento Gonçalves, 1800, Porto Alegre - Rio Grande do Sul', 'Sapateria do Jorge'),
(2, 'Ricardo', '03377821058', 'ricardo@gmail.com', '90620-110', '(51) 99620-3669', '1234', 1, NULL, NULL),
(3, 'Luiz', '03377821058', 'luiz@gmail.com', '90620-110', '(51) 99620-3669', '1234', 1, NULL, NULL),
(4, 'José', '03377821058', 'jose@gmail.com', '90620-110', '(51) 99620-3669', '1234', 2, NULL, NULL),
(5, 'Fulano da Silva', '0000000000', 'email@agm.com', '90620110', '2312312312', '132431231513125v', 1, 'Avenida ATl 1111', 'Sapataria do Fulano');

-- --------------------------------------------------------

--
-- Estrutura da tabela `servico`
--

CREATE TABLE `servico` (
  `id_servico` int(12) NOT NULL,
  `id_cliente` int(12) NOT NULL,
  `id_prestador` int(12) NOT NULL,
  `id_tipo_servico` int(12) NOT NULL,
  `id_status_servico` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `solicitacao`
--

CREATE TABLE `solicitacao` (
  `id_solicitacao` int(12) NOT NULL,
  `id_orcamento` int(12) NOT NULL,
  `id_prestador` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `solicitacao`
--

INSERT INTO `solicitacao` (`id_solicitacao`, `id_orcamento`, `id_prestador`) VALUES
(1, 9, 1),
(2, 9, 2),
(3, 9, 3),
(4, 9, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `status_servico`
--

CREATE TABLE `status_servico` (
  `id_status_servico` int(12) NOT NULL,
  `descricao` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_servico`
--

CREATE TABLE `tipo_servico` (
  `id_tipo_servico` int(12) NOT NULL,
  `descricao` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tipo_servico`
--

INSERT INTO `tipo_servico` (`id_tipo_servico`, `descricao`) VALUES
(1, 'Sapateiro'),
(2, 'Mecânico');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indexes for table `orcamento`
--
ALTER TABLE `orcamento`
  ADD PRIMARY KEY (`id_orcamento`),
  ADD KEY `orcamento_ibfk_1` (`id_cliente`);

--
-- Indexes for table `prestador`
--
ALTER TABLE `prestador`
  ADD PRIMARY KEY (`id_prestador`),
  ADD KEY `id_tipo_servico` (`id_tipo_servico`);

--
-- Indexes for table `servico`
--
ALTER TABLE `servico`
  ADD PRIMARY KEY (`id_servico`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_prestador` (`id_prestador`),
  ADD KEY `id_tipo_servico` (`id_tipo_servico`),
  ADD KEY `id_status_servico` (`id_status_servico`);

--
-- Indexes for table `solicitacao`
--
ALTER TABLE `solicitacao`
  ADD PRIMARY KEY (`id_solicitacao`),
  ADD KEY `solicitacao_ibfk_1` (`id_orcamento`),
  ADD KEY `solicitacao_ibfk_2` (`id_prestador`);

--
-- Indexes for table `status_servico`
--
ALTER TABLE `status_servico`
  ADD PRIMARY KEY (`id_status_servico`);

--
-- Indexes for table `tipo_servico`
--
ALTER TABLE `tipo_servico`
  ADD PRIMARY KEY (`id_tipo_servico`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orcamento`
--
ALTER TABLE `orcamento`
  MODIFY `id_orcamento` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `prestador`
--
ALTER TABLE `prestador`
  MODIFY `id_prestador` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `servico`
--
ALTER TABLE `servico`
  MODIFY `id_servico` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `solicitacao`
--
ALTER TABLE `solicitacao`
  MODIFY `id_solicitacao` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `status_servico`
--
ALTER TABLE `status_servico`
  MODIFY `id_status_servico` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tipo_servico`
--
ALTER TABLE `tipo_servico`
  MODIFY `id_tipo_servico` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `orcamento`
--
ALTER TABLE `orcamento`
  ADD CONSTRAINT `orcamento_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`);

--
-- Limitadores para a tabela `prestador`
--
ALTER TABLE `prestador`
  ADD CONSTRAINT `prestador_ibfk_1` FOREIGN KEY (`id_tipo_servico`) REFERENCES `tipo_servico` (`id_tipo_servico`);

--
-- Limitadores para a tabela `servico`
--
ALTER TABLE `servico`
  ADD CONSTRAINT `servico_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`),
  ADD CONSTRAINT `servico_ibfk_2` FOREIGN KEY (`id_prestador`) REFERENCES `prestador` (`id_prestador`),
  ADD CONSTRAINT `servico_ibfk_3` FOREIGN KEY (`id_tipo_servico`) REFERENCES `tipo_servico` (`id_tipo_servico`),
  ADD CONSTRAINT `servico_ibfk_4` FOREIGN KEY (`id_status_servico`) REFERENCES `status_servico` (`id_status_servico`);

--
-- Limitadores para a tabela `solicitacao`
--
ALTER TABLE `solicitacao`
  ADD CONSTRAINT `solicitacao_ibfk_1` FOREIGN KEY (`id_orcamento`) REFERENCES `orcamento` (`id_orcamento`),
  ADD CONSTRAINT `solicitacao_ibfk_2` FOREIGN KEY (`id_prestador`) REFERENCES `prestador` (`id_prestador`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
