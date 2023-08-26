-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 26/08/2023 às 20:39
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `tg_05-012`
--
CREATE DATABASE IF NOT EXISTS `tg_05-012` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `tg_05-012`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `atiradores`
--

CREATE TABLE `atiradores` (
  `ID_ATDRS` int(11) NOT NULL,
  `Numero` int(11) NOT NULL,
  `NomeC` varchar(100) NOT NULL,
  `NomeG` varchar(100) NOT NULL,
  `NomePai` varchar(100) NOT NULL,
  `TelPai` varchar(100) NOT NULL,
  `NomeMae` varchar(100) NOT NULL,
  `TelMae` varchar(100) NOT NULL,
  `DataNasc` date NOT NULL,
  `LocalNasc` varchar(100) NOT NULL,
  `CPF` varchar(100) NOT NULL,
  `RG` varchar(100) NOT NULL,
  `Religiao` varchar(100) NOT NULL,
  `Escolaridade` varchar(100) NOT NULL,
  `NTituloEleitor` varchar(100) NOT NULL,
  `TipoSangue` varchar(100) NOT NULL,
  `Habilitacao` varchar(100) NOT NULL,
  `TelContato` varchar(100) NOT NULL,
  `Endereco` varchar(100) NOT NULL,
  `Profissao` varchar(100) NOT NULL,
  `HProfissao` varchar(100) NOT NULL,
  `CarteiraAss` varchar(50) NOT NULL,
  `RemuneracaoM` varchar(100) NOT NULL,
  `RendaF` varchar(100) NOT NULL,
  `NRa` varchar(100) NOT NULL,
  `Situacao` varchar(50) NOT NULL,
  `QtdsFaltas` int(100) NOT NULL,
  `Imagem` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `ID_turma` int(11) DEFAULT NULL,
  `DataCadastro` year(4) NOT NULL DEFAULT current_timestamp(),
  `TotalF` int(11) NOT NULL,
  `Marco` int(11) NOT NULL,
  `Abril` int(11) NOT NULL,
  `Maio` int(11) NOT NULL,
  `Junho` int(11) NOT NULL,
  `Julho` int(11) NOT NULL,
  `Agosto` int(11) NOT NULL,
  `Setembro` int(11) NOT NULL,
  `Outubro` int(11) NOT NULL,
  `Novembro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `atiradores`
--

INSERT INTO `atiradores` (`ID_ATDRS`, `Numero`, `NomeC`, `NomeG`, `NomePai`, `TelPai`, `NomeMae`, `TelMae`, `DataNasc`, `LocalNasc`, `CPF`, `RG`, `Religiao`, `Escolaridade`, `NTituloEleitor`, `TipoSangue`, `Habilitacao`, `TelContato`, `Endereco`, `Profissao`, `HProfissao`, `CarteiraAss`, `RemuneracaoM`, `RendaF`, `NRa`, `Situacao`, `QtdsFaltas`, `Imagem`, `ID_turma`, `DataCadastro`, `TotalF`, `Marco`, `Abril`, `Maio`, `Junho`, `Julho`, `Agosto`, `Setembro`, `Outubro`, `Novembro`) VALUES
(45, 1, 'Carlos Eduardo', 'Eduardo', 'Marcos', '9999999', 'Roberta', '9999999', '2023-07-13', 'Joinville-SC', '123123123123', '13123123123', 'Ateu', 'Ensino médio completo', '12312313123', 'A', 'Nada', '999999999', 'Rua João Pessoa', 'Nada', 'Nada', 'Não', 'Nada', '5000', '123123123', 'Ligado', 0, '', 1, '2023', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(47, 2, 'João', 'h', '2', '2', '2', '2', '2023-08-09', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '22', '2', 'Sim', '2', '2', '12', '', 0, '', 1, '2023', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(70, 1, 'MAtheus', 'A', 'a', 'a', 'a', 'a', '2023-08-17', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'Não', 'a', 'a', '1231231231', '', 0, '', 3, '2023', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `turma`
--

CREATE TABLE `turma` (
  `ID` int(11) NOT NULL,
  `QTDsATDR` int(11) NOT NULL,
  `Ano` int(11) NOT NULL,
  `ID_subtenentes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `turma`
--

INSERT INTO `turma` (`ID`, `QTDsATDR`, `Ano`, `ID_subtenentes`) VALUES
(1, 2, 2023, 0),
(2, 0, 2022, 0),
(3, 1, 2021, 2);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `atiradores`
--
ALTER TABLE `atiradores`
  ADD PRIMARY KEY (`ID_ATDRS`),
  ADD KEY `fk_ID_turma` (`ID_turma`);

--
-- Índices de tabela `turma`
--
ALTER TABLE `turma`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `atiradores`
--
ALTER TABLE `atiradores`
  MODIFY `ID_ATDRS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de tabela `turma`
--
ALTER TABLE `turma`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `atiradores`
--
ALTER TABLE `atiradores`
  ADD CONSTRAINT `fk_ID_turma` FOREIGN KEY (`ID_turma`) REFERENCES `turma` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
