-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24/06/2024 às 14:50
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cadastroteste`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `ID` int(100) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `numero` varchar(20) NOT NULL,
  `data_cadastro` date DEFAULT NULL,
  `empresa` varchar(100) DEFAULT NULL,
  `produto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`ID`, `nome`, `email`, `numero`, `data_cadastro`, `empresa`, `produto`) VALUES
(64, 'Ana Nery', 'ascendinomartins2303@gmail.com', '11-96374-2196', '2024-06-21', 'AllaVipt', 'Produto teste'),
(66, 'Edileide', 'aninha@gmail.com', '11-85651-4862', '2024-06-23', '21312312 swwdasd', 'Produto23123123');

-- --------------------------------------------------------

--
-- Estrutura para tabela `empresas`
--

CREATE TABLE `empresas` (
  `empresa` varchar(200) NOT NULL,
  `id` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `empresas`
--

INSERT INTO `empresas` (`empresa`, `id`) VALUES
('empresaLouca', 6),
('21312312 swwdasd', 7),
('21312312 swwdasd321321', 8);

-- --------------------------------------------------------

--
-- Estrutura para tabela `meses_info`
--

CREATE TABLE `meses_info` (
  `id` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `nome_mes` varchar(20) NOT NULL,
  `informacao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `meses_info`
--

INSERT INTO `meses_info` (`id`, `mes`, `nome_mes`, `informacao`) VALUES
(1, 1, 'Janeiro', NULL),
(2, 2, 'Fevereiro', NULL),
(3, 3, 'Março', NULL),
(4, 4, 'Abril', NULL),
(5, 5, 'Maio', NULL),
(6, 6, 'Junho', NULL),
(7, 7, 'Julho', NULL),
(8, 8, 'Agosto', NULL),
(9, 9, 'Setembro', NULL),
(10, 10, 'Outubro', NULL),
(11, 11, 'Novembro', NULL),
(12, 12, 'Dezembro', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto`
--

CREATE TABLE `produto` (
  `id` int(100) NOT NULL,
  `produto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produto`
--

INSERT INTO `produto` (`id`, `produto`) VALUES
(7, 'Produto'),
(8, '4123'),
(9, 'Produto2'),
(10, 'Produto23123123'),
(11, 'teste1235512342321');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `foto_perfil` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`username`, `email`, `password`, `foto_perfil`) VALUES
('Felippi', 'ascendinomartins2303@gmail.com', '123', 'uploads/solluxImg.jpg'),
('funcionarioManeiro', 'funcionarioHomestuck@gmail.com', '1234', NULL),
('felippi', 'ascendinomartins2303@gmail.com', '123', NULL),
('user', 'jcloves.junior@gmail.com', '123', NULL),
('Felippi', 'ascendinomartins2303@gmail.comf', '123', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`ID`);

--
-- Índices de tabela `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `meses_info`
--
ALTER TABLE `meses_info`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT de tabela `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `meses_info`
--
ALTER TABLE `meses_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
